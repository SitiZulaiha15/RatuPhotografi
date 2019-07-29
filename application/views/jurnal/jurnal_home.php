<!-- <meta http-equiv="refresh" content="10" /> -->
<?php
$this->load->view('header');
?>
<div class="inner-block inner-padding">
    <div class="blank">
        <div class="clearfix">
            <div class="container">
                <div class="row">

                    <div class="col-md-11">
                        <div class="tab" role="tabpanel">
                            <!-- Nav tabs -->
                            
                            <ul class="nav nav-tabs" role="tablist">
                                <li >
                                    <a href="#umum" onclick="setActiveTabs('umum')" aria-controls="home" role="tab" data-toggle="tab">
                                        <i class="fa fa-envelope-o"></i>&nbsp;&nbsp;Jurnal Umum
                                    </a>
                                </li>
                                <li >
                                    <a href="#laporan_laporan" onclick="setActiveTabs('laporan_laporan')" aria-controls="profile" role="tab" data-toggle="tab">
                                        <i class="fa fa-cubes"></i>&nbsp;&nbsp;Laporan-Laporan
                                    </a>
                                </li>
                                <li >
                                    <a href="#fix_cost" onclick="setActiveTabs('fix_cost')" aria-controls="messages" role="tab" data-toggle="tab">
                                        <i class="fa fa-money"></i>&nbsp;&nbsp;Fix Cost
                                    </a>
                                </li>
                                <li >
                                    <a href="#gaji_karyawan" onclick="setActiveTabs('gaji_karyawan')" aria-controls="messages" role="tab" data-toggle="tab">
                                        <i class="fa fa-bitcoin"></i>&nbsp;&nbsp;Penggajian Karyawan
                                    </a>
                                </li>
                                <li >
                                    <a href="#pindah_uang" onclick="setActiveTabs('pindah_uang')" aria-controls="messages" role="tab" data-toggle="tab">
                                        <i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Pemindahan Keuangan
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="umum">
                                    <?php $this->load->view('jurnal/jurnal_umum') ?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="laporan_laporan">
                                    <?php $this->load->view('jurnal/laporan_laporan') ?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="fix_cost">
                                    <?php $this->load->view('jurnal/fix_cost') ?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="gaji_karyawan">
                                    <?php $this->load->view('jurnal/penggajian_karyawan') ?>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="pindah_uang">
                                    <?php $this->load->view('jurnal/pemindahan_keuangan') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url() ?>/assets/js/jquery-2.1.1.min.js"></script> 
<script type="text/javascript">
    $(document).ready(function () {
        activaTab('<?php echo $this->session->userdata('penanda'); ?>');
    })

    function activaTab(tab) {
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
    }

    function setActiveTabs(penanda) {
        var http = new XMLHttpRequest();
        var url = "<?php echo site_url('jurnal/set_active_tabs') ?>";
        var params = "penanda=" + penanda;
        http.open("POST", url, true);
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                                            http.onreadystatechange = function () {//Call a function when the state changes.
                                                if (http.readyState == 4 && http.status == 200) {
//                                                    alert(http.responseText);
//            location.reload(true);
}
}
http.send(params);
console.log(url);
console.log(params);
}
function formatCurrency(num, id)
    {
        num = num.toString().replace(/\$|\,/g, '');
        if (isNaN(num))
        {
            num = "0";
        }
        sign = (num === (num = Math.abs(num)));
        num = Math.floor(num * 100 + 0.50000000001);
        cents = num % 100;
        num = Math.floor(num / 100).toString();
        if (cents < 10)
        {
            cents = "0" + cents;
        }
        for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        {
            num = num.substring(0, num.length - (4 * i + 3)) + '.' +
                    num.substring(num.length - (4 * i + 3));
        }
        console.log(num);
        document.getElementById(id).innerHTML = num;
    }
</script>
<style>
.inner-padding{
    padding-top: 4em;
}
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type="number"] {
    -moz-appearance: textfield;
}
</style>
<?php $this->load->view('sidebar'); ?>
<?php

function buatrp($angka) {
    $jadi = "Rp. " . number_format($angka, 0, ',', '.');
    return $jadi;
}
?>