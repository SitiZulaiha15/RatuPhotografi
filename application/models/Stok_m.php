<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stok_m
 *
 * @author lauwba
 */
class Stok_m extends CI_Model {

    private $table_name = 'bahan_baku';
    private $primary_key = 'id_bb';

    public function __construct() {

        parent::__construct();
    }

    //put your code here
    public function get() {
        $this->db->select('*');
        return $this->db->get($this->table_name)->result();
    }

    public function get_by_id($id) {
        $this->db->where($this->primary_key, $id);
        return $this->db->get($this->table_name)->row();
    }

    function id_stok_in() {
//        $this->db->select('RIGHT(id_in,5) as kode', FALSE);
//        $this->db->order_by('id_in', 'DESC');
//        $this->db->limit(1);
//        $query = $this->db->get('stok_in');      //cek dulu apakah ada sudah ada kode di tabel.    
//        if ($query->num_rows() <> 0) {
//            $data = $query->row();
//            $kode = intval($data->kode) + 1;
//        } else {
//            $kode = 1;
//        }
//        $kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT);
//        $kodejadi = "BB_IN-" . $kodemax;
//        return $kodejadi;
//        start
        $q = $this->db->query("SELECT MAX(RIGHT(id_in,3)) AS kd_max FROM stok_in WHERE DATE(tgl)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "BB_IN-" . date('dmy') . $kd;
    }

    function id_stok_out() {
//        $this->db->select('RIGHT(id_out,5) as kode', FALSE);
//        $this->db->order_by('id_out', 'DESC');
//        $this->db->limit(1);
//        $query = $this->db->get('stok_out');      //cek dulu apakah ada sudah ada kode di tabel.    
//        if ($query->num_rows() <> 0) {
//            $data = $query->row();
//            $kode = intval($data->kode) + 1;
//        } else {
//            $kode = 1;
//        }
//        $kodemax = str_pad($kode, 5, "0", STR_PAD_LEFT);
//        $kodejadi = "BB_OUT-" . $kodemax;
//        return $kodejadi;
        $q = $this->db->query("SELECT MAX(RIGHT(id_out,3)) AS kd_max FROM stok_out WHERE DATE(tgl_cek)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return "BB_OUT-" . date('dmy') . $kd;
    }

    function place_item_db($data) {
        $this->db->insert('item_stok_in', $data);
    }

    function update_stok($id, $qty) {
        $this->db->set('stok', 'stok+' . $qty, FALSE);
        $this->db->where($this->primary_key, $id);
        $this->db->update($this->table_name);
    }

    function place_stok_db($data) {
        $this->db->insert('stok_in', $data);
    }

    function place_item_out($data) {
        $this->db->insert('item_stok_out', $data);
    }

    function update_stok_out($id, $qty) {
        $this->db->set('stok', $qty);
        $this->db->where($this->primary_key, $id);
        $this->db->update($this->table_name);
    }

    function place_stoknow_db($data) {
        $this->db->insert('stok_out', $data);
    }

    function data_stok_in_db($id) {
        $this->db->where('stok_in.id_in', $id);
        $this->db->select('*');
        $this->db->from('stok_in');
        $this->db->join('item_stok_in', 'stok_in.id_in=item_stok_in.id_in');
        $this->db->join('bahan_baku', 'item_stok_in.id_bb=bahan_baku.id_bb');
        return $this->db->get()->result();
    }

    function data_stok_in_periode($start, $end) {
        $this->db->where('tgl >=', $start);
        $this->db->where('tgl <=', $end);
        $this->db->select('*');
        $this->db->from('stok_in');
        $this->db->join('item_stok_in', 'stok_in.id_in=item_stok_in.id_in');
        $this->db->join('bahan_baku', 'item_stok_in.id_bb=bahan_baku.id_bb');
        return $this->db->get()->result();
    }

    function data_stok_out_db($id) {
        $this->db->where('stok_out.id_out', $id);
        $this->db->select('*');
        $this->db->from('stok_out');
        $this->db->join('item_stok_out', 'stok_out.id_out=item_stok_out.id_out');
        $this->db->join('bahan_baku', 'item_stok_out.id_bb=bahan_baku.id_bb');
        return $this->db->get()->result();
    }

    function data_stok_out_periode($start, $end) {
        $this->db->where('tgl_cek >=', $start);
        $this->db->where('tgl_cek <=', $end);
        $this->db->select('*');
        $this->db->from('stok_out');
        $this->db->join('item_stok_out', 'stok_out.id_out=item_stok_out.id_out');
        $this->db->join('bahan_baku', 'item_stok_out.id_bb=bahan_baku.id_bb');
        return $this->db->get()->result();
    }

}
