<?php $this->load->view('./header'); ?>
<style>
    * {box-sizing: border-box}
    body {font-family: "Lato", sans-serif;}

    /* Style the tab */
    .tab {
        float: left;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
        width: 20%;
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
        width: 80%;
        /*border-left: none;*/
        height: 450px;
        overflow-y: scroll;
    }
    input[type=number] { 
        width: 90px;
    }
</style>
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
        <div class="col-md-12 compose-right">
            <form name="myForm"  onsubmit="return validate();" target="_blank" method="post" action="<?php echo site_url('Frontline/antri_foto') ?>">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    <div class="alert alert-info">
                                        <span class="glyphicon glyphicon-plus"></span>
                                        Fotografer
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                                <input name="no" name="no" type="hidden" value="F<?php echo $this->Frontline_m->antrian('F'); ?>">
                                <div class="checkbox">
                                    <label for="primary" class="btn btn-primary">Member 
                                        <input onclick="myFunction()" type="checkbox" id="primary" class="badgebox" name="member">
                                        <span class="badge">&check;</span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <input class="form-control"  name="id_member" autofocus="" type="text" placeholder="ID Member" id="idMember" style="display:none">
                                    <span id="finalResult"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control"  id="an" name="an" type="text" placeholder="Atas Nama">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="notelp" name="no_telp" type="text" placeholder="Nomor Telepon">
                                </div>
                                <select id="photographer" class="form-control form-control-lg" name="id_foto">
                                    <option value="0">Pilih Fotografer</option>
                                    <?php foreach ($fotografer as $f) { ?>
                                        <option value="<?php echo $f->id_staf; ?>"><?php echo $f->nm_staf; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" id="klikin">
                                    <div class="alert alert-info">
                                        <span class="glyphicon glyphicon-plus"></span>
                                        Daftar Barang
                                    </div>
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <div class="col-md-8">
                                    <div class="tab">
                                        <?php foreach ($foto as $f) { ?>
                                            <button type="button" class="tablinks" onclick="openCity(event, 'Foto<?php echo $f->id_kat ?>')" <?php if ($f->id_kat == "G_Paket_0001") { ?>id="defaultOpen"<?php } ?>><?php echo $f->nm_kat ?></button>
                                        <?php } ?>
                                    </div>

                                    <?php
                                    foreach ($foto as $a) {
                                        ?>
                                        <div id="Foto<?php echo $a->id_kat ?>" class="tabcontent" >
                                            <br>
                                            <div class="col-md-12" >
                                                <?php
                                                $barang = $this->Frontline_m->paket_foto($a->id_kat);
                                                foreach ($barang as $b) {
                                                    ?>
                                                    <div class="col-md-6" >                                                                
                                                        <div class="checkbox">
                                                            <label class="checkbox-bootstrap">                                                                      
                                                                <button id="btn-add-to" class="add_cart btn btn-default btn-block" type="button"
                                                                        data-produkid="<?php echo $b->kd_brg; ?>" 
                                                                        data-produknama="<?php echo $b->nm_brg; ?>" 
                                                                        data-produkharga="<?php echo $b->hrg_brg; ?>">
                                                                    <?php echo $b->nm_brg; ?></button>

                                                            </label>
                                                        </div>

                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="col-md-4">
                                    <input type="submit" name="">
                                    <!--</form>-->
                                    <!--<h4>Shopping Cart</h4>-->
                                    <!--<form method="post" id="columnarForm">-->
                                    <div class="table-responsive" >

                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Produk</th>
                                                    <th>Qty</th>
                                                    <th>%(Rp)</th>
                                                    <th>Sub</th>
                                                    <th></th>
                                                </tr>
                                            </thead>

                                            <tbody id="detail_cart">

                                            </tbody>
                                            <!--</form>-->
                                        </table>
                                    </div>
                                    <!--</form>-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class='col-sm-12' style="height: 1000px"></div>
        <div class="clearfix"> </div> 
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>
<script>
    $(document).ready(function () {
        $(".collapse.in").each(function () {
            $(this).siblings(".panel-heading").find(".glyphicon").addClass("glyphicon-minus").removeClass("glyphicon-plus");
        });
        $(".collapse").on('show.bs.collapse', function () {
            $(this).parent().find(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");
        }).on('hide.bs.collapse', function () {
            $(this).parent().find(".glyphicon").removeClass("glyphicon-minus").addClass("glyphicon-plus");
        });
        $('#accordion').on('shown.bs.collapse', function () {
            //https://www.bootply.com/101026#
            var panel = $(this).find('.in');
            $('html, body').animate({
                scrollTop: panel.offset().top - 180
            }, 1000);

            // IGO, SIGIT ADD THIS TOO
            getPaddingToOffset(panel.offset().top - 180);
        });

        // END OF IGO, SIGIT ADD THIS TOO

        // SIGIT ADD THIS TOO
        function getPaddingToOffset(position) {
            var http = new XMLHttpRequest();
            var url = "<?php echo site_url('Frontline_cart/get_padding_session') ?>";
            var params = "penanda=" + position;
            http.open("POST", url, true);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            http.onreadystatechange = function () {//Call a function when the state changes.
                if (http.readyState == 4 && http.status == 200) {
                    console.log('berhasil : ', http.responseText)
                }
            }
            http.send(params);
            console.log(url);
            console.log(params);
        }

        // END OF SIGIT ADD THIS TOO


        $('.add_cart').click(function () {
            var produk_id = $(this).data("produkid");
            var produk_nama = $(this).data("produknama");
            var produk_harga = $(this).data("produkharga");
            var quantity = $('#' + produk_id).val();
            $.ajax({
                url: "<?php echo site_url(); ?>Frontline_cart/add_to_cart",
                method: "POST",
                data: {produk_id: produk_id, produk_nama: produk_nama, produk_harga: produk_harga, quantity: quantity},
                success: function (data) {
                    $('#detail_cart').html(data);
//                    $('#modal_form').modal('show');
                }
            });
        });
        // Load shopping cart
        $('#detail_cart').load("<?php echo base_url(); ?>index.php/Frontline_cart/load_cart");
        //Hapus Item Cart
        $(document).on('click', '.hapus_cart', function () {
            var row_id = $(this).attr("id"); //mengambil row_id dari artibut id
            $.ajax({
                url: "<?php echo site_url(); ?>Frontline_cart/hapus_cart",
                method: "POST",
                data: {row_id: row_id},
                success: function (data) {
                    $('#detail_cart').html(data);


                }
            });
        });
        $(document).on('click', '.update_cart', function () {
//            var row_id = $("#rowid").val();
//            var qty = $("#qtys").val();
//            var diskon = $("#diskon").val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url() ?>Frontline_cart/update_cart/",
//                data: {"rowid": row_id,"qtys":qty,"diskon":diskon},
                data: $("#columnarForm").serialize(),
//                dataType: "json",
                success: function (data) {
                    $('#detail_cart').html(data);
//                    alert(data);
                },
                error: function (data) {
                    alert("inside error");
                }
            });
        });
    });
</script>
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
<script type="text/javascript">
    // Form validation code will come here.
    function validate() {
        if (document.myForm.an.value === "") {
            alert("Atas Nama harus diisi!");
            document.myForm.an.focus();
            return false;
        } else
        if (document.myForm.no_telp.value === "") {
            alert("Nomor Telepon harus diisi!");
            document.myForm.no_telp.focus();
            return false;
        } else
        if (document.myForm.id_foto.value === "0") {
            alert("Fotografer belum dipilih!");
            return false;
        }
        else {
            setTimeout(function () {
                window.location.assign('<?php echo site_url('Frontline') ?>');
            }, 1);
        }
    }
</script>
<script type="text/javascript">
//    $(document).ready(function () {
//        $('#table_id').DataTable();
//    });
    var save_method; //for save method string
    var table;
    function add_book()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show'); // show bootstrap modal
        //$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
        var produk_id = $('#btn-add-to').data("produkid");
        var produk_nama = $('#btn-add-to').data("produknama");
        var produk_harga = $('#btn-add-to').data("produkharga");
        document.getElementById('getNama').value = produk_nama;
        document.getElementById('getId').value = produk_id;
        document.getElementById('getHrg').value = produk_harga;
    }
    function getId(a, b, c, d, e) {
        document.getElementById('getRowId').value = $(a).val();
        document.getElementById('getQty').value = $(b).val();
        document.getElementById('getDiscRp').value = $(c).val();
        document.getElementById('getKet').value = $(d).val();
        document.getElementById('getHrg').value = $(e).val();
        document.getElementById('getSub').value = $(e).val() * $(b).val();
        console.log(a);
    }

    function edit_book()
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('#modal_form').modal('show');
    }
    function save()
    {
        var url;
        if (save_method == 'add')
        {
            url = "<?php echo site_url('Frontline_cart/add_to_cart') ?>";
        }
        else
        {
            url = "<?php echo site_url('Frontline_cart/update') ?>";
        }
        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            // dataType: "JSON",
            success: function (data)
            {
                //if success close modal and reload ajax table
                $('#modal_form').modal('hide');
                $('#detail_cart').html(data);
                // location.reload();// for reload a page

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    }

</script>

<!--SIGIT ADD THIS-->
<script>
    var cart = document.location.href;
    var n = cart.includes("#updateCart");
    var paddingTop = '<?php echo $this->session->userdata('padding'); ?>';
    if (n) {
        console.log(cart);
        $('#klikin').trigger('click');
        $(document).ready(function () {
            $('body,html').animate({scrollTop: paddingTop}, 1000);
        });
    } else {

    }

</script>
<!--END OF SIGIT ADD-->
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Item Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="rowid" id="getRowId"/>
                    <input type="hidden" value="" name="produk_nama" id="getNama"/>
                    <input type="hidden" value="" name="produk_id" id="getId"/>
                    <input type="hidden" value="" name="produk_harga" id="getHrg"/>
                    <input type="hidden" value="" name="produk_sub" id="getSub"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Qty</label>
                            <div class="col-md-9">
                                <input onchange="validateQty(this.value)" class="form-control" type="number" step="0.1" data-decimals="2" value="1.0" min="1" name="qty" id="getQty" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Diskon</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input onchange="validateDisc(this.value)" class="form-control" type="number" name="diskon" id="getDisc" step="5" value="0" min="0"/>
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Diskon</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input class="form-control" type="number" name="diskonRp" id="getDiscRp" step="5" value="0" min="0"/>
                                    <span class="input-group-addon">Rp</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Keterangan Khusus</label>
                            <div class="col-md-9">
                                <textarea id="getKet" name="ket" placeholder="Keterangan Khusus" class="form-control"></textarea>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href='#updateCart' id="btnSave" onclick="save()" class="btn btn-primary">Save</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script>
    function validAngka(a)
    {
        if (!/^[0-9.]+$/.test(a.value))
        {
            a.value = a.value.substring(0, a.value.length - 1000);
        }
    }
    function validateQty(q) {
        var t = (q * $('#getHrg').val());
        var diskon = ($('#getDisc').val() / 100) * t;
        var sub = t - diskon;
        $('#getSub').val(sub);
        $('#getDiscRp').val(diskon);
    }
    function validateDisc(d) {
        var disc = (d / 100) * ($('#getQty').val() * $('#getHrg').val());
        $('#getDiscRp').val(disc);
    }
</script>
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

