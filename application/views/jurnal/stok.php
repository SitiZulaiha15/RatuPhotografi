<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <div style="text-align: center">
            <h3>Ringkasan Transaksi Bahan Baku</h3></div><br />
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead style="text-align: center; background: #327AB7; color: #fff">
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>  
                        <!--<th>Bahan Baku</th>-->  
                        <th>Tanggal</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <form action="<?php echo site_url('Jurnal/proses_stok') ?>" method="post">
                    <tbody>
                        <?php
                        $total = 0;
                        $no = 1;
                        if (sizeof($pj) <= 0) {
                            ?>
                        <script>
                            alert("tidak ada data yang ditampilkan");
                            window.location.assign('<?php echo site_url("jurnal") ?>');
                        </script>

                    <?php
                    } else {
                        foreach ($pj as $p) {
                            $sub = $p->hrg_beli * $p->jml_in
                            ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <!--<td><?php // echo $p->id_in;  ?></td>-->
                                <td><a href='#detailTransaksi' title='Klik untuk detail transaksi' data-toggle="modal" data-target="#detail_trans" onclick="sendIdTrans('<?php echo $p->id_in; ?>')"><?php echo $p->id_in; ?></a></td>
                                <!--<td><?php echo $p->nm_bb; ?></td>-->
                                <td><?php echo $p->tgl; ?></td>                                
                                <td><?php echo buatrp($p->total) ?></td>
                            </tr>
                            <?php
                            $no++;
                            $total += $p->total;
                        }
                    }
                    ?>
                    <tr><td colspan="3"> <p style="text-align: right"><b>Total</b></p></td>
                        <td > <b><?php echo buatrp($total); ?></b></td>
                    </tr>
                    </tbody>
            </table>
            <div style="visibility: collapse;">
                <input type="text" value="<?php echo $total; ?>" name="kredit">
                <input type="text" value="<?php echo 0; ?>" name="debit">
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
        </div>
    </div>
</div>
<script>
    function sendIdTrans(id) {
        var http = new XMLHttpRequest();
        var url = "<?php echo site_url('jurnal/detail_stok') ?>";
        var params = "id_in=" + id
                ;
        http.open("POST", url, true);

        document.getElementById('header_transaksi').innerHTML = "Detail Bahan Baku " + id;

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
    $jadi = "Rp. " . number_format($angka, 0, ',', '.');
    return $jadi;
}
?>