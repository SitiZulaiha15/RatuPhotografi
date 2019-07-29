<?php
$this->load->view('./header');
$kd = "";
$nm = "";
$hrg = "";
$hpp = "";
$kat = "";
$detail = "";
$url = "b_input";
foreach ($list as $r) {
    $kd = $r->kd_brg;
    $nm = $r->nm_brg;
    $hrg = $this->Etc->rp($r->hrg_brg);
    $hpp = $this->Etc->rp($r->hpp);
    $kat = $r->id_kat;
    $detail = $r->detail;
    $url = "b_upd";
}
?>
<div class="inner-block">
    <div class="blank">
        <h2>Product Input Form</h2>        	 
        <div class="col-md-8 compose-right">
            <div class="inbox-details-default">
                <div class="inbox-details-heading">
                    Input New Product
                </div>
                <div class="inbox-details-body">
                    <div class="alert alert-info">
                        Please fill details to insert a product
                    </div>
                    <form class="com-mail" method="post" action="<?php echo site_url('Crud/' . $url); ?>">
                        <input name="id_kat" type="hidden"  value="<?php echo $kd; ?>" placeholder="">                        
                        <input title="Nama" name="nm" type="text" value="<?php echo $nm; ?>" placeholder="Nama Barang" required="">
                        <input title="HPP" class="uang" name="hpp" type="text" value="<?php echo $hpp; ?>" placeholder="HPP" required="">
                        <input title="Harga Barang" class="uang" name="hrg" type="text" value="<?php echo $hrg; ?>" placeholder="Harga Barang" required="">
                        <input title="Detail" name="detail" type="text" value="<?php echo $detail; ?>" placeholder="Detail" required="">
                        <!--<input type="text" value="<?php echo $grup; ?>">-->
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <select title="Kategori" class="form-control form-control-lg" name="id_kat">
                                    <option value="0">--Pilih Kategori--</option>
                                    <?php foreach ($kategori as $k) { ?>
                                        <option value="<?php echo $k->id_kat; ?>" <?php if ($kat == $k->id_kat) { ?>selected<?php } ?> ><?php echo $k->nm_kat; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <input type="submit" value="Simpan"> 
                    </form>
                </div>
            </div>
        </div>
<div class='col-sm-12' style="height: 500px"></div>
        <div class="clearfix"> </div>     
    </div>
</div>
<?php
$this->load->view('./sidebar');
?>
<script type="text/javascript">
    $('.uang').maskMoney({
        thousands: '.',
        decimal: ',',
        precision: 0
    });
</script>