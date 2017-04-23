<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url("res/account/plugins/images/favicon.png") ?>">
        <title>Perdbill | <?= $user["name"] ?></title>
        <!-- Bootstrap Core CSS -->
        <link href="<?= base_url("res/account/bootstrap/dist/css/bootstrap.min.css") ?>" rel="stylesheet">
        <!-- Menu CSS -->
        <link href="<?= base_url("res/account/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css") ?>" rel="stylesheet">
        <!-- toast CSS -->
        <link href="<?= base_url("res/account/plugins/bower_components/toast-master/css/jquery.toast.css") ?>" rel="stylesheet">
        <!-- morris CSS -->
        <link href="<?= base_url("res/account/plugins/bower_components/morrisjs/morris.css") ?>" rel="stylesheet">
        <!-- chartist CSS -->
        <link href="<?= base_url("res/account/plugins/bower_components/chartist-js/dist/chartist.min.css") ?>" rel="stylesheet">
        <link href="<?= base_url("res/account/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css") ?>" rel="stylesheet">
        <!-- Calendar CSS -->
        <link href="<?= base_url("res/account/plugins/bower_components/calendar/dist/fullcalendar.css") ?>" rel="stylesheet" />
        <!-- animation CSS -->
        <link href="<?= base_url("res/account/css/animate.css") ?>" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?= base_url("res/account/css/style.css") ?>" rel="stylesheet">
        <!-- color CSS -->
        <link href="<?= base_url("res/account/css/colors/default.css") ?>" id="theme" rel="stylesheet">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>

    <body class="fix-header">
        <!-- ============================================================== -->
        <!-- Preloader -->
        <!-- ============================================================== -->
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>
        <!-- ============================================================== -->
        <!-- Wrapper -->
        <!-- ============================================================== -->
        <div id="wrapper">
            <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <nav class="navbar navbar-default navbar-static-top m-b-0">
                <div class="navbar-header">
                    <div class="top-left-part">
                        <!-- Logo -->
                        <a class="logo" href="index.html">
                            <!-- Logo icon image, you can use font-icon also --><b>
                                <!--This is dark logo icon--><img src="<?= base_url("res/account/plugins/images/admin-logo.png") ?>" alt="home" class="dark-logo" /><!--This is light logo icon--><img src="<?= base_url("res/account/plugins/images/admin-logo-dark.png") ?>" alt="home" class="light-logo" />
                            </b>
                            <!-- Logo text image you can use text also --><span class="hidden-xs">
                                <!--This is dark logo text--><img src="<?= base_url("res/account/plugins/images/admin-text.png") ?>" alt="home" class="dark-logo" /><!--This is light logo text--><img src="<?= base_url("res/account/plugins/images/admin-text-dark.png") ?>" alt="home" class="light-logo" />
                            </span> </a>
                    </div>
                    <!-- /Logo -->
                    <!-- Search input and Toggle icon -->
                    <ul class="nav navbar-top-links navbar-left">
                        <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="fa fa-envelope"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <ul class="dropdown-menu mailbox animated bounceInDown">
                                <li>
                                    <div class="drop-title text-center">คุณมีการชำระเงินเข้ามาใหม่</div>
                                </li> 
                                <li>
                                    <a class="text-center" href="javascript:void(0);"> <strong>ดูทั้งหมด</strong> <i class="fa fa-angle-right"></i> </a>
                                </li>
                            </ul>
                            <!-- /.dropdown-messages -->
                        </li> 
                    </ul>
                    <ul class="nav navbar-top-links navbar-right pull-right">
                        <li>
                            <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                                <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?= $user["image"] ?>" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?= $user["name"] ?></b><span class="caret"></span> </a>
                            <ul class="dropdown-menu dropdown-user animated flipInY">
                                <li>
                                    <div class="dw-user-box">
                                        <div class="u-img"><img src="<?= $user["image"] ?>" alt="user" /></div>
                                        <div class="u-text">
                                            <h4><?= $user["name"] ?></h4>
                                            <p class="text-muted"><?= $user["email"] ?></p><a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a></div>
                                    </div>
                                </li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="ti-user"></i> ข้อมูลร้านค้า</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="ti-settings"></i> ตั้งค่า</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#"><i class="fa fa-power-off"></i> ออกจากระบบ</a></li>
                            </ul>
                            <!-- /.dropdown-user -->
                        </li>
                        <!-- /.dropdown -->
                    </ul>
                </div>
                <!-- /.navbar-header -->
                <!-- /.navbar-top-links -->
                <!-- /.navbar-static-side -->
            </nav>
            <!-- End Top Navigation -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav slimscrollsidebar">
                    <div class="sidebar-head">
                        <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3> </div>  
                    <ul class="nav" id="side-menu" style="margin-top: 50px;">
                        <li> 
                            <a href="<?= base_url("account/$token/dashboard") ?>" ><i class="icon-graph  fa-fw" data-icon="v"></i> แดชบอร์ด <span class="fa arrow"></span></a> 
                        </li>
                        <li> 
                            <a href="<?= base_url("account/$token/report") ?>"><i class="ti-pie-chart fa-fw" data-icon="v"></i> รายงาน(Beta) <span class="fa arrow"></span></a> 
                        </li>
                        <li> 
                            <a href="<?= base_url("account/$token/customer") ?>"><i class="icon-user fa-fw" data-icon="v"></i> ดูแลลูกค้า <span class="fa arrow"></span></a> 

                        <li class="devider"></li>
                        <li> <a href="javascript:;" ><i class="ti-package fa-fw"></i> <span class="hide-menu">คลังสินค้า<span class="fa arrow"></span></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?= base_url("account/$token/products") ?>"><i class="fa-fw">P</i><span class="hide-menu">สินค้า</span></a></li> 
                            </ul>
                        </li>
                        <li> <a href="javascript:;" ><i class="ti-receipt fa-fw"></i> <span class="hide-menu">ออเดอร์<span class="fa arrow"></span></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?= base_url("account/$token/order/all") ?>"><i class="fa-fw">O</i><span class="hide-menu">ดูแลออเดอร์</span></a></li> 
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Left Sidebar -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page Content -->
            <!-- ============================================================== -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4 class="page-title">แดชบอร์ด</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                            <ol class="breadcrumb">
                                <li class="active"><a href="#" >แดชบอร์ด</a></li> 
                            </ol>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <!-- ============================================================== -->
                    <!-- Different data widgets -->
                    <!-- ============================================================== -->
                    <!-- .row -->
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">บิลทั้งหมด</h3>
                                <ul class="list-inline">
                                    <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">659</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">ชำระเงินแล้ว</h3>
                                <ul class="list-inline">
                                    <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">869</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">ยังไม่ได้ชำระเงิน</h3>
                                <ul class="list-inline two-part">
                                    <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">911</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">รายได้เดือนนี้</h3>
                                <ul class="list-inline"> 
                                    <li class="text-right">  <i class="ti-arrow-up text-success"></i><span class="counter text-success">17,230.00</span>  
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/.row -->


                </div>
                <!-- /.container-fluid -->
                <footer class="footer text-center"> 2017 &copy; Account panel by perdbill.co </footer>
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="<?= base_url("res/account/plugins/bower_components/jquery/dist/jquery.min.js") ?>"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?= base_url("res/account/bootstrap/dist/js/bootstrap.min.js") ?>"></script>
        <!-- Menu Plugin JavaScript -->
        <script src="<?= base_url("res/account/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js") ?>"></script>
        <!--slimscroll JavaScript -->
        <script src="<?= base_url("res/account/js/jquery.slimscroll.js") ?>"></script>
        <!--Wave Effects -->
        <script src="<?= base_url("res/account/js/waves.js") ?>"></script>
        <!--Counter js -->
        <script src="<?= base_url("res/account/plugins/bower_components/waypoints/lib/jquery.waypoints.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/counterup/jquery.counterup.min.js") ?>"></script>
        <!-- chartist chart -->
        <script src="<?= base_url("res/account/plugins/bower_components/chartist-js/dist/chartist.min.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js") ?>"></script>
        <!-- Sparkline chart JavaScript -->
        <script src="<?= base_url("res/account/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js") ?>"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?= base_url("res/account/js/custom.min.js") ?>"></script>
        <script src="<?= base_url("res/account/js/dashboard1.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/toast-master/js/jquery.toast.js") ?>"></script>
        <!--Style Switcher -->
        <script src="<?= base_url("res/account/plugins/bower_components/styleswitcher/jQuery.style.switcher.js") ?>"></script>
    </body>

</html>
