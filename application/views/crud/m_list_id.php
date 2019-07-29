<?php
$this->load->view('./header');
$id_member = "";
$nm = "";
$alamat = "";
$tipe = "";
$usaha = "";
$tgl_daftar = "";
$no_telp = "";
$url = 'm_input';
foreach ($list as $r) {
    $id_member = $r->id_member;
    $nm = $r->nm_member;
    $alamat = $r->alamat;
    $tipe = $r->tipe;
    $usaha = $r->usaha;
    $tgl_daftar = $r->tgl_daftar;
    $no_telp = $r->no_telp;
    $url = 'm_upd';
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
                        <input name="id_member" type="hidden"  value="<?php echo $id_member; ?>" >                        
                        <input name="nm" type="text" value="<?php echo $nm; ?>" placeholder="Nama" required="">
                        <textarea name="alamat" value="" placeholder="Alamat" required=""><?php echo $alamat; ?></textarea>
                        <textarea name="usaha" value="" placeholder="Usaha" required=""><?php echo $usaha; ?></textarea>
                        <input type="text" name="no_telp" value="<?php echo $no_telp; ?>" placeholder="Nomor Telepon" required="">
                        <div class="form-group">
                            <div class="btn btn-default btn-file">
                                <select class="form-control form-control-lg" name="tipe">
                                    <option value="0">--Pilih Tipe Member--</option>
                                    <option value="pelanggan" <?php if ($tipe == "pelanggan") { ?>selected<?php } ?>>Pelanggan</option>                                   
                                    <option value="member_biasa" <?php if ($tipe == "member_biasa") { ?>selected<?php } ?> >Member Biasa</option>                                   
                                    <option value="member_khusus" <?php if ($tipe == "member_khusus") { ?>selected<?php } ?> >Member Khusus</option>                                   
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