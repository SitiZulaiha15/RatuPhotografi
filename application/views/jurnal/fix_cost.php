<table style="margin: 0 auto;color: #000" class="table table-responsive table-condensed">
    <th colspan="5" style="text-align: center; background: #327AB7; color: #fff; padding-left: 150px;">Jurnal Umum</th>
    <th style="width: 1%; text-align: right; background: #327AB7; color: #fff" colspan="2">
        <a title="Lihat Seluruh Sumber Dana" style="color: #fff" href="<?php echo site_url('jurnal/seluruhSumberDana') ?>" target="_blank"><span class="glyphicon glyphicon-collapse-down"></span></a>
    </th>
    <tr style="width: 20%">
        <?php foreach ($jurnal_value as $value) { ?>
        <td style="width: 18%"><?php echo $value->nama_tempat ?></td>
        <?php } ?>
        <td>Tanggal</td>
        <td style="width: 15%">Total Uang</td>
    </tr>
    <tr>
        <tr>
            <?php foreach ($jurnal_value as $value) { ?>
            <td><?php echo buatrp($value->saldo) ?></td>
            <?php } ?>
            <td><?php echo $date_now ?></td>
            <?php foreach ($total_saldo as $value) { ?>
            <td colspan="2"><?php echo buatrp($value->total) ?></td>
            <?php } ?>
        </tr>
    </tr>
</table>
<hr />
<br />
<div class="container">
    <div class="row">
        <div class="modal fade left" id="history" tabindex='-1'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" title="Close">
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                        <h3 class="center-block">Seluruh History Sumber Dana</h3>

                    </div>
                    <div class="modal-body">
                        <form method="POST" target="_blank" action="<?php echo site_url('jurnal/seluruh_history_sumbe_Dana') ?>">
                            <table class="table">
                                <tr>
                                    <td>Pilih History Sumber Dana yang Akan Ditamppilkan</td>
                                </tr>
                                <tr>
                                    <td ><br /> 
                                        <select class="form-control form-control-lg" name="sumber_dana">
                                            <?php
                                            $i = 0;
                                            foreach ($sumber_dana as $value) {
                                                ?>
                                                <option value="<?php echo $value->kode; ?>"><?php echo $value->nama_tempat; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr style="text-align: center">
                                        <td colspan=4>
                                            <button class="btn btn-neutral" style="background: #68AE00; color: #fff">Tampilkan</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a data-toggle="modal" data-target="#history" class="float" title="history keuangan"> 
        <i class="fa fa-history my-float "onclick="return printDiv('print')"></i>
    </a>
    <!--<legend><b>Pemindahan Uang</b></legend>-->
    <h4 class="panel-title">
        <a style="text-decoration: none" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
            <div class="btn btn-neutral form-control" style="background-color: #68AE00; color: #fff">
                Pemindahan Uang 
                <div style="float: right">
                    <span class="glyphicon glyphicon-plus"></span>
                </div>
            </div>
        </a>
    </h4>
    <div id="collapseOne" class="panel-collapse collapse">
        <div class="panel-body">
            <?php $this->load->view('jurnal/pindah_uang_fix_cost') ?>
        </div>
    </div>
    <style>
    .float {
        position: fixed;
        width: 60px;
        height: 60px;
        bottom: 40px;
        right: 40px;
        background-color: #FC8213;
        color: #FFF;
        border-radius: 50px;
        text-align: center;
        box-shadow: 2px 2px 3px #999;
    }

    .my-float {
        margin-top: 22px;
    }
</style>