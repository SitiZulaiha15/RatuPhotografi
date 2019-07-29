<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Report_m
 *
 * @author lauwba
 */
class Report_m extends CI_Model {

    //put your code here
    function limit_bb_db() {
        $this->db->where('stok <= limit');
        $this->db->select('*');
        $this->db->from('bahan_baku');
        return $this->db->get()->result();
    }

    function stok_now_db() {
        $this->db->select('*');
        $this->db->from('bahan_baku');
        return $this->db->get()->result();
    }
    function staf_kinerja() {
        $this->db->or_where('level', 3);
        $this->db->select('*');
        $this->db->from('staf');
        return $this->db->get()->result();
    }

    function kinerja_db($start, $end, $id) {
        //Select * from transaksi join item_trans on transaksi.id_trans=item_trans.id_trans where (id_foto='S_03' or id_pj='S_01') and tgl between '2018-01-01' and '2018-04-30'
        $query = $this->db->query("Select * from transaksi 
                join item_trans on transaksi.id_trans=item_trans.id_trans
                join barang on barang.kd_brg=item_trans.kd_brg
                where (id_foto='$id' or id_pj='$id')and tgl between '$start' and '$end' group by barang.kd_brg");
        return $query->result();
    }
    function jml_kerja($staf, $id){
        $query = $this->db->query("Select sum(jml) as jml from item_trans 
                join transaksi on transaksi.id_trans=item_trans.id_trans
                where (id_foto='$staf' or id_pj='$staf') and kd_brg='$id' group by item_trans.kd_brg");
        $data = $query->row();
        $jml = $data->jml;
        return $jml;
    }
    function kasir_pj_report_db($start, $end) {
        $query = $this->db->query("Select sum(diskon) as diskon, nm_brg, hpp, hrg_brg, SUM(jml) as jml 
            from transaksi
            join item_trans on transaksi.id_trans=item_trans.id_trans
            join barang on item_trans.kd_brg=barang.kd_brg
            join kategori on barang.id_kat = kategori.id_kat
            join grup on grup.id_grup=kategori.id_grup
            where (stat_byr=2 or stat_byr=1) and tgl between '$start' and '$end' group by barang.nm_brg");
        return $query->result();
    }

    function kasir_pj_kat($a, $start, $end) {
        $query = $this->db->query("Select sum(diskon) as diskon, nm_brg, hpp, hrg_brg, SUM(jml) as jml
            from transaksi
            join item_trans on transaksi.id_trans=item_trans.id_trans
            join barang on item_trans.kd_brg=barang.kd_brg
            join kategori on barang.id_kat = kategori.id_kat
            join grup on grup.id_grup=kategori.id_grup
            where (stat_byr=1 or stat_byr=2) and grup.id_grup='$a' and tgl between '$start' and '$end' group by barang.nm_brg ");
        return $query->result();
    }

    function kasir_trans_report_db($start, $end) {
        $query = $this->db->query("Select * from transaksi
            join item_trans on transaksi.id_trans=item_trans.id_trans            
            where (stat_byr=1 or stat_byr=2) and tgl between '$start' and '$end' group by transaksi.id_trans ");
        return $query->result();
    }

    function t_trans($id) {
        $query = $this->db->query("Select sum((hrg*jml)-diskon) as total from item_trans           
            where id_trans = '$id'");
        $data = $query->row();
        $jml = $data->total;
        return $jml;
    }

    function kasir_order_db($start) {
        $query = $this->db->query("Select atas_nama, no_telp, nm_brg, hpp, hrg_brg, SUM(jml) as jml 
            from transaksi
            join item_trans on transaksi.id_trans=item_trans.id_trans
            join barang on item_trans.kd_brg=barang.kd_brg
            join kategori on barang.id_kat = kategori.id_kat
            join grup on grup.id_grup=kategori.id_grup
            where (stat_byr=1 or stat_byr=2) and tgl ='$start'group by barang.nm_brg order by atas_nama ASC");
        return $query->result();
    }

    function kasir_rinci_db($start, $end) {
        $query = $this->db->query("Select * 
            from transaksi
            join item_trans on transaksi.id_trans=item_trans.id_trans
            join barang on item_trans.kd_brg=barang.kd_brg
            join kategori on barang.id_kat = kategori.id_kat
            join grup on grup.id_grup=kategori.id_grup
            where (stat_byr=1 or stat_byr=2) and tgl between '$start' and '$end' group by transaksi.id_trans order by atas_nama ASC");
        return $query->result();
    }

    function qty($id) {
        $query = $this->db->query("Select sum(jml) as jml from item_trans 
                join transaksi on transaksi.id_trans=item_trans.id_trans
                where transaksi.id_trans='$id' group by item_trans.kd_brg");
        $data = $query->row();
        $jml = $data->jml;
        return $jml;
    }

}
