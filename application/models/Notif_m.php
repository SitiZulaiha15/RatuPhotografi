<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notif_m
 *
 * @author lauwba
 */
class Notif_m extends CI_Model{
    //put your code here
    function recieve_db($id){
        $query = $this->db->query("SELECT * FROM transaksi WHERE id_trans IN 
                (SELECT MAX(id_trans) FROM transaksi) AND notif_stat = '0' AND 
                id_foto='$id' ORDER BY id_trans DESC LIMIT 1");
        return $query->result();
    }
    function update_db($data, $id_trans){
        $this->db->where('id_trans', $id_trans);
        $this->db->update('transaksi',$data);
    }
}
