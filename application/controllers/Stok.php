<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stok
 *
 * @author lauwba
 */
class Stok extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('staf_ratu_id')) {
            redirect('Welcome/get_staf_bycookie');
        }
    }

    function door_index() {
        $this->cart->destroy();
        redirect('Stok');
    }

    function door_stok_in() {
        $this->cart->destroy();
        redirect('Stok/stok_in');
    }

    function index() {
        $data['barang'] = $this->Stok_m->get();
        $this->load->view('stok/stok', $data);
    }

    function stok_in() {
        $data['barang'] = $this->Stok_m->get();
        $this->load->view('stok/in', $data);
    }

    public function getbarang($id) {
        $barang = $this->Stok_m->get_by_id($id);

        if ($barang) {
            if ($barang->stok == '0') {
                $disabled = 'disabled';
                $info_stok = '<span class="help-block badge" id="reset" 
					          style="background-color: #d9534f;">
					          stok habis</span>';
            } else {
                $disabled = '';
                $info_stok = '<span class="help-block badge" id="reset" 
					          style="background-color: #5cb85c;">stok : '
                        . $barang->stok . '</span>';
            }

            echo '<div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="nama_barang">Nama Barang :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset" 
				        	name="nama_barang" id="nama_barang" 
				        	value="' . $barang->nm_bb . '"
				        	readonly="readonly">
				      </div>
				    </div>
				    
				    <div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="qty">Jumlah Beli :</label>
				      <div class="col-md-4">
				        <input type="number" class="form-control reset" 
				        	name="qty" placeholder="Isi qty..." autocomplete="off" 
				        	id="qty" min="0"  onkeypress="myFunction()" autofocus>
				      </div>' . $info_stok . '
				    </div>';
        } else {

            echo '<div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="nama_barang">Nama Barang :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset" 
				        	name="nama_barang" id="nama_barang" 
				        	readonly="readonly">
				      </div>
				    </div>
				    
				    <div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="qty">Jumlah Beli :</label>
				      <div class="col-md-4">
				        <input type="number" class="form-control reset" 
				        	autocomplete="off" onkeypress="myFunction()" id="qty" min="0"  
				        	name="qty" placeholder="Isi qty...">
				      </div>
				    </div>';
        }
    }

    function add_in() {
        $data = array(
            'id' => $this->input->post('id_barang'),
            'name' => $this->input->post('nama_barang'),
            'price' => str_replace('.', '', $this->input->post(
                            'harga_barang')),
            'qty' => $this->input->post('qty')
        );
        $insert = $this->cart->insert($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_list_transaksi() {
        $data = array();
        $no = 1;
        foreach ($this->cart->contents() as $items) {
            $row = array();
            $row[] = $no;
            $row[] = $items["id"];
            $row[] = $items["name"];
            $row[] = number_format($items['price'], 0, '', '.');
            $row[] = $items["qty"];

            //add html for action
            $row[] = '<a 
				href="javascript:void()" style="color:rgb(255,128,128);
				text-decoration:none" onclick="deletebarang('
                    . "'" . $items["rowid"] . "'" . ',' . "'" . $items['subtotal'] .
                    "'" . ')"> <i class="fa fa-close"></i> Delete</a>';

            $data[] = $row;
            $no++;
        }

        $output = array(
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function deletebarang($rowid) {
        $this->cart->update(array(
            'rowid' => $rowid,
            'qty' => 0,));
        echo json_encode(array("status" => TRUE));
    }

    function place_stok() {
        $id_in = $this->Stok_m->id_stok_in();
        $cart = $this->cart->contents();
        $total = 0;
        foreach ($cart as $item) {
            $data_item = array(
                "id_in" => $id_in,
                "jml_in" => $item['qty'],
                "hrg_beli" => $item['price'],
                "id_bb" => $item['id'],
            );
            $total += $item['price'] * $item['qty'];
            $this->Stok_m->place_item_db($data_item);
            $this->Stok_m->update_stok($item['id'], $item['qty']);
        }
        $data = array(
            "id_in" => $id_in,
            "tgl" => date("Ymd"),
            "total" => $total
        );
        //update ke uang?
        $this->Stok_m->place_stok_db($data);
        $this->cart->destroy();
        echo json_encode($id_in);
    }

    function data_stok_in($id) {
        $data['stok'] = $this->Stok_m->data_stok_in_db($id);
        $this->load->view('stok/data_stok_in', $data);
    }

    function data_stok_periode() {
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $data['stok'] = $this->Stok_m->data_stok_in_periode($start, $end);
        $this->load->view('stok/data_stok_in', $data);
    }

    public function getstok($id) {
        $barang = $this->Stok_m->get_by_id($id);

        if ($barang) {
            if ($barang->stok == '0') {
                $disabled = 'disabled';
                $info_stok = '<span class="help-block badge" id="reset" 
					          style="background-color: #d9534f;">
					          stok habis</span>';
            } else {
                $disabled = '';
                $info_stok = '<span class="help-block badge" id="reset" 
					          style="background-color: #5cb85c;">stok : '
                        . $barang->stok . '</span>';
            }

            echo '<div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="nama_barang">Nama Barang :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset" 
				        	name="nama_barang" id="nama_barang" 
				        	value="' . $barang->nm_bb . '"
				        	readonly="readonly">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="qty">Stok Sekarang :</label>
				      <div class="col-md-4">
				        <input type="number" class="form-control reset" 
				        	name="qty" placeholder="Isi qty..." autocomplete="off" 
				        	id="qty" min="0"  onkeypress="myFunction()" autofocus>
                                                <input type="hidden" name="stok_awal" value="' . $barang->stok . '">
				      </div>' . $info_stok . '
				    </div>';
        } else {

            echo '<div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="nama_barang">Nama Barang :</label>
				      <div class="col-md-8">
				        <input type="text" class="form-control reset" 
				        	name="nama_barang" id="nama_barang" 
				        	readonly="readonly">
				      </div>
				    </div>
				    <div class="form-group">
				      <label class="control-label col-md-3" 
				      	for="qty">Stok Sekarang :</label>
				      <div class="col-md-4">
				        <input type="number" class="form-control reset" 
				        	autocomplete="off" onkeypress="myFunction()" id="qty" min="0"  
				        	name="qty" placeholder="Isi qty...">
				      </div>
				    </div>';
        }
    }

    function add_out() {
        $data = array(
            'id' => $this->input->post('id_barang'),
            'name' => $this->input->post('nama_barang'),
            'qty' => $this->input->post('qty'),
            'price' => $this->input->post('stok_awal'),
        );
        $insert = $this->cart->insert($data);
        echo json_encode(array("status" => TRUE));
    }

    function place_stoknow() {
        $id_out = $this->Stok_m->id_stok_out();
        $cart = $this->cart->contents();
        foreach ($cart as $item) {
            $data_item = array(
                "id_out" => $id_out,
                "id_bb" => $item['id'],
                "stok_awal" => $item['price'],
                "stok_akhir" => $item['qty'],
            );
            $this->Stok_m->place_item_out($data_item);
            $this->Stok_m->update_stok_out($item['id'], $item['qty']);
        }
        $data = array(
            "id_out" => $id_out,
            "tgl_cek" => date("Ymd"),
        );
        //update ke uang?
        $this->Stok_m->place_stoknow_db($data);
        $this->cart->destroy();
        echo json_encode($id_out);
    }

    function data_stok_out($id) {
        $data['stok'] = $this->Stok_m->data_stok_out_db($id);
        $this->load->view('stok/data_stok_out', $data);
    }

    function data_stok_out_periode() {
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $data['stok'] = $this->Stok_m->data_stok_out_periode($start, $end);
        $this->load->view('stok/data_stok_out', $data);
    }

}
