<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Perdbill.co บริการเปิดบิลสั่งสินค้าและชำระเงินผ่านไลน์</title> 
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
                    <h4 class="text-center head-section userdetail " style="margin-top: 50px;">Login</h4>
                </div>
            </div>

            <div class="row" id="fulladdress">
                <?php if (!$login): ?>
                    <div class="alert alert-info" id="passwordnotmath">
                        <button type="button" class="close fui-cross" data-dismiss="alert"></button>
                        ชื่อผู้ใช้ / รหัสผ่านผิดพลาด
                    </div>
                <?php endif; ?>
                <div class="col-xs-12"> 
                    <form  action="" method="post" enctype="multipart/form-data"> 
                        <div class="row mbl">
                            <div class="col-lg-12">
                                <input type="email" value="" name="email" placeholder="Email address" class="form-control input-sm" required>
                            </div>
                        </div>



                        <div class="row mbl">
                            <div class="col-lg-12"> 
                                <input type="password" value="" name="password" placeholder="Confirm Password" class="form-control input-sm" required>
                            </div>
                        </div>
                        <button class="btn btn-lg btn-embossed btn-primary" style="width: 100%;">
                            เข้าใช้งาน
                        </button>

                    </form>
                    <hr/>
                    <p  class="text-center"><a href="<?= base_url("register") ?>" >ยังไม่มีบัญชี? คลิกที่นี่เพื่อไปหน้าสมัครสมาชิก</a></p>
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
        });


        function init() {


            $(".overlay-loader").hide();
        }
    </script>
</html>
