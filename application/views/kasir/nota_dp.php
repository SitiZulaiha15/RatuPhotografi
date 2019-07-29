<?php foreach ($nota as $n) { ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <title>Nota Pembayaran</title>
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
            </style>
        </head>
        <body>        
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="invoice-title">
                            <h2>Ratu Photography</h2>
                            <h4>Jl Lintas Timur KM.35 Muhajirin, Indralaya, Kab. Ogan Ilir SUMSEL</h4>
                            <h4>Telp 0711 581156 SMS/WA 0822 8198 8008</h4>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-xs-6">
                                <address>
                                    <strong>Data Pelanggan:</strong><br>
                                    <?php echo $n->atas_nama; ?><br>
                                    <?php echo $n->no_telp; ?><br>
                                </address>
                            </div>
                            <div class="col-xs-6 text-right">
                                <address>
                                    <strong>Order Date:</strong><br>
                                    <?php echo $this->Etc->tgl($n->tgl_byr); ?><br>
                                    <?php echo $this->Etc->m_byr($n->metode_byr); ?><br>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <address>
                                    <strong><?php echo $n->no_nota; ?></strong><br>
                                    PJ : <?php echo $this->Kasir_m->staf_nm($n->id_pj); ?> <br> 
                                    CS : <?php echo $this->Kasir_m->staf_nm($n->id_cs); ?><br>
                                    Kasir: <?php echo $this->Kasir_m->staf_nm($n->id_kasir); ?>
                                </address>
                            </div>
                            <div class="col-xs-6 text-right">
                                <address>
                                    <strong>Deadline:</strong><br>
                                    <?php echo $this->Etc->tgl($n->deadline); ?><br><?php echo $this->Etc->jam($n->deadline); ?><br><br>
                                </address>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Order summary</strong></h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <td><strong>Item</strong></td>
                                                <td class="text-center"><strong>Price</strong></td>
                                                <td class="text-center"><strong>Quantity</strong></td>
                                                <td class="text-center"><strong>Discount</strong></td>
                                                <td class="text-right"><strong>Totals</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!--foreach ($order->lineItems as $line) or some such thing here--> 
                                            <?php
                                            $total = 0;
                                            $diskon = 0;
                                            $barang= $this->Kasir_m->barang_db($n->id_trans);
                                            foreach ($barang as $b) {
                                                $s = $b->jml * $b->hrg;
                                                // $d = $s*($b->diskon/100);
                                                $d = $b->diskon;
                                                ?>
                                                <tr>
                                                    <td><?php echo $b->nm_brg; ?></td>
                                                    <td class="text-center"><?php echo $this->Etc->rp($b->hrg); ?></td>
                                                    <td class="text-center"><?php echo $b->jml; ?></td>
                                                    <!--<td class="text-center"><?php echo $b->diskon; ?>%-->
                                                    <!-- <p><?php echo $this->Etc->rp($d); ?></p>   -->
                                                    <!--</td>-->
                                                    <td class="text-center"><?php echo $this->Etc->rp($d); ?> </td>
                                                     <td class="text-right"><?php echo $this->Etc->rp($sub = $s-$d); ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $total += $sub;
                                                $diskon += $d;
                                            }
                                            ?>
                                            <tr>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line text-center"><strong>Total</strong></td>                                                
                                                <td class="thick-line text-right" colspan="3"><?php echo $this->Etc->rp($total); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-center"><strong>Diskon</strong></td>
                                                <td class="no-line text-right" colspan="3"><?php echo $this->Etc->rp($diskon); ?></td>
                                            </tr>
                                            <!--<tr>-->
                                            <!--    <td class="no-line"></td>-->
                                            <!--    <td class="no-line text-center"><strong>Total</strong></td>-->
                                            <!--    <td class="no-line text-right" colspan="2"><?php // echo $this->Etc->rp($total = $total - $diskon); ?></td>-->
                                            <!--</tr>-->
                                            <tr>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-center"><strong>Sudah Bayar</strong></td>
                                                <td class="no-line text-right" colspan="3"><?php echo $this->Etc->rp($n->bayar); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-center"><strong>Kekurangan</strong></td>
                                                <td class="no-line text-right" colspan="3"><?php 
                                                $end = $total - $n->bayar;
                                                if($end == 0 ){
                                                    $hasil = "Lunas";
                                                } else {
                                                    $hasil = $this->Etc->rp($end);
                                                }
                                                echo $hasil; ?></td>
                                            </tr>
                                            <tr class="tombol">
                                                <td class="no-line" colspan="3"><a href="<?php echo site_url('Kasir') ?>" class="btn btn-danger">Close</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a class="float" title="cetak halaman" onclick="cetak()"> 
                                        <i class="fa fa-print my-float" ></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <strong>Catatan</strong><br>
                                    1. Transaksi yang sudah diproses tidak dapat dikembalikan atau ditukar
                                    <br>
                                    2. Kami tidak bertanggungjawab atas order barang/jasa yang tidak diproses dan diambil lebih dari 2 bulan sejak tanggal selesai order
                                </address>
                            </div>
                        </div>
                </div>



            </div>
        </body>
    </html>
<?php } ?>
<script>
    function cetak() {
        print();
    }
</script>
<style>
    @media print
    {    
        .float, .float *, .tombol
        {
            display: none !important;
        }
    }
    .float {
        position: fixed;
        width: 160px;
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
