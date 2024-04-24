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
			$this->session->set_flashdata($this->template->buat_notif('GAGAL', "Tidak dapat menambahkan user", 'error'));
			redirect(base_url('user'));
		}
	}
}
