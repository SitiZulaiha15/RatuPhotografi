<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Report_xls
 *
 * @author windows8.1
 */
class Report_xls extends CI_Controller {

    //put your code here
    function penjualan() {
        $this->load->view('report_upd/penjualan_barang');
    }
    function pj_report() {
//        $start = "2019-01-03";
//        $end = "2019-01-03";
        $start = $this->input->post('start');
        $end = $this->input->post('start');
        $data['tgl'] = $start;
        $data['trans'] = $this->reportx->pj_trans($start, $end);
        $this->load->view('report_upd/penjualan_barang_report', $data);
    }
    function pj_report_xls($start, $end) {
        $data['tgl'] = $start;
        $data['trans'] = $this->reportx->pj_trans($start, $end);
        $this->load->view('report_upd/penjualan_barang_reportxls', $data);
    }
    
    function diskon(){
        $this->load->view('report_upd/diskon');
    }
    function diskon_report(){
//        $start = "2019-01-03";
//        $end = "2019-01-03";
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $data['barang'] = $this->reportx->diskon_brg($start, $end);
        $data['start'] = $start;
        $data['end'] = $end;
        $this->load->view('report_upd/diskon_report', $data);
    }
    function diskon_report_xls($start, $end){
        $data['barang'] = $this->reportx->diskon_brg($start, $end);
        $data['start'] = $start;
        $data['end'] = $end;
        $this->load->view('report_upd/diskon_reportxls', $data);
    }

}
