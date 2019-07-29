<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Jurnal_m
 *
 * @author lauwba
 */
class Jurnal_m extends CI_Model {

    //put your code here
    function penjualan_db($start, $end,$m_byr) {
        // $this->db->group_by('transaksi.id_trans', TRUE);
        // $this->db->where('tgl >=', "$start");
        // $this->db->where('tgl <=', "$end");
        // $this->db->where('id_umum = "0"');
        // $this->db->where('stat_byr = "2"');
        // // $this->db->where('(stat_byr=1 OR stat_byr=2)');
        // $this->db->select('SUM((item_trans.jml*item_trans.hrg)-item_trans.diskon) as Total, transaksi.id_trans, transaksi.no_nota, transaksi.tgl, transaksi.stat_byr, transaksi.deadline, transaksi.stat_krj, transaksi.id_umum');
        // $this->db->from('transaksi');
        // $this->db->join('item_trans', 'transaksi.id_trans = item_trans.id_trans');
        // return $this->db->get()->result();
        $this->db->order_by('transaksi.id_trans', TRUE);
        $this->db->where('tgl_byr >=', "$start");
        $this->db->where('tgl_byr <=', "$end");
        $this->db->where('metode_byr', $m_byr);
        $this->db->where('detail_bayar.id_umum = "0"');
        $this->db->where('(stat_byr=1 OR stat_byr=2 Or stat_byr=8)');
        $this->db->select('bayar as Total, transaksi.id_trans, transaksi.no_nota, transaksi.tgl, transaksi.stat_byr, transaksi.deadline, transaksi.stat_krj, detail_bayar.id_umum');
        $this->db->from('transaksi');
//        $this->db->join('item_trans', 'transaksi.id_trans = item_trans.id_trans');
        $this->db->join('detail_bayar', 'transaksi.no_nota = detail_bayar.no_nota');

//        "SELECT SUM((item_trans.jml*item_trans.hrg)-item_trans.diskon) as Total,
//        transaksi.id_trans, transaksi.no_nota,
//        transaksi.tgl, transaksi.stat_byr, transaksi.deadline, transaksi.stat_krj, 
//        transaksi.id_umum, transaksi.dp FROM transaksi join item_trans
//        on transaksi.id_trans = item_trans.id_trans
//        WHERE tgl_byr detail_bayar.id_umum = '0' and stat_byr=1 OR stat_byr=2
//        and between '$start' and '$end' GROUP BY transaksi.id_trans";

        return $this->db->get()->result();
    }

    function stok_db($start, $end) {
        $this->db->group_by('stok_in.id_in', TRUE);
        $this->db->where('tgl >=', $start);
        $this->db->where('tgl <=', $end);
        $this->db->where('id_umum = "0"');
        $this->db->select('*');
        $this->db->from('stok_in');
        $this->db->join('item_stok_in', 'stok_in.id_in = item_stok_in.id_in');
        $this->db->join('bahan_baku', 'bahan_baku.id_bb = item_stok_in.id_bb');
        return $this->db->get()->result();
    }

    function get_detail_trans($id) {
        $query = $this->db->query("SELECT item_trans.diskon, 
                 barang.kd_brg, barang.nm_brg, barang.hrg_brg, item_trans.jml 
                 FROM `item_trans` INNER JOIN transaksi ON item_trans.id_trans=transaksi.id_trans 
                 INNER JOIN barang ON item_trans.kd_brg=barang.kd_brg WHERE item_trans.id_trans='" . $id . "' "
                . "ORDER BY barang.kd_brg ASC");
        return $query->result();
    }
    function get_detail_stok($id) {
        $query = $this->db->query("SELECT * 
                 FROM `item_stok_in` JOIN stok_in ON item_stok_in.id_in=stok_in.id_in 
                 JOIN bahan_baku ON item_stok_in.id_bb=bahan_baku.id_bb WHERE item_stok_in.id_in='" . $id . "' "
                . "ORDER BY bahan_baku.id_bb ASC");
        return $query->result();
    }

    function get_dp($id) {
        $query = $this->db->query("SELECT transaksi.dp, item_trans.diskon, barang.kd_brg, barang.nm_brg, barang.hrg_brg, item_trans.jml FROM `item_trans` INNER JOIN transaksi ON item_trans.id_trans=transaksi.id_trans INNER JOIN barang ON item_trans.kd_brg=barang.kd_brg WHERE item_trans.id_trans='" . $id . "' ORDER BY barang.kd_brg ASC");
        return $query->result();
    }

