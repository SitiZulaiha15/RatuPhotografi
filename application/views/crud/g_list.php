<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <h2>Data Group</h2>
        <a href="<?php echo site_url('Crud/g_list_id/0'); ?>" class="hvr-icon-float-away">Tambah Group</a>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Group</th>
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
                            <td><?php echo $r->nm_grup; ?></td>
                            <td>
<!--                                <a href="<?php echo site_url('Crud/g_del/' . $r->id_grup); ?>" class="hvr-icon-float-away"
                                   onclick="return confirm('Apakah anda yakin?')"                                   
                                   >Hapus</a>-->
                                <!--<a href="<?php echo site_url('Crud/g_list_id/' . $r->id_grup); ?>" class="hvr-icon-float-away">Edit</a>-->
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>