<?php $this->load->view('header'); ?>
<div class="inner-block">
    <div class="blank">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a data-toggle="tab" href="#tab_input"><strong>Input Booking Foto</strong></a></li>
            <li><a data-toggle="tab" href="#tab_jadwal"><strong>Jadwal Booking</strong></a></li>
        </ul>

        <div class="tab-content">
            <div id="tab_input" class="tab-pane fade in active">
                <?php $this->load->view('book/tab_input'); ?>
            </div>
            <div id="tab_jadwal" class="tab-pane fade">
                <h2 style="padding-bottom: 10px">Jadwal</h2>                
                <?php $this->load->view('book/tab_jadwal'); ?>
            </div>
        </div>

        <div class="clearfix"> </div> 
    </div>
</div>
<?php $this->load->view('sidebar'); ?>
<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: "yyyy-mm-dd hh:ii",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "top-left"
    }
    );
    $('.form_date').datetimepicker({
        format: "yyyy-mm-dd",
        language: 'id',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $("#btnCariJadwal").click(function () {
        $.ajax({
            url: "<?php echo base_url(); ?>Book/jadwal_booking",
            type: "POST",
            data: $('#formJadwal').serialize(),
            success: function (data)
            {
                $('#jadwalBooking').html(data);
                return false;
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
            }
        });
    });
    $("#btnInput").click(function () {
        $.ajax({
            url: "<?php echo base_url(); ?>Book/input_booking",
            type: "POST",
            dataType: "JSON",
            data: $('#inputBooking').serialize(),
            success: function (data)
            {
                alert("Data Booking Berhasil Ditambahkan");
                window.location.assign("<?php echo site_url('Book') ?>");
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Input Data Booking Gagal, Silahkan coba lagi!');
                return false;
            }
        });
    });

</script>