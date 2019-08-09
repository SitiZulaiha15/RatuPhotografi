<table class="table table-condensed" border="1">
    <thead>
        <tr>
            <td rowspan="2"><strong>No</strong></td>
            <td class="text-center" rowspan="2"><strong>Atas Nama</strong></td>
            <td class="text-center" rowspan="2"><strong>Tanggal</strong></td>
            <td class="text-center" colspan="2"><strong>Pesanan</strong></td>
            <td class="text-center" rowspan="2"><strong>HPP</strong></td>
            <td class="text-center" rowspan="2"><strong>Harga</strong></td>
            <td class="text-center" rowspan="2"><strong>Diskon</strong></td>
            <td class="text-center" rowspan="2"><strong>Modal</strong></td>
            <td class="text-center" rowspan="2"><strong>Sub Total</strong></td>
            <td class="text-center" rowspan="2"><strong>Keuntungan</strong></td>
            <td class="text-center" rowspan="2"><strong>Total Transaksi</strong></td>
            <td class="text-center" colspan="3"><strong>Detail Bayar</strong></td>
        </tr>
        <tr>
            <td class="text-center"><strong>Barang</strong></td>
            <td class="text-center"><strong>Jumlah</strong></td>
            <td class="text-center"><strong>Tanggal</strong></td>
            <td class="text-center"><strong>Nominal</strong></td>
            <td class="text-center"><strong>Metode Bayar</strong></td>
        </tr>
    </thead>
    <tbody>
        <?php
        $no=1;
        foreach ($trans as $t) {
            $total = (($t->hrg * $t->jml) - $t->diskon);
            $modal = $t->hpp * $t->jml;
            $untung = $total-$total;
        ?>
        
        <tr>
            <td class="text-center"></td>
            <td class="text-center"><?php echo $t->atas_nama ?></td>
            <td class="text-center"><?php echo $t->tgl ?></td>
            <td class="text-center"><?php echo $t->nm_brg ?></td>
            <td class="text-center"><?php echo $t->jml ?></td>
            <td class="text-center"><?php echo $t->hpp ?></td>
            <td class="text-center"><?php echo $t->hrg_brg ?></td>
            <td class="text-center"><?php echo $t->diskon ?></td>
            <td class="text-center"><?php echo $modal ?></td>
            <td class="text-center"><?php echo $total ?></td>
            <td class="text-center"><?php echo $untung ?></td>
            <td class="text-center">Total Transaksi</td>
            <td class="text-center">Tanggal</td>
            <td class="text-center">Nominal</td>
            <td class="text-center">Metode Bayar</td>
        </tr>
        
        <?php
        }
        ?>
<!--        <tr>
        <td class="thick-line"></td>
        <td class="thick-line text-center" colspan="4"><strong>Total Penjualan</strong></td>                                                
        <td class="thick-line text-right" ><strong><?php echo $this->Etc->rps($t_total); ?></strong></td>
        <td class="thick-line text-right" ><strong><?php echo $this->Etc->rps($t_modal); ?></strong></td>
        <td class="thick-line text-right" ><strong><?php echo $this->Etc->rps($untung); ?></strong></td>
    </tr>-->

    </tbody>
</table>