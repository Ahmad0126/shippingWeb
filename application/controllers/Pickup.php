<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pickup extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == null){
			$this->session->set_flashdata('username', $this->template->buat_alert('Silahkan Login Dahulu', 'warning'));
			redirect(base_url('auth'));
		}
		$this->load->model('M_histori');
	}
	public function index(){
		$this->load->model('M_pengiriman');
		$data['barang'] = $this->M_pengiriman->get_pengiriman_inventory($this->session->userdata('id'), 'delivery');
		$this->template->load('layout/template', 'bagasi_index', 'Pickup Barang', $data);
	}
	public function pick_barang(){
		if($this->M_histori->pickup()){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil mengambil barang', 'success'));
			redirect(base_url('pickup'));
		}else{
			$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Tidak dapat mengambil barang", 'error'));
			redirect(base_url('pickup'));
		}
	}
	public function hapus(){
		foreach ($this->input->post('id_user') as $kode) {
			$this->M_histori->delete($kode, 'delivery');
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
}
