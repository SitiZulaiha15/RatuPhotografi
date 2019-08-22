

<!--<div class="copyrights">-->
<!--    <p>© 2016 Shoppy. All Rights Reserved | Design by  <a href="http://w3layouts.com/" target="_blank">W3layouts</a> </p>-->
<!--</div>	-->
<!--COPY rights end here-->
</div>
</div>
<!--slider menu-->
<?php
$sess = $this->session->userdata('staf_ratu_lv');
?>

<div class="sidebar-menu">
    <div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
            <!--<img id="logo" src="" alt="Logo"/>--> 
        </a> </div>		  
    <div class="menu">
        <ul id="menu" >

            <!--<li id="menu-home" ><a href="<?php echo site_url('Dashboard'); ?>"><i class="fa fa-home"></i><span>Dashboard</span></a></li>-->
            <?php
            
            if ($sess == 2 || $sess == 3) {
                ?>
                <li id="menu-home" ><a href="<?php echo site_url('Frontline/antrian'); ?>"><i class="fa fa-list-ol"></i><span>Antrian</span></a></li>
                <li id="menu-home" ><a href="<?php echo site_url('Job'); ?>"><i class="fa fa-flag-checkered"></i><span>Job</span></a></li> 
            <?php } else if ($sess == 6 || $sess == 1) { ?>
                <li id="menu-home" ><a href="<?php echo site_url('Frontline/antrian_cs'); ?>"><i class="fa fa-list-ol"></i><span>Antrian</span></a></li>
                <li id="menu-home" ><a href="<?php echo site_url('Job'); ?>"><i class="fa fa-floppy-o"></i><span>Job</span></a></li>
                <li><a href="#"><i class="fa fa-users"></i><span>Member</span><span class="fa fa-angle-right" style="float: right"></span></a>
                    <ul>
                        <li><a href="<?php echo site_url('Crud/m_list'); ?>">Data Member</a></li>
                        <li><a href="<?php echo site_url('Crud/m_list_id/0'); ?>">Daftar</a></li>
                        
                    </ul>
                </li>
                <?php
            }
            if ($sess == 3) {
                ?>
                <li id="menu-home" ><a href="<?php echo site_url('Report/kinerja_period'); ?>"><i class="fa fa-tachometer"></i><span>Data Kinerja</span></a></li>
                <?php
            }
            if ($sess == 1) {
                ?>
                <li><a href="#"><i class="fa fa-database"></i><span>Olah Data</span><span class="fa fa-angle-right" style="float: right"></span></a>
                    <ul>
                        <li><a href="<?php echo site_url('Crud/b_list'); ?>">Data Barang</a></li>
                        <li><a href="<?php echo site_url('Crud/bb_list'); ?>">Data Bahan Baku</a></li>		            
                        <li><a href="<?php echo site_url('Crud/k_list'); ?>">Data Karyawan</a></li>		            
                        <li><a href="<?php echo site_url('Crud/m_list'); ?>">Data Member</a></li>		            
                        <li><a href="<?php echo site_url('Crud/g_list'); ?>">Data Group</a></li>		            
                        <li><a href="<?php echo site_url('Crud/kat_list'); ?>">Data Kategori</a></li>		            
                        <li><a href="<?php echo site_url('Crud/s_list'); ?>">Data Status Kerja</a></li>	
                        <li><a href="<?php echo site_url('Report/pelanggan'); ?>">Download Laporan Pelanggan</a></li> 
                    </ul>
                </li>
                <?php
            }
            if ($sess == 4 || $sess == 1) {
                ?>
                <li><a href="#"><i class="fa fa-bullhorn"></i><span>Stok</span><span class="fa fa-angle-right" style="float: right"></span></a>
                    <ul>
                        <li><a href="<?php echo site_url('Stok/door_index'); ?>">Update Stok Bahan Baku</a></li>
                        <li><a href="<?php echo site_url('Stok/door_stok_in'); ?>">Bahan Baku Masuk</a></li>
                        <li><a href="<?php echo site_url('Report/limit_bb'); ?>">Limit Bahan Baku</a></li>
                        <li><a href="<?php echo site_url('Report/stok_now'); ?>">Data Bahan Baku</a></li>
                                               
                    </ul>
                </li>
<!--                <li><a href="#"><i class="fa fa-book"></i><span>Report</span><span class="fa fa-angle-right" style="float: right"></span></a>
                    <ul>
                        		            
                        	            
                    </ul>
                </li>-->
            <?php
            }
            if ($sess == 6 || $sess == 1) {
                ?>
                <li id="menu-home" ><a href="<?php echo site_url('Frontline'); ?>"><i class="fa fa-camera"></i><span>Layanan</span></a></li>
                <li id="menu-home" ><a href="<?php echo site_url('Frontline/ready_cetak'); ?>"><i class="fa fa-print"></i><span>Siap Cetak</span></a></li>
                <!--<li id="menu-home" ><a href="<?php echo site_url('Frontline/ambil'); ?>"><i class="fa fa-barcode"></i><span>Pengambilan</span></a></li>-->
            <?php
            }
            if ($sess == 5 || $sess == 1) {
                ?>
                <li><a href="#"><i class="fa fa-cogs"></i><span>Report Kasir</span><span class="fa fa-angle-right" style="float: right"></span></a>
                    <ul>
                        <li><a href="<?php echo site_url('Report/kasir_order'); ?>">Orderan</a></li>
                        <li><a href="<?php echo site_url('Report/kasir_pj'); ?>">Return</a></li>
                        <li><a href="<?php echo site_url('Report/kasir_rinci'); ?>">Rincian Penjualan</a></li>		            
                        <li><a href="<?php echo site_url('Report/kasir_trans'); ?>">Transaksi</a></li>
                        <li><a href="<?php echo site_url('Report/kinerja_period'); ?>">Data Kinerja Karyawan</a></li>
                        <li><a href="<?php echo site_url('hutang'); ?>" target="_blank">Hutang Pelanggan</a></li>
                        <li><a href="<?php echo site_url('diskon'); ?>">Diskon</a></li>
                        <li><a href="<?php echo site_url('pj'); ?>">Laporan Penjualan</a></li>
                    </ul>
                </li>
                <li id="menu-home" ><a href="<?php echo site_url('Kasir'); ?>"><i class="fa fa-money"></i><span>Kasir</span></a></li>
                <li id="menu-home" ><a href="<?php echo site_url('Jurnal'); ?>"><i class="fa fa-line-chart"></i><span>Jurnal Keuangan</span></a></li>
                
<?php } ?>
        </ul>
    </div>
