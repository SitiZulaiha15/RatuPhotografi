<?php
echo $this->session->userdata('cetak');
$this->load->view('./header');

?>
<div class="inner-block">
    <div class="blank">
        <div class="prices-head">
            <h2>Layanan</h2>
        </div>
        <div class="price-tables">
            <div class="col-md-4 price-grid">
                <div class="price-block">
                    <div class="price-gd-top pric-clr1">
                        <h4>Foto</h4>
                        <!--<h3><span class="usa-dollar">$</span> 5<span class="per-month">/mon</span></h3>-->
                        <h5><span class="fa fa-camera"></h5>
                    </div>
                    <div class="price-selet pric-clr1">		    			   
                        <a href="<?php echo site_url('Frontline/foto'); ?>">Pilih Layanan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 price-grid">
                <div class="price-block">
                    <div class="price-gd-top pric-clr2">
                        <h4>Cetak</h4>
                        <h3><span class="usa-dollar">$</span> 10<span class="per-month">/mon</span></h3>
                        <h5>Free for 2 months</h5>
                    </div>
                    <div class="price-selet pric-clr2">
                        <a class="popup-with-zoom-anim" href="#small-dialog">Pilih Layanan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 price-grid">
                <div class="price-block">
                    <div class="price-gd-top pric-clr3">
                        <h4>Pengambilan</h4>
                        <h3><span class="usa-dollar">$</span> 12<span class="per-month">/mon</span></h3>
                        <h5>Free for 9 months</h5>
                    </div>
                    <div class="price-selet pric-clr3">
                        <a href="<?php echo site_url('Frontline/ambil'); ?>">Pilih Layanan</a>
                    </div>
                </div>
            </div>

            <div class="clearfix"> </div>
        </div>
    </div>
</div>
</div><link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/assets/css/magnific-popup.css">
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
                <form onsubmit="setTimeout(function () { window.location.assign('<?php echo site_url('Frontline/ready_cetak')?>'); }, 1)" 
                      target="_blank" method='post' action="<?php echo site_url('Frontline/antri_cetak') ?>">
                    <h4><span class="shoppong-pay-1"> </span>Shipping Details</h4>
                    <ul>
                        <li><input class="text-box-dark" type="text" value="P<?php echo $this->Frontline_m->antrian('P'); ?>" readonly></li>
                        <li><input class="text-box-dark" type="text" value="<?php echo $this->Frontline_m->id_trans(); ?>" readonly name="id"></li>
                        <li><input class="text-box-dark" type="text" value="Atas Nama" name="an" onfocus="this.value = '';" onblur="if (this.value == '') {
                                    this.value = 'Atas Nama';
                                }" ></li>
                    </ul>
                    <div class="clear"></div>                    
                    <ul class="payment-sendbtns">
                        <li><input onclick="defaults()" class="btn btn-danger" type="button" value="Reset"></li>
                        <li><input class="btn btn-primary" type="submit" value="Process order" onclick='javascript: return SubmitForm()'></li>
                        <!--<li><a href="#" class="order">Process order</a></li>-->
                    </ul>
                    <div class="clear"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>
