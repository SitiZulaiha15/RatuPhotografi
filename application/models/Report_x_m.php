<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Report_x_m
 *
 * @author windows8.1
 */
class Report_x_m extends CI_Model {

    //put your code here
    function pj_trans($start, $end) {
        $query = $this->db->query("Select no_nota, id_trans, atas_nama, tgl from transaksi 
            where (stat_byr=2 or stat_byr=1) and tgl between '$start' and '$end'");
        return $query->result();
    }

    function pj_barang($id_trans) {
        $query = $this->db->query("Select diskon, hpp, hrg_brg, nm_brg, hrg, jml
            from  item_trans i join barang b on b.kd_brg=i.kd_brg
            where id_trans='$id_trans'");
//        $query = $this->db->query("Select atas_nama, tgl, diskon, hpp, hrg_brg, nm_brg, hrg, jml
//            from transaksi t join item_trans i on t.id_trans=i.id_trans
//            join barang b on b.kd_brg=i.kd_brg
//            where (stat_byr=2 or stat_byr=1) and tgl between '$start' and '$end'");
        return $query->result();
    }

    function pj_bayar($no_nota) {
        $query = $this->db->query("Select bayar, tgl_byr, metode_byr
            from detail_bayar where no_nota='$no_nota'");
        return $query->result();
    }

}
