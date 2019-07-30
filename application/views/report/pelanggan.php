<?php
$name = "Laporan Data Pelanggan per " . date("Y-m-d");

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$name.xls");

header("Pragma: no-cache");

header("Expires: 0");
?>
<div class="inner-block">
    <div class="blank">
        <h2>Laporan Data Pelanggan per <?php echo date("Y-m-d"); ?></h2>
        <div class="table-responsive">
            <table class="table table-hover" border='1'>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>  
                        <th>Nomor Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($report as $r) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $r->atas_nama; ?></td>
                            <td><?php echo $r->no_telp; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>