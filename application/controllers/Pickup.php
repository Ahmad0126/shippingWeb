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
		$this->template->load('layout/template', 'bagasi_index', 'Pickup Barang');
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
	public function tambah(){
		if($this->M_cabang->simpan()){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil menambahkan cabang', 'success'));
			redirect(base_url('cabang'));
		}else{
			$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Tidak dapat menambahkan cabang", 'error'));
			$this->session->set_flashdata('error', $this->template->buat_alert(validation_errors(), 'danger'));
			redirect(base_url('cabang'));
		}
	}
	public function edit(){
		if($this->M_cabang->edit()){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil mengedit cabang', 'success'));
			redirect(base_url('cabang'));
		}else{
			$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Tidak dapat menambahkan cabang", 'error'));
			$this->session->set_flashdata('error', $this->template->buat_alert(validation_errors(), 'danger'));
			redirect(base_url('cabang'));
		}
	}
	public function hapus(){
		foreach ($this->input->post('id_user') as $id) {
			$this->M_cabang->delete($id);
		}
		$msg = [
			'title' => 'GAGAL',
			'msg' => 'Tidak dapat menghapus cabang',
			'type' => 'danger',
		];
		if($this->input->post('id_cabang') != null){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil menghapus cabang', 'success'));
			$msg = [
				'title' => 'OK',
				'msg' => 'Berhasil menghapus cabang',
				'type' => 'success',
			];
		}
		echo json_encode($msg);
	}
}
