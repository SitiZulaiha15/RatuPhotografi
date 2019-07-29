<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Report
 *
 * @author lauwba
 */
class Report extends CI_Controller{
    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('staf_ratu_id')) {
            redirect('Welcome/get_staf_bycookie');
        }
    }
    //put your code here
    function limit_bb(){
        $data['bb']=$this->Report_m->limit_bb_db();
        $this->load->view('report/stok', $data);
    }
    function stok_now() {
        $data['bb'] = $this->Report_m->stok_now_db();
        $this->load->view('report/stok', $data);
    }

    function kinerja_period() {
        $this->load->view('report/kinerja_period');
    }

    function kinerja() {
//        $data['kinerja'] = $this->Report_m->kinerja_db();
        $data['staf'] = $this->Report_m->staf_kinerja();
        $data['start'] = $this->input->post('start');
        $data['end'] = $this->input->post('end');
        $this->load->view('report/kinerja', $data);
    }
    function kasir_pj() {
        $this->load->view('report/kasir_pj');
    }

    function kasir_pj_report() {
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $data['start'] = $start;
        $data['end'] = $end;
        $data['report'] = $this->Report_m->kasir_pj_report_db($start, $end);
        $data['kat'] = $this->Crud_m->select('grup');
        $this->load->view('report/kasir_pj_report', $data);
    }

    function kasir_trans() {
        $this->load->view('report/kasir_trans');
    }

    function kasir_trans_report() {
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $data['start'] = $start;
        $data['end'] = $end;
        $data['report'] = $this->Report_m->kasir_trans_report_db($start, $end);
        $this->load->view('report/kasir_trans_report', $data);
    }

    function kasir_order() {
        if ($this->input->post('tgl')) {
            $start = $this->input->post('tgl');
            $data['start'] = $start;
            $data['report'] = $this->Report_m->kasir_order_db($start);
        } else {
            $data['start'] = "";
            $data['report'] = 0;
        }
        $this->load->view('report/kasir_order', $data);
    }
    function kasir_rinci(){
        $this->load->view('report/kasir_rinci');
    }
    function kasir_rinci_report(){
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $data['start'] = $start;
        $data['end'] = $end;
        $data['report'] = $this->Report_m->kasir_rinci_db($start, $end);
        $this->load->view('report/kasir_rinci_report', $data);
    }
    
}
