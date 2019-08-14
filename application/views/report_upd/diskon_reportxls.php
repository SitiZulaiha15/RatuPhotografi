<?php
$name = "Laporan Diskon " . $start . 's/d' . $end;

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$name.xls");

header("Pragma: no-cache");

header("Expires: 0");
?>
<h2><?php echo $name; ?></h2>
<table class="table table-condensed" border="1">
    <thead>
        <tr>
            <td rowspan="2"><strong>No</strong></td>
            <td class="text-center" rowspan="2"><strong>Nama Barang</strong></td>
            <td class="text-center" rowspan="2"><strong>Harga</strong></td>
            <td class="text-center" colspan="3"><strong>Transaksi</strong></td>
            <td class="text-center" rowspan="2"><strong>Total Diskon</strong></td>
        </tr>
        <tr>
            <td class="text-center"><strong>Tanggal</strong></td>
            <td class="text-center"><strong>Qty</strong></td>
            <td class="text-center"><strong>Diskon</strong></td>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        
        foreach ($barang as $b) {
            ?>
            <tr>
                <td class="text-center"><?php echo $no++ ?></td>
                <td class="text-left"><?php echo $b->nm_brg ?></td>
                <td class="text-center"><?php echo $this->Etc->rps($b->hrg) ?></td>
                <td class="text-center" colspan="3">
                    <table class="table table-condensed" border="1">
        <!--                        <thead>
                            <tr>
                                <td class="text-center"><strong>Tanggal</strong></td>
                                <td class="text-center"><strong>Qty</strong></td>
                                <td class="text-center"><strong>Diskon</strong></td>

                            </tr>
                        </thead>-->
                        <tbody>
                            <?php
                            $trans = $this->reportx->diskon_trans($start, $end, $b->kd_brg);
                            $t_diskon = 0;
                            foreach ($trans as $t) {
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $this->Etc->tgl($t->tgl) ?></td>
                                    <td class="text-center"><?php echo $t->jml ?></td>
                                    <td class="text-center"><?php echo $this->Etc->rps($t->diskon) ?></td>
                                </tr>
                                <?php
                                $t_diskon += $t->diskon;
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
                <td class="text-center"><?php echo $this->Etc->rps($t_diskon) ?></td>
            </tr>
            <?php
        }
    
    ?>
</tbody>
</table>