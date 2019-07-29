<?php
$name = "Laporan Stok Bahan Baku per ".date("Y-m-d");

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$name.xls");

header("Pragma: no-cache");

header("Expires: 0");
?>
<div class="inner-block">
    <div class="blank">
        <h2>Data Stok Bahan Baku</h2>
        <div class="table-responsive">
            <table class="table table-hover" border="1">
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