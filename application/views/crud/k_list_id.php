<?php
$this->load->view('./header');
$id= "";
$nm = "";
$level = "";
$user = "";
$pass = "";
$url = "k_input";
foreach ($list as $r) {
    $id = $r->id_staf;
    $nm = $r->nm_staf;
    $level = $r->level;
    $user = $r->user;
    $pass = "";
    $url = 'k_upd';
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
                        <input name="id_staf" type="hidden"  value="<?php echo $id; ?>" >                        
                        <input name="nm" type="text" value="<?php echo $nm; ?>" placeholder="Nama" required="">
                        <input type="text" name="user" value="<?php echo $user; ?>" placeholder="Username" required="">
                        <input class="form-control" type="password" name="pass" value="<?php echo $pass; ?>" placeholder="Password" required="">
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <select class="form-control form-control-lg" name="level">
                                    <!--<option>--Pilih Level--</option>-->
                                    <option value="1" <?php if ($level == "1") { ?>selected<?php } ?>>Super Admin</option>                                   
                                    <option value="1" <?php if ($level == "2") { ?>selected<?php } ?> >Fotografer</option>                                   
                                    <option value="3" <?php if ($level == "3") { ?>selected<?php } ?> >Penanggungjawab</option>                                   
                                    <option value="4" <?php if ($level == "4") { ?>selected<?php } ?> >Admin Stok</option>                                   
                                    <option value="5" <?php if ($level == "5") { ?>selected<?php } ?> >Kasir</option>                                   
                                    <option value="6" <?php if ($level == "6") { ?>selected<?php } ?> >Customer Service</option>                                   
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