<!DOCTYPE HTML>
<html>
    <head>
        <title>Ratu Photography</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Shoppy Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <link href="<?php echo base_url() ?>/assets/css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
        <!-- Custom Theme files -->
        <link href="<?php echo base_url() ?>/assets/css/style.css" rel="stylesheet" type="text/css" media="all"/>
        <!--js-->
        <script src="<?php echo base_url() ?>/assets/js/jquery-2.1.1.min.js"></script> 
        <!--icons-css-->
        <link href="<?php echo base_url() ?>/assets/css/font-awesome.css" rel="stylesheet"> 
        <!--Google Fonts-->
        <link href='//fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Work+Sans:400,500,600' rel='stylesheet' type='text/css'>
        <!--//skycons-icons-->
        <script type="text/javascript">
            var auto_refresh = setInterval(
                    function () {
                        $('#load_content').load('<?php echo site_url('Notif'); ?>').fadeIn("slow");
                    }, 1000); // refresh setiap 10000 milliseconds

        </script>
        <link href="<?php echo base_url() ?>/assets/css/demo-page.css" rel="stylesheet" media="all">
        <link href="<?php echo base_url() ?>/assets/css/hover.css" rel="stylesheet" media="all">
        <!--pop up strat here-->
        <script src="<?php echo base_url() ?>/assets/js/jquery.magnific-popup.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
                $('.popup-with-zoom-anim').magnificPopup({
                    type: 'inline',
                    fixedContentPos: false,
                    fixedBgPos: true,
                    overflowY: 'auto',
                    closeBtnInside: true,
                    preloader: false,
                    midClick: true,
                    removalDelay: 300,
                    mainClass: 'my-mfp-zoom-in'
                });

            });
        </script>
        <!--pop up end here-->
        <link href="<?php echo base_url() ?>/assets/date_picker_bootstrap/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
        <!--radio di kasir-->
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/segmented-controls.css" type="text/css">
        <!--table-->
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/css/dataTables.bootstrap.css') ?>">
        <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/checkbox-bootstrap.css">
        <script type="text/javascript" src="<?php echo base_url() ?>/assets/js/bootstrap-notify.js"></script>
        <script src="<?php echo base_url('assets/maskMoney/jquery.maskMoney.min.js') ?>"></script>
        <?php
        $sess_lev = $this->session->userdata('staf_ratu_lv');
        $sess_id = $this->session->userdata('staf_ratu_id');
        if ($sess_lev == 2) {
            ?>
            <script type="text/javascript">
                var msg = function () {
                    var http = new XMLHttpRequest();
                    var url = "<?php echo site_url('Notif/recieve/') ?>";
                    var params = "untuk=<?php echo $sess_id; ?>";
                    http.open("POST", url, true);

                    //Send the proper header information along with the request
                    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                    http.onreadystatechange = function () {//Call a function when the state changes.
                        if (http.readyState == 4 && http.status == 200) {
                            var response = http.responseText;
                            if (response == "kosong") {
                                // $.notify('kosong');
                            } else {
                                var res = response.split("_");
                                var msg = "New Job";
                                $.notify({
                                    // options
                                    message: msg
                                }, {
                                    // settings
                                    type: 'info',
                                    delay: 0
                                });
                                document.getElementById('msg').innerHTML = msg;
                                updateStatus(res[0]);
                                var audio = new Audio('<?php echo base_url('assets/audio/bell_2.mp3') ?>');
                                audio.play();
                            }
                        }
                    }
                    http.send(params);
                }

                function updateStatus(id) {
                    var http = new XMLHttpRequest();
                    var url = "<?php echo site_url('Notif/update') ?>";
                    var params = "status=1&id=" + id;
                    http.open("POST", url, true);

                    //Send the proper header information along with the request
                    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

                    http.onreadystatechange = function () {//Call a function when the state changes.
                        if (http.readyState == 4 && http.status == 200) {
                            var response = http.responseText;
                            if (response == "kosong") {
                                // $.notify('kosong');
                            } else {
                                console.log(response);
                            }
                        }
                    }
                    console.log(params);
                    http.send(params);
                }

                setInterval(msg, 1000);
            </script>
        <?php } ?>

    </head>
    <body>	
        <div id="msg"></div>
        <div class="page-container">	
            <div class="left-content">
                <div class="mother-grid-inner">
                    <!--header start here-->
                    <div class="header-main">
                        <div class="header-left">
                            <div class="logo-name">
                                <a href="index.html"> <h1>Ratu</h1> 
                                    <!--<img id="logo" src="" alt="Logo"/>--> 
                                </a> 								
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <div class="header-right">
                            <div class="profile_details_left"><!--notifications of menu start -->
                                <ul class="nofitications-dropdown">
                                    <li class="dropdown head-dpdn" style="visibility:hidden">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">3</span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="notification_header">
                                                    <h3>You have 3 new messages</h3>
                                                </div>
                                            </li>
                                            <li><a href="#">
                                                    <div class="user_img"><img src="<?php echo base_url() ?>/assets/images/p4.png" alt=""></div>
                                                    <div class="notification_desc">
                                                        <p>Lorem ipsum dolor</p>
                                                        <p><span>1 hour ago</span></p>
                                                    </div>
                                                    <div class="clearfix"></div>	
                                                </a></li>
                                            <li class="odd"><a href="#">
                                                    <div class="user_img"><img src="<?php echo base_url() ?>/assets/images/p2.png" alt=""></div>
                                                    <div class="notification_desc">
                                                        <p>Lorem ipsum dolor </p>
                                                        <p><span>1 hour ago</span></p>
                                                    </div>
                                                    <div class="clearfix"></div>	
                                                </a></li>
                                            <li><a href="#">
                                                    <div class="user_img"><img src="<?php echo base_url() ?>/assets/images/p3.png" alt=""></div>
                                                    <div class="notification_desc">
                                                        <p>Lorem ipsum dolor</p>
                                                        <p><span>1 hour ago</span></p>
                                                    </div>
                                                    <div class="clearfix"></div>	
                                                </a></li>
                                            <li>
                                                <div class="notification_bottom">
                                                    <a href="#">See all messages</a>
                                                </div> 
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown head-dpdn" style="visibility:hidden">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="notification_header">
                                                    <h3>You have 3 new notification</h3>
                                                </div>
                                            </li>
                                            <li><a href="#">
                                                    <div class="user_img"><img src="<?php echo base_url() ?>/assets/images/p5.png" alt=""></div>
                                                    <div class="notification_desc">
                                                        <p>Lorem ipsum dolor</p>
                                                        <p><span>1 hour ago</span></p>
                                                    </div>
                                                    <div class="clearfix"></div>	
                                                </a></li>
                                            <li class="odd"><a href="#">
                                                    <div class="user_img"><img src="<?php echo base_url() ?>/assets/images/p6.png" alt=""></div>
                                                    <div class="notification_desc">
                                                        <p>Lorem ipsum dolor</p>
                                                        <p><span>1 hour ago</span></p>
                                                    </div>
                                                    <div class="clearfix"></div>	
                                                </a></li>
                                            <li><a href="#">
                                                    <div class="user_img"><img src="<?php echo base_url() ?>/assets/images/p7.png" alt=""></div>
                                                    <div class="notification_desc">
                                                        <p>Lorem ipsum dolor</p>
                                                        <p><span>1 hour ago</span></p>
                                                    </div>
                                                    <div class="clearfix"></div>	
                                                </a></li>
                                            <li>
                                                <div class="notification_bottom">
                                                    <a href="#">See all notifications</a>
                                                </div> 
                                            </li>
                                        </ul>
                                    </li>	
                                    <li class="dropdown head-dpdn" style="visibility:hidden">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">9</span></a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <div class="notification_header">
                                                    <h3>You have 8 pending task</h3>
                                                </div>
                                            </li>
                                            <li><a href="#">
                                                    <div class="task-info">
                                                        <span class="task-desc">Database update</span><span class="percentage">40%</span>
                                                        <div class="clearfix"></div>	
                                                    </div>
                                                    <div class="progress progress-striped active">
                                                        <div class="bar yellow" style="width:40%;"></div>
                                                    </div>
                                                </a></li>
                                            <li><a href="#">
                                                    <div class="task-info">
                                                        <span class="task-desc">Dashboard done</span><span class="percentage">90%</span>
                                                        <div class="clearfix"></div>	
                                                    </div>
                                                    <div class="progress progress-striped active">
                                                        <div class="bar green" style="width:90%;"></div>
                                                    </div>
                                                </a></li>
                                            <li><a href="#">
                                                    <div class="task-info">
                                                        <span class="task-desc">Mobile App</span><span class="percentage">33%</span>
                                                        <div class="clearfix"></div>	
                                                    </div>
                                                    <div class="progress progress-striped active">
                                                        <div class="bar red" style="width: 33%;"></div>
                                                    </div>
                                                </a></li>
                                            <li><a href="#">
                                                    <div class="task-info">
                                                        <span class="task-desc">Issues fixed</span><span class="percentage">80%</span>
                                                        <div class="clearfix"></div>	
                                                    </div>
                                                    <div class="progress progress-striped active">
                                                        <div class="bar  blue" style="width: 80%;"></div>
                                                    </div>
                                                </a></li>
                                            <li>
                                                <div class="notification_bottom">
                                                    <a href="#">See all pending tasks</a>
                                                </div> 
                                            </li>
                                        </ul>
                                    </li>	
                                </ul>
                                <div class="clearfix"> </div>
                            </div>
                            <!--notification menu end -->
                            <div class="profile_details">		
                                <ul>
                                    <li class="dropdown profile_details_drop">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <div class="profile_img">	
                                                <span class="prfil-img"><img src="<?php echo base_url() ?>/assets/images/man (1).png" alt=""> </span> 
                                                <div class="user-name">
                                                    <p><?php echo $this->session->userdata('staf_ratu_name'); ?></p>
                                                    <span><?php
                                                        $id = $this->session->userdata('staf_ratu_lv');
                                                        echo $this->Login_m->level($id);
                                                        ?></span>
                                                </div>
                                                <i class="fa fa-angle-down lnr"></i>
                                                <i class="fa fa-angle-up lnr"></i>
                                                <div class="clearfix"></div>	
                                            </div>	
                                        </a>
                                        <ul class="dropdown-menu drp-mnu">
                                            <!--<li style="visibility:collapse"> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> -->
                                            <!--<li style="visibility:hidden"> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> -->
                                            <li> <a href="<?php echo site_url('Logout') ?>"><i class="fa fa-sign-out"></i> Logout</a> </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="clearfix"> </div>				
                        </div>
                        <div class="clearfix"> </div>	
                    </div>
                    <!--heder end here-->
                    <!-- script-for sticky-nav -->
                    <script>
                        $(document).ready(function () {
                            var navoffeset = $(".header-main").offset().top;
                            $(window).scroll(function () {
                                var scrollpos = $(window).scrollTop();
                                if (scrollpos >= navoffeset) {
                                    $(".header-main").addClass("fixed");
                                } else {
                                    $(".header-main").removeClass("fixed");
                                }
                            });

                        });
                    </script>
                    <div class="inner-block">
                        <div class="blank">

                            <div class="clearfix"> </div> 
                        </div>
                    </div>
                </div>
            </div>
            <!--slider menu-->
            <div class="sidebar-menu">
                <div class="logo"> <a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="#"> <span id="logo" ></span> 
                        <!--<img id="logo" src="" alt="Logo"/>--> 
                    </a> 
                </div>		  
                <div class="menu">
                    <ul id="menu" >

                        <li id="menu-home" ><a href="<?php echo site_url('Dashboard'); ?>"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
                        <?php
                        $sess = $this->session->userdata('staf_ratu_lv');
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
                                </ul>
                            </li>
                            <?php
                        }
                        if ($sess == 4 || $sess == 1) {
                            ?>
                            <li><a href="#"><i class="fa fa-bullhorn"></i><span>Stok</span><span class="fa fa-angle-right" style="float: right"></span></a>
                                <ul>
                                    <li><a href="<?php echo site_url('Stok'); ?>">Update Stok Bahan Baku</a></li>
                                    <li><a href="<?php echo site_url('Stok/stok_in'); ?>">Bahan Baku Masuk</a></li>		            
                                </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-book"></i><span>Report</span><span class="fa fa-angle-right" style="float: right"></span></a>
                                <ul>
                                    <li><a href="<?php echo site_url('Report/limit_bb'); ?>">Limit Bahan Baku</a></li>
                                    <li><a href="<?php echo site_url('Report/stok_now'); ?>">Data Bahan Baku</a></li>		            
                                    <li><a href="<?php echo site_url('Report/kinerja_period'); ?>">Data Kinerja Karyawan</a></li>		            
                                </ul>
                            </li>
                        <?php }
                        if ($sess == 6 || $sess == 1) {
                            ?>
                            <li id="menu-home" ><a href="<?php echo site_url('Frontline'); ?>"><i class="fa fa-camera"></i><span>Layanan</span></a></li>
                            <li id="menu-home" ><a href="<?php echo site_url('Frontline/ready_cetak'); ?>"><i class="fa fa-print"></i><span>Siap Cetak</span></a></li>
                            <li id="menu-home" ><a href="<?php echo site_url('Frontline/ambil'); ?>"><i class="fa fa-barcode"></i><span>Pengambilan</span></a></li>
                        <?php }
                        if ($sess == 5 || $sess == 1) {
                            ?>
                            <li id="menu-home" ><a href="<?php echo site_url('Kasir'); ?>"><i class="fa fa-money"></i><span>Kasir</span></a></li>            
                            <!--<li id="menu-home" ><a href="<?php echo site_url('Jurnal/input_penjualan'); ?>"><i class="fa fa-pie-chart"></i><span>Jurnal Penjualan</span></a></li>-->
                            <li id="menu-home" ><a href="<?php echo site_url('Jurnal'); ?>"><i class="fa fa-line-chart"></i><span>Jurnal Keuangan</span></a></li>
                            <li><a href="#"><i class="fa fa-cogs"></i><span>Report</span><span class="fa fa-angle-right" style="float: right"></span></a>
                                <ul>
                                    <li><a href="<?php echo site_url('Report/kasir_order'); ?>">Orderan</a></li>
                                    <li><a href="<?php echo site_url('Report/kasir_pj'); ?>">Return</a></li>
                                    <li><a href="<?php echo site_url('Report/kasir_rinci'); ?>">Rincian Penjualan</a></li>		            
                                    <li><a href="<?php echo site_url('Report/kasir_trans'); ?>">Transaksi</a></li>		            
                                </ul>
                            </li>
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
    </body>
</html>