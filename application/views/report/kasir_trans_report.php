<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Laporan Transaksi</title>
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
                                <h3 class="panel-title"><strong>Laporan Transaksi <?php echo $this->Etc->tgl($start); ?> - <?php echo $this->Etc->tgl($end); ?></strong></h3>
                            </div>
                            <div class="panel-body">
                                <!--<div class="table-responsive">-->
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <td><strong>No</strong></td>
                                                <td class="text-center"><strong>Nama Customer</strong></td>
                                                <td class="text-center"><strong>No Telepon</strong></td>
                                                <td class="text-center"><strong>Tanggal</strong></td>
                                                <td class="text-center"><strong>Tanggal Selesai</strong></td>
                                                <td class="text-center"><strong>Total</strong></td>
                                                <td class="text-center"><strong>DP</strong></td>
                                                <td class="text-center"><strong>Sisa</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no=1;
                                            $total = 0;
                                            foreach ($report as $r) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td class="text-left"><?php echo $r->atas_nama; ?></td>
                                                    <td class="text-right"><?php echo $r->id_trans; ?></td>
                                                    <td class="text-right"><?php echo $this->Etc->tgl($r->tgl); ?></td>
                                                    <td class="text-center"><?php echo $this->Etc->tgl($r->deadline); ?></td>
                                                    <td class="text-center"><?php echo $this->Etc->rps($t = $this->Report_m->t_trans($r->id_trans)) ?></td>
                                                    <td class="text-right"><?php echo $this->Etc->rps($t_dp = $this->Kasir_m->dp($r->no_nota)); ?></td>
                                                    <td class="text-right"><?php echo $this->Etc->rps($t-$t_dp); ?></td>
                                                    
                                                    </td>
                                                </tr>
                                                <?php
                                                $total+=$t;
                                            }
                                            ?>
                                                <tr>
                                            <td class="thick-line"></td>
                                            <td class="thick-line text-center" colspan="4"><strong>Total</strong></td>                                                
                                            <td class="thick-line text-right" ><strong><?php echo $this->Etc->rps($total); ?></strong></td>
                                            <td class="thick-line text-right" ><strong></strong></td>
                                            <td class="thick-line text-right" ><strong></strong></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <a class="float" title="cetak halaman" onclick="cetak();"> 
                                        <i class="fa fa-print my-float" ></i>
                                    </a>
                                <!--</div>-->
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
