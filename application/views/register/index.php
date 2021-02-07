<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url("res/account/plugins/images/favicon.png") ?>">
    <title>Petto | เข้าสู่ระบบ</title>
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
                <a href="<?= base_url() ?>" class="p-20 di"><img src="https://pettodemo.web.app/assets/images/icon/logo/petto_logo.png" style="width: 150px;"></a>
                <div class="lg-content">
                    <h2>Petto.co</h2>
                    <p class="text-muted">บริการร้านค้าออนไลน์สำหรับซื้อขายสัตว์เลี้ยง</p>
                    <a href="<?= base_url("login") ?>" class="btn btn-rounded  p-l-20 p-r-20 btn-success" style="background: #21bf64;
    border: 1px solid #1db15c;">ต้องการเข้าสู่ระบบ?</a>
                </div>
            </div>
        </div>
        <div class="new-login-box" style="margin-top: 5%;">
            <div class="white-box">
                <!-- Alert Info -->
                <div class="alert alert-warning alert-dismissable" id="passwordnotmath">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    กรุณาระบุพาสเวิร์ดให้ตรงกัน
                </div>
                <div class="alert alert-warning alert-dismissable" id="passwordincorrectformat">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    พาสเวิร์ดต้องมีมากกว่า 8 ตัวอักษร
                    และต้องมีอย่างน้อย 1 ตัวเลข, ตัวอักษรภาษาอังกฤษพิมพ์เล็กหรือพิมพ์ใหญ่
                </div>

                <div class="alert alert-warning alert-dismissable" id="termandcond">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    กรุณาใส่เครื่องหมายถูกหน้ายอมรับเงื่อนไข
                </div>


                <?php if ($emaildoesexit) : ?>
                    <div class="alert alert-success alert-dismissable" id="passwordnotmath">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        อีเมลล์นี้มีผู้ใช้งานแล้ว
                    </div>
                <?php endif; ?>
                <?php if ($webnamedoesexit) : ?>
                    <div class="alert alert-success alert-dismissable" id="passwordnotmath">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        ร้านค้านี้ผู้ใช้งานแล้ว
                    </div>
                <?php endif; ?>
                <?php if ($register) : ?>
                    <div class="alert alert-success" id="passwordnotmath">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        สมัครสมาชิกเรียบร้อย <a href="<?= base_url("login") ?>">คลิกที่นี่</a> เพื่อไปหน้าเข้าสู่ระบบ
                    </div>
                <?php endif; ?>
                <h3 class="box-title m-b-0" style="font-weight: bold;">สมัครสมาชิก</h3>

                <form class="form-horizontal new-lg-form" action="" method="post" enctype="multipart/form-data" id="formsubmit">
                    <div class="form-group  m-t-20">
                        <div class="col-xs-12">
                            <label style="font-weight: bold;">อีเมลล์</label>
                            <input class="form-control" type="email" name="email" required placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group  m-t-20">
                        <div class="col-xs-12">
                            <label style="font-weight: bold;">Line ID</label>
                            <input class="form-control" type="text" name="lineid" required placeholder="Line ID">
                        </div>
                    </div>
                    <div class="form-group  m-t-20">
                        <div class="col-xs-12">
                            <label style="font-weight: bold;">ชื่อ</label>
                            <input class="form-control" type="text" name="firstname" id="firstname" required placeholder="ชื่อจริง">  
                        </div>
                    </div>
                    <div class="form-group  m-t-20">
                        <div class="col-xs-12">
                            <label style="font-weight: bold;">นามสกุล</label>
                            <input class="form-control" type="text" name="lastname" id="lastname" required placeholder="นามสกุล">  
                        </div>
                    </div>
                    <div class="form-group  m-t-20">
                        <div class="col-xs-12">
                            <label style="font-weight: bold;">เบอร์โทรศัพท์</label>
                            <input class="form-control" type="text" name="tel" id="tel" required placeholder="เบอร์โทรศัพท์มือถือ">  
                        </div>
                    </div>
                    <div class="form-group  m-t-20">
                        <div class="col-xs-12">
                            <label style="font-weight: bold;">ชื่อร้าน</label>
                            <input class="form-control" type="tel" name="name" id="name" required placeholder="ชื่อร้าน">
                            <input name="webname" id="webname" type="hidden">
                            <i class="text-success" id="shopname"></i>
                        </div>
                    </div>
                    <div class="form-group  m-t-20">
                        <div class="col-xs-12">
                            <label style="font-weight: bold;">รายละเอียดร้านค่้า</label>
                            <input class="form-control" type="name" name="name" id="name" required placeholder="รายละเอียด">
                        </div>
                    </div>
                    <div class="form-group">

                        <div class="col-xs-12">
                            <p><code> พาสเวิร์ดต้องมีมากกว่า 8 ตัวอักษร
                                    และต้องมีอย่างน้อย 1 ตัวเลข, ตัวอักษรภาษาอังกฤษพิมพ์เล็กหรือพิมพ์ใหญ่
                                </code></p>
                            <label style="font-weight: bold;">รหัสผ่าน</label>
                            <input class="form-control" type="password" name="password" id="password" required placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label style="font-weight: bold;">ยืนยันรหัสผ่าน</label>
                            <input class="form-control" type="password" name="confirmpassword" id="confirmpassword" required placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="checkbox checkbox-primary p-t-0">
                                <input id="checkbox-signup" type="checkbox" checked>
                                <label for="checkbox-signup"> ฉันทราบเงื่อนไขแล้ว</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block  text-uppercase waves-effect waves-light" type="submit">สมัครสมาชิก
                            </button>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p class="text-center">มีบัญชีอยู่แล้ว? <a class="text-danger m-l-5" href="<?= base_url("login") ?>" style="font-weight: bold;"> คลิกที่นี่ </a>
                                เพื่อไปหน้าล็อคอิน</p>
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
    <script>
        $(document).ready(function() {
            init();
            $("#formsubmit").submit(function() {
                if ($("#password").val() != $("#confirmpassword").val()) {
                    $("#passwordnotmath").show();
                    return false;
                }
                if (!checkPassword($("#password").val())) {
                    $("#passwordincorrectformat").show();
                    return false;
                }
                if (!$("#checkbox-signup").is(':checked')) {
                    $("#termandcond").show();
                    return false;
                }
                return true;
            });

            $('#name').bind('input', function() {
                $(this).val(function(_, v) {
                    var name = v.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '');
                    $("#shopname").html(name);
                    $("#webname").val(name);

                    return v.replace(/[^a-z0-9\s]/gi, '');
                });
            });
        });

        function checkPassword(str) {
            // at least one number, one lowercase and one uppercase letter
            // at least 8 characters
            var re = /(?=.*\d)(?=.*[a-z]).{8,}/;
            return re.test(str);
        }

        function init() {
            $("#passwordnotmath").hide();
            $("#passwordincorrectformat").hide();
            $("#termandcond").hide();
            $(".overlay-loader").hide();
        }
    </script>
    <script>


    </script>
</body>

</html>