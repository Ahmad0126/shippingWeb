<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sorting extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') != 'Admin' && $this->session->userdata('level') != 'Officer'){ 
			$this->session->set_flashdata('username', $this->template->buat_alert('Silahkan Login Dahulu', 'warning'));
			redirect(base_url('auth'));
		}
		if($this->session->userdata('data_cabang')->fasilitas != 'Sorting Center'){
			$this->session->set_flashdata('alert', $this->template->buat_alert('Masuk fasilitas sorting center terlebih dahulu!', 'danger'));
			redirect(base_url());
		}
		$this->load->model('M_histori');
	}
	public function index(){
		$this->load->model('M_pengiriman');
		$data['url'] = 'sorting';
		$data['barang'] = $this->M_pengiriman->get_pengiriman_inventory('received_sort', false);
		$data['forwarded'] = $this->M_pengiriman->get_pengiriman_inventory('forwarded', false);
		$this->template->load('layout/template', 'barang_index', 'Sorting Barang', $data);
	}
	public function pick_barang(){
		if($this->M_histori->buat('Diterima di Sorting Center', 'received_sort')){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil mengambil barang', 'success'));
			redirect(base_url('sorting'));
		}else{
			$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Tidak dapat mengambil barang", 'error'));
			redirect(base_url('sorting'));
		}
	}
	public function forward(){
		$kode = explode(',', $this->input->post('kode_pengiriman'));
		$this->load->model('M_pengiriman');
		$barang = $this->M_pengiriman->get_pengiriman_inventory('received_sort', false);
		foreach ($kode as $k) {
			$cek = in_array($k, array_column($barang, 'kode_pengiriman'));
			if(!$cek){
				$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Barang tidak ada di gudang", 'error'));
				redirect(base_url('sorting'));
			}
			$this->M_histori->forward('Diteruskan ke Gateway', $k, $this->input->post('kode_cabang'));
		}
		$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil meneruskan barang', 'success'));
		redirect(base_url('sorting'));
	}
	public function hapus(){
		foreach ($this->input->post('id_user') as $kode) {
			$this->M_histori->delete($kode, 'received_sort');
		}
		$msg = [
			'title' => 'GAGAL',
			'msg' => 'Tidak dapat membatalkan pickup',
			'type' => 'danger',
		];
		if($this->input->post('id_user') != null){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil membatalkan pickup', 'success'));
			$msg = [
				'title' => 'OK',
				'msg' => 'Berhasil membatalkan pickup',
				'type' => 'success',
			];
		}
		echo json_encode($msg);
	}
	public function accept(){
		foreach ($this->input->post('id_user') as $kode) {
			$this->M_histori->buat('Diterima di Sorting Center', 'received_sort', $kode);
		}
		$msg = [
			'title' => 'GAGAL',
			'msg' => 'Tidak dapat menerima barang',
			'type' => 'danger',
		];
		if($this->input->post('id_user') != null){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil menerima barang', 'success'));
			$msg = [
				'title' => 'OK',
				'msg' => 'Berhasil menerima barang',
				'type' => 'success',
			];
		}
		echo json_encode($msg);
	}
}
