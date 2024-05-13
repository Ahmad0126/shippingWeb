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
    protected $tambah_rules = [
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
    protected $checkout_rules = [
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
            'field' => 'kode_pos',
            'label' => 'Kode Pos',
            'rules' => 'required|min_length[2]|max_length[10]|is_numeric',
            'errors' => [
                'max_length' => '{field} maximal 10 digit!',
                'required' => 'Tolong kasih {field}!',
                'min_length' => '{field} minimal 2 huruf!',
                'is_numeric' => '{field} harus berisi angka!'
            ]
        ]
    ];


    protected $validation_rules;

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
        $this->db->select(
            $this->t1.'.kode_pengiriman, '.
            $this->t2.'.nama_penerima, '.
            $this->t1.'.alamat_tujuan, '.
            $this->t2.'.tanggal_dikirim, '.
            $this->t3.'.nama_layanan, '.
            'h.status'
        );
        $this->db->join($this->t1, $this->t1.'.kode_pengiriman = h.kode_pengiriman', 'inner');
        $this->db->join($this->t2, $this->t2.'.kode_pengiriman = h.kode_pengiriman', 'inner');
        $this->db->join($this->t3, $this->t3.'.id_layanan = '.$this->t1.'.id_layanan', 'inner');
        $this->db->join('(SELECT kode_pengiriman, MAX(tanggal) AS maxTgl FROM '.$this->t5.' GROUP BY kode_pengiriman) hts', 'h.kode_pengiriman = hts.kode_pengiriman AND h.tanggal = hts.maxTgl', 'inner');
        $this->db->order_by($this->t1.'.id_pengiriman', 'DESC');
        return $this->db->get($this->t5.' h')->result();
    }
    public function get_detail_pengiriman($kode){
        $this->db->select('
            pengiriman.kode_pengiriman,
            tanggal,
            detail_pengiriman.deskripsi,
            status,
            alamat_tujuan,
            pengiriman.kode_pos,
            pengiriman.ongkir,
            pengiriman.no_nota,
            tanggal_dikirim,
            nama_penerima,
            no_hp_penerima,
            berat,
            koli,
            instruksi_khusus,
            nama_layanan,
            nama_pengirim,
            alamat_pengirim,
            no_hp_pengirim,
            pembayaran,
            estimasi'
        );
        $this->db->join($this->t1, $this->t1.'.kode_pengiriman = h.kode_pengiriman', 'inner');
        $this->db->join($this->t2, $this->t2.'.kode_pengiriman = h.kode_pengiriman', 'inner');
        $this->db->join($this->t3, $this->t3.'.id_layanan = '.$this->t1.'.id_layanan', 'inner');
        $this->db->join($this->t4, $this->t4.'.no_nota = '.$this->t1.'.no_nota', 'left');
        $this->db->join('(SELECT kode_pengiriman, MAX(tanggal) AS maxTgl FROM '.$this->t5.' GROUP BY kode_pengiriman) hts', 'h.kode_pengiriman = hts.kode_pengiriman AND h.tanggal = hts.maxTgl', 'inner');
        $this->db->where($this->t1.'.kode_pengiriman', $kode);
        return $this->db->get($this->t5.' h')->row();
    }
    public function get_pengiriman_by_kode($kode){
        $this->db->select('detail_pengiriman.deskripsi, status, berat, nama_layanan, nama_penerima, pengiriman.ongkir, pengiriman.kode_pengiriman');
        $this->db->join($this->t2, $this->t2.'.kode_pengiriman = '.$this->t1.'.kode_pengiriman');
        $this->db->join($this->t3, $this->t3.'.id_layanan = '.$this->t1.'.id_layanan');
        $this->db->join($this->t5.' h', $this->t1.'.kode_pengiriman = h.kode_pengiriman', 'inner');
        $this->db->join('(SELECT kode_pengiriman, MAX(tanggal) AS maxTgl FROM '.$this->t5.' GROUP BY kode_pengiriman) hts', 'h.kode_pengiriman = hts.kode_pengiriman AND h.tanggal = hts.maxTgl', 'inner');
        return $this->db->get_where($this->t1, array($this->t1.'.kode_pengiriman' => $kode))->row();
    }
    public function get_pengiriman_by_nota($nota){
        $this->db->select('detail_pengiriman.deskripsi, status, berat, nama_layanan, nama_penerima, pengiriman.ongkir, pengiriman.kode_pengiriman');
        $this->db->join($this->t2, $this->t2.'.kode_pengiriman = '.$this->t1.'.kode_pengiriman');
        $this->db->join($this->t3, $this->t3.'.id_layanan = '.$this->t1.'.id_layanan');
        $this->db->join($this->t5.' h', $this->t1.'.kode_pengiriman = h.kode_pengiriman', 'inner');
        $this->db->join('(SELECT kode_pengiriman, MAX(tanggal) AS maxTgl FROM '.$this->t5.' GROUP BY kode_pengiriman) hts', 'h.kode_pengiriman = hts.kode_pengiriman AND h.tanggal = hts.maxTgl', 'inner');
        return $this->db->get_where($this->t1, array($this->t1.'.no_nota' => $nota))->result();
    }
    public function get_histori_pengiriman($kode){
        $this->db->join($this->t6, $this->t6.'.kode_cabang = '.$this->t5.'.kode_cabang', 'left');
        $this->db->where('kode_pengiriman', $kode);
        return $this->db->get($this->t5)->result();
    }
    public function get_nota_pengiriman($no){
        return $this->db->get_where($this->t4, array('no_nota' => $no))->row();
    }

    //Delete
    public function delete($id){
        $this->db->delete($this->t1, array('id_pengiriman' => $id));
        return TRUE;
    }

    //Insert
    public function simpan(){
        $this->validation_rules = $this->tambah_rules;
        $validation_pengiriman = $this->validation();
        if ($validation_pengiriman){
            $kode = $this->generate_code();
            $tanggal = date('Y-m-d H:i:s');
            $addr = $this->input->post('alamat_tujuan');
            $alamat = $addr[0].'; '.$addr[1].'; '.$addr[2];

            $pos1 = $this->input->post('kode_pos');
            $pos2 = $this->session->userdata('data_cabang')->kode_pos;
            $diff_pos = str_pad(abs($pos1 - $pos2), 5, STR_PAD_LEFT);
            $jarak = intval(substr($diff_pos, 0, 1));

            $layanan = $this->db->get_where($this->t3, array('id_layanan', $this->input->post('id_layanan')))->row();
            if($this->input->post('berat') / 1000 > $layanan->kapasitas){
                $this->session->set_flashdata('custom_error', 'Barang melebihi kapasitas layanan');
            }
            $waktu = explode('-', $layanan->waktu);
            $estimasi = $waktu[0];
            $ongkir = $layanan->ongkir;
            if($jarak > 1){ 
                $ongkir = $ongkir * $jarak * ceil($this->input->post('berat') / 1000);
                $estimasi = $waktu[1]; 
            }
            $pngr = [
                'kode_pengiriman' => $kode,
                'alamat_tujuan' => $alamat,
                'ongkir' => $ongkir,
                'estimasi' => $estimasi,
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
                'id_user' => $this->session->userdata('id'),
                'kode_cabang' => $this->session->userdata('kode_cabang')
            ];
            $this->insert_pengiriman($pngr, $detail);
            $this->insert_histori($histori);
            if($this->input->post('process') == 'true'){
                redirect(base_url('pengiriman/checkout?kode_pengiriman%5B%5D='.$kode));
            }else{ return TRUE; }
        } else { return FALSE; }
    }
    public function checkout(){
        $this->validation_rules = $this->checkout_rules;
        $validation_pengiriman = $this->validation();
        if ($validation_pengiriman){
            $kode = $this->generate_invoice();
            $tanggal = date('Y-m-d H:i:s');
            $addr = $this->input->post('alamat_tujuan');
            $alamat = $addr[0].'; '.$addr[1].'; '.$addr[2];
            $nota = [
                'no_nota' => $kode,
                'alamat_pengirim' => $alamat,
                'total' => $this->input->post('total'),
                'nama_pengirim' => $this->input->post('nama_penerima'),
                'no_hp_pengirim' => $this->input->post('no_hp_penerima'),
                'pembayaran' => $this->input->post('pembayaran')
            ];
            foreach ($this->input->post('kode_pengiriman') as $k) {
                $this->update_pengiriman(array('no_nota' => $kode), array('kode_pengiriman' => $k));
                $data = [
                    'kode_pengiriman' => $k,
                    'tanggal' => $tanggal,
                    'deskripsi' => 'Diproses di kantor',
                    'status' => 'checkout',
                    'id_user' => $this->session->userdata('id'),
                    'kode_cabang' => $this->session->userdata('kode_cabang')
                ];
                $this->insert_histori($data);
            }
            return $this->insert_nota($nota);
        }else{
            return FALSE;
        }
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
    private function insert_nota($data){
        $this->db->insert($this->t4, $data);
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
    private function update_pengiriman($data, $where){
        $this->db->where($where);
        $this->db->update($this->t1, $data);
        return TRUE;
    }

    //generator
    private function generate_code(){
        $hsl = $this->db->get($this->t1)->last_row();
        if($hsl == null){
            $total = 1;
        }else{
            $total = intval($hsl->kode_pengiriman) + 1;
        }
        $code = str_pad($total, 15, '0', STR_PAD_LEFT);
        return $code;
    }
    private function generate_invoice(){
        $tanggal = date('ymd');
        $kota = substr(strtoupper($this->input->post('alamat_tujuan')[1]), 0, 3);
        $pos = $this->input->post('kode_pos');
        $code = $kota.$pos.'-'.$tanggal;

        $this->db->like('no_nota', $kode);
        $chk = $this->db->get($this->t4)->result();
        if($chk != null){
            $total = count($chk);
            $code = $code.str_pad($total, 3, '0', STR_PAD_LEFT);
        }
        return $code;
    }
}