<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <h2>Data Member</h2>
        <a href="<?php echo site_url('Crud/m_list_id/0'); ?>" class="hvr-icon-float-away">Tambah Member Baru</a>
        <a href="<?php echo site_url('Crud/m_list_excel'); ?>" class="btn btn-success">Cetak Excel <i class="fa fa-file-excel-o"></i></a>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kode Member</th>
                        <th>Alamat</th>
                        <th>Tipe Member</th>
                        <th>Usaha</th>
                        <th>Tanggal Daftar</th>
                        <th>Nomor Telepon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    foreach ($list as $r) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $r->nm_member; ?></td>
                            <td><?php echo $r->id_member; ?></td>
                            <td><?php echo $r->alamat; ?></td>
                            <td><?php echo $r->tipe; ?></td>
                            <td><?php echo $r->usaha; ?></td>
                            <td><?php echo $r->tgl_daftar; ?></td>
                            <td><?php echo $r->no_telp; ?></td>
                            <td>
                                <a href="<?php echo site_url('Crud/m_del/' . $r->id_member); ?>" class="hvr-icon-float-away"
                                   onclick="return confirm('Apakah anda yakin?')"                                   
                                   >Hapus</a>
                                <a href="<?php echo site_url('Crud/m_list_id/' . $r->id_member); ?>" class="hvr-icon-float-away">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>