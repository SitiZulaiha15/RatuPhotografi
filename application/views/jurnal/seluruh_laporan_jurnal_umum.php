<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Seluruh Jurnal Umum</title>
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
<body>
    <div class="container">
        <div style="text-align: center">
            <h2>Ratu Photography</h2>
            <span>Alamat : bla bla bla</span>
        </div>
        <hr />
        <hr />
        <div style="text-align: center">
            <h3>Laporan Seluruh Jurnal Umum</h3>
        </div>
        <div style="text-align: center">
            <!--<h3>Ringkasan</h3>-->
        </div>
        <br />
        <table style="margin: 0 auto; color: #000"
        class="table table-responsive table-condensed table-striped">
        <tr style="text-align: left;  background: #FC8213">
            <th>No</th>
            <th>No Nota</th>
            <th style="width: 15%">Tanggal</th>
            <th style="width: 15%">Debit</th>
            <th style="width: 15%">Kredit</th>
            <th style="width: 15%">History</th>
            <th>Keterangan</th>
        </tr>
        <?php
        $i = 1;
        $total = 0;
        foreach ($seluruh_jurnal as $value) {
            $histori = $total + $value->Debit - $value->Kredit;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $value->no_nota ?></td>
                <td><?php echo $value->tanggal ?></td>
                <td><?php echo buatrp($value->Debit) ?></td>
                <td><?php echo buatrp($value->Kredit) ?></td>
                <td><?php echo buatrp($histori) ?></td>
                <td><?php echo $value->ket ?></td>
            </tr>
            <?php
            $i++;
            $total = $histori;
            ;
        }
        ?>
        <tr style="background: #337AB7; color: #fff">
            <td colspan=4 style="text-align: right;">
                <b>Total Debit Seluruh</b>
            </td>
            <td>
                <b>Total Kredit Seluruh</b>
            </td>
            <td colspan=2>
                <b>Total Kas Seluruh</b>
            </td>
        </tr>
        <tr style="background: #337AB7; color: #fff">
            <td colspan=4 style="text-align: right">
                <b><?php echo buatrp($total_debit) ?></b>
            </td>
            <td>
                <b><?php echo buatrp($total_kredit) ?></b>
            </td>
            <td colspan=2>
                <b>Total Kas Seluruh</b>
            </td>
        </tr>
    </table>
    <hr />
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
@media print
{    
    .float, .float *
    {
        display: none !important;
    }
}
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