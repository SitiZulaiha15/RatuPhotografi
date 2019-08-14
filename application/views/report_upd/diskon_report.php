<h2>Laporan Diskon</h2>
<table class="table table-condensed">
    <thead>
        <tr>
            <td ><strong>No</strong></td>
            <td class="text-center" ><strong>Nama Barang</strong></td>
            <td class="text-center" ><strong>Harga</strong></td>
            <td class="text-center" ><strong>Transaksi</strong></td>
<!--            <td class="text-center" ><strong>Tanggal</strong></td>
            <td class="text-center" ><strong>Diskon</strong></td>-->
            <td class="text-center" ><strong>Total Diskon</strong></td>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no=1;
        if (empty($barang)) {
            ?>
        <script>
            alert("Tidak ada data yang ditampilkan");
            location.reload();
        </script>
        <?php
    } else {
        foreach ($barang as $b) { ?>
            <tr>
                <td class="text-center"><?php echo $no++ ?></td>
                <td class="text-center"><?php echo $b->nm_brg ?></td>
                <td class="text-center"><?php echo $this->Etc->rps($b->hrg) ?></td>
                <td class="text-center">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <td class="text-center"><strong>Tanggal</strong></td>
                                <td class="text-center"><strong>Qty</strong></td>
                                <td class="text-center"><strong>Diskon</strong></td>

                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $trans = $this->reportx->diskon_trans($start, $end, $b->kd_brg);
                            $t_diskon = 0;
                            foreach ($trans as $t) { ?>
                                <tr>
                                    <td class="text-center"><?php echo $this->Etc->tgl($t->tgl) ?></td>
                                    <td class="text-center"><?php echo $t->jml ?></td>
                                    <td class="text-center"><?php echo $this->Etc->rps($t->diskon) ?></td>
                                </tr>
                            <?php 
                            $t_diskon += $t->diskon;
                            } ?>
                        </tbody>
                    </table>
                </td>
                <td class="text-center"><?php echo $this->Etc->rps( $t_diskon) ?></td>
            </tr>
        <?php }
    }?>
    </tbody>
</table>
<a class="float2" title="cetak excel" href="<?php echo site_url("Report_xls/diskon_report_xls/$start/$end"); ?>"> 
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