<?php $this->load->view('./header'); ?>
<script src="<?php echo base_url('assets/maskMoney/jquery.maskMoney.min.js') ?>"></script>
<div class="inner-block">
    <div class="blank">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" id="form_transaksi" role="form" onkeydown="myFunction()">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label col-md-3" 
                                       for="id_barang">Id Barang :</label>
                                <div class="col-md-5">
                                    <input list="list_barang" class="form-control reset" 
                                           placeholder="Isi id..." name="id_barang" id="id_barang" 
                                           autocomplete="off" onchange="showBarang(this.value)">
                                    <datalist id="list_barang">
                                        <?php foreach ($barang as $barang): ?>
                                            <option value="<?php echo $barang->id_bb ?>"><?php echo $barang->nm_bb ?></option>
                                        <?php endforeach ?>
                                    </datalist>
                                </div>
                                <div class="col-md-1">
                                    <a href="javascript:;" class="btn btn-primary" 
                                       data-toggle="modal" 
                                       data-target="#modal-cari-barang">
                                        <i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div id="barang">
                                <div class="form-group">
                                    <label class="control-label col-md-3" 
                                           for="nama_barang">Nama Barang :</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control reset" 
                                               name="nama_barang" id="nama_barang" 
                                               readonly="readonly">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3" 
                                           for="qty">Jumlah Beli :</label>
                                    <div class="col-md-4">
                                        <input type="number" class="form-control reset" 
                                               autocomplete="off" onkeypress="addbarang()" id="qty" min="0" 
                                               name="qty" placeholder="Isi qty...">
                                    </div>
                                </div>
                            </div><!-- end id barang -->
                            <div class="form-group">
                                <label class="control-label col-md-3" 
                                       for="harga_barang">Harga (Rp) :</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control reset uang" 
                                           name="harga_barang" id="harga_barang">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-3">
                                    <button type="button" class="btn btn-primary" 
                                            id="tambah" onclick="addbarang()">
                                        <i class="fa fa-cart-plus"></i> Tambah</button>
                                </div>
                            </div>
                        </div><!-- end col-md-8 -->
                    </form>
                    <div class="col-md-12">
                        <table id="table_transaksi" class="table table-striped 
                               table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Quantity</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!--<div class="col-md-2">-->
                    <div class="col-md-offset-8" style="margin-top:20px">
                        <button type="button" class="btn btn-primary btn-lg" 
                                id="selesai" onclick="selesai()">
                            Selesai <i class="fa fa-angle-double-right"></i></button>
                        <p id="alter_f12">Atau Tekan F12 Untuk Selesai</p>
                    </div>
                    <!--</div>-->
                </div>
            </div>
        </div><!-- end col-md-9 --> 
        <div class='col-sm-12' style="height: 500px"></div>
        <div class='col-sm-12' style="height: 1000px"></div>
        <div class="clearfix"> </div> 
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>
<script type="text/javascript">
    function showBarang(str)
    {
        if (str == "") {
            $('#nama_barang').val('');
            $('#harga_barang').val('');
            $('#qty').val('');
            $('#reset').hide();
            return;
        } else {

            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("barang").innerHTML =
                            xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "<?php echo base_url('Stok/getbarang') ?>/" + str, true);
            xmlhttp.send();


        }

    }



    function convertToRupiah(angka)
    {

        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');

        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0)
                rupiah += angkarev.substr(i, 3) + '.';

        return rupiah.split('', rupiah.length - 1).reverse().join('');

    }

    var table;
    $(document).ready(function () {
        $('#id_barang').focus();
        table = $('#table_transaksi').DataTable({
            paging: false,
            "info": false,
            "searching": false,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' 
            // server-side processing mode.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('Stok/ajax_list_transaksi') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0, 1, 2, 3, 4, 5], //last column
                    "orderable": false, //set not orderable
                },
            ],
        });
    });

    function reload_table()
    {

        table.ajax.reload(null, false); //reload datatable ajax 
        $('#id_barang').focus();

    }

    function addbarang()
    {
        var id_barang = $('#id_barang').val();
        var qty = $('#qty').val();
        if (id_barang == '') {
            $('#id_barang').focus();
        } else if (qty == '') {
            $('#qty').focus();
        } else {
            // ajax adding data to database
            $.ajax({
                url: "<?php echo site_url('Stok/add_in') ?>",
                type: "POST",
                data: $('#form_transaksi').serialize(),
                dataType: "JSON",
                success: function (data)
                {
                    //reload ajax table
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding data');
                }
            });
            //mereset semua value setelah btn tambah ditekan
            $('.reset').val('');
        }
        ;
    }

    function deletebarang(id, sub_total)
    {
        // ajax delete data to database
        $.ajax({
            url: "<?php echo site_url('Stok/deletebarang') ?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function (data)
            {
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

//        var ttl = $('#total').val().replace(".", "");

//        $('#total').val(convertToRupiah(ttl - sub_total));

//        showKembali($('#bayar').val());
    }



    //maskMoney

    function selesai() {
        var r = confirm("Anda akan menyimpan data Stok Bahan Baku.!\nPastikan data sudah valid!.\nLalu lanjutkan proses.");
        if (r === true) {
            place_stok();
            location.reload();
        }
    }
    function myFunction() {
        /* tombol F12 */
        if (event.keyCode === 123) {
            event.preventDefault();
            selesai();
        } else if (event.keyCode === 13) {
            event.preventDefault();
            addbarang();
        }
    }
    function place_stok()
    {
        $.ajax({
            url: "<?php echo site_url('Stok/place_stok') ?>",
            type: "POST",
            dataType: "JSON",
            success: function (data)
            {
                //reload ajax table
                alert('Data sudah ditambahkan!');
                window.location = '<?php echo site_url('Stok/data_stok_in') ?>/' + data;
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding data');
            }
        });
        //mereset semua value setelah btn tambah ditekan
        $('.reset').val('');
        ;
    }
    $('.uang').maskMoney({
        thousands: '.',
        decimal: ',',
        precision: 0
    });

</script>