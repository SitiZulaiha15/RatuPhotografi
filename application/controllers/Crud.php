<?php

class Crud extends CI_Controller {
    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('staf_ratu_id')) {
            redirect('Welcome/get_staf_bycookie');            
        }
    }

//    GRUP
    function g_list() {
        $data['list'] = $this->Crud_m->select('grup');
        $this->load->view('crud/g_list', $data);
    }

    function g_list_id($id) {
        $data['list'] = $this->Crud_m->select_id('grup', 'id_grup', $id);
        $this->load->view('crud/g_list_id', $data);
    }

    function g_input() {
        $nm = $this->input->post('nm');
        $id_grup = "G_" . $nm;
        $data = array(
            'id_grup' => $id_grup,
            'nm_grup' => $nm
        );
        $this->Crud_m->insert('grup', $data);
        redirect('Crud/g_list');
    }

    function g_del($id) {
        $ids = "\'$id\'";
        $this->Crud_m->select('grup', 'id_grup', $ids);
//        redirect('Crud/g_list');
    }

//    END GRUP
//    
//    KATEGORI
    function kat_list() {
        $data['list'] = $this->Crud_m->select('kategori');
        $this->load->view('crud/kat_list', $data);
    }

    function kat_list_id($id) {
        $data['list'] = $this->Crud_m->select_id('kategori', 'id_kat', $id);
        $data['grup'] = $this->Crud_m->select('grup');
        $this->load->view('crud/kat_list_id', $data);
    }

    function kat_input() {
        $nm = $this->input->post('nm');
        $id_grup = $this->input->post('id_grup');
        $kode = $this->Crud_m->kode($id_grup);
        $id_kat = $id_grup . "_" . $kode;
        $data = array(
            'id_kat' => $id_kat,
            'id_grup' => $id_grup,
            'nm_kat' => $nm
        );
        $this->Crud_m->insert('kategori', $data);
        redirect('Crud/kat_list');
    }

    function kat_del($id) {
        $this->Crud_m->delete('kategori', 'id_kat', $id);
        redirect('Crud/kat_list');
    }

    function kat_upd() {
        $nm = $this->input->post('nm');
        $id_grup = $this->input->post('id_grup');
        $id_kat = $this->input->post('id_kat');
        $data = array(
            'id_kat' => $id_kat,
            'id_grup' => $id_grup,
            'nm_kat' => $nm
        );
        $this->Crud_m->update('kategori',$data, 'id_kat', $id_kat);
        redirect('Crud/kat_list');
    }

//   END KATEGORI
//   BARANG
    function b_list() {
        $data['list'] = $this->Crud_m->select('barang');
        $this->load->view('crud/b_list', $data);
    }

    function b_list_id($id) {
        $data['list'] = $this->Crud_m->select_id('barang', 'kd_brg', $id);
        $data['kategori'] = $this->Crud_m->select('kategori');
        $this->load->view('crud/b_list_id', $data);
    }

    function b_input() {
        $nm = $this->input->post('nm');
        $hrg = str_replace('.', '', $this->input->post('hrg'));
        $hpp = str_replace('.', '', $this->input->post('hpp'));
        $detail = $this->input->post('detail');
        $id_kat = $this->input->post('id_kat');
        $kd_brg = $this->Crud_m->kd_brg();
        $data = array(
            'kd_brg' => $kd_brg,
            'nm_brg' => $nm,
            'hrg_brg' => $hrg,
            'hpp' => $hpp,
            'detail' => $detail,
            'id_kat' => $id_kat
        );
        $this->Crud_m->insert('barang', $data);
        redirect('Crud/b_list');
    }

    function b_del($id) {
        $this->Crud_m->delete('barang', 'kd_brg', $id);
        redirect('Crud/b_list');
    }

    function b_upd() {
        $nm = $this->input->post('nm');
        $hrg = str_replace('.', '', $this->input->post('hrg'));
        $hpp = str_replace('.', '', $this->input->post('hpp'));
        $detail = $this->input->post('detail');
        $id_kat = $this->input->post('id_kat');
        $kd_brg = $this->input->post('kd_brg');
        $data = array(
            'nm_brg' => $nm,
            'hrg_brg' => $hrg,
            'hpp' => $hpp,
            'detail' => $detail,
            'id_kat' => $id_kat
        );
        $this->Crud_m->update('barang', $data, 'kd_brg', $kd_brg);
        redirect('Crud/b_list');
    }

