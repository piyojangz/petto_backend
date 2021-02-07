<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Petto.co บริการเปิดบิลสั่งสินค้าและชำระเงินผ่านไลน์</title> 
        <link href="<?= base_url("res/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css"/>
        <!-- Loading Bootstrap -->
        <link href="<?= base_url("res/dist/css/vendor/bootstrap.min.css") ?>" rel="stylesheet">

        <!-- Loading Flat UI Pro -->
        <link href="<?= base_url("res/dist/css/flat-ui-pro.css") ?>" rel="stylesheet" type="text/css"/>

        <!-- Custom -->
        <link href="<?= base_url("res/css/webcustom.css") ?>" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="overlay-loader">
            <div class="bg"></div>
            <div class="container">
                <div class="loader"></div>
                <p>กรุณารอสักครู่ระบบกำลังดำเนินการ...</p>
            </div>
        </div>
        <!-- Static navbar -->
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                    </button>
                    <a class="navbar-brand" href="#">Perdbill.co</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="#">หน้าหลัก</a></li>
                        <li><a href="#about">วิธีใช้งาน</a></li>
                        <li><a href="#contact">ราคา</a></li>
                        <li><a href="#contact">ติดต่อเรา</a></li> 
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="startusing"><a href="<?= base_url("register") ?>">เริ่มใช้เลยฟรี!</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

        <div class="container">



            <div class="row">
                <div class="col-xs-12">
                    <h4 class="text-center head-section userdetail " style="margin-top: 50px;">Register</h4>
                </div>
            </div>

            <div class="row" id="fulladdress">
                <div class="col-xs-12"> 
                    <!-- Alert Info -->
                    <div class="alert alert-info" id="passwordnotmath">
                        <button type="button" class="close fui-cross" data-dismiss="alert"></button>
                        กรุณาระบุพาสเวิร์ดให้ตรงกัน
                    </div>
                    <div class="alert alert-info" id="passwordincorrectformat">
                        <button type="button" class="close fui-cross" data-dismiss="alert"></button>
                        พาสเวิร์ดต้องมีมากกว่า 8 ตัวอักษร
                        และต้องมีอย่างน้อย 1 ตัวเลข, ตัวอักษรภาษาอังกฤษพิมพ์เล็กและพิมพ์ใหญ่
                    </div>

                    <?php if ($emaildoesexit): ?>
                        <div class="alert alert-info" id="passwordnotmath">
                            <button type="button" class="close fui-cross" data-dismiss="alert"></button>
                            อีเมลล์นี้มีผู้ใช้งานแล้ว
                        </div>
                    <?php endif; ?>
                    <?php if ($register): ?>
                        <div class="alert alert-success" id="passwordnotmath">
                            <button type="button" class="close fui-cross" data-dismiss="alert"></button>
                            สมัครสมาชิกเรียบร้อย <a href="<?= base_url("login") ?>">คลิกที่นี่</a> เพื่อไปหน้าเข้าสู่ระบบ
                        </div>
                    <?php endif; ?>

                    <form  action="" method="post"  id="formsubmit"> 
                        <div class="row mbl">
                            <div class="col-lg-12">
                                <input type="email" value="" name="email" placeholder="Email address" class="form-control input-sm" required>
                            </div>
                        </div>

                        <div class="row mbl">

                            <div class="col-lg-12">
                                <p class="ptl mtl">พาสเวิร์ดต้องมีมากกว่า 8 ตัวอักษร
                                    และต้องมีอย่างน้อย 1 ตัวเลข, ตัวอักษรภาษาอังกฤษพิมพ์เล็กและพิมพ์ใหญ่
                                </p>
                                <input required type="password" value="" name="password" id="password" placeholder="Password" class="form-control input-sm">
                            </div>



                        </div>

                        <div class="row mbl">
                            <div class="col-lg-12"> 
                                <input required type="password" value="" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password" class="form-control input-sm">
                            </div>
                        </div>
                        <button class="btn btn-lg btn-embossed btn-primary" style="width: 100%;">
                            Register
                        </button>

                    </form>
                    <hr/>
                    <p  class="text-center"><a href="<?= base_url("login") ?>" >มีบัญชีอยู่แล้ว คลิกที่นี่เพื่อไปหน้าล็อคอิน</a></p>
                </div>
            </div>
        </div> 
        <div class="mtl pbl" style="position: absolute;bottom: 0px; width: 100%;">
            <div class="bottom-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="#fakelink" class="bottom-menu-brand">Powered by ServeWellSolution Co.,ltd.</a>
                        </div>

                        <div class="col-xs-12">
                            <ul class="bottom-menu-iconic-list"> 
                                <i class="fa fa-phone-square" aria-hidden="true"></i> Hotline : 062292917
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- /bottom-menu-inverse -->
        </div>
    </body>
    <script type="text/javascript" src="<?= base_url("res/js/jquery-3.2.0.min.js") ?>"></script>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script src="https://npmcdn.com/bootstrap@4.0.0-alpha.5/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url("res/bootstrap/js/bootstrap.min.js") ?>"></script>
    <script>
        $(document).ready(function () {
            init();
            $("#formsubmit").submit(function () {
                if ($("#password").val() != $("#confirmpassword").val()) {
                    $("#passwordnotmath").show();
                    return false;
                }
                if (!checkPassword($("#password").val())) {
                    $("#passwordincorrectformat").show();
                    return false;
                }
                return true;
            });
        });

        function checkPassword(str)
        {
            // at least one number, one lowercase and one uppercase letter
            // at least 8 characters
            var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/;
            return re.test(str);
        }
        function init() {
            $("#passwordnotmath").hide();
            $("#passwordincorrectformat").hide();
            $(".overlay-loader").hide();
        }
    </script>
</html>
