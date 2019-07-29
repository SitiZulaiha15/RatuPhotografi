<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <div class="col-md-12">
            <p style="float: right"><a href="<?php echo site_url();?>Job/job_search" class="hvr-float">Pencarian</a></p>
        </div>
        <div class="col-md-12">
            <div class="tab" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">
                            ALL
                        </a>
                    </li>
                    <?php foreach ($staf as $s) { ?>
                        <li role="presentation">
                            <a href="#Section<?php echo $s->id_staf; ?>" aria-controls="home" role="tab" data-toggle="tab">
                                <?php echo $s->nm_staf; ?>
                            </a>
                        </li>                    
                    <?php } ?>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">
                        <!--<div class="table-responsive">-->
                        <table class="table table-hover dataTabless" id="dataTable">
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
                                    foreach ($jobs as $t) {
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
                                                    echo "<p><" . $o->jml ."> ". $o->nm_brg . " " . $o->ket . "</p>";
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
                        <!--</div>-->
                    </div>
                    <?php foreach ($staf as $a) { ?>
                        <div role="tabpanel" class="tab-pane" id="Section<?php echo $a->id_staf; ?>">
                            <!--<div class="table-responsive">-->
                                <table class="table table-hover dataTabless" id="dataTables">
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
                                                        echo "<p><" . $o->jml ."> ". $o->nm_brg . " " . $o->ket . "</p>";
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
                            <!--</div>-->
                        </div>
                    <?php } ?>
                </div>
            </div>            
        </div>
    </div>
    <div class='col-sm-12' style="height: 500px"></div>
</div>
<?php $this->load->view('./sidebar'); ?>