//   END BARANG
//   MEMBER
    function m_list() {
        $data['list'] = $this->Crud_m->select('member');
        $this->load->view('crud/m_list', $data);
    }

    function m_list_id($id) {
        $data['list'] = $this->Crud_m->select_id('member', 'id_member', $id);
        $this->load->view('crud/m_list_id', $data);
    }

    function m_input() {
        $tipe = $this->input->post('tipe');
        if ($tipe == 'pelanggan') {
            $id = $this->Crud_m->m_id('IDP', 'P');
        } else if ($tipe == "member_khusus") {
            $id = $this->Crud_m->m_id('IDMK', 'MK');
        } else if ($tipe == "member_biasa") {
            $id = $this->Crud_m->m_id('IDMB-', 'MB');
        }
        $data = array(
            'id_member' => $id,
            'nm_member' => $this->input->post('nm'),
            'alamat' => $this->input->post('alamat'),
            'tipe' => $tipe,
            'usaha' => $this->input->post('usaha'),
            'tgl_daftar' => date("Ymd"),
            'no_telp' => $this->input->post('no_telp')
        );
        $this->Crud_m->insert('member', $data);
        redirect('Crud/m_list');
    }

    function m_del($id) {
        $this->Crud_m->delete('member', 'id_member', $id);
        redirect('Crud/m_list');
    }

    function m_upd() {
        $tipe = $this->input->post('tipe');
        $id = $this->input->post('id_member');
        $data = array(
            'nm_member' => $this->input->post('nm'),
            'alamat' => $this->input->post('alamat'),
            'tipe' => $tipe,
            'usaha' => $this->input->post('usaha'),
            'tgl_daftar' => date("Ymd"),
            'no_telp' => $this->input->post('notelp')
        );
        $this->Crud_m->update('member', $data, 'id_member', $id);
        redirect('Crud/m_list_id/' . $id);
    }

//   END MEMBER
//    KARYAWAN
    function k_list() {
        $data['list'] = $this->Crud_m->select('staf');
        $this->load->view('crud/k_list', $data);
    }

    function k_list_id($id) {
        $data['list'] = $this->Crud_m->select_id('staf', 'id', $id);
        $this->load->view('crud/k_list_id', $data);
    }

    function k_input() {
        $id = $this->Crud_m->k_id();
        $data = array(
            'id_staf' => $id,
            'nm_staf' => $this->input->post('nm'),
            'user' => $this->input->post('user'),
            'pass' => md5($this->input->post('pass')),
            'level' => $this->input->post('level'),
        );
        $this->Crud_m->insert('staf', $data);
        redirect('Crud/k_list');
    }

    function k_del($id) {
        $this->Crud_m->delete('staf', 'id', $id);
        redirect('Crud/k_list');
    }

    function k_upd() {
        $id = $this->input->post('id_staf');
        $data = array(
            'nm_staf' => $this->input->post('nm'),
            'user' => $this->input->post('user'),
            'pass' => md5($this->input->post('pass')),
            'level' => $this->input->post('level'),
        );
        $this->Crud_m->update('staf', $data, 'id', $id);
        redirect('Crud/k_list');
    }

//    END KARYAWAN
//    BAHAN BAKU
    function bb_list() {
        $data['list'] = $this->Crud_m->select('bahan_baku');
        $this->load->view('crud/bb_list', $data);
    }

    function bb_list_id($id) {
        $data['list'] = $this->Crud_m->select_id('bahan_baku', 'id_bb', $id);
        $this->load->view('crud/bb_list_id', $data);
    }

    function bb_input() {
        $id = $this->Crud_m->bb_id();
        $data = array(
            'id_bb' => $id,
            'nm_bb' => $this->input->post('nm'),
            'limit' => $this->input->post('limit'),
            'stok' => md5($this->input->post('stok')),
        );
        $this->Crud_m->insert('bahan_baku', $data);
        redirect('Crud/bb_list');
    }

    function bb_del($id) {
        $this->Crud_m->delete('bahan_baku', 'id_bb', $id);
        redirect('Crud/bb_list');
    }

    function bb_upd() {
        $id = $this->input->post('id_bb');
        $data = array(
            'nm_bb' => $this->input->post('nm'),
            'limit' => $this->input->post('limit'),
            'stok' => $this->input->post('stok'),
        );
        $this->Crud_m->update('bahan_baku', $data, 'id_bb', $id);
        redirect('Crud/bb_list');
    }

//    END BAHAN BAKU
//    STATUS KERJA
    function s_list() {
        $data['list'] = $this->Crud_m->select('status_kerja');
        $this->load->view('crud/s_list', $data);
    }

    function s_list_id($id) {
        $data['list'] = $this->Crud_m->select_id('status_kerja', 'id_stat', $id);
        $this->load->view('crud/s_list_id', $data);
    }

    function s_input() {
        $nm = $this->input->post('nm');
        $data = array(
            'status' => $nm
        );
        $this->Crud_m->insert('status_kerja', $data);
        redirect('Crud/s_list');
    }

    function s_del($id) {
        $this->Crud_m->delete('status_kerja', 'id_stat', $id);
        redirect('Crud/s_list');
    }

    function s_upd() {
        $id = $this->input->post('id');
        $data = array(
            'status' => $this->input->post('nm')
        );
        $this->Crud_m->update('status_kerja', $data, 'id_stat', $id);
        redirect('Crud/s_list');
    }

//    END STATUS KERJA
    function kode(){
        echo $this->Crud_m->m_id('IDMB-', 'MB');
    }
}
