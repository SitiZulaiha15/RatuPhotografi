<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Job_m
 *
 * @author lauwba
 */
class Job_m extends CI_Model {

    //put your code here
    function job_all_db() {
//        $this->db->where('stat_krj <> 4');
//        $this->db->select('*');
//        $this->db->from('transaksi');
        $today = date("Y-m-d");
        $query = $this->db->query("SELECT * FROM transaksi where stat_krj <> 4 and deadline >= '$today'");
        return $query->result();
    }

    function job_by_db($id) {
//        $this->db->where('stat_krj<>4');
//        $this->db->where('id_pj='.$id.' OR id_foto='.$id);
//        $this->db->where('id_pj', $id);
//        $this->db->or_where('id_foto', $id);
//        $this->db->select('*');
//        $this->db->from('transaksi');
//        return $this->db->get()->result();
        $today = date("Y-m-d");
        $query = $this->db->query("Select * FROM transaksi where (id_pj='$id' or id_foto='$id') and stat_krj<>4 and deadline >= '$today'");
        return $query->result();
    }

    function update_krj_db($data, $id) {
        $this->db->where('id_trans', $id);
        $this->db->update('transaksi', $data);
    }

    function staf_job() {
//        $this->db->where('level',3);
//        $this->db->or_where('level',0);
        $this->db->select('*');
        $this->db->from('staf');
        return $this->db->get()->result();
    }

    function staf_job_forjob() {
//        $this->db->where('level',2);
        $this->db->or_where('level', 3);
        $this->db->select('*');
        $this->db->from('staf');
        return $this->db->get()->result();
    }

    function stat_krj() {
        $query = $this->db->query("Select *  FROM status_kerja");
        return $query->result();
    }

    function status($id) {
        $query = $this->db->query("Select status as s FROM status_kerja where id_stat=$id");
        $data = $query->row();
        $kode = $data->s;
        return $kode;
    }

    function search_job_sa($nama, $tgl) {
        $query = $this->db->query("Select * from transaksi where (atas_nama like '$nama' or tgl='$tgl')");
        return $query->result();
    }
    function search_job($nama, $tgl, $id) {
        $query = $this->db->query("Select * from transaksi where (atas_nama like '$nama' or tgl='$tgl') and (id_pj='$id')");
        return $query->result();
    }

}
