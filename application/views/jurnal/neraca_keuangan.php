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
            <label>Periode <?php echo $bulan_dari . ' ' . $tahun_dari ?></label>
        </div>
        <label>A. Aktiva Lancar</label>
        <table style="margin: 0 auto; color: #000;" class="table table-condensed table-striped">
            <tr style="text-align: left;  background: #FC8213">
                <th> No </th>
                <th> Akun </th>
                <th> Debit </th>
                <th> Kredit </th>
            </tr>

            <?php
            $i = 1;
            $debittempa = 0;
            $kredittempa = 0;
            if (sizeof($activ_lancar) == 0) {
                ?>
                <script>
                    alert("Tidak ada data yang ditampilkan");
                    window.close();
                </script>
                <?php
            } else {
                foreach ($activ_lancar as $value) {
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $value->Akun ?></td>
                        <td><?php
                        echo buatrp($value->TotDebita);
                        $totaldebita = $debittempa + $value->TotDebita;
                        ?></td>
                        <td><?php
                        echo buatrp($value->TotKredita);
                        $totalkredita = $kredittempa + $value->TotKredita;
                        ?></td>
                    </tr>
                    <?php
                    $i++;
                    $debittempa = $totaldebita;
                    $kredittempa = $totalkredita;
                }
            }
            ?>
            <tr style="text-align: left;  background: #c0c0c0">
                <td colspan="2" style="text-align: right"><b>Aktiva Lancar</b></td>
                <td ><b><?php echo buatrp($debittempa) ?></b></td>
                <td ><b><?php echo buatrp($kredittempa) ?></b></td>
            </tr>
            <tr style="text-align: left;  background: #c0c0c0">
                <td colspan="3" style="text-align: right"><b>Total Aktiva Lancar</b></td>
                <td ><b><?php
                $totalaktivalancar = $debittempa - $kredittempa;
                echo buatrp($totalaktivalancar)
                ?></b></td>
            </tr>
        </table>
        <br /><br />
        <label>B. Aktiva Tetap</label>
        <table style="margin: 0 auto; color: #000;" class="table table-condensed table-striped">
            <tr style="text-align: left;  background: #FC8213">
                <th> No </th>
                <th> Akun </th>
                <th> Debit </th>
                <th> Kredit </th>
            </tr>

            <?php
            $j = 1;
            $debittempb = 0;
            $kredittempb = 0;
            foreach ($activ_tetap as $value) {
                ?>
                <tr>
                    <td><?php echo $j ?></td>
                    <td><?php echo $value->Akun ?></td>
                    <td><?php
                    echo buatrp($value->TotDebitb);
                    $totaldebitb = $debittempb + $value->TotDebitb;
                    ?></td>
                    <td><?php
                    echo buatrp($value->TotKreditb);
                    $totalkreditb = $kredittempb + $value->TotKreditb;
                    ?></td>
                </tr>
                <?php
                $j++;
                $debittempb = $totaldebitb;
                $kredittempb = $totalkreditb;
            }
            ?>
            <tr style="text-align: left;  background: #c0c0c0">
                <td colspan="2" style="text-align: right"><b>Aktiva Tetap</b></td>
                <td ><b><?php echo buatrp($debittempb) ?></b></td>
                <td ><b><?php echo buatrp($kredittempb) ?></b></td>
            </tr>
            <tr style="text-align: left;  background: #c0c0c0">
                <td colspan="3" style="text-align: right"><b>Total Aktiva Tetap</b></td>
                <td ><b><?php
                $totalaktivatetap = $debittempb - $kredittempb;
                echo buatrp($totalaktivatetap)
                ?></b></td>
            </tr>
        </table>
        <br /><br />
        <label>C. Hutang</label>
        <table style="margin: 0 auto; color: #000;" class="table table-condensed table-striped">
            <tr style="text-align: left;  background: #FC8213">
                <th> No </th>
                <th> Akun </th>
                <th> Debit </th>
                <th> Kredit </th>
            </tr>

            <?php
            $k = 1;
            $debittempc = 0;
            $kredittempc = 0;
            foreach ($hutang as $value) {
                ?>
                <tr>
                    <td><?php echo $k ?></td>
                    <td><?php echo $value->Akun ?></td>
                    <td><?php
                    echo buatrp($value->TotDebitc);
                    $totaldebitc = $debittempc + $value->TotDebitc;
                    ?></td>
                    <td><?php
                    echo buatrp($value->TotKreditc);
                    $totalkreditc = $kredittempc + $value->TotKreditc;
                    ?></td>
                </tr>
                <?php
                $k++;
                $debittempc = $totaldebitc;
                $kredittempc = $totalkreditc;
            }
            ?>
            <tr style="text-align: left;  background: #c0c0c0">
                <td colspan="2" style="text-align: right"><b>Hutang</b></td>
                <td ><b><?php echo buatrp($debittempc) ?></b></td>
                <td ><b><?php echo buatrp($kredittempc) ?></b></td>
            </tr>
            <tr style="text-align: left;  background: #c0c0c0">
                <td colspan="3" style="text-align: right"><b>Total Hutang</b></td>
                <td ><b><?php
                $totalutang = $debittempc - $kredittempc;
                echo buatrp($totalutang)
                ?></b></td>
            </tr>
        </table>
        <br /><br />
        <label>D. Modal</label>
        <table style="margin: 0 auto; color: #000;" class="table table-condensed table-striped">
            <tr style="text-align: left;  background: #FC8213">
                <th> No </th>
                <th> Akun </th>
                <th> Debit </th>
                <th> Kredit </th>
            </tr>

            <?php
            $l = 1;
            $debittempd = 0;
            $kredittempd = 0;
            foreach ($hutang as $value) {
                ?>
                <tr>
                    <td><?php echo $l ?></td>
                    <td><?php echo $value->Akun ?></td>
                    <td><?php
                    echo buatrp($value->TotDebitd);
                    $totaldebitd = $debittempd + $value->TotDebitd;
                    ?></td>
                    <td><?php
                    echo buatrp($value->TotKreditd);
                    $totalkreditd = $kredittempd + $value->TotKreditd;
                    ?></td>
                </tr>
                <?php
                $l++;
                $debittempd = $totaldebitd;
                $kredittempd = $totalkreditd;
            }
            ?>
            <tr style="text-align: left;  background: #c0c0c0">
                <td colspan="2" style="text-align: right"><b>Modal</b></td>
                <td ><b><?php echo buatrp($debittempd) ?></b></td>
                <td ><b><?php echo buatrp($kredittempd) ?></b></td>
            </tr>
            <tr style="text-align: left;  background: #c0c0c0">
                <td colspan="3" style="text-align: right"><b>Total Modal</b></td>
                <td ><b><?php
                $totalmodal = $debittempd - $kredittempd;
                echo buatrp($totalmodal)
                ?></b></td>
            </tr>
        </table>

        <br /><br />
        <div style="text-align: center">
            <h3>Ringkasan Neraca Keuangan </h3>
            <label>Periode <?php echo $bulan_dari . ' ' . $tahun_dari ?></label>
        </div>
        <table style="margin: 0 auto; color: #000;" class="table table-condensed table-striped">
            <tr style="text-align: left;  background: #FC8213">
                <th> Total Aktiva Lancar </th>
                <th> Total Aktiva Tetap </th>
                <th> Total Utang </th>
                <th> Total Modal </th>
                <th> Total Final </th>
            </tr>
            <tr style="text-align: left;  background: #c0c0c0">
                <td><?php
                $totalaktivalancar_ring = $debittempa - $kredittempa;
                echo buatrp($totalaktivalancar_ring);
                ?></td>
                <td><?php
                $totalaktivatetap_ring = $debittempb - $kredittempb;
                echo buatrp($totalaktivatetap_ring);
                ?></td>
                <td><?php
                $totalutang_ring = $debittempc - $kredittempc;
                echo buatrp($totalutang_ring);
                ?></td>
                <td><?php
                $totalmodal_ring = $debittempd - $kredittempd;
                echo buatrp($totalmodal_ring);
                ?></td>
                <td><b><?php
                $totalseluruhneraca = $totalaktivalancar_ring + $totalaktivatetap_ring + $totalutang_ring + $totalmodal_ring;
                echo buatrp($totalseluruhneraca);
                ?></b></td>
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

function buatrp($angka) {
    $jadi = "Rp. " . number_format($angka, 0, ',', '.');
    return $jadi;
}
?>