<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Book_,
 *
 * @author windows8.1
 */
class Book_m extends CI_Model {
    //put your code here
    function jadwal_booking_db($date){
        $query = $this->db->query("Select * from transaksi where date(jadwal_foto) = date('$date')");
        return $query->result();
    }
    function data_booking_db($nota){
        $query=$this->db->query("SELECT * from transaksi
                WHERE transaksi.no_nota='$nota'
                ");
        return $query->result();
    }
    function nota_booking_db($nota){
        $query=$this->db->query("SELECT * from transaksi  join
                detail_bayar ON transaksi.no_nota=detail_bayar.no_nota
                WHERE transaksi.no_nota='$nota'
                ");
        return $query->result();
    }
    function status_book($data, $id) {
        $this->db->where('no_nota', $id);
        $this->db->update('transaksi', $data);
    }
}
