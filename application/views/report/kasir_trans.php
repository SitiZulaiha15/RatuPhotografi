<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">        	 
        <div class="col-md-8 compose-right">
            <div class="inbox-details-default">
                <div class="inbox-details-heading">
                        Laporan Transaksi Penjualan
                    </div>
                <div class="inbox-details-body">
                    <form class="com-mail" method="post" target="_blank" action="<?php echo site_url('Report/kasir_trans_report'); ?>">
                        <div class="input-group date form_date col-md-6" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input  size="10" type="text" name="start" placeholder="Start">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar"></i>                                    
                            </span>
                        </div>
                        <div class="input-group date form_date col-md-6" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                            <input size="10" type="text" name="end" placeholder="End">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-calendar"></i>                                    
                            </span>
                        </div>
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
<?php $this->load->view('./sidebar'); ?>
<script type="text/javascript">
    $('.form_date').datetimepicker({
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