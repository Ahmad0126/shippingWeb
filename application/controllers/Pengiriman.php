<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengiriman extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') != 'Admin' && $this->session->userdata('level') != 'Kasir'){ 
			$this->session->set_flashdata('username', $this->template->buat_alert('Silahkan Login Dahulu', 'warning'));
			redirect(base_url('auth'));
		}
		if($this->session->userdata('data_cabang')->fasilitas != 'Office'){
			$this->session->set_flashdata('alert', $this->template->buat_alert('Masuk kantor office terlrbih dahulu!', 'danger'));
			redirect(base_url());
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
			$this->session->set_flashdata('error', $this->template->buat_alert(validation_errors().$this->session->flashdata('custom_error'), 'danger'));
			redirect(base_url('pengiriman'));
		}
	}
	public function checkout(){
		if($this->input->get('kode_pengiriman') == null){
			$this->session->set_flashdata('alert', $this->template->buat_notif('ERROR', "Tidak ada pengiriman yang dipilih", 'error'));
			redirect(base_url('pengiriman'));
		}
		$data['pengiriman'] = array();
		$total = 0;
		foreach ($this->input->get('kode_pengiriman') as $k) {
			$p = $this->M_pengiriman->get_pengiriman_by_kode($k);
			if($p == null){
				$this->session->set_flashdata('alert', $this->template->buat_notif('WOY!', "Pengiriman tidak terdaftar!", 'error'));
				redirect(base_url('pengiriman'));
			}
			if($p->status != 'registered'){
				$this->session->set_flashdata('alert', $this->template->buat_notif('NGAPAIN?', "Pengiriman sudah di-checkout!", 'error'));
				redirect(base_url('pengiriman'));
			}
			$total += $p->ongkir;
			array_push($data['pengiriman'], $p);
		}
		$data['total'] = $total;
		$this->template->load('layout/template', 'pengiriman_checkout', 'Checkout Pengiriman', $data);
	}
	public function nota(){
		if($this->input->get('p') == null){
			$this->session->set_flashdata('alert', $this->template->buat_notif('ERROR', "Tidak ada nota yang dipilih", 'error'));
			redirect(base_url('pengiriman'));
		}
		$data['nota'] = $this->M_pengiriman->get_nota_pengiriman($this->input->get('p'));
		$data['pengiriman'] = $this->M_pengiriman->get_pengiriman_by_nota($this->input->get('p'));
		$this->template->load('layout/template', 'pengiriman_nota', 'Nota Pengiriman', $data);
	}
	public function process(){
		if($this->M_pengiriman->checkout()){
			$this->session->set_flashdata('alert', $this->template->buat_notif('OK', 'Berhasil mencheckout pengiriman', 'success'));
			redirect(base_url('pengiriman'));
		}else{
			$this->session->set_flashdata('alert', $this->template->buat_notif('GAGAL', "Tidak dapat mencheckout pengiriman", 'error'));
			$this->session->set_flashdata('error', $this->template->buat_alert(validation_errors(), 'danger'));
			redirect(base_url('pengiriman'));
		}
	}
	public function detail(){
		if($this->input->get('p') == null){
			$this->session->set_flashdata('alert', $this->template->buat_notif('ERROR', "Tidak ada pengiriman yang dipilih", 'error'));
			redirect(base_url('pengiriman'));
		}
		$data['pengiriman'] = $this->M_pengiriman->get_detail_pengiriman($this->input->get('p'));
		if($data['pengiriman'] == null){
			$this->session->set_flashdata('alert', $this->template->buat_notif('WOY!', "Pengiriman tidak terdaftar!", 'error'));
			redirect(base_url('pengiriman'));
		}
		$data['histori'] = $this->M_pengiriman->get_histori_pengiriman($this->input->get('p'));
		$this->template->load('layout/template', 'pengiriman_detail', 'Detail Pengiriman', $data);
	}
}
