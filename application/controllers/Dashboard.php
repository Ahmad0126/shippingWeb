<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->userdata('level') == null){
			$this->session->set_flashdata('username', $this->template->buat_alert('Silahkan Login Dahulu', 'warning'));
			redirect(base_url('auth'));
		}
	}
	public function index(){
		$this->template->load('layout/template', 'dashboard', 'Dashboard');
	}
}
