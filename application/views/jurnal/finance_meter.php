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
// echo $query;
$totalKas = 0;
foreach ($kas as $value) {
    $totalKas = $value->TotDebitz - $value->TotKreditz;
}

$totalPenjualan = 0;
foreach ($penjualan as $value) {
    $totalPenjualan = $value->TotDebitD - $value->TotKreditD;
}
    //Aktiva Lancar
$debittempa = 0;
$kredittempa = 0;
foreach ($activ_lancar as $value) {
    $totaldebita = $debittempa + $value->TotDebita;
    $totalkredita = $kredittempa + $value->TotKredita;

    $debittempa = $totaldebita;
    $kredittempa = $totalkredita;
}

    //Aktiva Tetap
$debittempb = 0;
$kredittempb = 0;
foreach ($activ_tetap as $value) {
    $totaldebitb = $debittempb + $value->TotDebitb;
    $totalkreditb = $kredittempb + $value->TotKreditb;
    $debittempb = $totaldebitb;
    $kredittempb = $totalkreditb;
}


    // Hutang
$k = 1;
$debittempc = 0;
$kredittempc = 0;
foreach ($hutang as $value) {
    $totaldebitc = $debittempc + $value->TotDebitc;
    $totalkreditc = $kredittempc + $value->TotKreditc;
    $debittempc = $totaldebitc;
    $kredittempc = $totalkreditc;
}

    // Operational
$debittempE = 0;
$kredittempE = 0;
$totalbiayaoperational = 0;
foreach ($operational as $value) {
    $totaldebitE = $debittempE + $value->TotDebite;
    $totalkreditE = $kredittempE + $value->TotKredite;
    $debittempE = $totaldebitE;
    $kredittempE = $totalkreditE;
}
$totalbiayaoperational = $kredittempE - $debittempE;

    //Modal
$debittempf = 0;
$kredittempf = 0;
foreach ($modal as $value) {
    $totaldebitf = $debittempf + $value->TotDebitd;
    $totalkreditf = $kredittempf + $value->TotKreditd;
    $debittempf = $totaldebitf;
    $kredittempf = $totalkreditf;
}


$keuangandebit = $totalKas + $totalPenjualan + $debittempa + $debittempb + $debittempc + $debittempf;
$keuangankredit = $kredittempa + $kredittempb + $kredittempc + $totalbiayaoperational + + $kredittempf;
$totalkeauangan = $keuangandebit - $keuangankredit;
$totalkeauangantanpakas = $keuangandebit - $keuangankredit - $totalKas;
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
            $akun = array('Kas bulan lalu', 'Penjualan', 'Aktiva Lancar', 'Aktiva Tetap', 'Utang', 'Biaya Operational', 'Modal');
            $debit = array($totalKas, $totalPenjualan, $debittempa, $debittempb, $debittempc, '0', $debittempf);
            $kredit = array('0', '0', $kredittempa, $kredittempb, $kredittempc, $totalbiayaoperational, $kredittempf);
            $i = 0;
            $debittempa = 0;
            $kredittempa = 0;
            for ($i; $i < sizeof($akun); $i++) {
                ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $akun[$i] ?></td>
                    <td><?php echo buatrp($debit[$i]) ?></td>
                    <td><?php echo buatrp($kredit[$i]) ?></td>
                </tr>
                <?php }
                ?>
                <tr style="text-align: left;  background: #c0c0c0">
                    <td colspan="2" style="text-align: right"><b>Keuangan</b></td>
                    <td ><b><?php echo buatrp($keuangandebit) ?></b></td>
                    <td ><b><?php echo buatrp($keuangankredit) ?></b></td>
                </tr>
                <tr style="text-align: left;  background: #c0c0c0">
                    <td colspan="2" style="text-align: right"><b>Total Keuangan Tanpa Kas</b></td>
                    <td colspan="2" style="text-align: center" ><b><?php echo buatrp($totalkeauangantanpakas) ?></b></td>
                </tr>
                <tr style="text-align: left;  background: #c0c0c0">
                    <td colspan="2" style="text-align: right"><b>Total Keuangan Final</b></td>
                    <td colspan="2" style="text-align: center" ><b><?php echo buatrp($totalkeauangan) ?></b></td>
                </tr>
            </table>
        </div>
        <a class="float" title="cetak halaman" onclick="cetak()"> 
            <i class="fa fa-print my-float" ></i>
        </a>
    </body>
    </html>
    <script>
        function cetak() {
            print();
        }
    </script>
    <style>
    .float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        background-color: purple;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        box-shadow: 2px 2px 3px #999;
    }

    .my-float {
        margin-top: 22px;
    }
</style>
<?php

function buatrp($angka) {
    $jadi = "Rp. " . number_format($angka, 0, ',', '.');
    return $jadi;
}
?>