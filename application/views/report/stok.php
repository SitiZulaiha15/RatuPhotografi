<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Bahan Baku</th>  
                        <th>Kode Bahan Baku</th>
                        <th>Limit</th>
                        <th>Jumlah Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    foreach ($bb as $j) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $j->nm_bb; ?></td>
                            <td><?php echo $j->id_bb; ?></td>
                            <td><?php echo $j->limit; ?></td>
                            <td><?php echo $j->stok; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>