<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo ucwords(str_replace('%20', ' ', $laporan)) ?></title>
    <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <script
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body onload="return hiddenHistory()">
    <div class="container">
        <div style="text-align: center">
            <h2>Ratu Photography</h2>
            <span>Alamat : bla bla bla</span>
        </div>
        <hr />
        <hr />
        <?php // echo $nama_tempat;?>
        <div style="text-align: center">
            <h3><?php echo ucwords(str_replace('%20', ' ', $laporan)) ?></h3>
            <label>Periode <?php echo $bulan_dari . ' ' . $tahun_dari ?></label>
        </div>
        <table style="margin: 0 auto; color: #000;" class="table table-condensed table-striped">
            <tr style="text-align: left;  background: #FC8213">
                <td><b>No</b></td>
                <td><b>No Nota</b></td>
                <td><b>Tanggal</b></td>
                <td><b>Akun</b></td>
                <td><b>Debit</b></td>
                <td><b>Kredit</b></td>
                <?php
                if ($id + 1 == 4) {
                    
                } else {
                    ?>
                    <td id="history"><b>History</b></td>
                    <?php } ?>
                    <td><b>Keterangan</b></td>
                </tr>

                <?php
                $i = 0;
                $total = 0;
                $totalK = 0;
                $totalD = 0;
//                if (sizeof($laporan_content) == 0) {
                ?>
                <script>
//                    alert("Tidak ada data yang ditampilkan");
//                    window.close();
</script>
<?php
//                } else {
foreach ($laporan_content as $value) {
    $histori = $total + $value->Debit - $value->Kredit;
    ?><tr>
        <td><?php echo $i + 1 ?></td>
        <td><?php echo $value->no_nota ?></td>
        <td><?php echo $value->tanggal ?></td>
        <td><?php echo $value->Akun ?></td>
        <td><?php echo buatrp($value->Debit) ?></td>
        <td><?php echo buatrp($value->Kredit) ?></td>
        <?php
        if ($id + 1 == 4) {
            
        } else {
            ?>
            <td id="history"><?php echo buatrp($histori) ?></td>
            <?php } ?>
            <td><?php echo $value->ket ?></td>
        </tr>
        <?php
//                        $tempD = $totalD + $value->Debit;  //Laporan Histori letak Uang
//                        $tempK = $totalK + $value->Kredit; //Laporan Histori letak Uang
        $total = $histori;
//                        $totalD = $tempD; //Laporan Histori letak Uang
//                        $totalK = $tempK; //Laporan Histori letak Uang
        $i++;
    }
//                }
    ?>
    <tr style="background: #838383;">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Total Debit</td>
        <td>Total Kredit</td>
        <td colspan="2">Total Kas</td>
    </tr>
    <tr style="background: #838383;">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <b><?php
//                            echo buatrp($totalD); //Laporan Histori letak Uang
                            foreach ($total_debit as $value) { //	Laporan Jurnal Umum
                                echo buatrp($value->totaldebit);
                                $totalDebit = $value->totaldebit;
                            }
                            ?>
                        </b>
                    </td>
                    <td>
                        <b><?php
//                            echo buatrp($totalK); //Laporan Histori letak Uang
                            foreach ($total_kredit as $value) { //	Laporan Jurnal Umum
                                echo buatrp($value->totalkredit);
                                $totalKredit = $value->totalkredit;
                            }
                            ?>
                        </b>
                    </td>
                    <td ><b>
                        <?php
                        echo buatrp($totalDebit - $totalKredit) //	Laporan Jurnal Umum
//                            echo buatrp($totalD - $totalK) //Laporan Histori letak Uang
                        ?>
                    </b></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </body>
    </html>
    <script>
        function hiddenHistory() {
            var id = '<?php echo $id + 1 ?>';
            if (id == 4) {
                document.getElementById('history').setAttribute("class", "hiddens");
            }
        }
    </script>
    <style>
    .hiddens{
        visibility: hidden;
    }
</style>
<?php

function buatrp($angka) {
    $jadi = "Rp. " . number_format($angka, 0, ',', '.');
    return $jadi;
}
?>