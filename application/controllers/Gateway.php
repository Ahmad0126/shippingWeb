<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gateway extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') != 'Admin' && $this->session->userdata('level') != 'Officer'){ 
			$this->session->set_flashdata('username', $this->template->buat_alert('Silahkan Login Dahulu', 'warning'));
			redirect(base_url('auth'));
		}
		if($this->session->userdata('data_cabang')->fasilitas != 'Gateway'){
			$this->session->set_flashdata('alert', $this->template->buat_alert('Masuk fasilitas gateway terlebih dahulu!', 'danger'));
			redirect(base_url());
		}
		$this->load->model('M_histori');
	}
	public function index(){
		$this->load->model('M_pengiriman');
		$data['url'] = 'gateway';
		$data['barang'] = $this->M_pengiriman->get_pengiriman_inventory('received_origin', false);
		$data['forwarded'] = $this->M_pengiriman->get_pengiriman_inventory('forwarded', false);
		$this->template->load('layout/template', 'barang_index', 'Gateway Barang', $data);
	}
	public function pick_barang(){
		if($this->M_histori->buat('Diterima di Gateway Asal', 'received_origin')){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil mengambil barang', 'success'));
			redirect(base_url('gateway'));
		}else{
			$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Tidak dapat mengambil barang", 'error'));
			redirect(base_url('gateway'));
		}
	}
	public function forward(){
		$kode = explode(',', $this->input->post('kode_pengiriman'));
		$this->load->model('M_pengiriman');
		$barang = $this->M_pengiriman->get_pengiriman_inventory('received_origin', false);
		foreach ($kode as $k) {
			$cek = in_array($k, array_column($barang, 'kode_pengiriman'));
			if(!$cek){
				$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Barang tidak ada di gudang", 'error'));
				redirect(base_url('gateway'));
			}
			$this->M_histori->forward('Diteruskan ke Warehouse', $k, $this->input->post('kode_cabang'));
		}
		$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil meneruskan barang', 'success'));
		redirect(base_url('gateway'));
	}
	public function hapus(){
		foreach ($this->input->post('id_user') as $kode) {
			$this->M_histori->delete($kode, 'received_origin');
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
			$this->M_histori->buat('Diterima di Gateway asal', 'received_origin', $kode);
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
