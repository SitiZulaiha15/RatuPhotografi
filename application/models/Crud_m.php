<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Crud_m
 *
 * @author lauwba
 */
class Crud_m extends CI_Model {

    //put your code here
    function select($table) {
        $query = $this->db->query("Select * from $table");
        return $query->result();
    }

    function select_id($table, $field, $id) {
        $query = $this->db->query("Select * from $table where $field='$id'");
        return $query->result();
    }

    function insert($table, $data) {
        $this->db->insert($table, $data);
    }

    function update($table, $data, $field, $id) {
        $this->db->where($field, $id);
        $this->db->update($table, $data);
    }

    function delete($table, $field, $id) {
        $this->db->where($field, $id);
        $this->db->delete($table);
    }

    function kode($id) {
        $this->db->where('id_grup', $id);
        $this->db->select('RIGHT(id_kat,5) as kode', FALSE);
        $this->db->order_by('id_kat', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('kategori');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT);
        return $kodemax;
    }

    function m_id($a, $like) {
        date_default_timezone_set('Asia/Jakarta');
        $this->db->like('id_member', $a);
        $this->db->where('DATE(tgl_daftar)=CURDATE()');
        $this->db->select('RIGHT(id_member,3) as kode', FALSE);
        $this->db->order_by('id_member', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('member');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = $a .date('dmy'). str_pad($kode, 3, "0", STR_PAD_LEFT);
        return $kodemax;
    }
    function k_id(){
        $this->db->select('RIGHT(id_staf,3) as kode', FALSE);
        $this->db->order_by('id_staf', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('staf');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = "S-" . str_pad($kode, 3, "0", STR_PAD_LEFT);
        return $kodemax;
    }
    function bb_id(){
        $query = $this->db->query("SELECT * FROM bahan_baku where id_bb like 'BB-%'");
	$lastid = $query->num_rows();
	$row = $lastid+1;
	$kode = "BB-".$row;
        return $kode;
    }
    function kd_brg(){
        $query = $this->db->query("SELECT * FROM barang where kd_brg like 'Brg-%'");
	$lastid = $query->num_rows();
	$row = $lastid+1;
	$kode = "Brg-".$row;
        return $kode;
    }

}
