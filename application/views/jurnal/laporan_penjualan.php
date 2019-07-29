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
                <td> <b>No. Nota</b></td>
                <td> <b>Tanggal</b></td>
                <td> <b>Akun</b> </td>
                <td> <b>Debit</b> </td>
                <td> <b>Kredit</b> </td>
                <td> <b>Keterangan</b> </td>
            </tr>
            <?php
            $i = 0;
            foreach ($content_penjualan as $values) {
                ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $values->no_nota ?></td>
                    <td><?php echo date('d/m/Y', strtotime($values->tanggal)) ?></td>
                        <td><?php echo $values->Akun  ?></td>
                        <td><?php echo buatrp($values->Debit)  ?></td>
                        <td><?php echo buatrp($values->Kredit)  ?></td>
                        <td><?php echo $values->ket  ?></td>
                        </tr>  
                        <?php
                        $i++;
                    }
                    ?>
                    <tr>
                    <td colspan="5" style="text-align: right;"><b>Total Debit</b></td>
                    <td><b>Total Kredit</b></td>
                    <td><b>Total Kas</b></td>
                    </tr>  
                    <tr>
                    <?php 
                    $total = 0;
                    $debit = 0;
                    $kredit = 0;
                    foreach ($total_debit as $key => $value) {
                        $debit = $value->totaldebit;
                        ?>
                        <td colspan="5" style="text-align: right;"><b><?php echo buatrp($value->totaldebit);?></b></td>
                        <?php
                    }
                    ?>

                    <?php 
                    foreach ($total_kredit as $key => $value) {
                        $kredit = $value->totalkredit
                        ?>
                        <td style="text-align: right;"><b><?php echo buatrp($value->totalkredit);?></b></td>
                        <?php
                    }

                    $total = $debit-$kredit;
                    ?>
                    <td><b><?php echo buatrp($total)?></b></td>
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