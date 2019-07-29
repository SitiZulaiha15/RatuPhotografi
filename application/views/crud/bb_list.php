<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <h2>Data Barang</h2>
        <a href="<?php echo site_url('Crud/bb_list_id/0'); ?>" class="hvr-icon-float-away">Tambah Bahan Baku</a>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Limit</th>
                        <th>Stok</th>
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
                            <td><?php echo $r->nm_bb; ?></td>
                            <td><?php echo $r->limit; ?></td>
                            <td><?php echo $r->stok; ?></td>
                            <td>
                                <a href="<?php echo site_url('Crud/bb_del/' . $r->id_bb); ?>" class="hvr-icon-float-away"
                                   onclick="return confirm('Apakah anda yakin?')"                                   
                                   >Hapus</a>
                                <a href="<?php echo site_url('Crud/bb_list_id/' . $r->id_bb); ?>" class="hvr-icon-float-away">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>