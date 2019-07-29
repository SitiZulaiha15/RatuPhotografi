<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <h2>Data Barang</h2>
        <a href="<?php echo site_url('Crud/b_list_id/0'); ?>" class="hvr-icon-float-away">Tambah Barang</a>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Grup</th>
                        <th>Nama</th>
                        <th>Kategori</th>
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
                            <td><?php echo $r->grup; ?></td>
                            <td><?php echo $r->nm_brg; ?></td>
                            <td><?php echo $r->id_kat; ?></td>
                            <td>
                                <a href="<?php echo site_url('Crud/b_del/' . $r->kd_brg); ?>" class="hvr-icon-float-away"
                                   onclick="return confirm('Apakah anda yakin?')"                                   
                                   >Hapus</a>
                                <a href="<?php echo site_url('Crud/b_list_id/' . $r->kd_brg); ?>" class="hvr-icon-float-away">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>