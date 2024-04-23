<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Template{
    var $template_data = array();
    function set($name, $value){
        $this->template_data[$name] = $value;
    }

    function load($template = '', $view = '' , $title = '' , $view_data = array(), $return = FALSE){
        $this->CI =& get_instance();
        $this->set('contents', $this->CI->load->view($view, $view_data, TRUE));
        $this->set('title', $title);
        return $this->CI->load->view($template, $this->template_data, $return);
    }

    function buat_notif($pesan, $warna){
        return '
		<div class="alert alert-'.$warna.' alert-dismissible fade show notifikasi" role="alert">
			<span class="alert-icon"><i class="fa fa-exclamation"></i></span>
            <span class="alert-text">'.$pesan.'</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
		</div>';
    }

    function translate_waktu($waktu, $sekarang){
        if($waktu == null){
            return "Belum pernah Login";
        }
        $splitter = explode(" ", $waktu);
        $hari = explode("-", $splitter[0]);
        $jam = explode(":", $splitter[1]);
        $splitter2 = explode(" ", $sekarang);
        $hari_ini = explode("-", $splitter2[0]);
        $saat_ini = explode(":", $splitter2[1]);
        if($hari_ini[0] == $hari[0]){
            if($hari_ini[1] == $hari[1]){
                if($hari_ini[2] == $hari[2]){
                    if($jam[0] == $saat_ini[0]){
                        if($jam[1] == $saat_ini[1]){
                            return "Baru saja";
                        }else if($saat_ini[1] > $jam[1]){
                            return ($saat_ini[1] - $jam[1])." menit yang lalu";
                        }
                    }else if($saat_ini[0] > $jam[0]){
                        return ($saat_ini[0] - $jam[0])." jam yang lalu";
                    }
                }else if($hari_ini[2] > $hari[2]){
                    return ($hari_ini[2] - $hari[2])." hari yang lalu";
                }
            }else if($hari_ini[1] > $hari[1]){
                return ($hari_ini[1] - $hari[1])." bulan yang lalu";
            }
        }else if($hari_ini[0] > $hari[0]){
            return ($hari_ini[0] - $hari[0])." tahun yang lalu";
        }
    }
    function translate_bulan($tanggal){
        if($tanggal == null){
            return "Tidak Diketahui";
        }

        $nama_bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        
        $splitter = explode("-", $tanggal);
        $hari = $splitter[2];
        $bulan = $splitter[1];
        $tahun = $splitter[0];

        $index = intval($bulan) - 1;
        return $hari.' '.$nama_bulan[$index].' '.$tahun;
    }
}