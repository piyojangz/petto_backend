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
    <body class="nopadding">
        <div class="overlay-loader">
            <div class="bg"></div>
            <div class="container">
                <div class="loader"></div>
                <p>กรุณารอสักครู่ระบบกำลังดำเนินการ...</p>
            </div>
        </div>

        <div class="register-header-fixed">
            <div class="row">
                <div class="col-xs-12">
                    <h5>เปิดบิล - สมัครสมาชิก</h5> 
                </div>
            </div>

        </div>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 text-center">
                    <h4>ยินดีต้อนรับเข้าสู่ Perdbill</h4> 
                    <p>ตัวช่วยสำหรับนักขายบนไลน์</p> 
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 text-center">
                    <div class="panel panel-info panel-login-box">
                        <div class="panel-heading text-center">
                            เข้าสู่ระบบด้วย Line Account
                        </div>
                        <div class="panel-body">

                        </div>

                    </div>
                </div>
            </div>
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
