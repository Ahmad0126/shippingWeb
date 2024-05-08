<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_layanan extends CI_Model{
    protected $_table = 'layanan'; //DB table

    //validation rules
    protected $validation_rules = [
        [
            'field' => 'nama_layanan',
            'label' => 'Nama Layanan',
            'rules' => 'required|min_length[2]|max_length[20]',
            'errors' => [
                'max_length' => '{field} maximal 20 karakter!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 2 huruf!'
            ]
        ],
        [
            'field' => 'kapasitas',
            'label' => 'Kapasitas',
            'rules' => 'required|max_length[11]|integer',
            'errors' => [
                'max_length' => '{field} maximal 11 digit!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 2 huruf!',
                'integer' => 'Masukkan {field} yang jelas!'
            ]
        ],
        [
            'field' => 'waktu',
            'label' => 'Waktu',
            'rules' => 'required|max_length[11]|integer',
            'errors' => [
                'max_length' => '{field} maximal 11 digit!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 2 huruf!',
                'integer' => 'Masukkan {field} yang jelas!'
            ]
        ],
        [
            'field' => 'ongkir',
            'label' => 'Ongkir',
            'rules' => 'required|max_length[11]|integer',
            'errors' => [
                'max_length' => '{field} maximal 11 digit!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 2 huruf!',
                'integer' => 'Masukkan {field} yang jelas!'
            ]
        ]
    ];

    //validation form
    private function validation(){
        $this->form_validation->set_rules($this->validation_rules);
        if ($this->form_validation->run() == TRUE){
            return TRUE;
        }
        return FALSE;
    }
    
    //Read
    public function get_layanan(){
        $this->db->order_by('id_layanan', 'DESC');
        return $this->db->get($this->_table)->result();
    }
    public function get_layanan_by_id($id){
        return $this->db->get_where($this->_table, array('layanan_id' => $id))->row();
    }

    //Delete
    public function delete($id){
        $this->db->delete($this->_table, array('id_layanan' => $id));
        return TRUE;
    }

    //Insert
    public function simpan(){
        $validation_layanan = $this->validation();
        if ($validation_layanan){
            $data = [
                'nama_layanan' => $this->input->post('nama_layanan'),
                'kapasitas' => $this->input->post('kapasitas'),
                'waktu' => $this->input->post('waktu'),
                'ongkir' => $this->input->post('ongkir')
            ];
            return $this->insert_layanan($data);
        } else { return FALSE; }
    }
    private function insert_layanan($data){
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