<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cart_model
 *
 * @author lauwba
 */
class Cart_m extends CI_Model {

    //put your code here
    function update_cart($rowid, $qty, $d, $price) {
        $data = array(
            'rowid' => $rowid,
            'qty' => $qty,
            'price' => $price,
            'diskon' => $d,
        );
        $this->cart->update($data);
    }

}
