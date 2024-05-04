<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') != 'Admin'){
			$this->session->set_flashdata('username', $this->template->buat_alert('Silahkan Login Dahulu', 'warning'));
			redirect(base_url('auth'));
		}
		$this->load->model('M_user');
	}
	public function index(){
		$data['user'] = $this->M_user->get_user();
		$this->template->load('layout/template', 'user_index', 'Daftar User', $data);
	}
	public function tambah(){
		if($this->M_user->simpan()){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil menambahkan user', 'success'));
			redirect(base_url('user'));
		}else{
			$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Tidak dapat menambahkan user", 'error'));
			$this->session->set_flashdata('error', $this->template->buat_alert(validation_errors(), 'danger'));
			redirect(base_url('user'));
		}
	}
	public function edit(){
		if($this->M_user->edit()){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil mengedit user', 'success'));
			redirect(base_url('user'));
		}else{
			$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Tidak dapat mengedit user", 'error'));
			$this->session->set_flashdata('error', $this->template->buat_alert(validation_errors(), 'danger'));
			redirect(base_url('user'));
		}
	}
	public function reset(){
		foreach ($this->input->post('id_user') as $id) {
			$this->M_user->reset($id);
		}
		$msg = [
			'title' => 'GAGAL',
			'msg' => 'Tidak dapat mereset user',
			'type' => 'danger',
		];
		if($this->input->post('id_user') != null){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil mereset user', 'success'));
			$msg = [
				'title' => 'OK',
				'msg' => 'Berhasil mereset user',
				'type' => 'success',
			];
		}
		echo json_encode($msg);
	}
	public function hapus(){
		foreach ($this->input->post('id_user') as $id) {
			$this->M_user->delete($id);
		}
		$msg = [
			'title' => 'GAGAL',
			'msg' => 'Tidak dapat menghapus user',
			'type' => 'danger',
		];
		if($this->input->post('id_user') != null){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil menghapus user', 'success'));
			$msg = [
				'title' => 'OK',
				'msg' => 'Berhasil menghapus user',
				'type' => 'success',
			];
		}
		echo json_encode($msg);
	}
}
