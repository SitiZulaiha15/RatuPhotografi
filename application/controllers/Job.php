<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Job
 *
 * @author lauwba
 */
class Job extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('staf_ratu_id')) {
            redirect('Welcome/get_staf_bycookie');
        }
    }

    function index() {
        $data['jobs'] = $this->Job_m->job_all_db();
        $data['staf'] = $this->Job_m->staf_job_forjob();
        $data['krj'] = $this->Job_m->stat_krj();
        if ($this->session->userdata('staf_ratu_lv') == 1) {
            $this->load->view('all/job_backup', $data);
        } else {
            $this->load->view('all/job_session', $data);
        }
    }

    function job_by($id) {
        $data['job'] = $this->Job_m->job_by_db($id);
        $this->load->view('all/job_by', $data);
    }

    function update_krj($id, $k) {
        $data = array(
            "stat_krj" => $k
        );
        $this->Job_m->update_krj_db($data, $id);
        header('location:' . site_url('Job'));
    }

    function set_active_tabs() {
        $sess_data['penanda'] = $this->input->post('penanda');
        $this->session->set_userdata($sess_data);
    }

    function job_search() {
        $this->load->view('all/job_search');
    }

    function job_search_result() {
        $nama = $this->input->post('id');
        $tgl = $this->input->post('tgl');
        $id = $this->session->userdata('staf_ratu_id');
        if ($nama == "" && $tgl == "") {
            $return = '<script>
        alert("Data Nama Pelanggan atau Data Tanggal harus ada yang diisi!")
        window.location.assign("' . site_url('Job/job_search') . '");
        </script>';
            echo $return;
        } else if (!empty($nama)) {
            $nama = "%$nama%";
        }
        $lv = $this->session->userdata('staf_ratu_lv');
        if ($lv == 1) {
            $data['result'] = $this->Job_m->search_job_sa($nama, $tgl);
        } else {
            $data['result'] = $this->Job_m->search_job($nama, $tgl, $id);
        }
        $this->load->view('all/job_search_result', $data);
    }

}
