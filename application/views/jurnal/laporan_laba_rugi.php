<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo ucwords(str_replace('%20', ' ', $laporan)) ?></title>
    <link href="<?php echo base_url() ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <!-- Custom Theme files -->
    <link href="<?php echo base_url() ?>/assets/css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <!--js-->
    <script src="<?php echo base_url() ?>/assets/js/jquery-2.1.1.min.js"></script> 
    <script src="<?php echo base_url() ?>/assets/js/currency.js"></script> 
    <!--icons-css-->
    <link href="<?php echo base_url() ?>/assets/css/font-awesome.css" rel="stylesheet"> 
    <!--Google Fonts-->
    <link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>

    <link href="<?php echo base_url() ?>/assets/css/demo-page.css" rel="stylesheet" media="all">
    <link href="<?php echo base_url() ?>/assets/css/hover.css" rel="stylesheet" media="all">

</head>
<?php
$totalPenjualan = 0;
foreach ($penjualan as $value) {
    $totalPenjualan = $value->TotDebitD - $value->TotKreditD;
}

    // Operational
$debittempE = 0;
$kredittempE = 0;
foreach ($operational as $value) {
    $totaldebitE = $debittempE + $value->TotDebite;
    $totalkreditE = $kredittempE + $value->TotKredite;
    $debittempE = $totaldebitE;
    $kredittempE = $totalkreditE;
}
?>
<body>
    <div class="container">
        <div style="text-align: center">
            <h2>Ratu Photography</h2>
            <span>Alamat : bla bla bla</span>
        </div>
        <hr />
        <hr />
        <div style="text-align: center">
            <h3><?php echo ucwords(str_replace('%20', ' ', $laporan)) ?></h3>
            <label>Periode <?php echo $bulan_dari . ' ' . $tahun_dari ?> 
            </label>
        </div>
        <div style="text-align: center">
            <!--<h3>Ringkasan</h3>-->
        </div>

        <table style="margin: 0 auto; color: #000; width: 75%" class="table table-condensed table-bordered table-striped" >
            <tr style="text-align: left;  background: #FC8213">
                <td style="width: 2%;"> <b>No</b></td>
                <td> <b>Akun</b> </td>
                <td> <b>Debit</b> </td>
                <td> <b>Kredit</b> </td>
            </tr>
            <?php
            $i = 0;
            $debittempd = 0;
            $kredittempd = 0;
            foreach ($penjualan as $values) {
                $totaldebitD = $debittempd + $values->TotDebitD;
                $totalkreditD = $debittempd + $values->TotKreditD;
                ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $values->Akun ?></td>
                    <td><?php echo buatrp($values->TotDebitD) ?></td>
                    <td><?php echo buatrp($values->TotKreditD) ?></td>
                </tr>  
                <?php
                $i++;
                $debittempD = $totaldebitD;
                $kredittempD = $totalkreditD;
            }
            ?>
            <tr>
                <td>2</td>
                <td>HPP</td>
                <td></td>
                <td></td>
            </tr>

            <tr bgcolor="#c0c0c0">
                <td colspan = "3" style="text-align: right"> <b>LABA KOTOR</b> </td>
                <td align = "right"></td>
            </tr >
            <?php
            $j = 0;
            $debittempa = 0;
            $kredittempa = 0;
            foreach ($operational as $values) {
                $totaldebita = $debittempa + $values->TotDebite;
                $totalkredita = $kredittempa + $values->TotKredite;
                ?>
                <tr>
                    <td><?php echo $j + 1 ?></td>
                    <td><?php echo $values->Akun ?></td>
                    <td><?php echo buatrp($values->TotDebite) ?></td>
                    <td><?php echo buatrp($values->TotKredite) ?></td>
                </tr>
                <?php
                $j++;
                $debittempa = $totaldebita;
                $kredittempa = $totalkredita;
            }
            $totalbiayaoperational = $debittempa - $kredittempa;
            ?>
            <tr style="text-align: left;  background: #c0c0c0">
                <td colspan="2" style="text-align: right"><b>Total Biaya Operational</b></td>
                <td ><b><?php echo buatrp($debittempa) ?></b></td>
                <td ><b><?php echo buatrp($kredittempa) ?></b></td>
            </tr>
            <tr style="text-align: left;  background: #c0c0c0">
                <td colspan="2" style="text-align: right"><b>TTotal Biaya Operational Final</b></td>
                <td colspan="2" style="text-align: center" ><b><?php echo buatrp($totalbiayaoperational) ?></b></td>
            </tr>
            <tr style="text-align: left;  background: #c0c0c0">
                <td colspan="2" style="text-align: right"><b>Laba Operational Operational</b></td>
                <td colspan="2" style="text-align: center" ><b><?php ?></b></td>
            </tr>
        </table>
    </div>
    <hr />
    <hr />
</body>
</html>
<?php

function buatrp($angka) {
    $jadi = "Rp. " . number_format($angka, 0, ',', '.');
    return $jadi;
}
?>