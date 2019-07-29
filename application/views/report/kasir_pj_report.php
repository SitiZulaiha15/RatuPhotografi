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
                                <h3 class="panel-title"><strong>Laporan Return Penjualan <?php echo $this->Etc->tgl($start); ?> - <?php echo $this->Etc->tgl($end); ?></strong></h3>
                            </div>
                            <div class="panel-body">
                                <!--<div class="table-responsive">-->
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <td><strong>No</strong></td>
                                            <td class="text-center"><strong>Nama Barang</strong></td>
                                            <td class="text-center"><strong>HPP</strong></td>
                                            <td class="text-center"><strong>Harga Barang</strong></td>
                                            <td class="text-center"><strong>Jumlah</strong></td>
                                            <td class="text-center"><strong>Total</strong></td>
                                            <td class="text-center"><strong>Modal</strong></td>
                                            <td class="text-center"><strong>Keuntungan</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $untung = 0;
                                        $no = 1;
                                        $t_total = 0;
                                        $t_modal = 0;
                                        foreach ($report as $r) {
                                            $total = (($r->hrg_brg * $r->jml)-$r->diskon);
                                            $modal = $r->hpp * $r->jml;
                                            ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td class="text-left"><?php echo $r->nm_brg; ?></td>
                                                <td class="text-right"><?php echo $this->Etc->rps($r->hpp); ?></td>
                                                <td class="text-right"><?php echo $this->Etc->rps($r->hrg_brg); ?></td>
                                                <td class="text-center"><?php echo $r->jml; ?></td>
                                                <td class="text-right"><?php echo $this->Etc->rps($total); ?></td>
                                                <td class="text-right"><?php echo $this->Etc->rps($modal); ?>
                                                <td class="text-right"><?php echo $this->Etc->rps($sub = $total - $modal); ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $untung += $sub;
                                            $t_total += $total;
                                            $t_modal += $modal;
                                        }
                                        ?>
                                        <tr>
                                            <td class="thick-line"></td>
                                            <td class="thick-line text-center" colspan="4"><strong>Total Penjualan</strong></td>                                                
                                            <td class="thick-line text-right" ><strong><?php echo $this->Etc->rps($t_total); ?></strong></td>
                                            <td class="thick-line text-right" ><strong><?php echo $this->Etc->rps($t_modal); ?></strong></td>
                                            <td class="thick-line text-right" ><strong><?php echo $this->Etc->rps($untung); ?></strong></td>
                                        </tr>

                                    </tbody>
                                </table>
                                <a class="float" title="cetak halaman" onclick="cetak();"> 
                                    <i class="fa fa-print my-float" ></i>
                                </a>
                                <!--</div>-->
                                <?php foreach ($kat as $k) { ?>
                                    <div class="col-md-12 notab">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><strong>Laporan Penjualan <?php echo $k->nm_grup; ?> <?php echo $this->Etc->tgl($start); ?> - <?php echo $this->Etc->tgl($end); ?></strong></h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-condensed">
                                                        <thead>
                                                            <tr>
                                                                <td><strong>No</strong></td>
                                                                <td class="text-center"><strong>Nama Barang</strong></td>
                                                                <td class="text-center"><strong>HPP</strong></td>
                                                                <td class="text-center"><strong>Harga Barang</strong></td>
                                                                <td class="text-center"><strong>Jumlah</strong></td>
                                                                <td class="text-center"><strong>Total</strong></td>
                                                                <td class="text-center"><strong>Modal</strong></td>
                                                                <td class="text-center"><strong>Keuntungan</strong></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $untung1 = 0;
                                                            $no1 = 1;
                                                            $t_total1 = 0;
                                                            $t_modal1 = 0;
                                                            $report1 = $this->Report_m->kasir_pj_kat($k->id_grup, $start, $end);
                                                            foreach ($report1 as $r1) {
                                                                $total1 = ($r1->hrg_brg * $r1->jml)-$r1->diskon;
                                                                $modal1 = $r1->hpp * $r1->jml;
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $no1++; ?></td>
                                                                    <td class="text-left"><?php echo $r1->nm_brg; ?></td>
                                                                    <td class="text-right"><?php echo $this->Etc->rps($r1->hpp); ?></td>
                                                                    <td class="text-right"><?php echo $this->Etc->rps($r1->hrg_brg); ?></td>
                                                                    <td class="text-center"><?php echo $r1->jml; ?></td>
                                                                    <td class="text-right"><?php echo $this->Etc->rps($total1); ?></td>
                                                                    <td class="text-right"><?php echo $this->Etc->rps($modal1); ?>
                                                                    <td class="text-right"><?php echo $this->Etc->rps($sub1 = $total1 - $modal1); ?>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $untung1 += $sub1;
                                                                $t_total1 += $total1;
                                                                $t_modal1 += $modal1;
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td class="thick-line"></td>
                                                                <td class="thick-line text-center" colspan="4"><strong>Total Penjualan</strong></td>                                                
                                                                <td class="thick-line text-right" ><strong><?php echo $this->Etc->rps($t_total1); ?></strong></td>
                                                                <td class="thick-line text-right" ><strong><?php echo $this->Etc->rps($t_modal1); ?></strong></td>
                                                                <td class="thick-line text-right" ><strong><?php echo $this->Etc->rps($untung1); ?></strong></td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="col-md-12 notab">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><strong>Persentasi Penyumbang Omset</strong></h3>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-condensed">
                                                    <thead>
                                                        <tr>
                                                            <?php foreach ($kat as $ka) { ?>
                                                                <td><strong><?php echo $ka->nm_grup; ?></strong></td>
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <?php                                                            
                                                            foreach ($kat as $b) {
                                                                $tot=0;
                                                                $rep = $this->Report_m->kasir_pj_kat($b->id_grup, $start, $end);
                                                                foreach ($rep as $re) {
                                                                    $tot+= ($re->hrg_brg * $re->jml)-$re->diskon;
                                                                }
                                                                    ?>
                                                            <td><?php echo $tot; ?></td>
                                                                    <?php
                                                                
                                                            }
                                                            ?>
                                                        </tr>
                                                        <tr>
                                                            <?php                                                            
                                                            foreach ($kat as $b) {
                                                                $tot=0;
                                                                $rep = $this->Report_m->kasir_pj_kat($b->id_grup, $start, $end);
                                                                foreach ($rep as $re) {
                                                                    $tot+=($re->hrg_brg * $re->jml)-$re->diskon;
                                                                }
                                                                    ?>
                                                                    <td><?php echo number_format(($tot*100/$t_total),0,',','.')." %"; ?></td>
                                                                    <?php
                                                                
                                                            }
                                                            ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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

    .my-float {
        margin-top: 22px;
    }
</style>
