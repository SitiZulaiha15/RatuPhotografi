<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Etc
 *
 * @author lauwba
 */
class Etc extends CI_Model {

    //put your code here
    public function rp($angka) {
        $rupiah = number_format($angka, 0, ',', '.');
        return $rupiah;
    }

    public function rps($angka) {
        $rupiah = number_format($angka, 0, ',', '.');
        return "Rp " . $rupiah;
    }

    function bulan($tgl) {
        $bulan = substr($tgl, 5, 2);
        Switch ($bulan) {
            case 1 : $bulan = "Januari";
                Break;
            case 2 : $bulan = "Februari";
                Break;
            case 3 : $bulan = "Maret";
                Break;
            case 4 : $bulan = "April";
                Break;
            case 5 : $bulan = "Mei";
                Break;
            case 6 : $bulan = "Juni";
                Break;
            case 7 : $bulan = "Juli";
                Break;
            case 8 : $bulan = "Agustus";
                Break;
            case 9 : $bulan = "September";
                Break;
            case 10 : $bulan = "Oktober";
                Break;
            case 11 : $bulan = "November";
                Break;
            case 12 : $bulan = "Desember";
                Break;
        }
        return $bulan;
    }

    function tgl($tgl) {
        $hari = substr($tgl, 8, 2);
        $tahun = substr($tgl, 0, 4);
        $nama_bulan = $this->bulan($tgl);
        $tgl_oke = $hari . ' ' . $nama_bulan . ' ' . $tahun;
        return $tgl_oke;
    }

    function byr($id) {
        if ($id == 0) {
            $a = "Belum";
        } else if ($id == 1) {
            $a = "DP";
        } else if ($id == 2) {
            $a = "Lunas";
        } else if ($id == 9) {
            $a = "Booking";
        } else if ($id == 8) {
            $a = "Sudah Bayar Booking";
        }
        return $a;
    }

    function jam($jam) {
        $wkt = substr($jam, 11, 5);
        return 'Jam ' . $wkt . ' WIB';
    }

    function m_byr($id) {
        if ($id == 0) {
            $a = "Tunai";
        } else if ($id == 1) {
            $a = "Transfer";
        }
        return $a;
    }

}