    // function penjualan_db($start, $end) {
    //     $this->db->group_by('transaksi.id_trans', TRUE);
    //     $this->db->where('tgl >=', $start);
    //     $this->db->where('tgl <=', $end);
    //     $this->db->where('id_umum = "0"');
    //     $this->db->where('stat_byr = "2"');
    //     $this->db->select('*');
    //     $this->db->from('transaksi');
    //     $this->db->join('item_trans', 'transaksi.id_trans = item_trans.id_trans');
    //     return $this->db->get()->result();
    // }
    // function stok_db($start, $end) {
    //     $this->db->group_by('stok_in.id_in', TRUE);
    //     $this->db->where('tgl >=', $start);
    //     $this->db->where('tgl <=', $end);
    //     $this->db->select('*');
    //     $this->db->from('stok_in');
    //     $this->db->join('item_stok_in', 'stok_in.id_in = item_stok_in.id_in');
    //     return $this->db->get()->result();
    // }

    function uang_db() {
        $query = $this->db->query("Select *  FROM uang");
        return $query->result();
    }

    function id() {
        $query = $this->db->query("Select MAX(id) as id FROM umum limit 1");
        $data = $query->row();
        $kode = $data->id + 1;
        return $kode;
    }

    function proses_pj_db($data) {
        $this->db->insert('umum', $data);
    }

    function update_trans($data_update, $id) {
        $this->db->where('no_nota', $id);
        $this->db->update('detail_bayar', $data_update);
    }

    function update_stok($data_update, $id) {
        $this->db->where('id_in', $id);
        $this->db->update('stok_in', $data_update);
    }

    function getJurnalUmum() {
        $this->db->select('*');
        $this->db->from('uang');
        $this->db->where('kode in (1,2,3,4)');
        return $this->db->get()->result();
    }

    function getTotalSaldo() {
        $this->db->select('sum(saldo) as total');
        $this->db->from('uang');
        $this->db->where('kode in (1,2,3,4)');
        return $this->db->get()->result();
    }

    function getUang() {
        $this->db->select('*');
        $this->db->from('uang');
        $this->db->where('kode in (1,2,3,4)');
        return $this->db->get()->result();
    }

    function updateUang($id, $jumlah) {
        $data = array(
            'saldo' => $jumlah
        );
        $this->db->where('kode', $id);
        $this->db->update('uang', $data);
    }

    function getByKodeUang($kode) {
        $this->db->select('*');
        $this->db->from('uang');
        $this->db->where('kode in (' . $kode . ')');
        return $this->db->get()->result();
    }

    function getKodeAkun($nama) {
        $this->db->select('*');
        $this->db->from('akun');
        $this->db->where('WHERE Akun LIKE "%' . $nama . '%"');
        $this->db->order_by('Akun', 'asc');
        return $this->db->get()->result();
    }

    function getTotalUang() {
        $this->db->select('sum(saldo) as total');
        $this->db->from('uang');
        return $this->db->get()->result();
    }

    function getTabungan() {
        // select sum(saldo) from uang where kode in (5,6,7,9,10,11)
        $this->db->select('sum(saldo) as totalTabungan');
        $this->db->from('uang');
        $this->db->where('kode in (5,6,7,9,10,11)');
        return $this->db->get()->result();
    }

    function getAkun() {
        $this->db->select('*');
        $this->db->from('akun');
        $this->db->where('Akun <> "Bahan Baku" AND Akun <> "Penjualan"');
        $this->db->order_by('Akun', 'asc');
        return $this->db->get()->result();
    }

    function getSumberDana() {
        $this->db->select('*');
        $this->db->from('uang');
        $this->db->order_by('kode', 'asc');
        return $this->db->get()->result();
    }

    function getUmumBulanIni($sblm, $skrg) {
        $query = $this->db->query(
                'SELECT umum.no_nota, umum.tanggal, akun.Akun, umum.Debit, umum.Kredit, umum.ket, umum.kode FROM umum INNER JOIN akun WHERE umum.Akun=akun.Kode AND umum.tanggal BETWEEN "' . $sblm . '" AND "' . $skrg . '" ORDER BY umum.id ASC'
        );
        //'SELECT * FROM umum WHERE tanggal BETWEEN "' . $sblm . '" AND "' . $skrg . '" ORDER BY id ASC'
        return $query->result();
    }

