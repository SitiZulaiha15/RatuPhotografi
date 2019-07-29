<?php $this->load->view('header'); ?>
<div class="inner-block">
    <div class="blank">
        <div class="col-md-8 compose-right">
            <div class="inbox-details-default">
                <div class="inbox-details-heading">
                    Cari Pesanan
                </div>
                <div class="inbox-details-body">
                    <div class="alert alert-info">
                        Masukkan Nomor Nota
                    </div>
                    <form class="com-mail" method="post" action="<?php echo site_url('Frontline/ready_cetak'); ?>" enctype="multipart/form-data">
                        <input name="id" type="text"  placeholder="Nomor Nota :" required="" autofocus="autofocus">
                        <input type="submit" value="Cari"> 
                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"> </div> 
    </div>
</div>
<?php $this->load->view('sidebar'); ?>