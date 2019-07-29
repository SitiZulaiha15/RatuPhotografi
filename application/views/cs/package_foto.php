<?php

function buatrp($angka) {
    $jadi = "Rp. " . number_format($angka, 0, ',', '.');
    return $jadi;
}
?>
<?php $this->load->view('header'); ?>
<script lang="text/javascript">
    function getIdProduk(x) {
        document.getElementById('id_barang').value = document.getElementById(x).innerHTML;
    }
    function getHarga(x) {
        document.getElementById('hrg_barang').value = document.getElementById(x).innerHTML;
    }
    function defaults() {
        document.getElementById('atas_nama').value = "";
        document.getElementById('atas_nama').placeholder = "Atas Nama";
        document.getElementById('photographer').value = 0;
    }
</script>
<div class="inner-block">
    <div class="blank">
        <div class="pro-head">
            <h2>Products</h2>
        </div>
        <?php foreach ($package as $r) { ?>
            <div class="col-md-3 product-grid">
                <div class="product-items">
                    <!--                    <div class="project-eff">
                                            <div id="nivo-lightbox-demo"> <p> <a href="<?php echo base_url() ?>/assets/images/pro1.jpg" data-lightbox-gallery="gallery1" id="nivo-lightbox-demo"><span class="rollover1"> </span> </a></p></div>     
                                            <img class="img-responsive" src="<?php echo base_url() ?>/assets/images/pro1.jpg" alt="">
                                        </div>-->
                    <div class="produ-cost">
                        <div id="nivo-lightbox-demo"> <p> <a href="images/pro1.jpg"data-lightbox-gallery="gallery1" id="nivo-lightbox-demo"><span class="rollover1"> </span> </a></p></div>     
                        <h4><?php echo $r->nm_brg; ?></h4>
                        <!--<h5><?php echo buatrp($r->hrg_brg); ?></h5>-->
                    </div>
                    <div class="price-selet pric-clr1">
                        <span hidden="hidden"  id='<?php echo $r->kd_brg; ?>' onclick="getIdProduk('<?php echo $r->kd_brg; ?>')"><?php echo $r->kd_brg; ?></span>
                        <span hidden="hidden" id='<?php echo $r->hrg_brg; ?>' onclick="getIdProduk('<?php echo $r->hrg_brg; ?>')"><?php echo $r->hrg_brg; ?></span>
                        <a class="popup-with-zoom-anim" href="#small-dialog" onclick="getIdProduk('<?php echo $r->kd_brg; ?>');
                                getHarga('<?php echo $r->hrg_brg; ?>')">Select Plan</a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="clearfix"> </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/magnific-popup.css">
<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/nivo-lightbox.min.js"></script>
<script type="text/javascript">
                        $(document).ready(function () {
                            $('#nivo-lightbox-demo a').nivoLightbox({effect: 'fade'});
                        });
</script>
<div id="popup">
    <div id="small-dialog" class="mfp-hide">
        <div class="pop_up">
            <div class="payment-online-form-left">
                <form target="_blank" onsubmit="setTimeout(function () {
                            window.location.assign('<?php echo site_url('Frontline') ?>');
                        }, 1)" method="post" action="<?php echo site_url('Frontline/antri_foto') ?>">
                    <h4><span class="shoppong-pay-1"> </span>Shipping Details</h4>
                    <ul>
                        <li><input class="text-box-dark" type="text" value="<?php echo $this->Frontline_m->id_trans(); ?>" readonly></li>
                        <li><input class="text-box-dark" name="id_paket" type="hidden" id='id_barang' readonly /></li>
                        <li><input class="text-box-dark" name="hrg_paket" type="hidden" id='hrg_barang' readonly /></li>
                        <li><input class="text-box-dark" id="atas_nama" name="an" type="text" value="Atas Nama" onfocus="this.value = '';" onblur="if (this.value == '') {
                                    this.value = 'Atas Nama';
                                }"></li>
                    </ul>
                    <ul>
                        <li>
                            <select id="photographer" class="form-control form-control-lg" name="id_foto">
                                <option value="0">Pilih Fotografer</option>
                                <?php foreach ($fotografer as $f) { ?>
                                    <option value="<?php echo $f->id_staf; ?>"><?php echo $f->nm_staf; ?></option>
                                <?php } ?>
                            </select>
                        </li>
                    </ul>
                    <div class="clear"></div>                    
                    <ul class="payment-sendbtns">
                        <!--<li><input onclick="hapus()" class="btn btn-primary" type="button" value="Reset"></li>-->
                        <li><input onclick="defaults()" class="btn btn-danger" type="button" value="Reset"></li>
                        <li><input type="submit" class="order" value="Process order"></li>
                        <!--<li><a href="#" class="order">Process order</a></li>-->
                    </ul>
                    <div class="clear"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('sidebar'); ?>