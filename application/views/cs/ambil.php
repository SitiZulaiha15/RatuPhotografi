<?php $this->load->view('header'); ?>
<div class="inner-block">
    <div class="blank">

        <h2>Form Pengambilan</h2>     
        <div class="col-md-8 compose-right">
            <div class="inbox-details-default">
                <div class="inbox-details-heading">
                    Cari Pesanan
                </div>
                <div class="inbox-details-body">
                    <div class="alert alert-info">
                        Masukkan Data Kode Transaksi atau Nama Pelanggan
                    </div>
                    <form class="com-mail" method="post" action="<?php echo site_url('Frontline/ambil'); ?>">
                        <input name="id" type="text"  placeholder="Kode Transaksi :" required="">
                        <input type="submit" value="Cari"> 
                    </form>
                </div>
            </div>
        </div>
        <?php
        if (!empty($trans)) {
            ?>
            <div class="col-md-12 compose-right">
                <div class="table-responsive">
                    <br>
                    <table class="table table-hover dataTabless">
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
                            <?php foreach ($trans as $t) { ?>
                                <tr>
                                    <td><?php echo $t->atas_nama; ?></td>
                                    <td><?php echo $this->Etc->tgl($t->tgl); ?></td>
                                    <td><?php echo $this->Kasir_m->staf_nm($t->id_pj); ?></td>
                                    <td><?php echo $this->Etc->tgl($t->deadline); ?></td>
                                    <td><?php echo $this->Job_m->status($t->stat_krj); ?></td>
                                    <td><?php echo $this->Etc->byr($t->stat_byr); ?></td>
                                    <td> <?php
                                $order = $this->Frontline_m->order_db($t->no_nota);
                                foreach ($order as $o) {
                                    echo "<p>" . $o->nm_brg . "</p>";
                                }
                                ?></td>
                                    <td>
                                        <?php if ($t->stat_krj <> 4) { ?>
                                            <a href="<?php echo site_url('Frontline/proses_ambil/' . $t->no_nota); ?>" class="hvr-icon-spin">Diambil</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        }
        ?>
        <div class='col-sm-12' style="height: 1000px"></div>
        <div class="clearfix"> </div> 
    </div>
</div>
<?php
$this->load->view('sidebar');
?>