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
<div class="inner-block">
    <div class="blank">
        <?php
        $pjw = null;
        $dl = "";
        foreach ($trans as $row) {
            $pjw = $row->id_pj;
            $dl = $row->deadline;
            ?>
            <div class="col-md-12 compose-right">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <th>Nomor Telepon</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $row->atas_nama; ?></td>
                                <td><?php echo $row->no_telp; ?></td>
                                <td><?php echo $this->Etc->tgl($row->tgl); ?></td>
                                <td><?php echo $st_member = $this->Frontline_m->status_member($row->id_member); ?></td>                                
                                <td>
                                    <?php
                                    $items = $this->Frontline_m->order_db($row->no_nota);
                                    if (!empty($items)) {
                                        foreach ($items as $item) {
                                            ?>
                                            <p><?php echo $item->nm_brg; ?> (<?php echo $item->jml; ?>)</p>
                                            <?php
                                        }
                                    } else {
                                        echo "Layanan Cetak";
                                    }
                                    ?>

                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="col-md-12 compose-right">
                <form name="myForm" onsubmit="return validate()" method="post" action="<?php echo site_url('Frontline/save_order'); ?>" >
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        <div class="alert alert-info">
                                            <span class="glyphicon glyphicon-plus"></span>
                                            Penanggungjawab
                                        </div>
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="input-group date form_datetime col-md-6" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                        <input name="deadline" class="form-control" size="10" type="text" placeholder="Deadline" id="deadline"
                                               <?php if ($pjw <> "") { ?> value="<?php echo $dl; ?>" <?php } ?>>
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-calendar"></i>                                    
                                        </span>
                                    </div>
                                    <select class="form-control form-control-lg" name="pj" id="pj">
                                        <option value="0">Pilih Penanggungjwab</option>
                                        <?php foreach ($pj as $p) { ?>
                                            <option value="<?php echo $p->id_staf; ?>"
                                                    <?php if ($pjw == $p->id_staf) { ?>selected<?php } ?>
                                                    ><?php echo $p->nm_staf; ?></option>
                                                <?php } ?>
                                    </select>  
                                    <input type="hidden" name="nota" value="<?php echo $row->no_nota; ?>">
                                    <input type="hidden" name="id_trans" value="<?php echo $row->id_trans; ?>">
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
                                    <!--<form method="post" action="<?php echo site_url('Frontline/save_order'); ?>">-->
                                    <div class="col-md-8">
                                        <div class="tab">
                                            <!--<button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Kategori</button>-->
                                            <?php foreach ($grup as $f) { ?>
                                                <button type="button" class="tablinks" onclick="openCity(event, 'Brg<?php echo $f->id_grup ?>')"
                                                        <?php if ($f->id_grup == "G_Alat") { ?>id="defaultOpen"<?php } ?>><?php echo $f->nm_grup ?></button>
                                                    <?php } ?>
                                        </div>

                                        <?php
                                        foreach ($grup as $a) {
                                            ?>
                                            <div id="Brg<?php echo $a->id_grup ?>" class="tabcontent" >
                                                <br>
                                                <?php
                                                $kat = $this->Frontline_m->kat_nonpaket($a->id_grup);
                                                foreach ($kat as $k) {
                                                    ?>
                                                    <div class="col-md-12">
                                                        <h4><u><?php echo $k->nm_kat; ?></u></h4>
                                                    </div>
                                                    <div class="col-md-12" >
                                                        <?php
                                                        $barang = $this->Frontline_m->paket_foto($k->id_kat);
                                                        foreach ($barang as $b) {
                                                            ?>
                                                            <div class="col-md-6" >
                                                                    <!--<input type="checkbox" class="checkbox" name="barang[]" value="<?php echo $b->kd_brg ?>">-->
                                                                <div class="checkbox">
                                                                    <label class="checkbox-bootstrap">                                                                      
                                                                        <!--                                                                            <button class="add_cart btn btn-default btn-block" type="button"
                                                                                                                                                            data-produkid="<?php echo $b->kd_brg; ?>" 
                                                                                                                                                            data-produknama="<?php echo $b->nm_brg; ?>" 
                                                                                                                                                            data-produkharga="<?php echo $b->hrg_brg; ?>"><?php echo $b->nm_brg; ?></button>-->
                                                                        <button id="btn-add-to" class="add_cart btn btn-default btn-block" type="button"
                                                                                data-produkid="<?php echo $b->kd_brg; ?>" 
                                                                                data-produknama="<?php echo $b->nm_brg; ?>" 
                                                                                data-produkharga="<?php echo $b->hrg_brg; ?>">
                                                                            <!--onclick="add_book()"
                                                                        data-toggle="modal" data-target="#modal_form"-->
                                                                            <?php echo $b->nm_brg; ?></button>

                                                                    </label>
                                                                </div>
                                                                <!--<input type="text" style="display:none" id="tks-diskon[]" name="diskon[]">-->
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="submit" name="">
                                        </form>
                                        <!--<h4>Shopping Cart</h4>-->
                                        <form method="post" id="columnarForm">
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
                                                    </form>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                    <!--                                        <div class="col-md-1">
                                                                                
                                                                            </div>-->
                                </div>

                            </div>
                        </div>
                        <!--                    <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-plus"></span> What is CSS?</a>
                                                    </h4>
                                                </div>
                                                <div id="collapseThree" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <p>CSS stands for Cascading Style Sheet. CSS allows you to specify various style properties for a given HTML element such as colors, backgrounds, fonts etc. <a href="https://www.tutorialrepublic.com/css-tutorial/" target="_blank">Learn more.</a></p>
                                                    </div>
                                                </div>
                                            </div>-->
                    </div>

            </div>
            <?php
        }
        ?>

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
    });</script>
<script type="text/javascript">
    // $('.form_date').datetimepicker({
    //     language: 'id',
    //     weekStart: 1,
    //     todayBtn: 1,
    //     autoclose: 1,
    //     todayHighlight: 1,
    //     startView: 2,
    //     minView: 2,
    //     forceParse: 0
    // });
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "top-right"
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
    function validate()
    {
        if (document.myForm.deadline.value === "")
        {
            alert("Deadline harus diisi!");
            document.myForm.deadline.focus();
            return false;
        }
        if (document.myForm.pj.value === "0")
        {
            alert("Penanggungjawab belum dipilih!");
            return false;
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
//    function validateQty(q) {
//        var sub = q * $('#getHrg').val();
//        $('#getSub').val(sub);
//    }
//    function validateDisc(d) {
//        var disc = (d / 100) * $('#getSub').val();
//        $('#getDiscRp').val(disc);
//    }
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
