<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Frontline_m
 *
 * @author lauwba
 */
class Frontline_m extends CI_Model {

    //put your code here
    function package_db($id) {
//        SELECT * FROM barang where grup='paket'  ORDER BY kd_brg ASC
        $this->db->where('grup', $id);
        $this->db->select('*');
        $this->db->from('barang');
        return $this->db->get()->result();
    }

    function id_trans() {
        $q = $this->db->query("SELECT MAX(RIGHT(id_trans,4)) AS kd_max FROM transaksi WHERE DATE(tgl)=CURDATE()");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        date_default_timezone_set('Asia/Jakarta');
        return date('dmy') . $kd;
    }

    function staf_db($id) {
        $this->db->where('level', $id);
        $this->db->select('*');
        $this->db->from('staf');
        return $this->db->get()->result();
    }

    function antri_foto_db($data) {
        $this->db->insert('transaksi', $data);
    }

    function paket_db($data) {
        $this->db->insert('item_trans', $data);
    }

    function item_db($id) {
        $this->db->where('kd_brg', $id);
        $this->db->select('*');
        $this->db->from('barang');
        return $this->db->get()->result();
    }

//    function print_antrian_db($id){
//        $this->db->select('*');
//        $this->db->from('transaksi');
//        $this->db->where('id_transaksi', $id);
//        return $this->db->get()->result();
//    }
    function trans_db($id, $date) {
        //select * from transaksi left join item_transaksi on transaksi.id_trans=item_trans.id_trans
        //left join barang on item_trans.kd_brg=barang.kd_brg
        //where no_nota ="" group by id_trans
//        $this->db->where('no_nota', $id);
//        $this->db->or_where('no_nota', $id);
//        $this->db->select('*');
//        $this->db->from('transaksi');
//        $this->db->join('item_trans','transaksi.id_trans=item_trans.id_trans', 'LEFT');
//        $this->db->join('barang','item_trans.kd_brg=barang.kd_brg','LEFT');
//        return $this->db->get()->result();
//        or (atas_nama like '%$id%' and tgl='$date') or (tgl='$date')
        $query = $this->db->query("SELECT * from transaksi where (no_nota='$id')
                 or (atas_nama like '%$id%') or (tgl = '$date')");
        return $query->result();
    }

    function m_by_id($id) {
        $query = $this->db->query("SELECT * from transaksi where no_nota='$id'
                 or atas_nama like '%$id%'");
        return $query->result();
    }

    function m_by_date($date) {
        $query = $this->db->query("SELECT * from transaksi where tgl = '$date'");
        return $query->result();
    }

    function trans_detail_db($id) {
        $this->db->where('no_nota', $id);
        $this->db->select('*');
        $this->db->from('transaksi');
        return $this->db->get()->result();
    }

//    function barang_db($id) {
//        $this->db->select('*');
//        $this->db->from('barang');
//        return $this->db->get()->result();
//    }
    function barang_db($id, $like) {
        //SELECT * FROM barang where grup='file' and nm_brg like'%biasa%'
        $this->db->where('grup', $id);
        $this->db->like('nm_brg', $like);
        $this->db->select('*');
        $this->db->from('barang');
        return $this->db->get()->result();
    }

    function save_order_item($data_item) {
        $this->db->insert('item_trans', $data_item);
    }

    function save_order_db($id, $data) {
        $this->db->where('no_nota', $id);
        $this->db->update('transaksi', $data);
    }

    function ambil_db($id, $date) {
//        $this->db->like('atas_nama', $id);
//        $this->db->or_where('no_nota', $id);
////        $this->db->where('stat_krj', 0);
//        $this->db->select('*');
//        $this->db->from('transaksi');
//        return $this->db->get()->result();

        $query = $this->db->query("SELECT * from transaksi where (no_nota='$id') 
                or (atas_nama like '%$id%')  or (tgl='$date')");
        return $query->result();
    }

    function order_db($id) {
        $this->db->like('atas_nama', $id);
        $this->db->or_where('no_nota', $id);
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('item_trans', 'transaksi.id_trans=item_trans.id_trans');
        $this->db->join('barang', 'barang.kd_brg=item_trans.kd_brg');
        return $this->db->get()->result();
    }

    function foto() {
        $this->db->where('id_grup', 'G_Paket');
        $this->db->select('*');
        $this->db->from('kategori');
        return $this->db->get()->result();
    }

    function paket_foto($id) {
        $this->db->where('id_kat', $id);
        $this->db->select('*');
        $this->db->from('barang');
        return $this->db->get()->result();
    }

    function antrian($id) {
        //select RIGHT(id,2) as kode from antrian where antrian like f
        //
        $this->db->like('no', $id);
        $this->db->select('RIGHT(no,3) as kode', FALSE);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('antrian');      //cek dulu apakah ada sudah ada kode di tabel.    
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        return $kodemax;
    }

    function insert_antrian($data) {
        $this->db->insert('antrian', $data);
    }

    function print_antrian($id) {
        $this->db->where('no_nota', $id);
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->join('antrian', 'transaksi.id_trans=antrian.id_trans');
        return $this->db->get()->result();
    }

    function list_antrian($id, $stat) {
        $this->db->where('status', $stat);
        $this->db->select('*');
        $this->db->from('antrian');
        $this->db->like('no', $id);
//        $this->db->from('transaksi');
        $this->db->join('transaksi', 'transaksi.id_trans=antrian.id_trans');
        return $this->db->get()->result();
    }

    function del_antrian() {
        $this->db->where('tgl<>', date('Ymd'));
        $this->db->delete('antrian');
    }

    function get_member($search) {
        $query = $this->db->query("Select id_member,nm_member,no_telp from member where id_member='$search'");
        return $query->result();
    }

    function grup_nonpaket() {
        $this->db->where('kategori.id_grup <>', 'G_Paket');
        $this->db->group_by('kategori.id_grup');
        $this->db->order_by('nm_grup', 'ASC');
        $this->db->select('*');
        $this->db->from('kategori');
        $this->db->join('grup', 'kategori.id_grup=grup.id_grup');
        return $this->db->get()->result();
    }

    function kat_nonpaket($id) {
        $this->db->where('id_grup', $id);
        $this->db->select('*');
        $this->db->from('kategori');
        return $this->db->get()->result();
    }

    function status_member($id) {
        $query = $this->db->query("select tipe from member where id_member='$id'");
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $m = $data->tipe;
        } else {
            $m = "Non Member";
        }
        return $m;
    }
    function item_brg($nota){
         $query =$this->db->query("SELECT nm_brg, item_trans.ket as ket FROM item_trans join transaksi 
                 on transaksi.id_trans = item_trans.id_trans 
                 join barang on barang.kd_brg=item_trans.kd_brg where no_nota='$nota'");
         return $query->result();
    }

}
