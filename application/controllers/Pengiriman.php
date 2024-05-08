<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengiriman extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == null){
			redirect(base_url('auth'));
		}
		$this->load->model('M_pengiriman');
	}
	public function index(){
		$data['pengiriman'] = $this->M_pengiriman->get_pengiriman();
		$this->template->load('layout/template', 'pengiriman_index', 'Daftar Pengiriman', $data);
	}
	public function daftar(){
		$this->load->model('M_layanan');
	 	$data['layanan'] = $this->M_layanan->get_layanan();
		$this->template->load('layout/template', 'pengiriman_daftar', 'Daftar Pengiriman', $data);
	}
	public function tambah(){
		if($this->M_pengiriman->simpan()){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil menambahkan pengiriman', 'success'));
			redirect(base_url('pengiriman'));
		}else{
			$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Tidak dapat menambahkan pengiriman", 'error'));
			$this->session->set_flashdata('error', $this->template->buat_alert(validation_errors(), 'danger'));
			redirect(base_url('pengiriman'));
		}
	}
}
