<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Book
 *
 * @author windows8.1
 */
class Book extends CI_Controller {

    //put your code here
    function index() {
        $this->load->view('book/book_form');
    }

    function input_booking() {
        $id_trans = $this->Frontline_m->id_trans();
//        insert transaksi
        $nota = "n-" . time();
        $data = array(
            "id_trans" => $id_trans,
            "no_nota" => $nota,
            "atas_nama" => $this->input->post('an'),
            "tgl" => date('Ymd'),
            "stat_byr" => 9,
            "ket" => $this->input->post('ket'),
            "jadwal_foto" => $this->input->post('jadwal_foto'),
        );
//        insert item transaksi
//        $data_item = array(
//            "kd_brg" => "Brg-32",
//            'id_trans' => $id_trans,
//        );
        $this->Frontline_m->antri_foto_db($data);
//        $this->Frontline_m->paket_db($data_item);
        echo json_encode(array(
            "status" => TRUE,
            "id" => $nota
        ));
    }

    function jadwal_booking() {
        $tgl = $this->input->post('tgl');
        $data = $this->Book_m->jadwal_booking_db($tgl);
        $no = 1;
        $result = '<div class="table-responsive">
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jadwal</th>
                        <th>Atas Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($data as $d) {
            $result .= "
                <tr>
                    <td>" . $no++ . "</td>
                    <td>" . $this->Etc->tgl($d->jadwal_foto) . " ". $this->Etc->jam($d->jadwal_foto) ."</td>
                    <td>$d->atas_nama</td>
                    <td>
                        <a href='#' class='hvr-icon-float-away'
                           onclick='return confirm('Apakah anda yakin?')'                                   
                           >Batal</a>
                        <a href='" . site_url('Book/paket_book/' . $d->no_nota) . "' class='hvr-icon-wobble-horizontal'                              
                           >Proses Booking</a>
                    </td>
                </tr>
            ";
        }
        $result .= '         </tbody>
                        </table>
                    </div>';
        echo $result;
    }

    function nota_booking($id) {
        $data['result'] = $this->Book_m->nota_booking_db($id);
        $this->load->view('book/nota', $data);
    }

    function paket_book($id) {
        $data['data_book'] = $this->Book_m->data_booking_db($id);
        $data['foto'] = $this->Frontline_m->foto();
        $data['fotografer'] = $this->Frontline_m->staf_db('2');
        $this->load->view('book/paket_book', $data);
    }

    function proses_paket_book() {
        $id_trans = $this->input->post('id_trans');
        $nota = $this->input->post('no_nota');
        $data = array(
            "no_telp" => $this->input->post('no_telp'),
            "id_foto" => $this->input->post('id_foto')
        );
        $this->Frontline_m->save_order_db($nota, $data);
        $item = $this->cart->contents();
        foreach ($item as $a) {
            if ($a['ket'] <> "") {
                $ket = '(' . $a['ket'] . ')';
            } else {
                $ket = $a['ket'];
            }
            $data_item = array(
                'id_trans' => $id_trans,
                'kd_brg' => $a['id'],
                'jml' => $a['qty'],
                'diskon' => $a['diskon'],
                'hrg' => $a['price'],
                'ket' => $ket
            );
            $this->Frontline_m->save_order_item($data_item);
        }
        $this->cart->destroy();
        $return = '<script>
        alert("Data Paket Booking Berhasil Ditambahkan")
        window.location.assign("' . site_url('Book') . '");
        </script>';
        echo $return;
    }

    function bayar_booking() {
        $nota = $this->input->post('nota_book');
        $id_kasir = $this->session->userdata("staf_ratu_id");
        $bayar = str_replace('.', '', $this->input->post('byr_booking'));
        $data = array(
            "stat_byr" => 8,
        );
        $data_bayar = array(
            'no_nota' => $nota,
            'bayar' => $bayar,
            'tgl_byr' => date('Ymd'),
            'id_kasir' => $id_kasir,
            'metode_byr' => $this->input->post('metode_byr'),
        );
        $this->Book_m->status_book($data, $nota);
        $this->Kasir_m->bayar_db($data_bayar);
        echo json_encode(array(
            "status" => TRUE,
            "id" => $nota
        ));
    }

    function nota_byr_booking($id) {
        $data['result'] = $this->Book_m->nota_booking_db($id);
        $this->load->view('book/nota_byr', $data);
    }

}
