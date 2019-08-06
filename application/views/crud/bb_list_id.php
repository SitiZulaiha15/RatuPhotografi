<?php
$this->load->view('./header');
$id = "";
$nm = "";
$limit = "";
$stok = "";
$url = "bb_input";
foreach ($list as $r) {
    $id = $r->id_bb;
    $nm = $r->nm_bb;
    $limit = $r->limit;
    $stok = $r->stok;
    $url = "bb_upd";
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
                        <input name="id_bb" type="hidden"  value="<?php echo $id; ?>" placeholder="">                        
                        <input name="nm" type="text" value="<?php echo $nm; ?>" placeholder="Nama Bahan Baku" required="">
                        <input name="limit" type="number" value="<?php echo $limit; ?>" placeholder="Limit" required="">
                        <input name="stok" type="number" value="<?php echo $stok; ?>" placeholder="Stok" required="">
                        
                        <input type="submit" value="Simpan"> 
                    </form>
                </div>
            </div>
        </div>
<div class='col-sm-12' style="height: 500px"></div>
        <div class='col-sm-12' style="height: 1000px"></div>
        <div class="clearfix"> </div>     
    </div>
</div>
<?php
$this->load->view('./sidebar');
?>