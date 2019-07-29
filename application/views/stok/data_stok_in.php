<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Barang</th>
                        <th>Nama Barang</th>
                        <th>Stok Awal</th>
                        <th>Harga/pcs</th>
                        <th>Qty Masuk</th>
                        <th>Stok Akhir</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $total = 0;
                    foreach ($stok as $j) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $j->id_bb; ?></td>
                            <td><?php echo $j->nm_bb; ?></td>
                            <td><?php echo $j->stok - $j->jml_in; ?> pcs</td>
                            <td><?php echo $this->Etc->rps($j->hrg_beli); ?></td>
                            <td><?php echo $j->jml_in; ?> pcs</td>
                            <td><?php echo $j->stok; ?> pcs</td>
                            <td><?php echo $this->Etc->rps($sub = $j->hrg_beli * $j->jml_in); ?></td>                                
                        </tr>
                        <?php
                        $total += $sub;
                    }
                    ?>
                    <tr>
                        <th colspan="7">Total Pengeluaran</th>
                        <td><?php echo $this->Etc->rps($total); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>