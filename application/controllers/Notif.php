<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Notif
 *
 * @author lauwba
 */
class Notif extends CI_Controller {

    //put your code here
    function recieve() {
        $id = $this->input->post('untuk');
        $data = $this->Notif_m->recieve_db($id);
//        $n = "";
//        echo $data;
//        echo sizeof($data);
        if (sizeof($data) > 0) {
            foreach ($data as $d) {
//                echo $d->id_trans;
                echo $d->id_trans;
                echo "_";
                echo $d->no_nota;
            }
        } else {
            echo 'kosong';
        }
    }

    function update() {
        $notif_stat = $this->input->post('status');
        $id_trans = $this->input->post('id');
        $data = array(
            'notif_stat' => $notif_stat
        );
        $this->Notif_m->update_db($data, $id_trans);
        echo "berhasil";
    }

}
