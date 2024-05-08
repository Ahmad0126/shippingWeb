<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengiriman extends CI_Model{
    //DB table
    protected $t1 = 'pengiriman'; 
    protected $t2 = 'detail_pengiriman'; 
    protected $t3 = 'layanan'; 
    protected $t4 = 'nota'; 
    protected $t5 = 'histori'; 
    protected $t6 = 'cabang'; 
    protected $t7 = 'user'; 

    //validation rules
    protected $validation_rules = [
        [
            'field' => 'nama_penerima',
            'label' => 'Nama Penerima',
            'rules' => 'required|min_length[2]|max_length[20]',
            'errors' => [
                'required' => 'Tolong kasih {field}!',
                'max_length' => '{field} maximal 20 karakter!',
                'min_length' => '{field} minimal 2 huruf!'
            ]
        ],
        [
            'field' => 'no_hp_penerima',
            'label' => 'No Telp Penerima',
            'rules' => 'min_length[2]|max_length[15]|is_numeric',
            'errors' => [
                'max_length' => '{field} maximal 15 digit!',
                'min_length' => '{field} minimal 2 huruf!',
                'is_numeric' => '{field} harus berisi angka!'
            ]
        ],
        [
            'field' => 'desc',
            'label' => 'Deskripsi',
            'rules' => 'required|min_length[2]|max_length[200]',
            'errors' => [
                'max_length' => '{field} maximal 200 karakter!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 2 huruf!'
            ]
        ],
        [
            'field' => 'instruksi_khusus',
            'label' => 'Instruksi Khusus',
            'rules' => 'min_length[2]|max_length[200]',
            'errors' => [
                'max_length' => '{field} maximal 200 karakter!',
                'min_length' => '{field} minimal 2 huruf!'
            ]
        ],
        [
            'field' => 'berat',
            'label' => 'Berat',
            'rules' => 'required|max_length[11]|integer',
            'errors' => [
                'max_length' => '{field} maximal 11 digit!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 2 huruf!',
                'integer' => 'Masukkan {field} yang jelas!'
            ]
        ],
        [
            'field' => 'koli',
            'label' => 'Koli',
            'rules' => 'required|max_length[11]|integer',
            'errors' => [
                'max_length' => '{field} maximal 11 digit!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 2 huruf!',
                'integer' => 'Masukkan {field} yang jelas!'
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
            'field' => 'id_layanan',
            'label' => 'Layanan',
            'rules' => 'required',
            'errors' => [
                'required' => 'Tolong kasih {field}!'
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
    public function get_pengiriman(){
        $this->db->order_by('id_pengiriman', 'DESC');
        $this->db->join($this->t2, $this->t2.'.kode_pengiriman = '.$this->t1.'.kode_pengiriman');
        $this->db->join($this->t3, $this->t3.'.id_layanan = '.$this->t1.'.id_layanan');
        $this->db->join($this->t5, $this->t5.'.kode_pengiriman = '.$this->t1.'.kode_pengiriman');
        return $this->db->get($this->t1)->result();
    }
    public function get_pengiriman_by_id($id){
        return $this->db->get_where($this->t1, array('id_pengiriman' => $id))->row();
    }

    //Delete
    public function delete($id){
        $this->db->delete($this->t1, array('id_pengiriman' => $id));
        return TRUE;
    }

    //Insert
    public function simpan(){
        $validation_pengiriman = $this->validation();
        if ($validation_pengiriman){
            $kode = $this->generate_code();
            $tanggal = date('Y-m-d H:i:s');
            $addr = $this->input->post('alamat_tujuan');
            $alamat = $addr[0].'; '.$addr[1].'; '.$addr[2];
            $pngr = [
                'kode_pengiriman' => $kode,
                'alamat_tujuan' => $alamat,
                'kode_pos' => $this->input->post('kode_pos'),
                'id_layanan' => $this->input->post('id_layanan')
            ];
            $detail = [
                'kode_pengiriman' => $kode,
                'tanggal_dikirim' => $tanggal,
                'nama_penerima' => $this->input->post('nama_penerima'),
                'no_hp_penerima' => $this->input->post('no_hp_penerima'),
                'deskripsi' => $this->input->post('desc'),
                'berat' => $this->input->post('berat'),
                'koli' => $this->input->post('koli'),
                'instruksi_khusus' => $this->input->post('instruksi_khusus')
            ];
            $histori = [
                'kode_pengiriman' => $kode,
                'tanggal' => $tanggal,
                'deskripsi' => 'Terdaftar di Kantor',
                'status' => 'registered',
                'id_user' => $this->session->userdata('id')
            ];
            $this->insert_pengiriman($pngr, $detail);
            return $this->insert_histori($histori);
        } else { return FALSE; }
    }
    private function insert_pengiriman($pngr, $detail){
        $this->db->insert($this->t1, $pngr);
        $this->db->insert($this->t2, $detail);
        return TRUE;
    }
    private function insert_histori($data){
        $this->db->insert($this->t5, $data);
        return TRUE;
    }
    
    //Update
    public function edit(){
        $validation_pengiriman = $this->validation();
        if ($validation_pengiriman){
            $data = [
                'alamat' => $this->input->post('alamat')
            ];
            return $this->update_pengiriman($data);
        } else { return FALSE; }
    }
    private function update_pengiriman($data){
        $this->db->where('id_pengiriman',$this->input->post('id_pengiriman'));
        $this->db->update($this->t1, $data);
        return TRUE;
    }

    //generator
    private function generate_code(){
        $hsl = $this->db->get($this->t1)->last_row();
        if($hsl == null){
            $total = 1;
        }else{
            $total = intval(substr($hsl->kode_pengiriman, 11, 3)) + 1;
        }
        $code = str_pad($total, 15, '0', STR_PAD_LEFT);
        return $code;
    }
}