<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Frontline_cart
 *
 * @author lauwba
 */
class Frontline_cart extends CI_Controller {

    function add_to_cart() { //fungsi Add To Cart
        $data = array(
            'id' => $this->input->post('produk_id'),
            'name' => $this->input->post('produk_nama'),
            'price' => $this->input->post('produk_harga'),
            'qty' => 1,
            'diskon' => 0,
            'ket' => "",
        );
        $this->cart->insert($data);
        echo $this->show_cart(); //tampilkan cart setelah added
    }

    function show_cart() { //Fungsi untuk menampilkan Cart
        $output = '';
        $no = 0;
        $diskon = 0;
//        <td>' . number_format($items['price']) . '</td>
//        $output.='<tr >
//                        <td colspan="3"><button type="button" class="update_cart btn btn-warning btn-xs">Update Qty & Discount</button></td>
//			</tr>';
        foreach ($this->cart->contents() as $items) {
            $no++;
            $output .='
                
				<tr>
                                <input type="hidden" value="' . $items['rowid'] . '" id="rowid_'.$no.'">
                                <input type="hidden" value="' . $items['ket'] . '" id="ket_'.$no.'">
                                <input type="hidden" value="' . $items['price'] . '" id="hrg_'.$no.'">
					<td><a title="'.$items['ket'].'" href="#" class="btn btn-info" onclick="edit_book(); getId(rowid_'.$no.',qtys_'.$no.',diskon_'.$no.',ket_'.$no.',hrg_'.$no.')">' . $items['name'] . '</a></td>					
					<td>' . $items['qty']. '</td><input name = "" type = "hidden" value = "' . $items['qty'] . '" min="1" id="qtys_'.$no.'">
                                        <td>' . $items['diskon']. '</td><input type="hidden" name="" size="2" value="' . $items['diskon'] . '" id="diskon_'.$no.'">
					<td>' . number_format($items['subtotal'] - $items['diskon']) . '</td>
					<td><button type="button" id="' . $items['rowid'] . '" class="hapus_cart btn btn-danger btn-xs">X</button></td>                                        
				</tr> 
                                
			';
            // $diskon +=$items['diskon'];
            $diskon += $items['diskon'];
        }
        $output .= '                       
			
			<tr>
				<th colspan="3">Total</th>
				<th colspan="2">' . 'Rp ' . number_format($this->cart->total() - $diskon) . '</th>
			</tr>
                        
		';
        return $output;
    }

    function load_cart() { //load data cart
        echo $this->show_cart();
    }

    function hapus_cart() { //fungsi untuk menghapus item cart
        $data = array(
            'rowid' => $this->input->post('row_id'),
            'qty' => 0,
        );
        $this->cart->update($data);
        echo $this->show_cart();
    }

    function update_cart() {
        $carts = $this->input->post('cart');
        foreach ($carts as $id => $cart) {
            $price = $cart['price'];
            $d = $cart['diskon'];
            $this->Cart_m->update_cart($cart['rowid'], $cart['qty'], $d, $price);
        }
        echo $this->show_cart();
    }

    function empty_cart() {
        $this->cart->destroy();
    }

    function update() {
        $data = array(
            'rowid' => $this->input->post('rowid'),
            'qty' => $this->input->post('qty'),
            'diskon' => $this->input->post('diskonRp'),
            'ket' => $this->input->post('ket'),
        );
        $this->cart->update($data);
        echo $this->show_cart();
        // echo json_encode($data);
    }
    
    //SIGIT ADD THIS
    function get_padding_session() {
    $sess_data['padding'] = $this->input->post('penanda');
    echo $this->input->post('penanda');
    $this->session->set_userdata($sess_data);
    // END OF SIGIT ADD THIS
}


}
