<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">

            <div class="col-md-8 compose-right">
                <div class="inbox-details-default">
                    <div class="inbox-details-heading">
                        Cari Pesanan
                    </div>
                    <div class="inbox-details-body">
                        <div class="alert alert-info">
                            Masukkan Data Tanggal dan Nama Pelanggan
                        </div>
                        <form class="com-mail" method="post" action="<?php echo site_url('Job/job_search_result'); ?>">
                            <input name="id" type="text"  placeholder="Nama Pelanggan :">
                            <div class="input-group date form_datetime col-md-6" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <input name="tgl" class="form-control" size="10" type="text" placeholder="Tanggal Transaksi" id="deadline">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>                                    
                                </span>
                            </div>
                            <input type="submit" value="Cari"> 
                        </form>
                    </div>
                </div>
            </div>
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        language: 'id',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
</script>