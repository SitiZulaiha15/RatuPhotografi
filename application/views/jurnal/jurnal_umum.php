<table style="margin: 0 auto; color: #000" class="table table-responsive table-condensed">
    <thead>
        <tr>
            <th colspan="5" style="text-align: center; background: #327AB7; color: #fff">
                Jurnal Umum
            </th>
            <th style="width: 1%; text-align: right; background: #327AB7; color: #fff" colspan="2">
                <a title="Lihat Seluruh Sumber Dana" style="color: #fff" href="<?php echo site_url('jurnal/seluruhSumberDana') ?>" target="_blank"><span class="glyphicon glyphicon-collapse-down"></span></a>
            </th>
        </tr>
    </thead>
    <tr >
        <?php foreach ($jurnal_value as $value) { ?>
            <td style="width: 18%"><?php echo $value->nama_tempat ?></td>
        <?php } ?>
        <td>Tanggal</td>
        <td style="width: 15%">Total Uang</td>
    </tr>
    <tr>
    <tr>
        <?php foreach ($jurnal_value as $value) { ?>
            <td><?php echo buatrp($value->saldo) ?></td>
        <?php } ?>
        <td><?php echo $date_now ?></td>
        <?php foreach ($total_saldo as $value) { ?>
            <td colspan="2"><?php echo buatrp($value->total) ?></td>
        <?php } ?>
    </tr>
</tr>
</table>
<div style="margin-top: 2%; text-align: center">
    <a class="btn btn-neutral popup-with-zoom-anim" style="background: #68AE00; color: #fff"
       data-toggle="modal" data-target="#myModal">Inp. Jurnal Umum</a>
    <a class="btn btn-neutral popup-with-zoom-anim" style="background: #68AE00; color: #fff"
       data-toggle="modal" data-target="#penjualan">Inp. Jurnal Penjualan</a>   
    <a class="btn btn-neutral popup-with-zoom-anim" style="background: #68AE00; color: #fff"
       data-toggle="modal" data-target="#bahanBaku">Inp. Jurnal Bahan Baku</a>  
    <a  target="_blank" class="btn btn-neutral" style="background: #68AE00; color: #fff" href="<?php echo site_url('jurnal/jurnal_umum_seluruh') ?>" id="seluruh">
        Lap. Seluruh Jurnal Umum
    </a> 
    <a  class="btn btn-neutral popup-with-zoom-anim" style="background: #68AE00; color: #fff" data-toggle="modal" data-target="#laporan_jurnal" onclick = 'return cekJurnalSekarang()'>
        Lap. Jurnal Umum
    </a>
