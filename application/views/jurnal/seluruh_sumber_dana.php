<!doctype html>
<html>
<head>
    <title>Laporan Sumber Dana</title>
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
            <h3>Laporan Sumber Dana Per <?php
            date_default_timezone_set('Asia/Jakarta');
            setlocale(LC_ALL, 'id');
            echo date('d') . ' ' . getMonth(date('n')) . ' ' . date('Y');
            ?></h3>
        </div>
        <div style="text-align: center">
            <h3><?php
            $array = array();
            $uang = array();
            $i = 0;
            foreach ($sumber_dana as $values) {
                $array[$i] = $values->nama_tempat . ' ';
                $uang[$i] = $values->saldo;
//                        echo $values->nama_tempat . ' ';
//                        echo $values->saldo . ' ';
//                        echo '<br />';
                $i++;
            }
            ?></h3>
            <br />
            <br />
        </div>
        <table style="margin: 0 auto; color: #000; width: 75%" class="table table-condensed table-striped">
            <tr style="">
                <th style="text-align: left;  background: #FC8213; width: 50%">
                    Nama Sumber Dana
                </th>
                <th style="text-align: left;  background: #FC8213; width: 50%">
                 Jumlah Uang
             </th>
         </tr>
         <tr style="text-align: left;  background: #FC8213">
            <?php
            $i = 1;
            foreach ($sumber_dana as $values) {
                ?>
                <tr>
                    <td >
                        <?php echo $values->nama_tempat; ?> 
                    </td>
                    <td>
                        <?php echo buatrp($values->saldo); ?>
                    </td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </table>
        <hr />
        <hr />
        <?php
        $totalTabungan = 0;
        $totalUang = 0;
        foreach ($tabungan as $values) {
            $totalTabungan = $values->totalTabungan;
        }
        foreach ($total_uang as $values) {
            $totalUang = $values->total;
        }
        $uangPanas = $totalUang - $totalTabungan;
        $uangStudio = $uangPanas - 45061000;
        ?>
        <table style="margin: 0 auto; color: #000;; width: 75%" class="table table-condensed table-striped">
            <tr>
                <th style="width: 50%">Total Tabungan</th>
                <th style="width: 50%"><?php echo buatrp($totalTabungan) ?></th>
            </tr>
            <tr>
                <th>Total Uang</th>
                <th><?php echo buatrp($totalUang) ?></th>
            </tr>
            <tr>
                <th>Uang Studio</th>
                <th><?php echo buatrp($uangStudio) ?></th>
            </tr>
            <tr>
                <th>Uang Banner</th>
                <th><?php echo buatrp(45061000) ?></th>
            </tr>

        </table>
        <hr />
        <hr />
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

function getMonth($bulan) {
    $cars = array(
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember"
    );
    return $cars[$bulan - 1];
}

function buatrp($angka) {
    $jadi = "Rp. " . number_format($angka, 0, ',', '.');
    return $jadi;
}
?>