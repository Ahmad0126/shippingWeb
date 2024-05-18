<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == null){
			$this->session->set_flashdata('username', $this->template->buat_alert('Silahkan Login Dahulu', 'warning'));
			redirect(base_url('auth'));
		}
		if($this->session->userdata('data_cabang')->fasilitas != 'Warehouse'){
			$this->session->set_flashdata('alert', $this->template->buat_alert('Masuk fasilitas warehouse terlebih dahulu!', 'danger'));
			redirect(base_url());
		}
		$this->load->model('M_histori');
	}
	public function index(){
		$this->load->model('M_pengiriman');
		$data['url'] = 'warehouse';
		$data['barang'] = $this->M_pengiriman->get_pengiriman_inventory('received_warehouse', false);
		$data['forwarded'] = $this->M_pengiriman->get_pengiriman_inventory('forwarded', false);
		$this->template->load('layout/template', 'barang_index', 'Warehouse Barang', $data);
	}
	public function pick_barang(){
		if($this->M_histori->buat('Diterima di Warehouse', 'received_warehouse')){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil mengambil barang', 'success'));
			redirect(base_url('warehouse'));
		}else{
			$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Tidak dapat mengambil barang", 'error'));
			redirect(base_url('warehouse'));
		}
	}
	public function forward(){
		$kode = explode(',', $this->input->post('kode_pengiriman'));
		$this->load->model('M_pengiriman');
		$barang = $this->M_pengiriman->get_pengiriman_inventory('received_warehouse', false);
		foreach ($kode as $k) {
			$cek = in_array($k, array_column($barang, 'kode_pengiriman'));
			if(!$cek){
				$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Barang tidak ada di gudang", 'error'));
				redirect(base_url('warehouse'));
			}
			$this->M_histori->forward('Diteruskan ke Warehouse', $k, $this->input->post('kode_cabang'));
		}
		$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil meneruskan barang', 'success'));
		redirect(base_url('warehouse'));
	}
	public function hapus(){
		foreach ($this->input->post('id_user') as $kode) {
			$this->M_histori->delete($kode, 'received_warehouse');
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
			$this->M_histori->buat('Diterima di Warehouse', 'received_warehouse', $kode);
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
