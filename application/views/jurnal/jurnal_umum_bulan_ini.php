<div class="container"  >
    <div class="row">
        <div class="modal fade left" id="laporan_jurnal" tabindex="-1" > 
            <div class="modal-dialog" style="width: auto; margin: 2%; height: 10% "> 
                <div class="modal-content"> 
                    <div class="modal-header">  
                        <button onclick="return test()" type="button" class="close" data-dismiss="modal" aria-hidden="true" title="Close">
                            <span class="glyphicon glyphicon-remove"></span>
                        </button> 
                        <h3 class="center-block">Laporan Jurnal Umum</h3>
                    </div> 
                    <div class="modal-body">
                        <a class="cetak" style="text-align: right" href="#" onclick="printDiv('print_jurnal')">
                            <span class="glyphicon glyphicon-print" style="width: 20px; height: 20px"></span> cetak
                        </a><br />
                        <table style="margin: 0 auto; color: #000;" class="table table-condensed table-striped">
                            <tr style="text-align: left;  background: #FC8213">
                                <td><b>No</b></td>
                                <td><b>No Nota</b></td>
                                <td><b>Tanggal</b></td>
                                <td><b>Akun</b></td>
                                <td><b>Debit</b></td>
                                <td><b>Kredit</b></td>
                                <td><b>History</b></td>
                                <td><b>Keterangan</b></td>
                            </tr>

                            <?php
                            $i = 1;
                            $total = 0;
                            foreach ($jurnal_umum_sekarang as $value) {
                                $histori = $total + $value->Debit - $value->Kredit;
                                ?><tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $value->no_nota ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($value->tanggal)) ?></td>
                                    <td><?php echo $value->Akun ?></td>
                                    <td><?php echo buatrp($value->Debit) ?></td>
                                    <td><?php echo buatrp($value->Kredit) ?></td>
                                    <td><?php echo buatrp($histori) ?></td>
                                    <td><?php echo $value->ket ?></td>
                                </tr>
                                <?php
                                $i++;
                                $total = $histori; 
                            }
                            ?>
                            <tr style="background: #838383;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total Debit</td>
                                <td>Total Kredit</td>
                                <td colspan="2">Total Kas</td>
                            </tr>
                            <tr style="background: #838383;">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <b><?php
                                    foreach ($total_debit as $value) {
                                        echo buatrp($value->totalDebit);
                                    }
                                    ?>
                                </b>
                            </td>
                            <td>
                                <b><?php
                                foreach ($total_kredit as $value) {
                                    echo buatrp($value->totalKredit);
                                }
                                ?>
                            </b>
                        </td>
                        <td ><b><?php echo buatrp($total_kas) ?></b></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div> 
    </div> 
</div>
</div>
</div>
<div id="print_jurnal" style="visibility: hidden"> 
    <div class="modal-header" style="text-align: center">  
        <h3 class="center-block">Laporan Jurnal Umum</h3>
    </div> 
    <table style="margin: 0 auto; color: #000;" class="table table-condensed table-striped">
        <tr style="text-align: left;  background: #FC8213">
            <td><b>No</b></td>
            <td><b>No Nota</b></td>
            <td><b>Tanggal</b></td>
            <td><b>Akun</b></td>
            <td><b>Debit</b></td>
            <td><b>Kredit</b></td>
            <td><b>History</b></td>
            <td><b>Keterangan</b></td>
        </tr>

        <?php
        $i = 1;
        foreach ($jurnal_umum_sekarang as $value) {
            ?><tr>
                <td><?php echo $i ?></td>
                <td><?php echo $value->no_nota ?></td>
                <td><?php echo $value->tanggal ?></td>
                <td><?php echo $value->Akun ?></td>
                <td><?php echo buatrp($value->Debit) ?></td>
                <td><?php echo buatrp($value->Kredit) ?></td>
                <td><?php echo buatrp($value->Kredit) ?></td>
                <td><?php echo $value->ket ?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
        <tr style="background: #838383;">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total Debit</td>
            <td>Total Kredit</td>
            <td colspan="2">Total Kas</td>
        </tr>
        <tr style="background: #838383;">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>
                <b><?php
                foreach ($total_debit as $value) {
                    echo buatrp($value->totalDebit);
                }
                ?>
            </b>
        </td>
        <td>
            <b><?php
            foreach ($total_kredit as $value) {
                echo buatrp($value->totalKredit);
            }
            ?>
        </b>
    </td>
    <td ><b><?php echo buatrp($total_kas) ?></b></td>
    <td></td>
</tr>
</table>
</div> 
<style>
@media print
{    
    .cetak, .cetak *
    {
        display: none !important;
    }
}
</style>
<script>
    function test() {
        $('#laporan_jurnal').hide();
        $('.modal-backdrop').hide();
    }
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }</script>