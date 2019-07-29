<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login_m
 *
 * @author lauwba
 */
class Login_m extends CI_Model {

    //put your code here
    function cek($username, $password) {
        $this->db->where('user', $username);
        $this->db->where('pass', $password);
        return $this->db->get('staf');
    }

    function login_bycookie($id) {
        $this->db->where('id_staf', $id);
        return $this->db->get('staf');
    }

    function level($id) {
        if ($id == 1) {
            $lv = "Super Admin";
        } else if ($id == 2) {
            $lv = "Fotografer";
        } else if ($id == 3) {
            $lv = "Penanggungjawab";
        } else if ($id == 4) {
            $lv = "Admin Stok";
        } else if ($id == 5) {
            $lv = "Kasir";
        } else if ($id == 6) {
            $lv = "Customer Service";
        } else if ($id == 0) {
            $lv = "Level Tidak Terdaftar";
        }
        return $lv;
    }

    function hapus_antrian() {
        $this->db->where('tgl<>', date("Ymd"));
        $this->db->delete('antrian');
    }

}