</div>
<div class="clearfix"> </div>
</div>
<!--slide bar menu end here-->
<script>
    var toggle = true;

    $(".sidebar-icon").click(function () {
        if (toggle)
        {
            $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
            $("#menu span").css({"position": "absolute"});
        }
        else
        {
            $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
            setTimeout(function () {
                $("#menu span").css({"position": "relative"});
            }, 400);
        }
        toggle = !toggle;
    });
</script>
<!--scrolling js-->
<script src="<?php echo base_url() ?>/assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo base_url() ?>/assets/js/scripts.js"></script>
<!--//scrolling js-->
<script src="<?php echo base_url() ?>/assets/js/bootstrap.js"></script>
<!-- mother grid end here-->
<script type="text/javascript" src="<?php echo base_url('assets/date_picker_bootstrap/js/bootstrap-datetimepicker.js') ?>" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url('assets/date_picker_bootstrap/js/locales/bootstrap-datetimepicker.id.js') ?>" charset="UTF-8"></script>

<!--<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>-->
<script src="<?php echo base_url() ?>/assets/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>/assets/datatables/dataTables.bootstrap4.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTable').DataTable();
        $('#dataTables').DataTable();
        $('.dataTabless').DataTable();
    });
</script>
<script src="<?php echo base_url(); ?>assets/loading/loading.js"></script>
</body>
</html>