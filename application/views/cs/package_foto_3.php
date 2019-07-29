<?php

function buatrp($angka) {
    $jadi = "Rp. " . number_format($angka, 0, ',', '.');
    return $jadi;
}
?>
<?php $this->load->view('header'); ?>
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
<style>
    * {box-sizing: border-box}
    body {font-family: "Lato", sans-serif;}

    /* Style the tab */
    .tab {
        float: left;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
        width: 10%;
        /*height: 300px;*/
    }

    /* Style the buttons inside the tab */
    .tab button {
        display: block;
        background-color: inherit;
        color: black;
        padding: 11px 8px;
        width: 100%;
        border: none;
        outline: none;
        text-align: left;
        cursor: pointer;
        transition: 0.3s;
        font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
        background-color: #ddd;
    }

    /* Create an active/current "tab button" class */
    .tab button.active {
        background-color: #0091d6;
    }

    /* Style the tab content */
    .tabcontent {
        float: left;
        padding: 0px 12px;
        border: 1px solid #ccc;
        width: 90%;
        border-left: none;
        /*height: 300px;*/
    }
</style>
<div class="inner-block">
    <div class="blank">
        <div class="tab">
            <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Kategori</button>
            <?php foreach ($foto as $f) { ?>
                <button class="tablinks" onclick="openCity(event, 'Foto<?php echo $f->id_kat ?>')"><?php echo $f->nm_kat ?></button>
            <?php } ?>
        </div>
        <div id="London" class="tabcontent">
            <br>
            <h3>Paket Foto</h3>
            <p>London is the capital city of England.</p> 
        </div>
        <?php
        foreach ($foto as $a) {
            ?>
            <div id="Foto<?php echo $a->id_kat ?>" class="tabcontent">
                <!--<h3><?php echo $a->nm_kat ?></h3>-->
                <br>
                <?php
                $barang = $this->Frontline_m->paket_foto($a->id_kat);
                foreach ($barang as $r) {
                    ?>
                    <div class="col-md-4 product-grid">
                        <div class="product-items">
                            <!--                    <div class="project-eff">
                                                    <div id="nivo-lightbox-demo"> <p> <a href="<?php echo base_url() ?>/assets/images/pro1.jpg" data-lightbox-gallery="gallery1" id="nivo-lightbox-demo"><span class="rollover1"> </span> </a></p></div>     
                                                    <img class="img-responsive" src="<?php echo base_url() ?>/assets/images/pro1.jpg" alt="">
                                                </div>-->
                            <div class="produ-cost">
                                <div id="nivo-lightbox-demo"> <p> <a href="images/pro1.jpg"data-lightbox-gallery="gallery1" id="nivo-lightbox-demo"><span class="rollover1"> </span> </a></p></div>     
                                <h4><?php echo $r->nm_brg; ?></h4>
                                <h5><?php echo buatrp($r->hrg_brg); ?></h5>
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
            </div>
        <?php } ?>

        <!--        <div id="Paris" class="tabcontent">
                    <h3>Paris</h3>
                    <p>Paris is the capital of France.</p> 
                </div>
        
                <div id="Tokyo" class="tabcontent">
                    <h3>Tokyo</h3>
                    <p>Tokyo is the capital of Japan.</p>
                </div>-->

        <script>
            function openCity(evt, cityName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>
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
                        <li>
                            <div class="checkbox">
                                <label for="primary" class="btn btn-primary">Member <input onclick="myFunction()" type="checkbox" id="primary" class="badgebox" name="member"><span class="badge">&check;</span></label>
                            </div>
                        </li>
                    </ul>
                    <div class="clear"></div>
                    <ul>
                        <li>
                            <input name="id_member" autofocus="" class="text-box-dark" 
                                   type="text" placeholder="ID Member" id="idMember" style="display:none">
                            <ul id="finalResult"></ul>
                        </li>
                    </ul>
                    <div class="clear"></div>
                    <ul>
                        <li><input class="text-box-dark" id="an" name="an" type="text" placeholder="Atas Nama" required=""></li>
                        <li><input id="notelp" name="no_telp" class="text-box-dark"type="text" placeholder="Nomor Telepon" required="""></li>
                        <li><input name="no" class="text-box-dark" name = "no" type="hidden" value="F<?php echo $this->Frontline_m->antrian('F'); ?>" readonly></li>
                        <li><input class="text-box-dark" name="id_paket" type="hidden" id='id_barang' readonly /></li>
                        <li><input class="text-box-dark" name="hrg_paket" type="hidden" id='hrg_barang' readonly /></li>
                        <li><input class="text-box-dark" type="hidden" value="<?php echo $this->Frontline_m->id_trans(); ?>" readonly></li>
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
                        <li><input type="submit" class="btn btn-primary" value="Process order"></li>
                        <!--<li><a href="#" class="order">Process order</a></li>-->
                    </ul>
                    <div class="clear"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('sidebar'); ?>
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
