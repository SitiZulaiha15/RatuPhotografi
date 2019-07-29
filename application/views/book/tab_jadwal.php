<div class="row">
    <div class='col-sm-6'>
        <div class="alert alert-info">
            Masukkan Tanggal Untuk Melihat Jadwal
        </div>
        <form method="post" id="formJadwal">
            <div class="form-group">
                <div class='input-group date form_date' id='datetimepicker3'>
                    <input type='text' class="form-control" name="tgl"/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div> 
                
            </div>
            <input type="button" value="Cari" class="btn btn-warning" id="btnCariJadwal"> 
        </form>
    </div>
    <div class="col-sm-12" id="jadwalBooking">
    </div>
    <div class='col-sm-12' style="height: 500px"></div>
</div>