<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <div class="col-lg-6">
            <h2>Data Antrian</h2>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($antri as $r) {
                            ?>
                            <tr>
                                <td><?php echo $r->no; ?></td>
                                <td><?php echo $r->atas_nama; ?></td>
                                <td>
                                    <a href="<?php echo site_url('Frontline/selesai/' . $r->id); ?>" class="hvr-icon-float-away">Selesai</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-lg-6">
            <h2>Antrian Selesai</h2>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($antri_1 as $s) {
                            ?>
                            <tr>
                                <td><?php echo $s->no; ?></td>
                                <td><?php echo $r->atas_nama; ?></td>
                                <td>
                                    Selesai
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class='col-sm-12' style="height: 500px"></div>
</div>
<?php $this->load->view('./sidebar'); ?>