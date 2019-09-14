<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Laporan Penjualan</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link href="<?php echo base_url() ?>/assets/css/font-awesome.css" rel="stylesheet">
        <style type="text/css">
            .invoice-title h2, .invoice-title h3 {
                display: inline-block;
            }

            .table > tbody > tr > .no-line {
                border-top: none;
            }

            .table > thead > tr > .no-line {
                border-bottom: none;
            }

            .table > tbody > tr > .thick-line {
                border-top: 2px solid;
            }
            td, th{
                border: 1px solid;
            }
        </style>
    </head>
    <body>
        <div id="printing">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Laporan Hutang Pelanggan periode <?php echo $this->Etc->tgl($start) . "-" .$this->Etc->tgl($end); ?></strong></h3>
                            </div>
                            <div class="panel-body">
                                <!--<div class="table-responsive">-->
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <td><strong>No</strong></td>
                                            <td class="text-center"><strong>Nama Pelanggan</strong></td>
                                            <td class="text-center"><strong>Nomor telepon</strong></td>
                                            <td class="text-center"><strong>Tanggal</strong></td>
                                            <td class="text-center"><strong>Invoice/ No nota</strong></td>
                                            <td class="text-center"><strong>Nama Barang/ Jasa</strong></td>
                                            <td class="text-center"><strong>Status</strong></td>
                                            <td class="text-center"><strong>Total Pesanan</strong></td>
                                            <td class="text-center"><strong>Sisa Belum dibayar</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $total  = array();
                                        $hutang = array();
                                        foreach ($report as $r) {
                                            $t = $this->Report_m->barang_hutang($r->id_trans);
                                            $barang = $this->Kasir_m->barang_db($r->id_trans);
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td class="text-left"><?php echo $r->atas_nama; ?></td>
                                                <td class="text-left"><?php echo $r->no_telp; ?></td>
                                                <td class="text-right"><?php echo $this->Etc->tgl($r->tgl); ?></td>
                                                <td class="text-right"><?php echo $r->no_nota; ?></td>
                                                <td class="text-center"><?php foreach ($barang as $br) {
                                            echo $br->nm_brg . "<br>";
                                        } ?></td>
                                                <td class="text-right"><?php echo "DP"; ?></td>
                                                <td class="text-right"><?php echo $this->Etc->rps($t->total); ?>
                                                <td class="text-right"><?php echo $this->Etc->rps($t->total - $r->dp);
                                                array_push($total, $t->total);
                                                array_push($hutang,$t->total - $r->dp);


                                                 ?>

                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="7">Grand Total Pesanan:</td>
                                            <td colspan="2"><?php echo $this->Etc->rps(array_sum($total));?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7">Grand Hutang:</td>
                                            <td colspan="2"><?php echo $this->Etc->rps(array_sum($hutang));?></td>
                                        </tr>

                                    </tbody>
                                </table>
                                <a class="float" title="cetak halaman" onclick="cetak();"> 
                                    <i class="fa fa-print my-float" ></i>
                                </a>                                
                                <a class="float2" title="cetak excel" href="<?php echo site_url("Report/hutang_excel/$start/$end"); ?>"> 
                                    <i class="fa fa-file-excel-o my-float" ></i>
                                </a> 

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script type="text/javascript">
    function cetak() {
        print();
    }
    function cetak_excel(start, end) {
        $.ajax({
            url: "<?php echo site_url("Report/kasir_pj_report_excel"); ?>",
            data: {start: start, end: end},
            type: "POST",
            success: function (data) {
            },
            error: function (a, b, c) {
            }
        })
    }

</script>
<style>
    @media print
    {    
        .float, .float *, .notab
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
    .float2 {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 120px;
        background-color: #009d28;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        box-shadow: 2px 2px 3px #999;
    }

    .my-float {
        margin-top: 22px;
    }
</style>
