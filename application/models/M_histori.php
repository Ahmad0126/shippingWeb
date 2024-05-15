<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_histori extends CI_Model{
    protected $_table = 'histori'; //DB table

    //validation form
    private function validation(){
        $kode = $this->input->post('kode');
        $p = $this->db->get_where($this->_table, array('kode_pengiriman' => $kode))->row();
        if($p == null){
            $this->session->set_flashdata('error', $this->template->buat_alert('Barang Tidak terdaftar!', 'danger'));
            return FALSE;
        }
        return TRUE;
    }
    
    //Read
    public function get_layanan(){
        $this->db->order_by('id_layanan', 'DESC');
        return $this->db->get($this->_table)->result();
    }
    public function get_layanan_by_id($id){
        return $this->db->get_where($this->_table, array('id_layanan' => $id))->row();
    }

    //Delete
    public function delete($kode, $status){
        $this->db->delete($this->_table, array('kode_pengiriman' => $kode, 'status' => $status));
        return TRUE;
    }

    //Insert
    public function pickup(){
        if ($this->validation()){
            $data = [
                'kode_pengiriman' => $this->input->post('kode'),
                'tanggal' => date('Y-m-d H:i:s'),
                'deskripsi' => 'Dibawa oleh kurir',
                'status' => 'delivery',
                'id_user' => $this->session->userdata('id')
            ];
            return $this->insert_histori($data);
        } else { return FALSE; }
    }
    private function insert_histori($data){
        $this->db->insert($this->_table, $data);
        return TRUE;
    }
    
    //Update
    public function edit(){
        $validation_layanan = $this->validation();
        if ($validation_layanan){
            $data = [
                'nama_layanan' => $this->input->post('nama_layanan'),
                'kapasitas' => $this->input->post('kapasitas'),
                'waktu' => $this->input->post('waktu'),
                'ongkir' => $this->input->post('ongkir')
            ];
            return $this->update_layanan($data);
        } else { return FALSE; }
    }
    private function update_layanan($data){
        $this->db->where('id_layanan',$this->input->post('id_layanan'));
        $this->db->update($this->_table, $data);
        return TRUE;
    }
}