    function getTotalDebit($sblm, $skrg) {
        $query = $this->db->query(
                'SELECT sum(Debit) as totalDebit FROM umum WHERE tanggal BETWEEN "' . $sblm . '" AND "' . $skrg . '" ORDER BY id ASC'
        );
        return $query->result();
    }

    function getTotalKredit($sblm, $skrg) {
        $query = $this->db->query(
                'SELECT sum(Kredit) as totalKredit FROM umum WHERE tanggal BETWEEN "' . $sblm . '" AND "' . $skrg . '" ORDER BY id ASC'
        );
        return $query->result();
    }

    function getTotalSeluruhDebit() {
        $query = $this->db->query(
                'SELECT sum(Debit) as totalSeluruhDebit FROM umum'
        );
        return $query->result();
    }

    function getTotalSeluruhKredit() {
        $query = $this->db->query(
                'SELECT sum(Kredit) as totalSeluruhKredit FROM umum'
        );
        return $query->result();
    }

    function seluruh_jurnal() {
        $query = $this->db->query(
                'SELECT * FROM umum ORDER BY tanggal, id asc'
        );
        return $query->result();
    }

    function getTahun() {
        $query = $this->db->query(
                'select DISTINCT substring(tanggal, 1, 4) as tahunTerakhir from umum order by tanggal asc'
        );
        return $query->result();
    }

    function getKaryawan() {
        $query = $this->db->query(
                'select * from staf order by nm_staf asc'
        );
        return $query->result();
    }

    function getSeluruhHistorySumberDana($kode) {
        $query = $this->db->query(
                'select umum.no_nota, umum.tanggal, akun.Akun, umum.Debit, umum.Kredit, umum.ket, umum.kode FROM umum INNER JOIN akun WHERE umum.Akun=akun.Kode AND umum.kode="' . $kode . '" order by umum.id asc'
        );
        return $query->result();
    }

    function getTotalDebitSeluruhHistorySumberDana($kode) {
        $query = $this->db->query(
                'select SUM(Debit) as totaldebit FROM umum  WHERE kode="' . $kode . '"'
        );
        return $query->result();
    }

    function getTotalKreditSeluruhHistorySumberDana($kode) {
        $query = $this->db->query(
                'select SUM(Kredit) as totalkredit FROM umum  WHERE kode="' . $kode . '"'
        );
        return $query->result();
    }

    function laporanTest($awal, $akhir) {
//        $query = $this->db->query(
//                'select * from umum  WHERE tanggal BETWEEN "' . $awal . '-28" AND "' . $akhir . '-27"  order by tanggal, id asc'
//        );
        $query = $this->db->query(
                'select * from umum  WHERE tanggal BETWEEN "2017-12-28" AND "2018-01-27" order by akun, tanggal asc'
        ); //FIX
//        $query = $this->db->query(
//                'select * from umum where kode="' . $kode . '" and tanggal BETWEEN "' . $awal . '-28" AND "' . $akhir . '-27" order by id asc'
//        );
        return $query->result();
    }

    function getLaporanJurnalUmum($awal, $akhir) {
        $query = $this->db->query(
                'SELECT umum.no_nota, umum.tanggal, akun.Akun, umum.Debit, umum.Kredit, umum.ket, umum.kode FROM umum INNER JOIN akun WHERE umum.Akun=akun.Kode AND umum.tanggal BETWEEN "' . $awal . '-28" AND "' . $akhir . '-27"  order by umum.tanggal, umum.id asc'
        );

        return $query->result();
    }

    function getLaporanPenjualan($awal, $akhir) {
        $query = $this->db->query(
                'SELECT umum.no_nota, umum.tanggal, akun.Akun, umum.Debit, umum.Kredit, umum.ket, umum.kode FROM umum INNER JOIN akun WHERE umum.Akun=akun.Kode AND umum.akun="410" AND umum.tanggal BETWEEN "' . $awal . '-28" AND "' . $akhir . '-27" ORDER BY umum.id ASC'
        );
        return $query->result();
    }

