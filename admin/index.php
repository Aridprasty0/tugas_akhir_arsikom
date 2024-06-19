<?php
require_once '../setting/crud.php';
require_once '../setting/koneksi.php';
require_once '../setting/tanggal.php';
require_once '../setting/fungsi.php';

session_start();
if (isset($_SESSION['admin'])){
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Sistem Informasi Geografis - Pemetaan Gempa </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="../assets/images/happy_34670.ico">

        <!-- DataTables -->
        <link href="../assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>

         <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap core CSS -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <!-- MetisMenu CSS -->
        <link href="../assets/css/metisMenu.min.css" rel="stylesheet">
        <!-- Icons CSS -->
        <link href="../assets/css/icons.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="../assets/css/style.css" rel="stylesheet">

        <style type="text/css">
        .twitter-bmkg-btn {
            height: 48px; width: 48px; background: #000000; position: absolute; right: 0; bottom: 8px; border-radius: 50%;
        }
        .twitter-bmkg-btn:hover {
            cursor: pointer;
        }
        #main-content.shrinked {
            width: 65%; margin-right: 0; margin-left: 0;
        }
        #twitter-content {
            width: 35%; height: 100%; position: absolute; right: 0; top: 0; z-index: -1;
        }
        #twitter-content.show {
            z-index: 0;
        }
        </style>
    </head>
    <body>

        <div id="page-wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="">
                        <a href="#" class="logo">
                        <!--
                            <img src="../assets/images/logo.png" alt="logo" class="logo-lg" />
                            <img src="../assets/images/logo_sm.png" alt="logo" class="logo-sm hidden" />
                            -->
                        </a>
                    </div>
                </div>

                <!-- Top navbar -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                        <h4 align="center">Sistem Informasi Pemetaan Gempa</h4>
                         <h4 align="center">Provinsi NTB</h4>
                            <!-- Mobile menu button -->
                            <div class="pull-left">
                                <button type="button" class="button-menu-mobile visible-xs visible-sm">
                                    <i class="fa fa-bars"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                        </div>

                         <div class="twitter-bmkg-btn">
                             <img src="../assets/images/bmkg.jpg" style="width: 100%; border-radius: 50%;" />
                         </div>
                    </div> <!-- end container -->
                </div> <!-- end navbar -->
            </div>
            <!-- Top Bar End -->


            <!-- Page content start -->
            <div class="page-contentbar">
                <!--left navigation start-->
                <aside class="sidebar-navigation">
                    <div class="scrollbar-wrapper">
                        <div>
                            <button type="button" class="button-menu-mobile btn-mobile-view visible-xs visible-sm">
                                <i class="mdi mdi-close"></i>
                            </button>
                            <!-- User Detail box -->
                            <div class="user-details">
                                <div class="pull-left">
                                    <img src="../assets/images/users/admin.png" alt="" class="thumb-md img-circle">
                                </div>
                                <div class="user-info">
                                    <a href="?hal=profil"><?php echo caridata($mysqli,"select username from admin where idadmin='".$_SESSION['admin']."'") ?></a>
                                    <p class="text-muted m-0">Administrator</p>
                                </div>
                            </div>
                            <!--- End User Detail box -->

                            <!-- Left Menu Start -->
                            <ul class="metisMenu nav" id="side-menu">
                                <li><a href="?hal=beranda"><i class="ti-home"></i> Dashboard </a></li>
                                <li><a href="?hal=kabupaten"><i class="ti-import"></i> Kabupaten </a></li>
                                <li><a href="?hal=gempa"><i class="ti-tag"></i> Gempa </a></li>
                                <li><a href="?hal=kontak"><i class="ti-info"></i> Kontak </a></li>
                                
                                <li><a href="logout.php"><i class="ti-power-off"></i> Log Out </a></li>
                            </ul>
                        </div>
                    </div><!--Scrollbar wrapper-->
                </aside>
                <!--left navigation end-->

                <!-- START PAGE CONTENT -->
                <div id="page-right-content">
                    <div class="container">
                    <div id="main-content">
                <?php
                $hal = @$_GET['hal'];
                $modul = "";
                $default = $modul."beranda.php";
                if(!$hal){
                    require_once "$default";
                }else{
                    switch($hal){
                        case $hal:
                        if(is_file($modul.$hal.".php"))
                        {
                            require_once $modul.$hal.".php";
                        }
                        else
                        {
                            require_once "$default";
                        }
                        break;
                        default:
                        require_once "$default";
                    }
                }

                ?>
                </div>
                    <div id="twitter-content" style="padding-top: 77px;">
                        <a class="twitter-timeline" data-height="500" style="width: 100%;" href="https://twitter.com/infoBMKG?ref_src=twsrc%5Etfw">
                            Tweets by infoBMKG
                        </a> 
                    </div>
                    </div>
                    <!-- end container -->

<!--                     <div class="footer">
                        <div>
                             <strong>SPK - Kelayakan Ikan</strong> - Copyright &copy; 2018
                        </div>
                    </div> --> <!-- end footer -->

                </div>
                <!-- End #page-right-content -->

            </div>
            <!-- end .page-contentbar -->
        </div>
        <!-- End #page-wrapper -->



        <!-- js placed at the end of the document so the pages load faster -->
        <script src="../assets/js/jquery-2.1.4.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/metisMenu.min.js"></script>
        <script src="../assets/js/jquery.slimscroll.min.js"></script>
        <script src="../assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        
        <!-- Datatable js -->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="../assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="../assets/plugins/datatables/jszip.min.js"></script>
        <script src="../assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="../assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="../assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.print.min.js"></script>

        <script src="../assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.scroller.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.colVis.js"></script>
        <script src="../assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>

        <!-- init -->
        <script src="../assets/pages/jquery.datatables.init.js"></script>

        <!-- App Js -->
        <script src="../assets/pages/jquery.form-advanced.init.js"></script>
        <script src="../assets/js/jquery.app.js"></script>

        <script type="text/javascript">
            $(".twitter-bmkg-btn").click(function() {
                if (!$("#main-content").hasClass("shrinked")) {
                    $("#main-content").addClass("shrinked")
                    $("#twitter-content").addClass("show")
                } else {
                    $("#main-content").removeClass("shrinked")
                    $("#twitter-content").removeClass("show")
                }
            })
        </script>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </body>
</html>
<?php
}else{
    echo "<script>window.location='../index.php';</script>";
}
?>