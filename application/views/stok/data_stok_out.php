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
                        <th>Qty Out</th>
                        <th>Stok Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($stok as $j) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $j->id_bb; ?></td>
                            <td><?php echo $j->nm_bb; ?></td>
                            <td><?php echo $j->stok_awal ?> pcs</td>
                            <td><?php echo $j->stok_awal-$j->stok_akhir ; ?> pcs</td>
                            <td><?php echo $j->stok_akhir; ?> pcs</td>                               
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>