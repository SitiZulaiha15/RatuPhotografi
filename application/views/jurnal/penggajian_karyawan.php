<table class="table table-condensed table-striped"  style="margin: 10px;">
    <tr>
        <th style="width: 12%">Nama Karyawan</th>
        <th style="width: 10%">Nama Akun</th>
        <th>Tanggal</th>
        <th style="width: 15%">Keterangan</th>
        <th style="width: 10%">Debit</th>
        <th style="width: 10%">Kredit</th>
        <th style="width: 20%">Sumber Dana</th>
        <th>Tindakan</th>
    </tr>
    <?php
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

    $date = date('d');
    // $ket = $bulan[date('n') - 1];
    if($date >= 28){
        $ket = $bulan[date('n')];
    }elseif ($date >=1 && $date < 28) {
        $ket = $bulan[date('n')-1];
    }
    ?>
    <?php
    $i = 1;
    foreach ($karyawan as $value) {
        ?>
        <tr>
            <td><b><?php echo $value->nm_staf ?></b></td>
            <td ><span>Gaji Karyawan</span></td>
            <td >
                <input 
                data-provide="datepicker" name="date_selected" data-date-format="yyyy-mm-dd" placeholder="Select date" required
                type='text' class="form-control" id="datetimepicker_<?php echo $i; ?>" 
                onmouseenter="return getPicker('datetimepicker_<?php echo $i; ?>')" value="<?php
                date_default_timezone_set('Asia/Jakarta');
                echo date('Y-m-');
                echo date('d') - 1;
                ?>"/>
            </td>
            <td><textarea id="keterangan_<?php echo $i; ?>" style="resize: none;" readonly class="form form-control" type="text" name="">Gaji_<?php echo $value->nm_staf ?>_<?php echo $ket ?></textarea>
            </td>
        </td>
        <td >
            <input id="jumlah_debit_<?php echo $i; ?>" onkeyup="return formatCurrency(this.value, 'debit_<?php echo $value->nm_staf ?>')" class="form form-control debit" type="number" name="debit_gaji" placeholder="0"/>
            <label>Rp. </label>&nbsp;<span class="debit_sp" id="debit_<?php echo $value->nm_staf ?>"></span>
        </td>
    </td>
    <td >
        <input id="jumlah_kredit_<?php echo $i; ?>" onkeyup="return formatCurrency(this.value, 'kredit_<?php echo $value->nm_staf ?>')" class="form form-control kredit" type="number" name="kredit_gaji" placeholder="0"/>
        <label>Rp. </label>&nbsp;<span class="kredit_sp" id="kredit_<?php echo $value->nm_staf ?>"></span>
    </td>
    <td data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
        <select onchange="getSelectValue('sumber_dana_<?php echo $i; ?>')" class="form-control form-control-lg dana" name="sumber_dana" id="sumber_dana_<?php echo $i; ?>">
            <?php
            foreach ($sumber_dana as $value) {
                ?>
                <option 
                value="<?php echo $value->kode; ?>"><?php echo $value->nama_tempat; ?></option>
                <?php } ?>
            </select>
        </td>
        <td >
            <a href="#send_data" onclick="sendDataToServer(
                'datetimepicker_<?php echo $i; ?>',
                'keterangan_<?php echo $i; ?>',
                'jumlah_debit_<?php echo $i; ?>',
                'jumlah_kredit_<?php echo $i; ?>',
                'sumber_dana_<?php echo $i; ?>'
                )" onmouseenter="getSelectValue('sumber_dana_<?php echo $i; ?>')" ><button  class="btn btn-neutral" style="background: #68AE00; color: #fff" >Kirim</button></a>
            </td>
        </tr>
        <?php
        $i++;
    }
    ?>
</table>
<a class="float" title="Bersihkan Kolom" onclick="return clearInput()"> 
    <i class="fa fa-trash-o my-float"onclick="return printDiv('print')"></i>
</a>

<script>
    function sendDataToServer(id_tanggal, id_keterangan, id_debit, id_kredit, id_sumber_dana){
        var tanggal = document.getElementById(id_tanggal).value;
        var keterangan = document.getElementById(id_keterangan).value;
        var debit = document.getElementById(id_debit).value;
        var kredit = document.getElementById(id_kredit).value;
        var sumber_dana = getSelectValue(id_sumber_dana);

        /*
              $data['keterangan'] = $this->input->post('keterangan_'.$pengenal);
        $data['no_nota'] = $this->input->post('no_nota_'.$pengenal);
        $data['akun'] = $this->input->post('akun_'.$pengenal);
        $data['tanggal'] = $this->input->post('tanggal_'.$pengenal);
        $data['debit'] = $this->input->post('jumlah_debit_'.$pengenal);
        $data['kredit'] = $this->input->post('jumlah_kredit_'.$pengenal);
        $data['sumber_dana'] = $this->input->post('sumber_dana_'.$pengenal);
        */
        if(debit == "" && kredit == ""){
            alert("Silahkan isi debit atau kredit terbih dahulu");
        }else{
        var http = new XMLHttpRequest();
        var url = "<?php echo site_url('jurnal/process_data/gaji_karyawan')?>";
        var params = "akun_gaji_karyawan=680&tanggal_gaji_karyawan="+tanggal+
        "&keterangan_gaji_karyawan="+keterangan+
        "&jumlah_debit_gaji_karyawan="+debit+
        "&jumlah_kredit_gaji_karyawan="+kredit+
        "&sumber_dana_gaji_karyawan="+sumber_dana
        ;
        http.open("POST", url, true);

        //Send the proper header information along with the request
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        http.onreadystatechange = function() {//Call a function when the state changes.
            if(http.readyState == 4 && http.status == 200) {
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

    function getSelectValue(id_sumber_dana){
        var e = document.getElementById(id_sumber_dana).value;

        return e;   
    }


    function getPicker(id) {
        $('#' + id + ' input').datetimepicker({
            language: 'id',
            weekStart: 1,
            todayBtn: 1,
            pickTime: false,
            autoclose: true,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
            format: 'YYYY'
        }).on('changeDate', function (e) {
            $(this).datetimepicker('hide');
        });
    }
    function clearInput() {
        $('.debit').val('');
        $('.kredit').val('');
        $('.debit_sp').html('0');
        $('.kredit_sp').html('0');
        $('.dana').prop('selectedIndex', 0);
    }
</script>