<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <div class="col-md-12">
            <div class="tab" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
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
                    <?php foreach ($staf as $a) { ?>
                        <div role="tabpanel" class="tab-pane" id="Section<?php echo $a->id_staf; ?>">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kerja</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no=1;
                                        $job = $this->Report_m->kinerja_db($start, $end, $a->id_staf);
                                        foreach ($job as $t) {
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $t->nm_brg; ?></td>
                                                <td><?php echo $this->Report_m->jml_kerja($a->id_staf,$t->kd_brg); ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>            
        </div>
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>