<?php
$this->load->view('./header');
$id_grup = "";
$id_kat = "";
$nm_kat = "";
$url = "kat_input";
foreach ($list as $r) {
    $id_grup = $r->id_grup;
    $id_kat = $r->id_kat;
    $nm_kat = $r->nm_kat;
    $url = "kat_upd";
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
                    <form class="com-mail" method="post" action="<?php echo site_url('Crud/'.$url); ?>">
                        <input name="id_kat" type="hidden"  value="<?php echo $id_kat; ?>">                        
                        <input name="nm" type="text" value="<?php echo $nm_kat; ?>" placeholder="Nama Kategori" required="">
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <select class="form-control form-control-lg" name="id_grup">
                                    <!--<option value="0">--Pilih Grup--</option>-->
                                    <?php foreach($grup as $g){?>
                                    <option value="<?php echo $g->id_grup; ?>"
                                            <?php if ($id_grup == $g->id_grup) { ?>selected<?php } ?>>
                                                <?php echo $g->nm_grup; ?></option>
                                    <?php }?>
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