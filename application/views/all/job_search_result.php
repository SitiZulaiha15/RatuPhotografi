<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <div class="col-md-12 compose-right">
            <div class="table-responsive">
                <br>
                <table class="table table-hover dataTabless">
                    <thead>
                        <tr>
                            <th>A/n</th>
                            <th>Nomor Nota</th>
                            <th>Tanggal</th>
                            <th>PJ</th>
                            <th>Deadline</th>
                            <th>Pembayaran</th>
                            <th>Items</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($result as $t) {
                            ?>
                            <tr>
                                <td><?php echo $t->atas_nama; ?></td>
                                <td><?php echo $t->no_nota; ?></td>
                                <td><?php echo $this->Etc->tgl($t->tgl); ?></td>
                                <td><?php echo $this->Kasir_m->staf_nm($t->id_pj); ?></td>
                                <td><?php echo $this->Etc->tgl($t->deadline); ?></td>
                                <td><?php echo $this->Etc->byr($t->stat_byr); ?></td>
                                <td> <?php
                                    $order = $this->Frontline_m->order_db($t->no_nota);

                                    foreach ($order as $o) {
                                        echo "<p><" . $o->jml . "> " . $o->nm_brg . " " . $o->ket . "</p>";
                                    }
                                    ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $this->Job_m->status($t->stat_krj); ?>
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu">
                                            <?php
                                            $krj = $this->Job_m->stat_krj();
                                            foreach ($krj as $k) {
                                                ?>
                                                <li><a href="<?php echo site_url('Job/update_krj/' . $t->id_trans . "/" . $k->id_stat); ?>"><?php echo $k->status; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        language: 'id',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
</script>