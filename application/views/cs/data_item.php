<?php
$this->load->view('header');
?>
<div class="inner-block">
    <div class="blank">
        <?php if (empty($trans)) { ?>
            <h2>Input Data Gagal! Silahkan Input Kembali</h2>
            <?php
        } else {
            foreach ($trans as $t) {
                ?>
                <div class="col-md-12 compose-right">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Pelanggan</th>
                                    <th>Tanggal</th>
                                    <th>PJ</th>
                                    <th>Deadline</th>
                                    <th>Status Kerja</th>
                                    <th>Status Pembayaran</th>
                                    <th>Data Transaksi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><?php echo $t->atas_nama; ?></td>
                                    <td><?php echo $this->Etc->tgl($t->tgl); ?></td>
                                    <td><?php echo $this->Kasir_m->staf_nm($t->id_pj); ?></td>
                                   <td><?php echo $this->Etc->tgl($t->deadline)."<br> ".$this->Etc->jam($t->deadline); ?></td>
                                    <td><?php echo $this->Job_m->status($t->stat_krj); ?></td>
                                    <td><?php echo $this->Etc->byr($t->stat_byr); ?></td>
                                    <td> <?php
        foreach ($order as $o) {
            echo "<p>" . $o->nm_brg . "</p>";
        }
                ?></td>
                                    <td>
                                        <a href="<?php echo site_url('Frontline/ready_cetak/'); ?>" class="hvr-icon-spin">Close</a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <div class="clearfix"> </div> 
    </div>
</div>
<?php
$this->load->view('sidebar');
?>