</div>
<div style="clear: both"></div>
<div style="clear: both"></div>
<div class="container" >
    <div class="row">
        <div class="modal fade left" id="myModal" tabindex='-1'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" title="Close">
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                        <h3 class="center-block">Input Jurnal Umum</h3>

                    </div>
                    <div class="modal-body">
                        <!--<form target="_blank" onsubmit="return submitForm(this);" method ="POST" action="<?php echo site_url('jurnal/process_data/jurnal_umum') ?>">-->
                        <label>Nomor Nota : </label> 
                        <label for="nota" style="color: #FC8213">
                            <?php
                            date_default_timezone_set('Asia/Jakarta');
                            echo date('ymd-hms')
                            ?>
                        </label>
                        <input type="hidden" id="no_nota_jurnal_umum" name="no_nota_jurnal_umum" value="<?php
                        date_default_timezone_set('Asia/Jakarta');
                        echo date('ymd-hms')
                        ?>">
                        <br /> 
                        <label>Pilih Akun</label><br /> 
                        <select class="form-control form-control-lg" id="akun_jurnal_umum" name="akun_jurnal_umum" id="akun_input_jurnal">
                            <?php
                            $i = 0;
                            foreach ($akun as $value) {
                                ?>
                                <option
                                    value="<?php echo $value->Kode; ?>"><?php echo $value->Akun; ?></option>
                                <?php } ?>
                        </select> <br />
                        <div class="input-group date form_date col-md-6" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" onmouseenter="return getPicker('datetimepicker4')" data-link-format="yyyy-mm-dd" id="datetimepicker4">
                            <input id="tanggal_jurnal_umum" type='text' name="tanggal_jurnal_umum" class="form-control" value="<?php
                            date_default_timezone_set('Asia/Jakarta');
                            echo date('Y-m-d');
                            ?>">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>

                        <br />
                        <textarea id="keterangan_input_jurnal" class="form-control" placeholder="keterangan" name="keterangan_jurnal_umum"></textarea>
                        <br /> 
                        <input id="debit_input_jurnal" name="jumlah_debit_jurnal_umum" class="form-control" type="number" name="start" placeholder="Jumlah Debit" onkeyup="formatCurrency(this.value, 'currency_debit')" />
                        <div style="float: right">
                            <span id="currency_debit"></span>
                        </div>
                        <br /> 
                        <input id="kredit_input_jurnal" name="jumlah_kredit_jurnal_umum" class="form-control" type="number" name="start" placeholder="Jumlah Kredit" onkeyup="formatCurrency(this.value, 'currency_kredit')" />
                        <div style="float: right">
                            <span id="currency_kredit"></span>
                        </div>
                        <br /> 
                        <label>Pilih Sumber Dana</label><br /> 
                        <select class="form form-control" name="sumber_dana_jurnal_umum" id="sumber_dana_input_jurnal">
                            <?php
                            $i = 0;
                            foreach ($sumber_dana as $value) {
                                ?>
                                <option
                                    value="<?php echo $value->kode; ?>"><?php echo $value->nama_tempat; ?></option>
                                <?php } ?>
                        </select> <br />
                        <div style="float: right">
                            <input class="btn btn-primary" type="submit"
                                   onclick="sendDataToServerJurnalUmum(
                                                   'no_nota_jurnal_umum',
                                                   'akun_jurnal_umum',
                                                   'tanggal_jurnal_umum',
                                                   'keterangan_input_jurnal',
                                                   'debit_input_jurnal',
                                                   'kredit_input_jurnal',
                                                   'sumber_dana_input_jurnal'
                                                   )" onmouseenter="getSelectValue('sumber_dana_input_jurnal')"
                                   />
                        </div>
                        <br /> <br />
                        <!--</form>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" >
    <div class="row">
        <div class="modal fade left" id="bahanBaku" tabindex='-1'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" title="Close">
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                        <h3 class="center-block">Input Jurnal Bahan Baku</h3>

                    </div>
                    <div class="modal-body">
                        <form class="com-mail" method="post" action="<?php echo site_url('Jurnal/stok'); ?>">
                            <h4>Pilih Tanggal Awal</h4>
                            <br />
                            <div class="input-group date form_date col-md-6" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" onmouseenter="return getPicker('datetimepicker5')" data-link-format="yyyy-mm-dd" id="datetimepicker5">
                                <input id="tanggal_jurnal_umum" type='text' name="start" class="form-control" value="<?php
                                date_default_timezone_set('Asia/Jakarta');
                                echo date('Y-m-d');
                                ?>">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <br />
                            <h4>Pilih Tanggal Akhir</h4>
                            <br />
                            <div class="input-group date form_date col-md-6" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" onmouseenter="return getPicker('datetimepicker6')" data-link-format="yyyy-mm-dd" id="datetimepicker6">
                                <input id="tanggal_jurnal_umum" type='text' name="end" class="form-control" value="<?php
                                date_default_timezone_set('Asia/Jakarta');
                                echo date('Y-m-d');
                                ?>">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <div style="float: right">
                                <input class="btn btn-primary" type="submit" value="Proses" />
                            </div>
                        </form>
                        <br />
                        *) Jika transaksi yang dicari tidak ditemukan, silahkan ubah range tanggal
                        <br /> <br />
                        <!--</form>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" >
    <div class="row">
        <div class="modal fade left" id="penjualan" tabindex='-1'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" title="Close">
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                        <h3 class="center-block">Input Jurnal Penjualan</h3>

                    </div>
                    <div class="modal-body">
                        <form class="com-mail" method="post" action="<?php echo site_url('Jurnal/penjualan'); ?>">
                            <h4>Pilih Tanggal Awal</h4>
                            <br />
                            <div class="input-group date form_date col-md-6" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" onmouseenter="return getPicker('datetimepicker7')" data-link-format="yyyy-mm-dd" id="datetimepicker7">
                                <input id="tanggal_jurnal_umum" type='text' name="start" class="form-control" value="<?php
                                date_default_timezone_set('Asia/Jakarta');
                                echo date('Y-m-d');
                                ?>">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                            <br />
                            <h4>Pilih Tanggal Akhir</h4>
                            <br />
                            <div class="input-group date form_date col-md-6" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" onmouseenter="return getPicker('datetimepicker8')" data-link-format="yyyy-mm-dd" id="datetimepicker8">
                                <input id="tanggal_jurnal_umum" type='text' name="end" class="form-control" value="<?php
                                date_default_timezone_set('Asia/Jakarta');
                                echo date('Y-m-d');
                                ?>">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div><br /> 
                            <label>Pilih Metode Pembayaran</label><br /> 
                            <select class="form-control form-control-lg"  name="metode_byr">
                                <option value="0">Tunai</option>
                                <option value="1">Transfer</option>
                            </select> <br />
                            <div style="float: right">
                                <input class="btn btn-primary" type="submit" value="Proses" />
                            </div>
                        </form><br />
                        *) Jika transaksi yang dicari tidak ditemukan, silahkan ubah range tanggal
                        <br /> <br />
                        <!--</form>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('jurnal/jurnal_umum_bulan_ini'); ?>
