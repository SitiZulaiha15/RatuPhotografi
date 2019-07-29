<?php
$name = "Data Pelanggan per ".date("Y-m-d");

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=$name.xls");

header("Pragma: no-cache");

header("Expires: 0");
?>
<div class="inner-block">
    <div class="blank">
        <h2>Data Pelanggan</h2>
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kode Member</th>
                        <th>Tipe Member</th>
                        <th>Tanggal Daftar</th>
                        <th>Nomor Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    foreach ($list as $r) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $r->nm_member; ?></td>
                            <td><?php echo $r->id_member; ?></td>
                            <td><?php echo $r->tipe; ?></td>
                            <td><?php echo $r->tgl_daftar; ?></td>
                            <td><?php echo $r->no_telp; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>