<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <h2>Data Staf</h2>
        <a href="<?php echo site_url('Crud/k_list_id/0'); ?>" class="hvr-icon-float-away">Tambah Staf Baru</a>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    foreach ($list as $r) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $r->nm_staf; ?></td>
                            <td><?php echo $r->user; ?></td>
                            <td><?php echo $this->Login_m->level($r->level); ?></td>
                            <td>
                                <a href="<?php echo site_url('Crud/k_del/' . $r->id); ?>" class="hvr-icon-float-away"
                                   onclick="return confirm('Apakah anda yakin?')"                                   
                                   >Hapus</a>
                                <a href="<?php echo site_url('Crud/k_list_id/' . $r->id); ?>" class="hvr-icon-float-away">Edit</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>