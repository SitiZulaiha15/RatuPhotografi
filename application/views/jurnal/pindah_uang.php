<style>
.testimonial-group>.row {
    overflow-x: auto;
    white-space: nowrap;
}

.testimonial-group>.row>.col-xs-4 {
    display: inline-block;
    float: none;
}

/* Decorations */
.col-xs-4 {
    color: #fff;
    font-size: 48px;
    padding-bottom: 20px;
    padding-top: 18px;
}

.col-xs-4:nth-child(3n+1) {
    background: #c69;
}

.col-xs-4:nth-child(3n+2) {
    background: #9c6;
}

.col-xs-4:nth-child(3n+3) {
    background: #69c;
}
.list-group-item.disabled, .list-group-item.disabled:focus, .list-group-item.disabled:hover{
    /*background: #FC8213;*/
    color: #FC8213;
}

</style>

<body>
    <?php
    $kegunaan = array(
        'Keluarkan Kas',
        'Masukkan Kas',
        'Keluarkan Mandiri',
        'Masukkan Mandiri',
        'Keluarkan BRI',
        'Masukkan BRI',
        'Keluarkan SUMSEL',
        'Masukkan SUMSEL',
        'KELUAR',
        'MASUK'
    );
    $bulan = array(
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember"
    );
    date_default_timezone_set('Asia/Jakarta');

    $uang_value = array();
    $i = 0;
    foreach ($uang as $value) {
        $uang_value[$i] = $value->saldo;
        $i++;
    }
    // print_r($uang_value);
    ?>
    <div>
        <div style="text-align: center">
            <label id="keter_label">Pilih Fungsi</label>
            <br /> 
            <a style="background: #68AE00; color: #fff" class="btn btn-neutral popup-with-zoom-anim" data-toggle="modal" data-target="#pindah">
                Jelajah Fungsi
            </a>
        </div>
        <br /> 
        <label id="keter_label">Keterangan</label>
        <textarea type="text" class="form form-control" id="keterangan_pindah_uang" name="keterangan_pindah_uang"></textarea>
        <br /> 
        <input readonly type="hidden" class="form form-control" id="kode_pindah" name="kode_pindah_uang"/>
        <label>Akun</label> 
        <input readonly type="text" class="form form-control" id="akun_pindah" name="akun_pindah_uang"/><br /> 
        <label>Tanggal</label>
        <div class="input-group date form_date col-md-6" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" onmouseenter="return getPicker('datetimepicker_pindah')" data-link-format="yyyy-mm-dd" id="datetimepicker_pindah">
            <input type='text' id="tanggal_pindah_uang" name="tanggal_pindah_uang" class="form-control" readonly value="<?php
            date_default_timezone_set('Asia/Jakarta');
            echo date('Y-m-');
            echo date('d') - 1;
            ?>"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
    <br /> 
    <label>Debit</label>
    <input type="number" name="jumlah_debit_pindah_uang" class="form form-control" id="debit_pindah"
    placeholder="0"
    onkeyup="formatCurrency(this.value, 'currency_debit_pindah_uang_pindah')" /> 
    <label>Rp.</label> <span id="currency_debit_pindah_uang_pindah"></span><br /> <br /> 
    <label>Kredit</label> 
    <input type="number" name="jumlah_kredit_pindah_uang" class="form form-control" id="kredit_pindah" placeholder="0"
    onkeyup="formatCurrency(this.value, 'currency_kredit_pindah_uang_pindah')" /> 
    <label>Rp.</label> <span id="currency_kredit_pindah_uang_pindah"></span><br /> <br /> 
    <label>Sumber Dana Tujuan</label><br />
    <select name="sumber_dana_pindah_uang" class="form" id="sumber_dana_pindah">
        <?php
        $i = 0;
        foreach ($sumber_dana as $value) {
            ?>
            <option value="<?php echo $value->kode; ?>"><?php echo $value->nama_tempat; ?></option>
            <?php } ?>
        </select>
        <div style="text-align: center">
            <button class="btn btn-neutral" style="background: #68AE00; color: #fff"
            onclick="sendDataToServerJPindahUang(
                'keterangan_pindah_uang',
                'kode_pindah',
                'tanggal_pindah_uang',
                'debit_pindah',
                'kredit_pindah',
                'sumber_dana_pindah'
                )" onmouseenter="getSelectValue('sumber_dana_pindah')"

                >Kirim</button>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="modal fade left" id="pindah" tabindex='-1'>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" title="Close">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                                <h3 class="center-block">Jelajah Fungsi</h3>

                            </div>
                            <div class="modal-body">
                                <div class="list-group" style="overflow-y: scroll; height: 200px;">
                                    <?php
                                    $i = 1;
                                    foreach ($kegunaan as $values) {
                                        ?>
                                        <a class="list-group-item"
                                        style=".active{ background: #68AE00;}"  id="<?php echo $i ?>"
                                        onclick="return setProperty('<?php echo $i ?>', '<?php echo str_replace(" ", "_", $values) ?>');">
                                        <?php echo $values ?></a> 
                                        <?php
                                        $i ++;
                                    }
                                    ?>
                                </div>
                                <div style="text-align: center">
                                    <button class="btn btn-neutral" style="background: #68AE00; color: #fff"  data-dismiss="modal" title="Close">
                                        Tutup (Esc)
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var date = "<?php echo $bulan[date('n') - 1] ?>";
            var date_next = "<?php echo $bulan[date('n')] ?>";
            function setProperty(value, content) {
                var kode = ['888', '110', '888', '110', '888', '110', '888',
                '110', '888', '888']; 
                var akun = ['Pemindahan Uang', 'Kas', 'Pemindahan Uang', 'Kas', 'Pemindahan Uang', 'Kas', 'Pemindahan Uang',
                'Kas', 'Pemindahan Uang', 'Pemindahan Uang'];
                var debit = [
                '0',
                '<?php echo $uang_value[0] ?>',
                '0',
                '<?php echo $uang_value[1] ?>',
                '0',
                '<?php echo $uang_value[2] ?>',
                '0',
                '<?php echo $uang_value[3] ?>',
                '0',
                '0'
                ];
                var kredit = [
                '<?php echo $uang_value[0] ?>',
                '0',
                '<?php echo $uang_value[1] ?>',
                '0',
                '<?php echo $uang_value[2] ?>',
                '0',
                '<?php echo $uang_value[3] ?>',
                '0',
                '0',
                '0'];
                var keter = ['Kas', 'Mandiri', 'BRI', 'SUMSEL'];
            // var keterangan_pindah = getValueList(value);

            console.log(akun[value - 1]);
            document.getElementById('kode_pindah').value = kode[value - 1];
            document.getElementById('akun_pindah').value = akun[value - 1] + " (" + kode[value - 1] + ")";

            document.getElementById('debit_pindah').value = debit[value - 1];
            formatCurrency(debit[value - 1], 'currency_debit_pindah_uang_pindah');

            document.getElementById('kredit_pindah').value = kredit[value - 1];
            formatCurrency(kredit[value - 1], 'currency_kredit_pindah_uang_pindah');

            if (value == 1 || value == 2) {
                keterangan_pindah = keter[0] + '_' + date + '_' + date_next;
                document.getElementById('sumber_dana_pindah').value = 1;
            } else if (value == 3 || value == 4) {
                keterangan_pindah = keter[1] + '_' + date + '_' + date_next;
                document.getElementById('sumber_dana_pindah').value = 2;
            } else if (value == 5 || value == 6) {
                keterangan_pindah = keter [2] + '_' + date + '_' + date_next;
                document.getElementById('sumber_dana_pindah').value = 3;
            } else if (value == 7 || value == 8) {
                keterangan_pindah = keter[3] + '_' + date + '_' + date_next;
                document.getElementById('sumber_dana_pindah').value = 4;
            } else {
                document.getElementById('sumber_dana_pindah').value = 1;
            }
            document.getElementById('keterangan_pindah_uang').value = content + '_' + date + '_' + date_next;
        }

        jQuery("a.list-group-item").click(function (e) {
            jQuery(this).addClass('disabled').siblings().removeClass('disabled');
        });
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

        function getValueList(id) {
            var keter = document.getElementById(id).innerHTML;
            return keter.replace(/\s/g, '');
        }

        function sendDataToServerJPindahUang(keter, akun, tanggal, debit, kredit, sumber_dana) {
            var akun__pindah_uang = document.getElementById(akun).value;
            var tanggal__pindah_uang = document.getElementById(tanggal).value;
            var keterangan__pindah_uang = document.getElementById(keter).value;
            var debit__pindah_uang = document.getElementById(debit).value;
            var kredit__pindah_uang = document.getElementById(kredit).value;
            var sumber_dana__pindah_uang = getSelectValue(sumber_dana);
 
            if(akun__pindah_uang == "" || keterangan__pindah_uang == ""){
                alert("Pilih Fungsi terlebih dan isi keterangan dahulu");
            }else if(debit__pindah_uang == "" && kredit__pindah_uang == ""){
                alert("Silahkan isi debit atau kredit terbih dahulu");
            }else{
            var http = new XMLHttpRequest();
            var url = "<?php echo site_url('jurnal/process_data/pindah_uang') ?>";
            var params = "akun_pindah_uang=" + akun__pindah_uang +
            "&tanggal_pindah_uang=" + tanggal__pindah_uang +
            "&keterangan_pindah_uang=" + keterangan__pindah_uang +
            "&jumlah_debit_pindah_uang=" + debit__pindah_uang +
            "&jumlah_kredit_pindah_uang=" + kredit__pindah_uang +
            "&sumber_dana_pindah_uang=" + sumber_dana__pindah_uang
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

            console.log(params);
            }
        }
        function getSelectValue(id_sumber_dana) {
            var e = document.getElementById(id_sumber_dana).value;

            return e;
        }
    </script>