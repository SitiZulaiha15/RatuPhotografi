<h2>Laporan Penjualan</h2>
<table class="table table-condensed">
    <thead>
        <tr>
            <td ><strong>No</strong></td>
            <td class="text-center" ><strong>Atas Nama</strong></td>
            <td class="text-center" ><strong>Tanggal</strong></td>
            <td class="text-center" ><strong>Pesanan</strong></td>            
            <td class="text-center" ><strong>Total Transaksi</strong></td>
            <td class="text-center" ><strong>Detail Bayar</strong></td>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        if (empty($trans)) {
            ?>
        <script>
            alert("Tidak ada data yang ditampilkan");
            location.reload();
        </script>

    <?php
    } else {
        foreach ($trans as $t) {
            ?>

            <tr>
                <td class="text-center"><?php echo $no++ ?></td>
                <td class="text-center"><?php echo $t->atas_nama ?></td>
                <td class="text-center"><?php echo $this->Etc->tgl($t->tgl) ?></td>
                <td class="text-center">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>Barang</strong></td>
                                <td class="text-center"><strong>Jumlah</strong></td>
                                <td class="text-center" ><strong>HPP</strong></td>
                                <td class="text-center" ><strong>Harga</strong></td>
                                <td class="text-center" ><strong>Diskon</strong></td>
                                <td class="text-center" ><strong>Modal</strong></td>
                                <td class="text-center" ><strong>Sub Total</strong></td>
                                <td class="text-center" ><strong>Keuntungan</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            $barang = $this->reportx->pj_barang($t->id_trans);
                            foreach ($barang as $b) {
                                $subtotal = (($b->hrg * $b->jml) - $b->diskon);
                                $modal = $b->hpp * $b->jml;
                                $untung = $subtotal - $modal;
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $b->nm_brg; ?></td>
                                    <td class="text-center"><?php echo $b->jml; ?></td>
                                    <td class="text-center"><?php echo $this->Etc->rps($b->hpp); ?></td>
                                    <td class="text-center"><?php echo $this->Etc->rps($b->hrg); ?></td>
                                    <td class="text-center"><?php echo $this->Etc->rp($b->diskon); ?></td>
                                    <td class="text-center"><?php echo $this->Etc->rps($modal); ?></td>
                                    <td class="text-center"><?php echo $this->Etc->rps($subtotal); ?></td>
                                    <td class="text-center"><?php echo $this->Etc->rps($untung); ?></td>
                                </tr>
                                <?php
                                $total += $subtotal;
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
                <td class="text-center"><?php echo $this->Etc->rps($total); ?></td>
                <td class="text-center">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>Tanggal</strong></td>
                                <td class="text-center"><strong>Nominal</strong></td>
                                <td class="text-center"><strong>Metode Bayar</strong></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $bayar = $this->reportx->pj_bayar($t->no_nota);
                            foreach ($bayar as $r) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $this->Etc->tgl($r->tgl_byr); ?></td>
                                    <td class="text-center"><?php echo $this->Etc->rps($r->bayar); ?></td>
                                    <td class="text-center"><?php echo $this->Etc->m_byr($r->metode_byr); ?></td>
                                </tr>
        <?php } ?>
                        </tbody>
                    </table>
                </td>
            </tr>

            <?php
        }
    }
    ?>

</tbody>
</table>
<a class="float2" title="cetak excel" href="<?php echo site_url("Report_xls/pj_report_xls/$tgl/$tgl"); ?>"> 
    <i class="fa fa-file-excel-o my-float" ></i>
</a>  
<style>
    @media print
    {    
        .float, .float *, .notab
        {
            display: none !important;
        }
    }
    .float2 {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 120px;
        background-color: #009d28;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        box-shadow: 2px 2px 3px #999;
    }

    .my-float {
        margin-top: 22px;
    }
</style>