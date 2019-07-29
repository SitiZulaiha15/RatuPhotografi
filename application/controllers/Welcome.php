<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();

        if ($this->session->userdata('staf_ratu_id')) {
            redirect('Dashboard');            
        } else if(get_cookie('staf_ratu_id')){
            $this->get_staf_bycookie();
        }

    }

    public function index() {
        $this->load->view('welcome_message');
    }

    function login_staf() {
        $username = $this->input->post('user');
        $password = md5($this->input->post('pass'));

        $cek = $this->Login_m->cek($username, $password);
        if ($cek->num_rows() == 1) {
            foreach ($cek->result() as $data) {
                if ($this->input->post('remember') == "remember") {
                    set_cookie('staf_ratu_id', $data->id_staf, time() + (365 * 24 * 60 * 60));
                }
                $sess_data['staf_ratu_id'] = $data->id_staf;
                $sess_data['staf_ratu_name'] = $data->nm_staf;
                $sess_data['staf_ratu_lv'] = $data->level;
                $this->session->set_userdata($sess_data);
            }
            redirect('Dashboard');
        } else {
            $this->session->set_flashdata('pesan', 'Login failed succesfully!');
            redirect('Welcome');
        }
    }

    function get_staf_bycookie() {
        if (get_cookie('staf_ratu_id')) {
            $id = get_cookie('staf_ratu_id');
            $cek = $this->Login_m->login_bycookie($id);
            foreach ($cek->result() as $data) {
                if ($this->input->post('remember') == "remember") {
                    set_cookie('staf_ratu_id', $data->id_staf, time() + (365 * 24 * 60 * 60));
                }
                $sess_data['staf_ratu_id'] = $data->id_staf;
                $sess_data['staf_ratu_name'] = $data->nm_staf;
                $sess_data['staf_ratu_lv'] = $data->level;
                $this->session->set_userdata($sess_data);
            }
            redirect('Dashboard');
        } else {
            $this->session->set_flashdata('pesan', 'Your session cookie is invalid. Please log in again.');
            redirect('Welcome');
        }
    }

}