    function getTotalDebitLaporanPenjualan($awal, $akhir) {
        $query = $this->db->query(
                'SELECT SUM(Debit) as totaldebit FROM umum WHERE umum.akun="410" AND umum.tanggal BETWEEN "' . $awal . '-28" AND "' . $akhir . '-27" ORDER BY umum.id ASC'
        );
        return $query->result();
    }

    function getTotalKreditLaporanPenjualan($awal, $akhir) {
        $query = $this->db->query(
                'SELECT SUM(Kredit) as totalkredit FROM umum WHERE umum.akun="410" AND umum.tanggal BETWEEN "' . $awal . '-28" AND "' . $akhir . '-27" ORDER BY umum.id ASC'
        );
        return $query->result();
    }

    function getLaporanJurnalUmumByAkun($awal, $akhir) {
        $query = $this->db->query(
                'SELECT umum.no_nota, umum.tanggal, akun.Akun, umum.Debit, umum.Kredit, umum.ket, umum.kode FROM umum INNER JOIN akun WHERE umum.Akun=akun.Kode AND umum.tanggal BETWEEN "' . $awal . '-28" AND "' . $akhir . '-27" order by umum.tanggal, umum.id asc'
        );

        return $query->result();
    }

    function getHistoryLetakUang($kode, $awal, $akhir) {
        $query = $this->db->query(
                'select umum.no_nota, umum.tanggal, akun.Akun, umum.Debit, umum.Kredit, umum.ket, umum.kode FROM umum INNER JOIN akun WHERE umum.Akun=akun.Kode AND umum.kode="' . $kode . '" and tanggal BETWEEN "' . $awal . '-28" AND "' . $akhir . '-27" order by umum.id asc'
        );
        return $query->result();
    }

    function activaLancar($awal, $akhir) {
        $query = $this->db->query(
                'select '
                . 'B.Akun, '
                . 'SUM(A.Debit) as TotDebita, '
                . 'SUM(A.Kredit) as TotKredita '
                . 'from umum A, akun B '
                . 'where A.Akun=B.Kode '
                . 'and B.Group="Aktiva Lancar" '
                . 'and A.tanggal BETWEEN '
                . '"' . $awal . '-28" AND "' . $akhir . '-27"'
                . 'GROUP by A.Akun;'
        );
        return $query->result();
    }

    function activaTetap($awal, $akhir) {
        $query = $this->db->query(
                'select B.Akun, '
                . 'SUM(A.Debit) as TotDebitb, '
                . 'SUM(A.Kredit) as TotKreditb '
                . 'from umum A, akun B '
                . 'where A.Akun=B.Kode and B.Group="Aktiva Tetap"'
                . 'and A.tanggal  BETWEEN '
                . '"' . $awal . '-28" AND "' . $akhir . '-27"'
                . 'GROUP by A.Akun;'
        );
        return $query->result();
    }

    function getHutang($awal, $akhir) {
        $query = $this->db->query(
                'select B.Akun, '
                . 'SUM(A.Debit) as TotDebitc, '
                . 'SUM(A.Kredit) as TotKreditc '
                . 'from umum A, akun B '
                . 'where A.Akun=B.Kode and B.Group="Utang"'
                . ' and A.tanggal BETWEEN '
                . '"' . $awal . '-28" AND "' . $akhir . '-27"'
                . 'GROUP by A.Akun'
        );
        return $query->result();
    }

    function getModal($awal, $akhir) {
        $query = $this->db->query(
                'select B.Akun, '
                . 'SUM(A.Debit) as TotDebitd, '
                . 'SUM(A.Kredit) as TotKreditd '
                . 'from umum A, akun B '
                . 'where A.Akun=B.Kode and B.Group="Modal"'
                . 'and A.tanggal BETWEEN '
                . '"' . $awal . '-28" AND "' . $akhir . '-27"'
                . 'GROUP by A.Akun;'
        );
        return $query->result();
    }

    function getKas($awal, $akhir) {
        $query = $this->db->query(
                'select Akun, '
                . 'SUM(Debit) as TotDebitz, '
                . 'SUM(Kredit) as TotKreditz '
                . 'from umum where Akun="110" AND tanggal  BETWEEN '
                . '"' . $awal . '-28" AND "' . $akhir . '-27" '
                . 'GROUP by Akun;'
        );
        return $query->result();
    }

