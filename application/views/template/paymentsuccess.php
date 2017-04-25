<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Perdbill.co - บริการเปิดบิลสินค้าผ่านไลน์ ใครๆก็ทำได้</title> 
        <meta name="description" content="บริการเปิดบิลจาก <?= $merchant->name ?> ปลอดภัย สะดวก รวดเร็ว">
        <link href="<?= base_url("res/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css"/>
        <!-- Loading Bootstrap -->
        <link href="<?= base_url("res/dist/css/vendor/bootstrap.min.css") ?>" rel="stylesheet">

        <!-- Loading Flat UI Pro -->
        <link href="<?= base_url("res/dist/css/flat-ui-pro.css") ?>" rel="stylesheet" type="text/css"/>

        <!-- Custom -->
        <link href="<?= base_url("res/css/custom.css") ?>" rel="stylesheet" type="text/css"/>   
    </head>
    <body>

        <div class="container mb">
            <div class="header">
                <div class="row">
                    <div class="logo">
                        <img src="<?= $merchant->image ?>"/>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-xs-12">
                    <h4 class="text-center head-section userdetail">Thank you</h4>
                </div>
            </div>

            <div class="row" style="margin-top:50px;">
                <div class="col-xs-12 text-center">
                    <h4>การสั่งซื้อสินค้าเสร็จเรียบร้อย</h4>
                    <h5>Thank you!</h5>
                </div>
            </div>
        </div>
        <div class="mtl pbl" style="position: absolute; bottom: 0px;width: 100%;">
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
    <script type="text/javascript" src="<?= base_url("res/bootstrap/js/bootstrap.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("res/dist/js/flat-ui-pro.js") ?>"></script> 
    <script type="text/javascript" src="<?= base_url("res/js/prettify.js") ?>"></script> 
    <script type="text/javascript" src="<?= base_url("res/js/application-docs.js") ?>"></script>    



</html>
