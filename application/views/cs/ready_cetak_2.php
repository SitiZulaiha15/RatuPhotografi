<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <h2>Data Transaksi</h2> 
        <?php
        $cetak = "";
        if ($this->session->userdata('cetak')) {
            $cetak = $this->session->userdata('cetak');
        }
            ?>        
            <div class="col-md-8 compose-right">
                <div class="inbox-details-default">
                    <div class="inbox-details-heading">
                        Cari Pesanan
                    </div>
                    <div class="inbox-details-body">
                        <div class="alert alert-info">
                            Masukkan Nomor Nota atau Nama Pelanggan
                        </div>
                        <form class="com-mail" method="post" action="<?php echo site_url('Frontline/ready_cetak'); ?>" enctype="multipart/form-data">
                            <input name="id" type="text"  placeholder="Kode Transaksi :" required="" value="<?php echo $cetak; ?>">
                            <input type="submit" value="Cari" name="cari"> 
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12 compose-right">
                <div class="table-responsive">
                    <div class="panel-body">
                    <table class="table table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <th>Nomor Telepon</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($trans as $t) { ?>
                                <tr>
                                    <td><?php echo $t->atas_nama; ?></td>
                                    <td><?php echo $t->no_telp; ?></td>
                                    <td><?php echo $this->Etc->tgl($t->tgl); ?></td>
                                    <td><?php echo $st_member = $this->Frontline_m->status_member($t->id_member); ?></td>
                                    <td><a href="<?php echo site_url('Frontline/ready_cetak_door/'.$t->no_nota)?>" class="hvr-icon-spin">Lanjut</a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        <div class='col-sm-12' style="height: 1000px"></div>
        <div class="clearfix"> </div> 
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>