<script type="text/javascript">
    function sendDataToServerJurnalUmum(no_nota, akun, tanggal, keterangan, debit, kredit, sumber_dana) {
        var no_notas = document.getElementById(no_nota).value;
        var akuns = document.getElementById(akun).value;
        var tanggals = document.getElementById(tanggal).value;
        var keterangans = document.getElementById(keterangan).value;
        var debits = document.getElementById(debit).value;
        var kredits = document.getElementById(kredit).value;
        var sumber_danas = getSelectValue(sumber_dana);

        /*
         $data['keterangan'] = $this->input->post('keterangan_'.$pengenal);
         $data['no_nota'] = $this->input->post('no_nota_'.$pengenal);
         $data['akun'] = $this->input->post('akun_'.$pengenal);
         $data['tanggal'] = $this->input->post('tanggal_'.$pengenal);
         $data['debit'] = $this->input->post('jumlah_debit_'.$pengenal);
         $data['kredit'] = $this->input->post('jumlah_kredit_'.$pengenal);
         $data['sumber_dana'] = $this->input->post('sumber_dana_'.$pengenal);
         */
        if (kredits == "" && debits == "" || keterangans == "") {
            alert("Silahkan isi keterangan, debit atau kredit terlebih dahulu");
        } else {
            var http = new XMLHttpRequest();
            var url = "<?php echo site_url('jurnal/process_data/jurnal_umum') ?>";
            var params = "no_nota_jurnal_umum=" + no_notas +
                    "&akun_jurnal_umum=" + akuns +
                    "&tanggal_jurnal_umum=" + tanggals +
                    "&keterangan_jurnal_umum=" + keterangans +
                    "&jumlah_debit_jurnal_umum=" + debits +
                    "&jumlah_kredit_jurnal_umum=" + kredits +
                    "&sumber_dana_jurnal_umum=" + sumber_danas
                    ;
            http.open("POST", url, true);

            //Send the proper header information along with the request
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            http.onreadystatechange = function () {//Call a function when the state changes.
                if (http.readyState == 4 && http.status == 200) {
                    alert(http.responseText);
                    location.reload(true);
                }
            }
            http.send(params);

            console.log(url);
            console.log(params);
            console.log(debit);
            console.log(kredit);
        }
    }
    function getSelectValue(id_sumber_dana) {
        var e = document.getElementById(id_sumber_dana).value;

        return e;
    }


    function cekJurnalSekarang() {
        var data = '<?php echo sizeof($jurnal_umum_sekarang) ?>';
        if (data == 0) {
            // $('#laporan_jurnal').hide();
            // $('.modal-backdrop').hide();
            alert('Tidak ada data yang ditampilkan');
        }

    }

    function getPicker(id) {
        $('#' + id).datetimepicker({
            language: 'id',
            weekStart: 1,
            todayBtn: 1,
            pickTime: false,
            autoclose: true,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        }).on('changeDate', function (e) {

            $(this).datetimepicker('hide');

        });
    }
    $(document).ready(function () {
        $(".modal").on("hidden.bs.modal", function () {
            $('#debit_input_jurnal').val('');
            $('#kredit_input_jurnal').val('');
            $('#tanggal_input_jurnal').val('<?php
date_default_timezone_set('Asia/Jakarta');
echo date('Y-m-d');
?>');
            $('#keterangan_input_jurnal').val('');
            $('#currency_debit').html('0');
            $('#currency_kredit').html('0');
            $('#akun_input_jurnal').prop('selectedIndex', 0);
            $('#sumber_dana_input_jurnal').prop('selectedIndex', 0);
        });
    });


</script>
