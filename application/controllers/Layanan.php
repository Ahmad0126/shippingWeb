<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layanan extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') != 'Admin'){
			$this->session->set_flashdata('username', $this->template->buat_alert('Silahkan Login Dahulu', 'warning'));
			redirect(base_url('auth'));
		}
		$this->load->model('M_layanan');
	}
	public function index(){
		$data['layanan'] = $this->M_layanan->get_layanan();
		$this->template->load('layout/template', 'layanan_index', 'Daftar Layanan', $data);
	}
	public function tambah(){
		if($this->M_layanan->simpan()){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil menambahkan layanan', 'success'));
			redirect(base_url('layanan'));
		}else{
			$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Tidak dapat menambahkan layanan", 'error'));
			$this->session->set_flashdata('error', $this->template->buat_alert(validation_errors(), 'danger'));
			redirect(base_url('layanan'));
		}
	}
	public function edit(){
		if($this->M_layanan->edit()){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil mengedit layanan', 'success'));
			redirect(base_url('layanan'));
		}else{
			$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Tidak dapat mengedit layanan", 'error'));
			$this->session->set_flashdata('error', $this->template->buat_alert(validation_errors(), 'danger'));
			redirect(base_url('layanan'));
		}
	}
	public function hapus(){
		foreach ($this->input->post('id_user') as $id) {
			$this->M_layanan->delete($id);
		}
		$msg = [
			'title' => 'GAGAL',
			'msg' => 'Tidak dapat menghapus layanan',
			'type' => 'danger',
		];
		if($this->input->post('id_layanan') != null){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil menghapus layanan', 'success'));
			$msg = [
				'title' => 'OK',
				'msg' => 'Berhasil menghapus layanan',
				'type' => 'success',
			];
		}
		echo json_encode($msg);
	}
}
