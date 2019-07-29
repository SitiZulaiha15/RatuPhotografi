<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Jurnal
 *
 * @author lauwba
 */
class Jurnal extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('staf_ratu_id')) {
            redirect('Welcome/get_staf_bycookie');
        }
    }

    function getJenisLaporan($jenis) {
        $laporan = array('Laporan Penjualan', 'Laporan Umum Berdasarkan Kelompok Akun', 'Laporan Jurnal Umum',
            'Laporan Jurnal Umum Berdasarkan Akun', 'Neraca Keuangan', 'Laporan Laba Rugi', 'Finance Meter');
        return $laporan[$jenis];
    }

    function getSumberDana($jenis) {
        $laporan = array();
        $value = $this->Jurnal_m->getSumberDana();
        $i = 0;
        foreach ($value as $values) {
            $laporan[$i] = $values->nama_tempat;
            $i++;
        }
        return $laporan[$jenis];
    }

    function test($jenis_laporan = null) {
        $this->load->view('jurnal/test');
    }

    function seluruhSumberDana() {
        $data['tabungan'] = $this->Jurnal_m->getTabungan();
        $data['total_uang'] = $this->Jurnal_m->getTotalUang();
        $data['sumber_dana'] = $this->Jurnal_m->getSumberDana();
        $this->load->view('jurnal/seluruh_sumber_dana', $data);
    }

    function index() {
        date_default_timezone_set('Asia/Jakarta');
        $data['date_now'] = date('d-M-Y');
        $data['date_now_input'] = date('Y-m-d');
        $data['jurnal_value'] = $this->Jurnal_m->getJurnalUmum();
        $data['total_saldo'] = $this->Jurnal_m->getTotalSaldo();
        $data['akun'] = $this->Jurnal_m->getAkun();
        $data['sumber_dana'] = $this->Jurnal_m->getSumberDana();
        $data['karyawan'] = $this->Jurnal_m->getKaryawan();

        $date = date('d');
        $month = date('n');
        $year = date('Y');
        $dari = '';
        $sampai = '';

        if ($date < 28 && $month == 1) {
            $tahun = $year - 1;
            $dari = $tahun . '-12-28';
            $sampai = $year . '-0' . $month . '-27';
        } else if ($date >= 28 && $month >= 1) {
            $dari = $year . '-0' . $month . '-28';
            $bulan = $month + 1;
            $sampai = $year . '-0' . $bulan . '-27';
        } else if ($date >= 1 && $date < 28 && $month >= 1) {
            $bulan_ = $month - 1;
            $dari = $year . '-0' . $bulan_ . '-28';
            $sampai = $year . '-0' . $month . '-27';
        }


        $data['jurnal_umum_sekarang'] = $this->Jurnal_m->getUmumBulanIni($dari, $sampai);
        $data['total_debit'] = $this->Jurnal_m->getTotalDebit($dari, $sampai);
        $data['total_kredit'] = $this->Jurnal_m->getTotalKredit($dari, $sampai);
        $data['uang'] = $this->Jurnal_m->getUang();
        $totaldebit = $this->Jurnal_m->getTotalDebit($dari, $sampai);
        $totalkredit = $this->Jurnal_m->getTotalKredit($dari, $sampai);
// 
        $totalseluruhdebit = $this->Jurnal_m->getTotalSeluruhDebit();
        $totalseluruhkredit = $this->Jurnal_m->getTotalSeluruhKredit();
        $total_kas = 0;
        foreach ($totaldebit as $deb) {
            foreach ($totalkredit as $kred) {
                $total_kas = $deb->totalDebit - $kred->totalKredit;
            }
        }

        $data['tahun'] = $this->Jurnal_m->getTahun();
        $data['total_kas'] = $total_kas;
        ;
        $data['penanda'] = 'umum';

        $this->load->view('jurnal/jurnal_home', $data);
    }

    function jurnal_umum_seluruh() {
        $total_seluruh_debit = $this->Jurnal_m->getTotalSeluruhDebit();
        $total_seluruh_kredit = $this->Jurnal_m->getTotalSeluruhKredit();
        $data['seluruh_jurnal'] = $this->Jurnal_m->seluruh_jurnal();
        $data['date_now'] = date('d-M-Y');
        $data['date_now_input'] = date('Y-m-d');
        $data['jurnal_value'] = $this->Jurnal_m->getJurnalUmum();
        $data['total_saldo'] = $this->Jurnal_m->getTotalSaldo();
        $data['akun'] = $this->Jurnal_m->getAkun();
        $data['sumber_dana'] = $this->Jurnal_m->getSumberDana();

        foreach ($total_seluruh_debit as $deb) {
            foreach ($total_seluruh_kredit as $kred) {
                $data['total_debit'] = $deb->totalSeluruhDebit;
                $data['total_kredit'] = $kred->totalSeluruhKredit;
            }
        }

        $this->load->view('jurnal/seluruh_laporan_jurnal_umum', $data);
    }

    function process_data($pengenal = null) {
        $keterangan = $this->input->post('keterangan_' . $pengenal);
        $no_nota = $this->input->post('no_nota_' . $pengenal);
        $akun = $this->input->post('akun_' . $pengenal);
        $tanggal = $this->input->post('tanggal_' . $pengenal);
        $debit = $this->input->post('jumlah_debit_' . $pengenal);
        $kredit = $this->input->post('jumlah_kredit_' . $pengenal);
        $sumber_dana = $this->input->post('sumber_dana_' . $pengenal);
        $kode = 0;
        $penanda = "";

        if ($pengenal == 'jurnal_umum') {
            $kode = 1;
            $pengenal = 'umum';
            $sess_data['penanda'] = 'umum';
            $this->session->set_userdata($sess_data);
        } elseif ($pengenal == 'fix_cost') {
            $kode = 2;
            $penanda = 'fix_cost';
            $sess_data['penanda'] = 'fix_cost';
            $this->session->set_userdata($sess_data);
        } elseif ($pengenal == 'gaji_karyawan') {
            $kode = 3;
            $penanda = 'gaji_karyawan';
            $sess_data['penanda'] = 'gaji_karyawan';
            $this->session->set_userdata($sess_data);
        } elseif ($pengenal == 'pindah_uang') {
            $kode = 4;
            $penanda = 'pindah_uang';
            $sess_data['penanda'] = 'pindah_uang';
            $this->session->set_userdata($sess_data);
        }

//        if ($debit != 0) {
//            $this->operasiMatematik($sumber_dana, 2, $debit);
//        } else if ($kredit != 0) {
//            $this->operasiMatematik($sumber_dana, 1, $kredit);
//        }
        $status = $this->Jurnal_m->insertIntoUmum(
                $kode, $no_nota, $tanggal, $akun, $debit, $kredit, $keterangan, $sumber_dana
        );
//        /* insertIntoUmum($pengenal, $no_nota, $tanggal, $akun, $debit, $kredit, $keterangan, $kode) */
//
//        $status = 0;
        if ($status == 0) {
            echo 'Data Berhasil Dimasukkan';
        } else if ($status == 1) {
            echo "Insert data gagal";
        } else {
            echo 'Undifined Status';
        }



//        echo 'pengenal ' . $pengenal . '<br />';
//        echo 'kode ' . $kode . '<br />';
//        echo 'keterangan ' . $keterangan . '<br />';
//        echo 'no_nota ' . $no_nota . '<br />';
//        echo 'akun ' . $akun . '<br />';
//        echo 'tanggal ' . $tanggal . '<br />';
//        echo 'debit ' . $debit . '<br />';
//        echo 'kredit ' . $kredit;
//        echo 'sumber_dana ' . $sumber_dana . '<br />';
        // $this->load->view('jurnal/seluruh_laporan_jurnal_umum', $data);
    }

    function laporan_history_letak_uang() {
        $sumberdana_value = $this->input->post('sumber_dana');
        $bulan = $this->input->post('bulan_dari');
        $tahun = $this->input->post('tahun_dari');
        if ($bulan == 1) {
            $bulan_sebelum = 12;
            $tahun_sebelum = $tahun - 1;
        } else {
            $bulan_sebelum = $bulan - 1;
            $tahun_sebelum = $tahun;
        }
        $awal = $tahun_sebelum . '-' . $bulan_sebelum;
        $akhir = $tahun . '-' . $bulan;

        $sumber_dana = $this->Jurnal_m->getSumberDana();
        $data['laporan_content'] = $this->Jurnal_m->getHistoryLetakUang($sumberdana_value, $awal, $akhir);
        $dana_value = array();
        $i = 0;
        foreach ($sumber_dana as $value) {
            $dana_value[$i] = $value->nama_tempat;
            $i++;
        }
        $data['nama_tempat'] = $dana_value[$sumberdana_value - 1];
        $data['laporan'] = 'History ' . $dana_value[$sumberdana_value - 1];
        $data['id'] = $sumberdana_value - 1;
        $data['bulan_dari'] = $this->getMonth($this->input->post('bulan_dari'));
        $data['tahun_dari'] = $this->input->post('tahun_dari');

        $this->load->view('jurnal/laporan_history_letak_uang', $data);
    }

    function laporan() {
        $jenis = $this->input->post('jenis_laporan');
        $bulan = $this->input->post('bulan_dari');
        $tahun = $this->input->post('tahun_dari');

        if ($bulan == 1) {
            $bulan_sebelum = 12;
            $tahun_sebelum = $tahun - 1;
        } else {
            $bulan_sebelum = $bulan - 1;
            $tahun_sebelum = $tahun;
        }

        $awal = $tahun_sebelum . '-' . $bulan_sebelum;
        $akhir = $tahun . '-' . $bulan;

        $data['bulan_dari'] = $this->getMonth($this->input->post('bulan_dari'));
        $data['tahun_dari'] = $this->input->post('tahun_dari');
        $data['id'] = $jenis - 1;
        $data['total_debit'] = $this->Jurnal_m->totalDebit($awal, $akhir);
        $data['total_kredit'] = $this->Jurnal_m->totalKredit($awal, $akhir);
        $data['tahun'] = $this->Jurnal_m->getTahun();
        $data['laporan'] = $this->getJenisLaporan($jenis - 1);

        if ($jenis == 1) {
            $data['content_penjualan'] = $this->Jurnal_m->getLaporanPenjualan($awal, $akhir);
            $data['total_kredit'] = $this->Jurnal_m->getTotalKreditLaporanPenjualan($awal, $akhir);
            $data['total_debit'] = $this->Jurnal_m->getTotalDebitLaporanPenjualan($awal, $akhir);
            $this->load->view('jurnal/laporan_penjualan', $data);
        } else if ($jenis == 2) {
            $data['kelompok_value'] = $this->Jurnal_m->getJurnalUmumKelompok($awal, $akhir);
            $this->load->view('jurnal/jurnal_umum_kelompok', $data);
        } else if ($jenis == 3) {
            $data['laporan_content'] = $this->Jurnal_m->getLaporanJurnalUmum($awal, $akhir);
            $this->load->view('jurnal/laporan_jurnal_umum', $data);
        } else if ($jenis == 4) {
            $data['laporan_content'] = $this->Jurnal_m->getLaporanJurnalUmumByAkun($awal, $akhir);
            $this->load->view('jurnal/laporan_jurnal_umum', $data);
        } else if ($jenis == 5) {
            $data['activ_lancar'] = $this->Jurnal_m->activaLancar($awal, $akhir);
            $data['activ_tetap'] = $this->Jurnal_m->activaTetap($awal, $akhir);
            $data['hutang'] = $this->Jurnal_m->getHutang($awal, $akhir);
            $data['modal'] = $this->Jurnal_m->getModal($awal, $akhir);
            $this->load->view('jurnal/neraca_keuangan', $data);
        } else if ($jenis == 5) {
            $data['activ_lancar'] = $this->Jurnal_m->activaLancar($awal, $akhir);
            $data['activ_tetap'] = $this->Jurnal_m->activaTetap($awal, $akhir);
            $data['hutang'] = $this->Jurnal_m->getHutang($awal, $akhir);
            $data['modal'] = $this->Jurnal_m->getModal($awal, $akhir);
            $this->load->view('jurnal/neraca_keuangan', $data);
        } else if ($jenis == 6) {
            $data['penjualan'] = $this->Jurnal_m->getPenjualan($awal, $akhir);
            $data['operational'] = $this->Jurnal_m->getBiayaOperational($awal, $akhir);
            $this->load->view('jurnal/laporan_laba_rugi', $data);
        } else if ($jenis == 7) {
            $data['kas'] = $this->Jurnal_m->getKas($awal, $akhir);
            $data['penjualan'] = $this->Jurnal_m->getPenjualan($awal, $akhir);
            $data['activ_lancar'] = $this->Jurnal_m->activaLancar($awal, $akhir);
            $data['activ_tetap'] = $this->Jurnal_m->activaTetap($awal, $akhir);
            $data['hutang'] = $this->Jurnal_m->getHutang($awal, $akhir);
            $data['operational'] = $this->Jurnal_m->getBiayaOperational($awal, $akhir);
            $data['modal'] = $this->Jurnal_m->getModal($awal, $akhir);
            $data['query'] = 'select Akun, '
                    . 'SUM(Debit) as TotDebitz, '
                    . 'SUM(Kredit) as TotKreditz '
                    . 'from umum where Akun="Kas" AND tanggal  BETWEEN '
                    . '"' . $awal . '-28" AND "' . $akhir . '-27" '
                    . 'GROUP by Akun;';


            $this->load->view('jurnal/finance_meter', $data);
        }
    }

    function laporan_by_akun() {
        $akun = $this->input->post('akun');
        $data['laporan'] = $this->getJenisLaporan(3);
        $data['akun'] = $this->Jurnal_m->getAkunByKode($akun);
        $data['akun_value'] = $this->Jurnal_m->getLaporanByAkun($akun);

        $this->load->view('jurnal/laporan_jurnal_by_akun', $data);
    }

    function seluruh_history_sumbe_Dana() {
        $kode = $this->input->post('sumber_dana');
        $data['laporan'] = 'Seluruh History Keuangan Akun ' . $this->getSumberDana($kode - 1);
        $data['sumber_dana_content_value'] = $this->Jurnal_m->getSeluruhHistorySumberDana($kode);
        $data['total_deb_content_value'] = $this->Jurnal_m->getTotalDebitSeluruhHistorySumberDana($kode);
        $data['total_kred_content_value'] = $this->Jurnal_m->getTotalKreditSeluruhHistorySumberDana($kode);

        $this->load->view('jurnal/laporan_history_seluruh_sumber_dana', $data);
    }

    function operasiMatematik($kode_sumber_dana, $debit_kredit, $jumlah_uang) {
        //kredit 1
        //debit 2


        $saldo = 0;
        $saldo_db = 0;
        $saldo_sumber_dana = $this->Jurnal_m->getByKodeUang($kode_sumber_dana);
        foreach ($saldo_sumber_dana as $value) {
            $saldo_db = $value->saldo;
        }
        try {
            if ($debit_kredit == 1) {
//                $saldo = $saldo_db - $jumlah_uang;
                echo number_format($saldo, 0, ',', '.');
            } else if ($debit_kredit == 2) {
//                $saldo = $saldo_db + $jumlah_uang;
                echo number_format($saldo, 0, ',', '.');
            }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    function set_active_tabs() {
        $sess_data['penanda'] = $this->input->post('penanda');
        $this->session->set_userdata($sess_data);
    }

    function getMonth($bulan) {
        $cars = array(
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        );
        return $cars[$bulan - 1];
    }

    function input_penjualan() {
        $this->load->view('jurnal/input_penjualan');
    }

    function penjualan() {
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $m_byr = $this->input->post('metode_byr');
        $data['pj'] = $this->Jurnal_m->penjualan_db($start, $end, $m_byr);
        $data['uang'] = $this->Jurnal_m->uang_db();
        $data['start'] = $start;
        $data['end'] = $end;
        $this->load->view('jurnal/penjualan', $data);
    }

    function proses_pj() {
        //insert
        $debit = $this->input->post('debit');
        $kredit = $this->input->post('kredit');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $id_umum = $this->Jurnal_m->id();
        $data = array(
            'id' => $id_umum,
            'no_nota' => 0,
            'tanggal' => date('Y-m-d'),
            'Akun' => "410",
            'Debit' => $debit,
            'Kredit' => $kredit,
            'ket' => "keterangan_" . $start . " sampai " . $end,
            'kode' => $this->input->post('kode')
        );
        $this->Jurnal_m->proses_pj_db($data);
        //update
        $query = $this->Jurnal_m->penjualan_db($start, $end);
        foreach ($query as $r) {
            $data_update = array(
                'id_umum' => $id_umum
            );
            $this->Jurnal_m->update_trans($data_update, $r->no_nota);
        }
        redirect('jurnal', 'auto');
//        header("location:");
    }

    function input_stok() {
        $this->load->view('jurnal/input_stok');
    }

    function stok() {
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $data['pj'] = $this->Jurnal_m->stok_db($start, $end);
        $data['uang'] = $this->Jurnal_m->uang_db();
        $data['start'] = $start;
        $data['end'] = $end;
        $this->load->view('jurnal/stok', $data);
    }

    function proses_stok() {
        //insert
        $debit = $this->input->post('debit');
        $kredit = $this->input->post('kredit');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $id_umum = $this->Jurnal_m->id();
        $data = array(
            'id' => $id_umum,
            'no_nota' => 0,
            'tanggal' => date('Y-m-d'),
            'Akun' => "130",
            'Debit' => $debit,
            'Kredit' => $kredit,
            'ket' => "keterangan_stok" . $start . " sampai " . $end,
            'kode' => $this->input->post('kode')
        );
        $this->Jurnal_m->proses_pj_db($data);
        //update
        $query = $this->Jurnal_m->stok_db($start, $end);
        foreach ($query as $r) {
            $data_update = array(
                'id_umum' => $id_umum
            );
            $this->Jurnal_m->update_stok($data_update, $r->id_in);
        }
        redirect('jurnal', 'auto');
//        header("location:");
    }

    function detail_trans() {
        $id = $this->input->post('id_trans');
        $content = $this->Jurnal_m->get_detail_trans($id);
        echo '<table class="table table-hover">';
        echo '<tr>';
        echo '<th>Kode barang</th>';
        echo '<th>Nama barang</th> ';
        echo '<th>Harga Barang</th>';
        echo '<th>Jumlah Barang</th>';
        echo '<th>Diskon</th>';
        echo '<th>Total</th>';
        echo '</tr>';
        $subtotal = 0;
        $total = 0;
        foreach ($content as $c) {

            echo '<tr>';
            echo '<td>';
            echo $c->kd_brg;
            echo '</td>';
            echo '<td>';
            echo $c->nm_brg;
            echo '</td>';
            echo '<td>';
            echo "Rp. " . number_format($c->hrg_brg, 0, ',', '.');
            echo '</td>';
            echo '<td>';
            echo $c->jml;
            echo '</td>';
            echo '<td>';
            echo $c->diskon;
            echo '</td>';
            echo '<td>';
            echo "Rp. " . number_format(($subtotal = ($c->hrg_brg * $c->jml)- $c->diskon) , 0, ',', '.');
            echo '</td>';
            echo '</tr>';
            $total+=$subtotal;
        }
        echo '<tr>';
        echo '<td colspan="5"><b>Total</b></td>';
        echo '<td><b>';
        echo "Rp. " . number_format($total, 0, ',', '.');
        echo '</b></td>';
        echo '</tr>';
//        foreach($dp as $s){

//        break;
//     }
        echo "</table>";
    }
    function detail_stok() {
        $id = $this->input->post('id_in');
        $content = $this->Jurnal_m->get_detail_stok($id);
        echo '<table class="table table-hover">';
        echo '<tr>';
        echo '<th>Kode barang</th>';
        echo '<th>Nama barang</th> ';
        echo '<th>Harga Barang</th>';
        echo '<th>Jumlah Barang</th>';
        echo '<th>Total</th>';
        echo '</tr>';
        $subtotal = 0;
        $total = 0;
        foreach ($content as $c) {

            echo '<tr>';
            echo '<td>';
            echo $c->id_bb;
            echo '</td>';
            echo '<td>';
            echo $c->nm_bb;
            echo '</td>';
            echo '<td>';
            echo "Rp. " . number_format($c->hrg_beli, 0, ',', '.');
            echo '</td>';
            echo '<td>';
            echo $c->jml_in;
            echo '</td>';
            echo '<td>';
            echo "Rp. " . number_format(($subtotal = $c->hrg_beli * $c->jml_in), 0, ',', '.');
            echo '</td>';
            echo '</tr>';
            $total+=$subtotal;
        }
        echo '<tr>';
        echo '<td colspan="4"><b>Total</b></td>';
        echo '<td><b>';
        echo "Rp. " . number_format($total, 0, ',', '.');
        echo '</b></td>';
        echo '</tr>';
//        foreach($dp as $s){

//        break;
//     }
        echo "</table>";
    }

}
