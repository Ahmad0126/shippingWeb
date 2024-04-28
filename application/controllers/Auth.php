<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{
    public function index(){
        $this->load->view('login');
    }
    public function login(){
        $this->load->model('M_user');
        $user = $this->input->post('username');
        $pass = $this->input->post('password');

        $data = $this->M_user->getwup_user($user);
        if($data){
            if($data['password'] == md5($pass)){
                $this->session->set_userdata('level', $data['level']);
                $this->session->set_userdata('id', $data['id_user']);
                $this->session->set_userdata('nama', $data['nama']);
                $this->session->set_userdata('username', $data['username']);
                // $this->session->set_userdata('profil', $data['profil']);
                redirect(base_url());
            }else{
                $this->session->set_flashdata('username_val', $user);
                $this->session->set_flashdata('password', $this->template->buat_alert('Password Salah!', 'danger'));
                redirect(base_url('auth'));
            }
        }else{
            $this->session->set_flashdata('username_val', $user);
            $this->session->set_flashdata('username', $this->template->buat_alert('Username tidak terdaftar!', 'danger'));
            redirect(base_url('auth'));
        }
    }
    public function logout(){
        $user = array('level', 'id', 'nama', 'username', 'profil');
        $this->session->unset_userdata($user);
        redirect(base_url('auth'));
    }
}