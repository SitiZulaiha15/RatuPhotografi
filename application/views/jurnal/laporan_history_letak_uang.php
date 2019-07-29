<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta charset="utf-8">
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
    <!--//skycons-icons-->
    <script type="text/javascript">
        var auto_refresh = setInterval(
            function () {
                $('#load_content').load('<?php echo site_url('Notif'); ?>').fadeIn("slow");
                    }, 1000); // refresh setiap 10000 milliseconds

                </script>
                <link href="<?php echo base_url() ?>/assets/css/demo-page.css" rel="stylesheet" media="all">
                <link href="<?php echo base_url() ?>/assets/css/hover.css" rel="stylesheet" media="all">

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
                            if (sizeof($laporan_content) == 0) {
                                ?>
                                <script>
                                    alert("Tidak ada data yang ditampilkan");
                                    window.close();
                                </script>
                                <?php
                            } else {
                                foreach ($laporan_content as $value) {
                                    $histori = $total + $value->Debit - $value->Kredit;
                                    ?><tr>
                                        <td><?php echo $i + 1 ?></td>
                                        <td><?php echo $value->no_nota ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($value->tanggal)) ?></td>
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
                        $tempD = $totalD + $value->Debit;  //Laporan Histori letak Uang
                        $tempK = $totalK + $value->Kredit; //Laporan Histori letak Uang
                        $total = $histori;
                        $totalD = $tempD; //Laporan Histori letak Uang
                        $totalK = $tempK; //Laporan Histori letak Uang
                        $i++;
                    }
                }
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
                            echo buatrp($totalD); //Laporan Histori letak Uang
//                            foreach ($total_debit as $value) { //	Laporan Jurnal Umum
//                                echo buatrp($value->totaldebit);
//                                $totalDebit = $value->totaldebit;
//                            }
                            ?>
                        </b>
                    </td>
                    <td>
                        <b><?php
                            echo buatrp($totalK); //Laporan Histori letak Uang
//                            foreach ($total_kredit as $value) { //	Laporan Jurnal Umum
//                                echo buatrp($value->totalkredit);
//                                $totalKredit = $value->totalkredit;
//                            }
                            ?>
                        </b>
                    </td>
                    <td ><b>
                        <?php
//                        echo buatrp($totalDebit - $totalKredit) //	Laporan Jurnal Umum
                            echo buatrp($totalD - $totalK) //Laporan Histori letak Uang
                            ?>
                        </b></td>
                        <td></td>
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