<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kasir
 *
 * @author lauwba
 */
class Frontline extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('staf_ratu_id')) {
           redirect('Welcome/get_staf_bycookie');
        }
        $this->del_antrian();
    }

    function index() {
        $this->load->view('cs/package_2');
    }

    function foto() {
        $data['foto'] = $this->Frontline_m->foto();
        $data['fotografer'] = $this->Frontline_m->staf_db('2');
        $this->load->view('cs/packagefoto', $data);
    }

    function foto_backup() {
        $data['package'] = $this->Frontline_m->package_db('paket');
        $data['fotografer'] = $this->Frontline_m->staf_db('2');
        $this->load->view('cs/package_foto', $data);
    }

    function antri_foto() {
        //ambil data paket, input transaksi, cetak antrian        
        $id_trans = $this->Frontline_m->id_trans();
        $nota = "n-" . time();
        $id_member = 0;
        if ($this->input->post('id_member')) {
            $id_member = $this->input->post('id_member');
        }
        $data = array(
            "id_trans" => $id_trans,
            "no_nota" => $nota,
            "atas_nama" => $this->input->post('an'),
            "id_member" => $id_member,
            "no_telp" => $this->input->post('no_telp'),
            "tgl" => date('Ymd'),
            "id_foto" => $this->input->post('id_foto')
        );
//        $data_paket = array(
//            "id_trans" => $id_trans,
//            "kd_brg" => $this->input->post('id_paket'), //$this->input->post()
//            "jml" => 1,
//            "hrg" => $this->input->post('hrg_paket') //$this->input->post()
//        );
        $item = $this->cart->contents();
        foreach ($item as $a) {
            if ($a['ket'] <> "") {
                $ket = '(' . $a['ket'] . ')';
            } else {
                $ket = $a['ket'];
            }
            $data_item = array(
                'id_trans' => $id_trans,
                'kd_brg' => $a['id'],
                'jml' => $a['qty'],
                'diskon' => $a['diskon'],
                'hrg' => $a['price'],
                'ket' => $ket
            );
            $this->Frontline_m->save_order_item($data_item);
        }
        $this->cart->destroy();
        $data_antri = array(
            'tgl' => date("Ymd"),
            'no' => $this->input->post('no'),
            'id_trans' => $id_trans
        );
        $this->Frontline_m->insert_antrian($data_antri);
        $this->Frontline_m->antri_foto_db($data);
//        $this->Frontline_m->paket_db($data_paket);
        redirect('Frontline/print_antrian_foto/'.$nota);
    }

    function print_antrian_foto($id) {
        $data['antri'] = $this->Frontline_m->print_antrian($id);
        $data['item'] = $this->Frontline_m->item_brg($id);
        $this->load->view('cs/print_antri_foto', $data);
    }

    function cetak() {
        $this->load->view('cs/cetak');
    }

