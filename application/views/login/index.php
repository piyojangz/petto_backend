<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url("res/account/plugins/images/favicon.png") ?>">
    <title>Perdbill | เข้าสู่ระบบ</title>
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
    <!--alerts CSS -->
    <link href="<?= base_url("res/account/plugins/bower_components/sweetalert/sweetalert.css") ?>" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= base_url("res/account/plugins/bower_components/dropify/dist/css/dropify.min.css") ?>">
    <!-- Popup CSS -->
    <link href="<?= base_url("res/account/plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css") ?>" rel="stylesheet">
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
<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="new-login-register" style="overflow-y: scroll;">
        <div class="lg-info-panel">
            <div class="inner-panel">
                <a href="<?= base_url() ?>" class="p-20 di"><img src="<?= base_url("res/account/plugins/images/admin-logo.png")  ?>" style="width: 50px;">  </a>
                <div class="lg-content">
                    <h2>Perdbill - เปิดบิล</h2>
                    <p class="text-muted">บริการเปิดบิลผ่าน LINE BOT ง่ายต่อการขายของออนไลน์ สะดวกต่อนักขายมืออาชีพ</p>
                    <a href="<?= base_url("register") ?>" class="btn btn-rounded   p-l-20 p-r-20 btn-success" style="background: #21bf64;
    border: 1px solid #1db15c;">ต้องการสมัครสามาชิก?</a>
                </div>
            </div>
        </div>
        <div class="new-login-box"> 
            <div class="white-box">
                <?php if (!$login): ?> 

                    <div class="alert alert-success" id="passwordnotmath">  
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        ชื่อผู้ใช้ / รหัสผ่านผิดพลาด
                    </div>
                <?php endif; ?>
                <h3 class="box-title m-b-0" style="font-weight: bold;">เข้าสู่ระบบจัดการร้าน</h3> 
                <form  class="form-horizontal new-lg-form" id="loginform" action="" method="post" enctype="multipart/form-data"> 
                    <div class="form-group  m-t-20">
                        <div class="col-xs-12">
                            <label style="font-weight: bold;">อีเมลล์</label>
                            <input class="form-control" type="text" name="email" required placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label style="font-weight: bold;">รหัสผ่าน</label>
                            <input class="form-control" type="password" name="password" required placeholder="Password" >
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">

                            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> ลืมรหัสผ่าน?</a> </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block  text-uppercase waves-effect waves-light" type="submit">เข้าสู่ระบบ</button>
                        </div>
                    </div>
                    <!--                    <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                                <div class="social"><a href="javascript:void(0)" class="btn  btn-facebook" data-toggle="tooltip"  title="Login with Facebook"> <i aria-hidden="true" class="fa fa-facebook"></i> </a> <a href="javascript:void(0)" class="btn btn-googleplus" data-toggle="tooltip"  title="Login with Google"> <i aria-hidden="true" class="fa fa-google-plus"></i> </a> </div>
                                            </div>
                                        </div>-->
                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p  class="text-center">ยังไม่มีบัญชี? <a class="text-primary m-l-5" href="<?= base_url("register") ?>" style="font-weight: bold;"> คลิกที่นี่ </a> เพื่อไปหน้าสมัครสมาชิก</p> 
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" id="recoverform" action="index.html">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>            


    </section>
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
