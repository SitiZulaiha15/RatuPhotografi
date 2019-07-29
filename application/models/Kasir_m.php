<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Kasir_m
 *
 * @author lauwba
 */
class Kasir_m extends CI_Model {

    function trans_db($nota) {
        $this->db->where('no_nota', $nota);
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('item_trans', 'transaksi.id_trans=item_trans.id_trans');
        $this->db->join('barang', 'item_trans.kd_brg=barang.kd_brg');
        return $this->db->get()->result();
    }

    function trans_kasir($id, $date) {
        $query = $this->db->query("SELECT * from transaksi where (no_nota='$id'
                 or atas_nama like '%$id%') or (tgl = '$date' and stat_byr<>2)");
        return $query->result();
    }
    function dp($id){
        $query = $this->db->query("Select sum(bayar)as bayar from detail_bayar where no_nota='$id'");
        if ($query->num_rows()>0){
            $data= $query->row()->bayar;
        } else {
            $data = 0;
        }
        return $data;
    }

    //put your code here
    function status_db($data, $id) {
        $this->db->where('id_trans', $id);
        $this->db->update('transaksi', $data);
    }

    function bayar_db($data) {
        $this->db->insert('detail_bayar', $data);
    }

    function nota_db($id) {
//        $this->db->where('transaksi.no_nota', $id);
//        $this->db->select('sum(bayar) as bayar, detail_bayar.no_nota, atas_nama, no_telp, id_cs, detail_bayar.id_kasir, tgl_byr');
//        $this->db->from('transaksi');
//        $this->db->join('detail_bayar', 'transaksi.no_nota=detail_bayar.no_nota');
//        return $this->db->get()->result();
        $query = $this->db->query("SELECT sum(bayar) as bayar,metode_byr, detail_bayar.no_nota, 
                atas_nama, no_telp, id_pj,id_cs,deadline, id_trans, tgl_byr, detail_bayar.id_kasir, tgl_byr FROM `transaksi` 
                join detail_bayar on transaksi.no_nota=detail_bayar.no_nota 
                WHERE transaksi.no_nota='$id'");
        return $query->result();
    }

    function staf_nm($id) {
        $this->db->where('id_staf', $id);
        $this->db->select('*', FALSE);
        $this->db->limit(1);
        $query = $this->db->get('staf');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = $data->nm_staf;
        } else {
            $kode = "";
        }
        return $kode;
    }

    function barang_db($id) {
        $this->db->where('transaksi.id_trans', $id);
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('item_trans', 'transaksi.id_trans=item_trans.id_trans');
        $this->db->join('barang', 'barang.kd_brg=item_trans.kd_brg');
        return $this->db->get()->result();
    }

}
