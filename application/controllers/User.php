<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
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
			$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Tidak dapat menambahkan user", 'error'));
			$this->session->set_flashdata('error', $this->template->buat_alert(validation_errors(), 'danger'));
			redirect(base_url('user'));
		}
	}
	public function reset(){
		$this->M_user->reset();
	}
	public function hapus($id){
		if($this->M_user->delete($id)){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil menghapus user', 'success'));
			redirect(base_url('user'));
		}else{
			$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Tidak dapat menambahkan user", 'error'));
			redirect(base_url('user'));
		}
	}
}
