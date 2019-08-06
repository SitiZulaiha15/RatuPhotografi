<?php
//echo $this->session->userdata('cetak');
$this->load->view('./header');
?>
<style type="text/css">
    .badgebox
    {
        opacity: 0;
    }

    .badgebox + .badge
    {
        /* Move the check mark away when unchecked */
        text-indent: -999999px;
        /* Makes the badge's width stay the same checked and unchecked */
        width: 27px;
    }

    .badgebox:focus + .badge
    {
        /* Set something to make the badge looks focused */
        /* This really depends on the application, in my case it was: */

        /* Adding a light border */
        box-shadow: inset 0px 0px 5px;
        /* Taking the difference out of the padding */
    }

    .badgebox:checked + .badge
    {
        /* Move the check mark back when checked */
        text-indent: 0;
    }
</style>
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
                        <!--<h3><span class="fa fa-camera">$</span> 5<span class="per-month">/mon</span></h3>-->
                        <!--<h5><span class="fa fa-camera"></span></h5>-->
                        <br />
                        <br />
                        <img src="<?php echo base_url() ?>/assets/images/camera_.png"/>
                        <br />
                        <br />
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
                        <br />
                        <br />
                        <img src="<?php echo base_url() ?>/assets/images/print_.png"/>
                        <br />
                        <br />
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
                        <br />
                        <br />
                        <img src="<?php echo base_url() ?>/assets/images/barcode_.png"/>
                        <br />
                        <br />
                    </div>
                    <div class="price-selet pric-clr3">
                        <a href="<?php echo site_url('Frontline/ambil'); ?>">Pilih Layanan</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 price-grid">
                <div class="price-block">
                    <div class="price-gd-top pric-clr1">
                        <h4>Booking</h4>
                        <!--<h3><span class="fa fa-camera">$</span> 5<span class="per-month">/mon</span></h3>-->
                        <!--<h5><span class="fa fa-camera"></span></h5>-->
                        <br />
                        <br />
                        <img src="<?php echo base_url() ?>/assets/images/next.png"/>
                        <br />
                        <br />
                    </div>
                    <div class="price-selet pric-clr1">		    			   
                        <a href="<?php echo site_url('Book'); ?>">Pilih Layanan</a>
                    </div>
                </div>
            </div>

            <div class='col-sm-12' style="height: 1000px"></div>
        <div class="clearfix"> </div>
        </div>
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
                <form onsubmit="setTimeout(function () {
                            window.location.assign('<?php echo site_url('Frontline/ready_cetak') ?>');
                        }, 1)" 
                      target="_blank" method='post' action="<?php echo site_url('Frontline/antri_cetak') ?>">
                    <h4><span class="shoppong-pay-1"> </span>Shipping Details</h4>
                    <ul>
                        <li>                            
                            <!--<input class="text-box-dark" type="text" placeholder="ID Member" id="text" style="display:none">-->
<!--                            <label class="checkbox-inline"><input type="checkbox" id="myCheck" onclick="myFunction()">Option 1</label>-->
                            <div class="checkbox">
                                <label for="primary" class="btn btn-primary">Member <input onclick="myFunction()" type="checkbox" id="primary" class="badgebox" name="member"><span class="badge">&check;</span></label>
                                <!--                                <label>
                                                                    
                                                                    <input class="text-box-dark" type="checkbox" id="myCheck" onclick="myFunction()">Member
                                                                </label>-->
                            </div>
                        </li>
                    </ul>
                    <div class="clear"></div>
                    <ul>
                        <li>
                            <!--<input class="text-box-dark" type="checkbox" id="myCheck"  onclick="myFunction()">Member-->
                            <input name="id_member" autofocus="" class="text-box-dark" 
                                   type="text" placeholder="ID Member" id="idMember" style="display:none">
                            <ul id="finalResult"></ul>
                        </li>
                    </ul>
                    <div class="clear"></div>
                    <ul>                        

                        <li><input id="an" class="text-box-dark" type="text" placeholder="Atas Nama" name="an" required=""></li>
                        <li><input id="notelp" class="text-box-dark" type="text" placeholder="Nomor Telepon" name="no_telp" required=""></li>
                        <li><input name="no" class="text-box-dark" type="hidden" value="P<?php echo $this->Frontline_m->antrian('P'); ?>" readonly></li>
                        <li><input class="text-box-dark" type="hidden" value="<?php echo $this->Frontline_m->id_trans(); ?>" readonly name="id"></li>

                    </ul>
                    <div class="clear"></div>                    
                    <ul class="payment-sendbtns">
                        <li><input onclick="defaults()" class="btn btn-danger" type="button" value="Reset"></li>
                        <li><input class="btn btn-primary" type="submit" value="Process order" onclick='javascript: return SubmitForm()'></li>
                    </ul>
                    <div class="clear"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>
<script>
    function myFunction() {
        var checkBox = document.getElementById("primary");
        var text = document.getElementById("idMember");
        if (checkBox.checked === true) {
            text.style.display = "block";
            $('#notelp').val("");
            $('#idMember').val("");
            $('#an').val("");
        } else {
            text.style.display = "none";
            $('#notelp').val("");
            $('#idMember').val("");
            $('#an').val("");
        }
    }
</script>
<script>
    $(document).ready(function () {
        $("#idMember").keyup(function () {
            search();
            return false;
        });
        $("#idMember").change(function () {
            search();
            return false;
        });
    });
    function search() {
        if ($("#idMember").val().length > 0) {
            var id = $("#idMember").val();
            $.ajax({
                type: "post",
                url: "<?php echo site_url('Frontline/get_member') ?>/" + id,
                cache: false,
                data: 'search=' + $("#idMember").val(),
                success: function (response) {
//                        $('#finalResult').html(response);
                    $('#finalResult').html("");
                    var obj = JSON.parse(response);
                    if (obj.length > 0) {
                        try {
                            var items = [];
                            $.each(obj, function (i, val) {
//                                    items.push($('<li/>').text(val.nm_member + " " + val.no_telp));
                                $('#an').val(val.nm_member);
                                $('#notelp').val(val.no_telp);
                                $('#idMember').val(val.id_member);
                            });
//                                $('#finalResult').append.apply($('#finalResult'), items);

                        } catch (e) {
                            alert('Exception while request..');
                        }
                    } else {
                        $('#finalResult').html($('<li/>').text("No Data Found"));
                    }
//                        $("#an").val(response);

                },
                error: function () {
                    alert('Error while request..');
                }
            });
        }
    }
</script>
