
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <title>Nomor Antrian</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <link href="<?php echo base_url() ?>/assets/css/font-awesome.css" rel="stylesheet"> 
            <style type="text/css">
                h1, th, h2{
                    text-align: center;
                }
            </style>
        </head>
        <body>    
            <?php foreach ($antri as $t) { ?>
            <div class="container">
                <h2>RATU PHOTOGRAPHY</h2>
                <center><small><?php echo $this->Etc->tgl($t->tgl); ?></small></center>
                <table class="table table-bordered" align="center">
                    <thead>
                        <tr>
                            <td align="right">Nomor Nota: <?php echo $t->no_nota; ?></td>
                        </tr>
                        <tr>
                            <th>Nomor Antrian</th>
                        </tr>
                        <tr>
                            <th><h1><?php echo $t->no ?></h1></th>
                        </tr>
                        <tr>
                            <td align="center">Atas Nama<br><?php echo $t->atas_nama; ?></td>
                        </tr>
                        <tr>
                            <td>
                                <?php
                                if (!empty($item)) {
                                    foreach ($item as $i) {
                                        ?>
                                <p><strong>Paket: </strong><?php echo $i->nm_brg; ?> <?php echo $i->ket; ?></p>
                                    <?php }
                                } ?>
                        </tr>

                <!--                    <tr>
                    <th><a href="#"><div onclick="open(location, '_self').close();">Close Tab Browser</div></a></th>
                </tr>-->
                    </thead>                
                </table>
                <a class="float" title="cetak halaman" onclick="cetak()"> 
                    <i class="fa fa-print my-float" ></i>
                </a>
            </div>
            <?php } ?>
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