//    function ready_cetak() {
//        //search kode transaksi
//
//        if ($this->input->post('cari')) {
//            $id = $this->input->post('id');
//            $this->unset_cetak();
//            $data['trans'] = $this->Frontline_m->trans_db($id);
//        } else {
//            $id = 0;
//            $data['trans'] = 0;
//        }
//        $data['pj'] = $this->Frontline_m->staf_db('3');
//        $data['biasa'] = $this->Frontline_m->barang_db('file', 'biasa');
//        $data['klg'] = $this->Frontline_m->barang_db('file', 'keluarga');
//        $data['prewed'] = $this->Frontline_m->barang_db('file', 'prewed');
//        $data['m_khusus'] = $this->Frontline_m->barang_db('cetak', 'cmk');
//        $data['m_biasa'] = $this->Frontline_m->barang_db('cetak', 'cmb');
//        $data['cetakx'] = $this->Frontline_m->barang_db('cetak', 'x');
//        $data['bingkai'] = $this->Frontline_m->package_db('bingkai');
//        $data['org'] = $this->Frontline_m->package_db('orang');
//        $data['mkup'] = $this->Frontline_m->package_db('makeup');
//        $data['album'] = $this->Frontline_m->package_db('album');
//        $data['edit'] = $this->Frontline_m->package_db('edit');
//        $data['baner'] = $this->Frontline_m->package_db('banner');
//        $data['lami'] = $this->Frontline_m->package_db('laminating');
//        $data['kostum'] = $this->Frontline_m->package_db('kostum');
//        $this->load->view('cs/ready_cetak', $data);
//        //tampil tabel barang
//        //pilih item maukkan ke item transaksi  & deadline, PJ
//    }

    function ready_cetak() {
        if ($this->input->post('cari')) {
            $id = $this->input->post('id');
            $date = "";
//            $data['trans'] = $this->Frontline_m->trans_db($id, $date);
            $data['trans'] = $this->Frontline_m->m_by_id($id);
            $data['search'] = 1;
        } else {
            $id = 0;
            $date = date("Ymd");
//            $data['trans'] = $this->Frontline_m->trans_db($id, $date);
            $data['trans'] = $this->Frontline_m->m_by_date($date);
            $data['search'] = 0;
        }
        $data['grup'] = $this->Frontline_m->grup_nonpaket();
        $this->load->view('cs/ready_cetak_2', $data);
    }

    function ready_cetak_door($id) {
        $this->cart->destroy();
        redirect('Frontline/ready_cetak_detail/'.$id);
    }

    function ready_cetak_detail($id) {
//        $id = $this->input->post('id');
        $this->unset_cetak();
        $data['trans'] = $this->Frontline_m->trans_detail_db($id);
        $data['pj'] = $this->Frontline_m->staf_db('3');
        $data['grup'] = $this->Frontline_m->grup_nonpaket();
        $this->load->view('cs/ready_cetak_detail', $data);
    }

    function save_order() {
        $id = $this->input->post('id_trans');
        $nota = $this->input->post('nota');
        $data = array(
            'id_pj' => $this->input->post('pj'),
            'deadline' => $this->input->post('deadline'),
            'id_cs' => $this->session->userdata('staf_ratu_id'),
        );
        $this->Frontline_m->save_order_db($nota, $data);
//        $item = $this->input->post('barang[]');
        $item = $this->cart->contents();
//        foreach ($item as $i) {
//            $item = $this->Frontline_m->item_db($i);
        foreach ($item as $a) {
            if ($a['ket'] <> "") {
                $ket = '(' . $a['ket'] . ')';
            } else {
                $ket = $a['ket'];
            }
            $data_item = array(
                'id_trans' => $id,
                'kd_brg' => $a['id'],
                'jml' => $a['qty'],
                'diskon' => $a['diskon'],
                'hrg' => $a['price'],
                'ket' => $ket
            );
            $this->Frontline_m->save_order_item($data_item);
        }
//        }
        $this->cart->destroy();
//        redirect('Frontline/ready_cetak');
        $this->data_item($nota);
    }

    function input_deadline() {
        $data['pj'] = $this->Frontline_m->staf_db('3');
        $this->load->view('cs/input_deadline', $data);
    }

    function antri_cetak() {
        $nota = "n-" . time();
        $this->session->set_userdata('cetak', $nota);
        $id_trans = $this->Frontline_m->id_trans('id');
        $id_member = 0;
        if ($this->input->post('id_member')) {
            $id_member = $this->input->post('id_member');
        }
        $data = array(
            "id_trans" => $id_trans,
            "no_nota" => $nota,
            "atas_nama" => $this->input->post('an'),
            "tgl" => date('Ymd'),
            "id_member" => $id_member,
            "no_telp" => $this->input->post('no_telp'),
        );
        $data_antri = array(
            'tgl' => date("Ymd"),
            'no' => $this->input->post('no'),
            'id_trans' => $id_trans
        );
        $this->Frontline_m->insert_antrian($data_antri);
        $this->Frontline_m->antri_foto_db($data);
        $this->print_antrian_foto($nota);
    }

    function ambil() {
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
            $date = "";
//            $data['trans'] = $this->Frontline_m->ambil_db($id, $date);
//            $data['order'] = $this->Frontline_m->order_db($id);
            $data['trans'] = $this->Frontline_m->m_by_id($id);
            $data['krj'] = $this->Job_m->stat_krj();
        } else {
            $id = 0;
//            $data['trans'] = 0;
            $date = date("Ymd");
            $data['trans'] = $this->Frontline_m->m_by_date($date);
//            $data['trans'] = $this->Frontline_m->ambil_db($id, $date);
//            $data['order'] = $this->Frontline_m->order_db($id);
            $data['krj'] = $this->Job_m->stat_krj();
        }
        $this->load->view('cs/ambil', $data);
    }

    function proses_ambil($id) {
        $data = array(
            "stat_krj" => 4
        );
        $this->Frontline_m->save_order_db($id, $data);
        header("location:" . site_url('Frontline/ambil/'));
    }

    function unset_cetak() {
        $this->session->unset_userdata('cetak');
    }

    function antrian() {
        if ($this->session->userdata('staf_ratu_lv') == 3) {
            $kode = "P";
        } else if ($this->session->userdata('staf_ratu_lv') == 2) {
            $kode = "F";
        } else {
            redirect('Dashboard');
        }
//        $this->del_antrian();
        $data['antri'] = $this->Frontline_m->list_antrian($kode, 0);
        $data['antri_1'] = $this->Frontline_m->list_antrian($kode, 1);
        $this->load->view('all/antrian', $data);
    }

    function antrian_cs() {
//        $this->del_antrian();
        $this->load->view('all/antrian_cs');
    }

    function del_antrian() {
        $this->Frontline_m->del_antrian();
    }

    function selesai($id) {
        $data = array(
            'status' => 1
        );
        $this->Crud_m->update('antrian', $data, 'id', $id);
        redirect('Frontline/antrian');
    }

    function get_member($search) {
        $query = $this->Frontline_m->get_member($search);
        echo json_encode($query);
    }

    function data_item($id) {
        $data['trans'] = $this->Frontline_m->ambil_db($id, "");
        $data['order'] = $this->Frontline_m->order_db($id);
        $this->load->view('cs/data_item', $data);
    }

}
