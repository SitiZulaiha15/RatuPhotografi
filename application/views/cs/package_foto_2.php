<?php $this->load->view('header'); ?>
<div class="inner-block">
    <div class="blank">
        <div class="pro-head">
            <h2>Products</h2>
        </div>
        <?php foreach ($package as $r) { ?>
            <div class="col-md-3 product-grid">
                <div class="product-items">
                    <div class="project-eff">
                        <div id="nivo-lightbox-demo"> <p> <a href="<?php echo base_url() ?>/assets/images/pro1.jpg" data-lightbox-gallery="gallery1" id="nivo-lightbox-demo"><span class="rollover1"> </span> </a></p></div>     
                        <img class="img-responsive" src="<?php echo base_url() ?>/assets/images/pro1.jpg" alt="">
                    </div>
                    <div class="produ-cost">
                        <div id="nivo-lightbox-demo"> <p> <a href="images/pro1.jpg"data-lightbox-gallery="gallery1" id="nivo-lightbox-demo"><span class="rollover1"> </span> </a></p></div>     
                        <h4><?php echo $r->nm_brg; ?></h4>
                        <h5><?php echo $r->hrg_brg; ?></h5>
                    </div>
                    <div class="price-selet pric-clr1">
                        <a class="popup-with-zoom-anim" href="#small-dialog">Select Plan</a>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class='col-sm-12' style="height: 1000px"></div>
        <div class="clearfix"> </div>
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
                <form method="post" action="<?php echo site_url('Frontline/antri_foto')?>">
                    <h4><span class="shoppong-pay-1"> </span>Shipping Details</h4>
                    <ul>
                        <li><input class="text-box-dark" type="text" value="<?php echo $this->Frontline_m->id_trans();?>" readonly name="id"></li>
                        <li><input class="text-box-dark" type="text" value="Atas Nama" name="an" onfocus="this.value = '';" onblur="if (this.value == '') {
                                    this.value = 'Atas Nama';
                                }"></li>
                    </ul>
                    <ul>
                        <li>
                            <select class="form-control form-control-lg" name="id_foto">
                                <option value="0">Pilih Fotografer</option>
                                <?php foreach ($fotografer as $f){ ?>
                                <option value="<?php echo $f->id_staf; ?>"><?php echo $f->nm_staf; ?></option>
                                <?php } ?>
                            </select>
                        </li>
                    </ul>
                    <div class="clear"></div>                    
                    <ul class="payment-sendbtns">
                        <li><input type="reset" value="Reset"></li>
                        <li><input type="submit" value="Process order"></li>
                        <!--<li><a href="#" class="order">Process order</a></li>-->
                    </ul>
                    <div class="clear"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('sidebar'); ?>