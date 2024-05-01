<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_cabang extends CI_Model{
    protected $_table = 'cabang'; //DB table

    //validation rules
    protected $validation_rules = [
        [
            'field' => 'alamat',
            'label' => 'Alamat',
            'rules' => 'required|min_length[2]|max_length[200]',
            'errors' => [
                'max_length' => '{field} maximal 200 karakter!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 2 huruf!'
            ]
        ],
        [
            'field' => 'kode_cabang',
            'label' => 'Kode Cabang',
            'rules' => 'min_length[2]|max_length[20]',
            'errors' => [
                'max_length' => '{field} maximal 20 karakter!',
                'min_length' => '{field} minimal 2 huruf!'
            ]
        ],
        [
            'field' => 'kota',
            'label' => 'Kota',
            'rules' => 'required|min_length[2]|max_length[30]',
            'errors' => [
                'max_length' => '{field} maximal 30 karakter!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 2 huruf!'
            ]
        ],
        [
            'field' => 'kode_pos',
            'label' => 'Kode Pos',
            'rules' => 'required|min_length[2]|max_length[10]|is_numeric',
            'errors' => [
                'max_length' => '{field} maximal 10 digit!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 2 huruf!',
                'is_numeric' => '{field} harus berisi angka!'
            ]
        ],
        [
            'field' => 'kode_cabang',
            'label' => 'Kode Cabang',
            'rules' => 'min_length[2]|max_length[20]|is_unique[cabang.kode_cabang]',
            'errors' => [
                'max_length' => '{field} maximal 20 digit!',
                'min_length' => '{field} minimal 2 huruf!',
                'is_unique' => '{field} sudah dipakai!'
            ]
        ],
        [
            'field' => 'fasilitas',
            'label' => 'Fasilitas',
            'rules' => 'in_list[Warehouse,Office,Sorting Center,Gateway]'
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
    public function get_cabang(){
        $this->db->order_by('id_cabang', 'DESC');
        return $this->db->get($this->_table)->result();
    }
    public function get_cabang_by_id($id){
        return $this->db->get_where($this->_table, array('id_cabang' => $id))->row();
    }

    //Delete
    public function delete($id){
        $this->db->delete($this->_table, array('id_cabang' => $id));
        return TRUE;
    }

    //Insert
    public function simpan(){
        $validation_cabang = $this->validation();
        if ($validation_cabang){
            $data = [
                'kode_cabang' => $this->input->post('kode_cabang') == null? $this->generate_code() : $this->input->post('kode_cabang'),
                'kode_pos' => $this->input->post('kode_pos'),
                'alamat' => $this->input->post('alamat'),
                'kota' => $this->input->post('kota'),
                'fasilitas' => $this->input->post('fasilitas')
            ];
            return $this->insert_cabang($data);
        } else { return FALSE; }
    }
    private function insert_cabang($data){
        $this->db->insert($this->_table, $data);
        return TRUE;
    }
    
    //Update
    public function edit(){
        $validation_cabang = $this->validation();
        if ($validation_cabang){
            $data = [
                'alamat' => $this->input->post('alamat')
            ];

            $this->db->where('id_cabang', $this->input->post('id_cabang'));
            $cabang = $this->db->get($this->_table)->row_array();
            $changed = ($this->input->post('kode_pos') != $cabang['kode_pos']) ||
                        ($this->input->post('kota') != $cabang['kota']) ||
                        ($this->input->post('fasilitas') != $cabang['fasilitas']);

            if($changed){
                $kode = $this->generate_code();
                $tambahan = [
                    'kode_cabang' => $this->generate_code(),
                    'kode_pos' => $this->input->post('kode_pos'),
                    'kota' => $this->input->post('kota'),
                    'fasilitas' => $this->input->post('fasilitas')
                ];
                $data = array_merge($data, $tambahan);
            }
            
            return $this->update_cabang($data);
        } else { return FALSE; }
    }
    private function update_cabang($data){
        $this->db->where('id_cabang',$this->input->post('id_cabang'));
        $this->db->update($this->_table, $data);
        return TRUE;
    }

    //generator
    private function generate_code(){
        switch ($this->input->post('fasilitas')) {
            case 'Warehouse': $fasilitas = 'WH'; break;
            case 'Sorting Center': $fasilitas = 'SC'; break;
            case 'Gateway': $fasilitas = 'GT'; break;
            default: $fasilitas = 'OF'; break;
        };

        $kota = substr(strtoupper($this->input->post('kota')), 0, 3);
        $kode_pos = $this->input->post('kode_pos');
        
        $q1 = $this->db->query("SELECT * FROM `cabang` WHERE kode_cabang LIKE '%".'C-'.$kota.$kode_pos."%".$fasilitas."'");
        $hsl = $q1->last_row();
        $total = intval(substr($hsl->kode_cabang, 11, 3)) + 1;
        $id = str_pad($total, 3, '0', STR_PAD_LEFT);

        $code = 'C-'.$kota.$kode_pos.'-'.$id.$fasilitas;
        return $code;
    }
}