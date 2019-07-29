<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <div class="col-md-12">
            <div class="tab" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <?php foreach ($staf as $s) { ?>
                        <li role="presentation">
                            <a href="#Section<?php echo $s->id_staf; ?>" aria-controls="home" role="tab" data-toggle="tab" onclick="setActiveTabs('Section<?php echo $s->id_staf; ?>')">
                                <?php echo $s->nm_staf; ?>
                            </a>
                        </li>                    
                    <?php } ?>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <?php foreach ($staf as $a) { ?>
                        <div role="tabpanel" class="tab-pane" id="Section<?php echo $a->id_staf; ?>">
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
                                    $job = $this->Job_m->job_by_db($a->id_staf);
                                    foreach ($job as $t) {
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
                                                        <?php foreach ($krj as $k) { ?>
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
                    <?php } ?>
                </div>
            </div>            
        </div>
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>
<script>
    $(document).ready(function () {
        $(".nav-tabs a").click(function () {
            $(this).tab('show');
        });
        activaTab('<?php echo $this->session->userdata('penanda'); ?>');
    });
    function activaTab(tab) {
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    }
    function setActiveTabs(penanda) {
        $.ajax({
            url: "<?php echo site_url(); ?>Job/set_active_tabs",
            method: "POST",
            data: {penanda: penanda},
            success: function (data) {
            }
        });
    }
</script>