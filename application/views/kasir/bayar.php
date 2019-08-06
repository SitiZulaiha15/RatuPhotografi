<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <h2>Pembayaran</h2>        
        <div class="col-md-8 compose-right">
            <div class="inbox-details-default">
                <div class="inbox-details-heading">
                    Cari Pesanan
                </div> 
                <script>
//                    alert("Belum ada Transaksi, Silahkan menuju ke Siap Cetak!");
//                    console.log("<?php echo site_url('Kasir') ?>");
                </script>
                <div class="inbox-details-body">
                    <div class="alert alert-info">
                        Masukkan Nomor Nota atau Nama Pelanggan
                    </div>
                    <form class="com-mail" method="post" action="<?php echo site_url('Kasir'); ?>" enctype="multipart/form-data">
                        <input name="id" type="text"  placeholder="Nomor Nota :" required="" autofocus="autofocus">
                        <input type="submit" value="Cari" name="cari"> 
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-12 compose-right">
            <div class="table-responsive">
                <div class="panel-body">
                    <table class="table table-hover" id="dataTable">
                        <thead>
                            <tr>
                                <th>Nama Pelanggan</th>
                                <th>Nomor Telepon</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($trans as $t) { ?>
                                <tr>
                                    <td><?php echo $t->atas_nama; ?></td>
                                    <td><?php echo $t->no_telp; ?></td>
                                    <td><?php echo $this->Etc->tgl($t->tgl); ?></td>
                                    <td><?php echo $this->Etc->byr($t->stat_byr); ?></td>
                                    <td>
                                        <?php if ($t->stat_byr == 9) { ?>
                                            <button onclick="bayarBooking('<?php echo $t->no_nota; ?>')" class="hvr-icon-spin">Bayar Booking</button>
                                        <?php } else { ?>
                                            <a href="<?php echo site_url('Kasir/bayar_detail/' . $t->no_nota) ?>" class="hvr-icon-spin">Lanjut</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div><!-- end col-md-9 -->

        <div class='col-sm-12' style="height: 1000px"></div>
        <div class="clearfix"> </div> 
    </div>
</div>

<!--modal bayar-->
<div class="modal fade" id="modalBooking" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Bayar Booking Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_byr_book" method="post">
                    <div class="form-group">
                        <label >Nominal Pembayaran Booking Foto</label>
                        <input type="text" class="form-control uang" placeholder="0" name="byr_booking">
                        <input type="hidden" class="form-control uang" placeholder="0" name="nota_book">
                        <!--<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group">
                        <label for="metode_byr" class="besar">Metode Pembayaran</label>
                        <select class="form-control form-control-lg" name="metode_byr" id="byr">
                            <option value="0">Tunai</option>
                            <option value="1">Transfer</option>
                        </select>  
                    </div>
                    <button type="button" class="btn btn-primary" id="simpan_byr_book">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end modal-->

<?php $this->load->view('./sidebar'); ?>

<script>
    function bayarBooking(id) {
        $('#modalBooking').modal('show');
        $('[name="nota_book"]').val(id);
    }
    $('#simpan_byr_book').click(function () {
        $.ajax({
            url: "<?php echo site_url('Book/bayar_booking') ?>",
            type: "POST",
            dataType: "JSON",
            data: $('#form_byr_book').serialize(),
            success: function (data)
            {
                alert("Data Pembayaran Booking Berhasil Ditambahkan");
                window.location.assign("<?php echo site_url('Book/nota_byr_booking/') ?>" + data.id);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Pembayaran Booking Gagal, Silahkan coba lagi!');
                return false;
            }
        });
    });
    $('.uang').maskMoney({
        thousands: '.',
        decimal: ',',
        precision: 0
    });
</script>
