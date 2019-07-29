<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <div class="col-md-12">
            <div style="text-align: center">
                <h3>Ringkasan Transaksi Penjualan</h3></div><br />
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead style="text-align: center; background: #327AB7; color: #fff">
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi <span class="glyphicon glyphicon-question-sign"
                                                     title="Klik kode transaksi untuk melihat detail transaksi"
                                                     ></span></th>  
                            <th>Tanggal</th>
                            <th>Status Bayar</th>
                            <th>ID Umum</th>
                            <th style="text-align: right;">Sub Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $total = 0;
                        $no = 1;
                        $stat = array('1' => 'DP', '2' => 'Lunas','8' => 'Booking');
                        if (sizeof($pj) <= 0) {
                            ?>
                        <script>
                            alert("tidak ada data yang ditampilkan");
                            window.location.assign('<?php echo site_url("jurnal") ?>');
                        </script>

                    <?php
                    } else {
                        foreach ($pj as $p) {
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><a href='#detailTransaksi' title='Klik untuk detail transaksi' data-toggle="modal" data-target="#detail_trans" onclick="sendIdTrans('<?php echo $p->id_trans; ?>')"><?php echo $p->id_trans; ?></a></td>
                                <td><?php echo date('d/m/Y', strtotime($p->tgl)) ?></td>
                                <td><?php echo $stat[$p->stat_byr] ?></td>
                                <td><?php echo $p->id_umum ?></td>
                                <!--<td style="text-align: right;">Rp. <?php // echo buatrp($subtotal = $this->Jurnal_m->byr($p->no_nota)) ?></td>-->                                        
                                <td style="text-align: right;">Rp. <?php echo buatrp($subtotal = $p->Total) ?></td>                                        
                            </tr>
                            <?php
                            $no++;
                            $total+=$subtotal;
                        }
                    }
                    ?>
                    <tr><td colspan="5"> <p style="text-align: right"><b>Total</b></p></td>
                        <td style="text-align: right;"> <b><?php echo 'Rp. ' . buatrp($total); ?></b></td>
                    </tr>
                    </tbody>
                </table>
                <form action="<?php echo site_url('Jurnal/proses_pj') ?>" method="post">
                    <div style="visibility: collapse">
                        <input type="text" value="<?php echo $total; ?>" name="debit">
                        <input type="text" value="<?php echo 0; ?>" name="kredit">
                        <input type="text" value="<?php echo $start; ?>" name="start">
                        <input type="text" value="<?php echo $end; ?>" name="end">
                    </div>
                    <fieldset>
                        <legend>Proses Input Jurnal Penjualan</legend>
                    </fieldset>
                    <label>Pilih Tujuan Sumber Dana</label>
                    <select name="kode" class="form-control form-control-lg" style="width: 50%">
                        <?php foreach ($uang as $u) { ?>
                            <option value="<?php echo $u->kode; ?>"><?php echo $u->nama_tempat; ?></option>
<?php } ?>
                    </select><br />
                    <button type="submit" class="btn btn-lg btn-neutral" style="background: #68AE00; color: #fff">Proses</button>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="modal fade left" id="detail_trans" tabindex='-1'>
        <div class="modal-dialog" style="width: 85%">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" title="Close">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <h3 class="center-block" id='header_transaksi'></h3>

                </div>
                <div class="modal-body" id='content_trans'>
                </div>

                <div style="text-align: center">
                    <button class="btn btn-neutral" style="background: #68AE00; color: #fff"  data-dismiss="modal" title="Close">
                        Tutup (Esc)
                    </button>
                </div>
                </form>
                <br />
                <!--</form>-->
            </div>
        </div>
    </div>
</div>
<!--</div>
</div>
</div>-->
<script>
    function sendIdTrans(id) {
        var http = new XMLHttpRequest();
        var url = "<?php echo site_url('jurnal/detail_trans') ?>";
        var params = "id_trans=" + id
                ;
        http.open("POST", url, true);

        document.getElementById('header_transaksi').innerHTML = "Detail Transaksi " + id;

        //Send the proper header information along with the request
        http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        http.onreadystatechange = function () {//Call a function when the state changes.
            if (http.readyState == 4 && http.status == 200) {
                document.getElementById("content_trans").innerHTML = http.responseText;
            }
        }
        http.send(params);

        console.log(url);
        console.log(params);
        console.log(debit);
        console.log(kredit);
    }
</script>
<?php $this->load->view('./sidebar'); ?>
<?php

function buatrp($angka) {
    $jadi = number_format($angka, 0, ',', '.');
    return $jadi;
}
?>