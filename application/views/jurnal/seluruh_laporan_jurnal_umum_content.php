<a href="<?php echo site_url('jurnal') ?>">
    <span class="glyphicon glyphicon-arrow-left"></span>
</a>
<div style="text-align: center">
    <h3>Laporan Seluruh Jurnal Umum</h3>
    <br />
</div>
<table style="margin: 0 auto; color: #000; width: 100%" class="table table-condensed table-striped">
    <th>No</th>
    <th>No Nota</th>
    <th style="width: 10%">Tanggal</th>
    <th style="width: 15%">Debit</th>
    <th style="width: 15%">Kredit</th>
    <th style="width: 15%">History</th>
    <th>Keterangan</th>
    <?php
    $i = 1;
    foreach ($seluruh_jurnal as $value) {
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $value->no_nota ?></td>
            <td><?php echo $value->tanggal ?></td>
            <td><?php echo buatrp($value->Debit) ?></td>
            <td><?php echo buatrp($value->Kredit) ?></td>
            <td><?php echo 'history' ?></td>
            <td><?php echo $value->ket ?></td>
        </tr>
        <?php
        $i++;
    }
    ?>
    <tr style="background: #337AB7; color: #fff">
        <td colspan=4 style="text-align: right;">
            <b>Total Debit Seluruh</b>
        </td>
        <td>
            <b>Total Kredit Seluruh</b>
        </td>
        <td colspan=2>
            <b>Total Kas Seluruh</b>
        </td>
    </tr>
    <tr style="background: #337AB7; color: #fff">
        <td colspan=4 style="text-align: right">
            <b><?php echo buatrp($total_debit) ?></b>
        </td>
        <td>
            <b><?php echo buatrp($total_kredit) ?></b>
        </td>
        <td colspan=2>
            <b>Total Kas Seluruh</b>
        </td>
    </tr>
</table>
<a href="#print" class="float"> 
    <i class="fa fa-print my-float"onclick="return printDiv('print')"></i>
</a>