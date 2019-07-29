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
class Kasir extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('staf_ratu_id')) {
            redirect('Welcome/get_staf_bycookie');
        }
    }

    function index() {
        if ($this->input->post('cari')) {
            $id = $this->input->post('id');
            $date = 0;
            // $data['trans'] = $this->Frontline_m->trans_db($id, $date);
            $data['trans'] = $this->Kasir_m->trans_kasir($id, $date);
        } else {
            $id = "null";
            $date = date("Ymd");
            //$data['trans'] = $this->Front line_m->trans_db($id, $date);
            $data['trans'] = $this->Kasir_m->trans_kasir($id, $date);
        }
//        $data['grup'] = $this->Frontline_m->grup_nonpaket();
        $this->load->view('kasir/bayar', $data);
    }

    function bayar_detail($id) {
        $data['trans'] = $this->Kasir_m->trans_db($id);
        $this->load->view('kasir/bayar_detail', $data);
    }

    function bayar() {
        $id = $this->input->post('id');
        $nota = $this->input->post('nota');
        $id_kasir = $this->session->userdata("staf_ratu_id");
        if ($this->input->post('byr') == "1") {            
            //bayar dengan dp   
            $bayar = str_replace('.', '', $this->input->post('dp'));
            $data = array(
                "stat_byr" => 1
            );
//            $location="Kasir/nota_dp/$nota";
        } else if($this->input->post('byr') == "0"){
            //bayar lunas
            $bayar = str_replace('.', '', $this->input->post('total'));
            $data = array(
                "stat_byr" => 2,
            );
//            $location="Kasir/nota/$nota/$bayar";
        } 
        $location="Kasir/nota_dp/$nota";
        $data_bayar= array(
            'no_nota'=>$nota,
            'bayar'=>$bayar,
            'tgl_byr'=>date('Ymd'),
            'id_kasir'=>$id_kasir,
            'metode_byr'=>$this->input->post('metode_byr'),
        );
        $this->Kasir_m->status_db($data, $id);
        $this->Kasir_m->bayar_db($data_bayar);
        header("location:" . site_url($location));
    }

    function nota($id, $a) {
        $data['a'] = $a;
        $data['nota'] = $this->Kasir_m->nota_db($id);
        $data['barang'] = $this->Kasir_m->barang_db($id);
        $this->load->view("kasir/nota", $data);
    }

    function nota_dp($id) {
        $data['nota'] = $this->Kasir_m->nota_db($id);        
        $this->load->view("kasir/nota_dp", $data);
    }

}
