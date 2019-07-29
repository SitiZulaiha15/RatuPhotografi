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
        </div>
        <div style="text-align: center">
            <!--<h3>Ringkasan</h3>-->
        </div>
        <br />
        <table style="margin: 0 auto; color: #000; " class="table table-condensed table-bordered table-striped" >
            <tr style="text-align: left;  background: #FC8213">
                <td style="width: 2%;"> <b>No</b></td>
                <td style="width: 2%;"> <b>No Nota</b></td>
                <td style="width: 10%;"> <b>Tanggal</b></td>
                <td style="width: 15%;"> <b>Akun</b> </td>
                <td style="width: 15%;"> <b>Debit</b> </td>
                <td style="width: 15%;"> <b>Kredit</b> </td>
                <td style="width: 15%;"> <b>History</b> </td>
                <td> <b>Keterangan</b> </td>
            </tr>
            <?php
            $i = 1;
            if (sizeof($sumber_dana_content_value) == 0) {
                ?>
                <script>
                    alert("Tidak ada data yang ditampilkan");
                    window.close();
                </script>
                <?php
            } else {
                $total = 0;
                foreach ($sumber_dana_content_value as $value) {
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $value->no_nota ?></td>
                        <td><?php echo date('d/m/Y', strtotime($value->tanggal)) ?></td>
                        <td><?php echo $value->Akun ?></td>
                        <td><?php echo buatrp($value->Debit) ?></td>
                        <td><?php echo buatrp($value->Kredit) ?></td>
                        <td><?php
                        $histori = $total + $value->Debit - $value->Kredit;
                        echo buatrp($histori);
                        ?></td>
                        <td><?php echo $value->ket ?></td>
                    </tr>
                    <?php
                    $i++;
                    $total = $histori;
                }
            }
            ?>
            <tr style="background: #838383;">
                <td colspan="5" style="text-align: right">Total Debit</td>
                <td>Total Kredit</td>
                <td colspan="2">Total Kas</td>
            </tr>
            <tr style="background: #838383;">
                <td colspan="5" style="text-align: right">
                    <b><?php
//                            echo buatrp($totalD); //Laporan Histori letak Uang
                            foreach ($total_deb_content_value as $value) { //	Laporan Jurnal Umum
                                echo buatrp($value->totaldebit);
                                $totalDebit = $value->totaldebit;
                            }
                            ?>
                        </b>
                    </td>
                    <td>
                        <b><?php
//                            echo buatrp($totalK); //Laporan Histori letak Uang
                            foreach ($total_kred_content_value as $value) { //	Laporan Jurnal Umum
                                echo buatrp($value->totalkredit);
                                $totalKredit = $value->totalkredit;
                            }
                            ?>
                        </b>
                    </td>
                    <td colspan="2"><b>
                        <?php
                            echo buatrp($totalDebit - $totalKredit) //	Laporan Jurnal Umum
//                            echo buatrp($totalD - $totalK) //Laporan Histori letak Uang
                            ?>
                        </b></td>
                    </tr>
                </table>
                <hr />
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