    function getBiayaOperational($awal, $akhir) {
        $query = $this->db->query(
                'select B.Akun, '
                . 'SUM(A.Debit) as TotDebite, '
                . 'SUM(A.Kredit) as TotKredite '
                . 'from umum A, akun B '
                . 'where A.Akun=B.Kode and B.Group="Operational"'
                . ' and A.tanggal BETWEEN'
                . '"' . $awal . '-28" AND "' . $akhir . '-27"'
                . 'GROUP by B.Akun;'
        );
        return $query->result();
    }

    function getPenjualan($awal, $akhir) {
        $query = $this->db->query(
                'select akun.Akun, '
                . 'SUM(umum.Debit) as TotDebitD, '
                . 'SUM(umum.Kredit) as TotKreditD '
                . 'from umum INNER JOIN akun where umum.Akun=akun.Kode AND umum.Akun="410" '
                . 'AND tanggal  BETWEEN'
                . '"' . $awal . '-28" AND "' . $akhir . '-27"'
                . 'GROUP by Akun;'
        );
        return $query->result();
    }

    function getLaporanByAkun($akun) {
        //select umum.no_nota, umum.tanggal, akun.Akun, umum.Debit, umum.Kredit, umum.ket, umum.kode FROM umum INNER JOIN akun WHERE umum.akun="' . $akun . '" order by umum.tanggal, umum.id asc'
        $query = $this->db->query(
                'select umum.no_nota, umum.tanggal, akun.Akun, umum.Debit, umum.Kredit, umum.ket, umum.kode from umum INNER JOIN akun where umum.Akun=akun.Kode AND umum.akun="' . $akun . '" order by umum.tanggal, umum.id asc'
        );
        return $query->result();
    }

    function totalDebit($awal, $akhir) {
        $query = $this->db->query(
                'select SUM(Debit) as totaldebit FROM umum WHERE tanggal BETWEEN "' . $awal . '-28" AND "' . $akhir . '-27"'
        );
        return $query->result();
    }

    function totalKredit($awal, $akhir) {
        $query = $this->db->query(
                'select SUM(Kredit) as totalkredit FROM umum WHERE tanggal BETWEEN "' . $awal . '-28" AND "' . $akhir . '-27"'
        );
        return $query->result();
    }

    function getJurnalUmumKelompok($awal, $akhir) {
        $query = $this->db->query(
                'select akun.Akun, SUM(umum.Debit) as totalDebit,'
                . ' SUM(umum.Kredit) as totalKredit FROM umum INNER JOIN akun WHERE umum.Akun=akun.Kode AND tanggal BETWEEN "' . $awal . '-28" AND "' . $akhir . '-27"  group by Akun'
        );
        return $query->result();
    }

    function insertIntoUmum($pengenal, $no_nota, $tanggal, $akun, $debit, $kredit, $keterangan, $kode) {

        // 1 untuk input jurnal umum
        if ($pengenal == 1) {
            $data = array(
                'no_nota' => $no_nota,
                'tanggal' => $tanggal,
                'Akun' => $akun,
                'Debit' => $debit,
                'Kredit' => $kredit,
                'ket' => $keterangan,
                'kode' => $kode
            );
            // 2 untuk pindah uang fix cost    
        } else if ($pengenal == 2) {
            $data = array(
                'tanggal' => $tanggal,
                'Akun' => $akun,
                'Debit' => $debit,
                'Kredit' => $kredit,
                'ket' => $keterangan,
                'kode' => $kode
            );
            // 3 untuk penggajian karyawan    
        } else if ($pengenal == 3) {
            $data = array(
                'tanggal' => $tanggal,
                'Akun' => $akun,
                'Debit' => $debit,
                'Kredit' => $kredit,
                'ket' => $keterangan,
                'kode' => $kode
            );
            // 4 untuk pindah uang menu pemindahan uang    
        } else if ($pengenal == 4) {
            $data = array(
                'tanggal' => $tanggal,
                'Akun' => $akun,
                'Debit' => $debit,
                'Kredit' => $kredit,
                'ket' => $keterangan,
                'kode' => $kode
            );
        }


        $this->db->insert('umum', $data);
        if ($this->db->affected_rows() > 0) {
            return 0;
        } else {
            return 1;
        }
    }

    function getAkunByKode($kode) {
        $this->db->select('Akun');
        $this->db->from('akun');
        $this->db->where('kode', $kode);
        return $this->db->get()->row();
    }

}
