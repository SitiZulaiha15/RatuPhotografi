<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">       
            <div class="col-md-8 compose-right">
                <div class="inbox-details-default">
                    <div class="inbox-details-heading">
                        Laporan Data Orderan
                    </div>
                    <div class="inbox-details-body">
                        <form class="com-mail" method="post" action="<?php echo site_url('Report/kasir_order'); ?>">
                            <div class="input-group date form_date col-md-6" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <input  size="10" type="text" name="tgl" placeholder="Tanggal">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-calendar"></i>                                    
                                </span>
                            </div>
                            <input type="submit" value="Simpan"> 
                        </form>
                    </div>
                </div>
            </div>
        <?php if ($report <> 0) {
            ?>
            <div class="col-lg-12">
                <br>
                <h2>Data Orderan <?php echo $this->Etc->tgl($start); ?> </h2>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Orderan</th>  
                                <th>Jml</th>
                                <th>Atas Nama</th>
                                <th>Nomor Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($report as $r) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $r->nm_brg; ?></td>
                                    <td><?php echo $r->jml; ?></td>
                                    <td><?php echo $r->atas_nama; ?></td>
                                    <td><?php echo $r->no_telp; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?> 
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