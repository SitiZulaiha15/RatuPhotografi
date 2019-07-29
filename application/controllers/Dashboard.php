<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dashboard
 *
 * @author lauwba
 */
class Dashboard extends CI_Controller{
    //put your code here
    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('staf_ratu_id')) {
            redirect('Welcome/get_staf_bycookie');            
        }
    }
    function index(){
        $this->load->view('dashboard');
    }
}
