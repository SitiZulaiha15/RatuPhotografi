<?php $this->load->view('./header'); ?>
<div class="inner-block">
    <div class="blank">
        <h2>Data Transaksi</h2> 
        <?php
        $cetak = "";
        if ($this->session->userdata('cetak')) {
            $cetak = $this->session->userdata('cetak');
        }
        if ($trans == 0) {
            ?>        
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
                            <input name="id" type="text"  placeholder="Kode Transaksi :" required="" value="<?php echo $cetak; ?>">
                            <input type="submit" value="Cari" name="cari"> 
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php
        if (!empty($trans)) {
//            print_r($trans);
            $pjw = null;
            $dl = "";
            foreach ($trans as $row) {
                $pjw = $row->id_pj;
                $dl = $row->deadline;
                ?>
                <div class="col-md-12 compose-right">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Pelanggan</th>
                                    <th>Nomor Telepon</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $row->atas_nama; ?></td>
                                    <td><?php echo $row->no_telp; ?></td>
                                    <td><?php echo $row->tgl; ?></td>
                                    <td><?php echo $row->stat_byr; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 compose-right">
                    <form method="post" action="<?php echo site_url('Frontline/save_order'); ?>">
                        <div class="panel-group" id="accordion">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                            <div class="alert alert-info">
                                                <span class="glyphicon glyphicon-plus"></span>
                                                Penanggungjawab
                                            </div>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <div class="input-group date form_date col-md-6" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                            <input name="deadline" class="form-control" size="10" type="text" name="start" placeholder="Deadline" 
                                                   <?php if ($pjw <> "") { ?> value="<?php echo $dl; ?>" <?php } ?>>
                                            <span class="input-group-addon">
                                                <i class="glyphicon glyphicon-calendar"></i>                                    
                                            </span>
                                        </div>
                                        <select class="form-control form-control-lg" name="pj">
                                            <option value="0">Pilih Penanggungjwab</option>
                                            <?php foreach ($pj as $p) { ?>
                                                <option value="<?php echo $p->id_staf; ?>"
                                                        <?php if ($pjw == $p->id_staf) { ?>selected<?php } ?>
                                                        ><?php echo $p->nm_staf; ?></option>
                                                    <?php } ?>
                                        </select>  
                                        <input type="hidden" name="nota" value="<?php echo $row->no_nota; ?>">
                                        <input type="hidden" name="id_trans" value="<?php echo $row->id_trans; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            <div class="alert alert-info">
                                                <span class="glyphicon glyphicon-plus"></span>
                                                Daftar Barang
                                            </div>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <form method="post" action="<?php echo site_url('Frontline/save_order'); ?>">
                                            <div class="col-md-3">
                                                <fieldset>
                                                    <legend> File Biasa </legend>
                                                    <table class="table table-hover">
                                                        <?php
                                                        foreach ($biasa as $b) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" class="checkbox" name="barang[]" value="<?php echo $b->kd_brg ?>">
                                                                </td>
                                                                <td>
                                                                    <?php echo $b->nm_brg; ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </fieldset>
                                                <fieldset>
                                                    <legend> File Prewed </legend>
                                                    <table class="table table-hover">
                                                        <?php
                                                        foreach ($prewed as $p) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" class="checkbox" name="barang[]" value="<?php echo $p->kd_brg ?>">
                                                                </td>
                                                                <td>
                                                                    <?php echo $p->nm_brg; ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-3">
                                                <fieldset>
                                                    <legend> File Keluarga </legend>
                                                    <table class="table table-hover">
                                                        <?php
                                                        foreach ($klg as $k) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" class="checkbox" name="barang[]" value="<?php echo $k->kd_brg ?>">
                                                                </td>
                                                                <td>
                                                                    <?php echo $k->nm_brg; ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </fieldset>
                                                <fieldset>
                                                    <legend> File Member Khusus </legend>
                                                    <table class="table table-hover">
                                                        <?php
                                                        foreach ($m_khusus as $mk) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" class="checkbox" name="barang[]" value="<?php echo $mk->kd_brg ?>">
                                                                </td>
                                                                <td>
                                                                    <?php echo $mk->nm_brg; ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-3">
                                                <fieldset>
                                                    <legend> Member Biasa </legend>
                                                    <table class="table table-hover">
                                                        <?php
                                                        foreach ($m_biasa as $mb) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" class="checkbox" name="barang[]" value="<?php echo $mb->kd_brg ?>">
                                                                </td>
                                                                <td>
                                                                    <?php echo $mb->nm_brg; ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </fieldset>
                                                <fieldset>
                                                    <legend> Cetak </legend>
                                                    <table class="table table-hover">
                                                        <?php
                                                        foreach ($cetakx as $c) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <input type="checkbox" class="checkbox" name="barang[]" value="<?php echo $c->kd_brg ?>">
                                                                </td>
                                                                <td>
                                                                    <?php echo $c->nm_brg; ?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </table>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="submit" name="">
                                            </div>
                                    </div>

                                </div>
                            </div>
                            <!--                    <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h4 class="panel-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-plus"></span> What is CSS?</a>
                                                        </h4>
                                                    </div>
                                                    <div id="collapseThree" class="panel-collapse collapse">
                                                        <div class="panel-body">
                                                            <p>CSS stands for Cascading Style Sheet. CSS allows you to specify various style properties for a given HTML element such as colors, backgrounds, fonts etc. <a href="https://www.tutorialrepublic.com/css-tutorial/" target="_blank">Learn more.</a></p>
                                                        </div>
                                                    </div>
                                                </div>-->
                        </div>
                    </form>
                </div>
                <?php
            }
        }
        ?>

        <div class='col-sm-12' style="height: 1000px"></div>
        <div class="clearfix"> </div> 
    </div>
</div>
<?php $this->load->view('./sidebar'); ?>
<script>
    $(document).ready(function () {
        $(".collapse.in").each(function () {
            $(this).siblings(".panel-heading").find(".glyphicon").addClass("glyphicon-minus").removeClass("glyphicon-plus");

        });
        $(".collapse").on('show.bs.collapse', function () {
            $(this).parent().find(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");

        }).on('hide.bs.collapse', function () {
            $(this).parent().find(".glyphicon").removeClass("glyphicon-minus").addClass("glyphicon-plus");
        });
        $('#accordion').on('shown.bs.collapse', function () {
            //https://www.bootply.com/101026#
            var panel = $(this).find('.in');

            $('html, body').animate({
                scrollTop: panel.offset().top - 100
            }, 1000);

        });
    });
</script>
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