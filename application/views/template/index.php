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
                        <?php if ($islogin): ?>
                            <li class="startusing"><a href="<?= base_url("account/$token") ?>">จัดการร้านค้า</a></li>
                            <li><a href="<?= base_url("logout") ?>">ออกจากระบบ</a></li>
                        <?php else: ?>
                            <li class="startusing"><a href="<?= base_url("login") ?>">เริ่มใช้เลยฟรี!</a></li>
                        <?php endif; ?>

                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        <div class="container">

        </div> 
        <div class="mtl pbl">
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
    <script src="https://npmcdn.com/bootstrap@4.0.0-alpha.5/dist/js/bootstrap.min.js"></script
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
