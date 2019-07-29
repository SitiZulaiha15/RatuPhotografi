<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <h2>Pembayaran</h2> 
        <?php
        if (empty($trans)) {
            ?>        
            <script>
                alert("Belum ada Transaksi, Silahkan menuju ke Siap Cetak!");
                window.location.assign("<?php echo site_url('Kasir') ?>");
            </script>
            <?php
        }
        if (!empty($trans)) {
            ?>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table id="table_transaksi" class="table table-striped 
                               table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Quantity</th>
                                    <th>Diskon</th>
                                    <th>Sub-Total</th>
                                    <!--<th>DP</th>-->
                                    <!--<th>Aksi</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $sub = 0;
                                $id_trans = 0;
                                $nota = 0;
//                                $dp = 0;
                                foreach ($trans as $row) {
                                    ?>
                                    <tr>
                                        <th><?php echo $no++; ?></th>
                                        <th><?php echo $row->nm_brg; ?></th>
                                        <th><?php echo $this->Etc->rps($row->hrg); ?></th>
                                        <th><?php echo $row->jml; ?></th>
                                        <!--<th><?php //echo $diskon = ($row->hrg * $row->jml) * ($row->diskon/100);    ?></th>-->
                                        <th><?php echo $diskon = $row->diskon; ?></th>
                                        <th><?php echo $this->Etc->rps($a = ($row->hrg * $row->jml) - $diskon); ?></th>
                                        <!--<th><?php echo $row->dp; ?></th>-->
                                        <!--<th>Aksi</th>-->
                                    </tr>
                                    <?php
                                    $dp = $this->Kasir_m->dp($row->no_nota);
                                    $sub += $a;
//                                    
                                    $id_trans = $row->id_trans;
                                    $nota = $row->no_nota;
                                }
                                if ($dp <> 0) {
                                    $sub = $sub - $dp;
                                }
                                ?>
                                <tr>
                                    <td colspan="5">DP</td>
                                    <td><?php echo $this->Etc->rps($dp); ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <form method="post" class="form-horizontal" role="form" action="<?php echo site_url('Kasir/bayar') ?>">
                            <input type="hidden" name="id" value="<?php echo $id_trans; ?>">
                            <input type="hidden" name="nota" value="<?php echo $nota; ?>"
                                   <div class="col-md-12 mb">
                                <div class="col-md-12"> 

                                    <!--                                    <div class="form-group">
                                                                            <div class="segmented-control" style="width: 20%; color: #f7ae40">
                                                                                <input type="radio" name="sc-1-1" id="sc-1-1-1" checked="" autofocus="autofocus">
                                                                                <input type="radio" name="sc-1-1" id="sc-1-1-2" >
                                                                                <label for="sc-1-1-1" data-value="Lunas">Lunas</label>
                                                                                <label for="sc-1-1-2" data-value="DP">DP</label>
                                                                            </div>
                                                                        </div>                                -->
                                    <div class="form-group">
                                        <label for="total" class="besar">Total (Rp) :</label>
                                        <input type="text" class="form-control input-lg uang" 
                                               name="total" id="total" placeholder="0"
                                               readonly="readonly"  value="<?php echo $this->Etc->rp($sub); ?>">
                                    </div> 
                                    <div class="form-group">
                                        <label for="byr" class="besar">Pembayaran</label>
                                        <select class="form-control form-control-lg" name="byr" id="byr" autofocus="autofocus">
                                            <option value="0">LUNAS</option>
                                            <option value="1">DP</option>
                                        </select>  
                                    </div>
                                    <div class="form-group">
                                        <label for="metode_byr" class="besar">Metode Pembayaran</label>
                                        <select class="form-control form-control-lg" name="metode_byr" id="byr">
                                            <option value="0">Tunai</option>
                                            <option value="1">Transfer</option>
                                        </select>  
                                    </div>
                                    <div class="form-group">
                                        <label for="bayar" class="besar">Bayar (Rp) :</label>
                                        <input type="text" class="form-control input-lg uang" 
                                               name="bayar" placeholder="0" autocomplete="off"
                                               id="bayar" onkeyup="showKembali(this.value)">
                                        <input type="hidden" class="form-control input-lg uang" 
                                               name="dp" placeholder="0" autocomplete="off"
                                               id="dp" onkeyup="showKembali(this.value)">
                                    </div>
                                    <div class="form-group">
                                        <label for="kembali" class="besar">Kembali (Rp) :</label>
                                        <input type="text" class="form-control input-lg uang" 
                                               name="kembali" id="kembali" placeholder="0"
                                               readonly="readonly">
                                    </div>
                                </div>
                            </div><!-- end col-md-4 -->



                            <div class="col-md-offset-8" style="margin-top:20px">
                                <!--                        <button type="button" class="btn btn-primary btn-lg" 
                                                                id="selesai" disabled="disabled" 
                                                                onclick="alert('Belum ada action untuk save pejualan')">
                                                            Selesai <i class="fa fa-angle-double-right"></i></button>-->
                                <button type="submit" class="btn btn-primary btn-lg" 
                                        id="selesai" >
                                    Selesai <i class="fa fa-angle-double-right"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php }
            ?>
        </div><!-- end col-md-9 -->

        <div class="clearfix"> </div> 
    </div>
    <?php $this->load->view('./sidebar'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#bayar').keydown(function () {
                showKembali($('#bayar').val());
            });
            $("#byr").change(function () {
                var a = $(this).find(':selected').val();
                if (a === "1") {
                    $('#bayar').attr("type", "hidden");
                    $('label[for="bayar"]').text('DP');
                    $('label[for="kembali"]').text('Kekurangan');
                    $('#dp').attr("type", "text");
                } else {
                    $('#bayar').attr("type", "text");
                    $('label[for="bayar"]').text('Bayar');
                    $('#dp').attr("type", "hidden");
                }
                ;
            });
        });
        function showKembali(str)
        {
            var total = $('#total').val().replace(".", "").replace(".", "");
            //                $('#total').val();
            var bayar = str.replace(".", "").replace(".", "");
            var kembali = bayar - total;
            $('#kembali').val(convertToRupiah(kembali));
        }
        $('.uang').maskMoney({
            thousands: '.',
            decimal: ',',
            precision: 0
        });
        function convertToRupiah(angka)
        {

            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');

            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0)
                    rupiah += angkarev.substr(i, 3) + '.';

            return rupiah.split('', rupiah.length - 1).reverse().join('');

        }

    </script>