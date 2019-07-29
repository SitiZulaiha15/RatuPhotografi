<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logout
 *
 * @author lauwba
 */
class Logout extends CI_Controller{
    //put your code here
    public function index() {
        $this->session->unset_userdata('staf_ratu_id');
        $this->session->unset_userdata('staf_ratu_name');
        $this->session->unset_userdata('staf_ratu_lv');
        delete_cookie('staf_ratu_id');
        redirect(site_url('Welcome'));
    }
}
