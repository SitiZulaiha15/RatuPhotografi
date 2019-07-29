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
        'Depresiasi Sewa',
        'Depresiasi Peralatan Kantor',
        'Depresiasi Peralatan Studio',
        'Depresiasi Peralatan Komputer',
        'Depresiasi Peralatan CCTV',
        'Depresiasi Mesin Minilab',
        'Depresiasi Mesin Xuli',
        'Depresiasi Mesin 9890',
        'Depresiasi Mesin 9600',
        'Perawatan Pajero',
        'Depresiasi Mesin D700',
        'Tabungan THR',
        'Tunjangan Kesehatan',
        'Zakat'
    );
    $kredit = array(
        '6000000',
        '2600000',
        '1500000',
        '1500000',
        '500000',
        '4500000',
        '3500000',
        '1000000',
        '1000000',
        '500000',
        '1000000',
        '2000000',
        '1400000',
        '2000000'
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
    ?>
    <div>
        <div style="text-align: center">
            <label id="keter_label">Pilih Fungsi</label>
            <br /> 
            <a style="background: #68AE00; color: #fff" class="btn btn-neutral popup-with-zoom-anim" data-toggle="modal" data-target="#fungsi" onclick="getFocus()">
                Jelajah Fungsi
            </a>
        </div>
        <br /> 
        <label id="keter_label">Keterangan</label>
        <textarea readonly type="text" class="form form-control" id="keterangan_fix_cost" name="keterangan_fix_cost"></textarea>
        <br /> 
        <input readonly type="hidden" class="form form-control" id="akun_fix_cost" name="akun_fix_cost"/>
        <label>Akun</label> 
        <input readonly type="text" class="form form-control" id="akun_fix" name="akun_fix"/><br /> 
        <label>Tanggal</label>
        <div class="input-group date form_date col-md-6" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" onmouseenter="return getPicker('datetimepicker_pindah_fix_cost')" data-link-format="yyyy-mm-dd" id="datetimepicker_pindah_fix_cost">
            <input type='text' id="tgl_fix_cost" name="tanggal_fix_cost" class="form-control" readonly value="<?php
            date_default_timezone_set('Asia/Jakarta');
            echo date('Y-m-');
            echo date('d') - 1;
            ?>"/>
            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
    <br /> 
    <label>Debit</label>
    <input type="number" name="jumlah_debit_fix_cost" class="form form-control" id="debit_fix_cost"
    placeholder="0"
    onkeyup="formatCurrency(this.value, 'currency_debit_pindah_uang_fix')"
    /> 
    <span id="currency_debit_pindah_uang_fix"></span><br /> <br /> 
    <label>Kredit</label> 
    <input type="number" name="jumlah_kredit_fix_cost" class="form form-control" id="kredit_fix_cost" placeholder="0"
    onkeyup="formatCurrency(this.value, 'currency_kredit_pindah_uang_fix')"
    /> 
    <span id="currency_kredit_pindah_uang_fix"></span><br /> <br /> 
    <label>Sumber Dana</label><br />
    <select name="sumber_dana_fix_cost" id="dana_fix" class="form">
        <?php
        $i = 0;
        foreach ($sumber_dana as $value) {
            ?>
            <option value="<?php echo $value->kode; ?>"><?php echo $value->nama_tempat; ?></option>
            <?php } ?>
        </select>
        <div style="text-align: center">
            <button target="_blank" class="btn btn-neutral" style="background: #68AE00; color: #fff"
            onclick="sendDataToServerFixCost(
                'keterangan_fix_cost',
                'akun_fix_cost',
                'tgl_fix_cost',
                'debit_fix_cost',
                'kredit_fix_cost',
                'dana_fix'
                )" onmouseenter="getSelectValue('dana_fix')"
                >Kirim</button>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="modal fade left" id="fungsi" tabindex='-1'>
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
                                        style=".active{ background: #68AE00;}"  id="<?php echo $values ?>"
                                        onclick="return setPropertys('<?php echo $values ?>', '<?php echo $i ?>', '<?php echo $kredit[$i - 1] ?>', '<?php echo str_replace(" ", "_", $values) ?>')"><?php echo $values ?>
                                    </a> 
                                    <?php
                                    $i ++;
                                }
                                ?>
                            </div>
                            <div style="text-align: center">
                                <button class="btn btn-neutral" style="background: #68AE00; color: #fff"  data-dismiss="modal" title="Close"
                                >
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
    function setPropertys(id, value, kredit, content) {
        console.log(id);
        if (value == 1) {
            document.getElementById('akun_fix').value = "Depresiasi Sewa (650)";
            document.getElementById('akun_fix_cost').value = "650";
        } else if (value >= 2 && value <= 5) {
            document.getElementById('akun_fix').value = "Depresiasi Peralatan (640)";
            document.getElementById('akun_fix_cost').value = "640";
        } else if (value >= 6 && value <= 11) {
            document.getElementById('akun_fix').value = "Depresiasi Mesin (651)";
            document.getElementById('akun_fix_cost').value = "651";
        } else if (value == 12) {
            document.getElementById('akun_fix').value = "Tabungan THR (692)";
            document.getElementById('akun_fix_cost').value = "692";
        } else if (value == 13) {
            document.getElementById('akun_fix').value = "Tunjangan Kesehatan (691)";
            document.getElementById('akun_fix_cost').value = "691";
        } else if (value == 14) {
            document.getElementById('akun_fix').value = "Zakat (693)";
            document.getElementById('akun_fix_cost').value = "693";
        }
        document.getElementById('keterangan_fix_cost').value = content + "_" + date;
        document.getElementById('kredit_fix_cost').value = kredit;
        formatCurrency(kredit, 'currency_kredit_pindah_uang_fix');
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
        /*'keterangan_fix',
         'akun_fix',
         'tanggal_fix_cost',
         'debit_fix',
         'kredit_fix',
         'sumber_dana_fix_cost'*/
         function sendDataToServerFixCost(keterangan_fix, akun_fix, tanggal_fix_cost,
            debit_fix, kredit_fix, sumber_dana_fix_cost) {
            var akun__fix = document.getElementById(akun_fix).value;
            var tanggal__fix = document.getElementById(tanggal_fix_cost).value;
            var keterangan__fix = document.getElementById(keterangan_fix).value;
            var debit__fix = document.getElementById(debit_fix).value;
            var kredit__fix = document.getElementById(kredit_fix).value;
            var sumber_dana__fix = getSelectValue(sumber_dana_fix_cost);

            /*
             $data['keterangan'] = $this->input->post('keterangan_'.$pengenal);
             $data['no_nota'] = $this->input->post('no_nota_'.$pengenal);
             $data['akun'] = $this->input->post('akun_'.$pengenal);
             $data['tanggal'] = $this->input->post('tanggal_'.$pengenal);
             $data['debit'] = $this->input->post('jumlah_debit_'.$pengenal);
             $data['kredit'] = $this->input->post('jumlah_kredit_'.$pengenal);
             $data['sumber_dana'] = $this->input->post('sumber_dana_'.$pengenal);
             */
            if(akun__fix =="" || keterangan__fix == ""){
                alert("Pilih Fungsi terlebih dahulu");
            }else if(debit__fix == "" && kredit__fix == ""){
                alert("Silahkan isi debit atau kredit terbih dahulu");
            }else{
             var http = new XMLHttpRequest();
             var url = "<?php echo site_url('jurnal/process_data/fix_cost') ?>";
//            var params = "akun_fix_cost=" + akun__fix +
//                    "&tanggal_fix_cost=" + tanggal__fix +
//                    "&keterangan_fix_cost=" + keterangan__fix +
//                    "&jumlah_fix_cost=" + debit__fix +
//                    "&jumlah_fix_cost=" + kredit__fix +
//                    "&sumber_fix_cost=" + sumber_dana__fix
var params = "akun_fix_cost=" + akun__fix +
"&tanggal_fix_cost=" + tanggal__fix +
"&keterangan_fix_cost=" + keterangan__fix +
"&jumlah_debit_fix_cost=" + debit__fix +
"&jumlah_kredit_fix_cost=" + kredit__fix +
"&sumber_dana_fix_cost=" + sumber_dana__fix;
http.open("POST", url, true);
//
//            //Send the proper header information along with the request
http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            http.onreadystatechange = function () {//Call a function when the state changes.
                if (http.readyState == 4 && http.status == 200) {
                    alert(http.responseText);
                    location.reload(true);
                }
            }
            http.send(params);

            console.log(tanggal__fix);
            console.log(params);
            console.log(debit);
            console.log(kredit);
            }
        }

        function getSelectValue(id_sumber_dana) {
            var e = document.getElementById(id_sumber_dana).value;

            return e;
        }
    </script>