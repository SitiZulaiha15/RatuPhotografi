<?php
$id = "";
$nm = "";
$url = "s_input";
if (!empty($list)) {
    foreach ($list as $r) {
        $id = $r->id_stat;
        $nm = $r->status;
        $url = "s_upd";
    }
}
$this->load->view('./header');
?>
<div class="inner-block">
    <div class="blank">
        <h2>Status Kerja Input Form</h2>        	 
        <div class="col-md-8 compose-right">
            <div class="inbox-details-default">
                <div class="inbox-details-heading">
                    Input Status Kerja
                </div>
                <div class="inbox-details-body">
                    <div class="alert alert-info">
                        Please fill details to insert a product
                    </div>
                    <form class="com-mail" method="post" action="<?php echo site_url('Crud/' . $url); ?>">                      
                        <input name="id" type="hidden" value="<?php echo $id; ?>">                        
                        <input name="nm" type="text" value="<?php echo $nm; ?>" placeholder="Status Kerja" required="">                        
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