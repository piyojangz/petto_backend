<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Social Billing</title> 
        <link href="<?= base_url("res/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css"/>
        <!-- Loading Bootstrap -->
        <link href="<?= base_url("res/dist/css/vendor/bootstrap.min.css") ?>" rel="stylesheet">

        <!-- Loading Flat UI Pro -->
        <link href="<?= base_url("res/dist/css/flat-ui-pro.css") ?>" rel="stylesheet" type="text/css"/>

        <!-- Custom -->
        <link href="<?= base_url("res/css/custom.css") ?>" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <div class="row">
                    <div class="logo">
                        <img src="http://www.rochubeauty.com//public/images/logo_white.png"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="text-center head-section">Billing Detail</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="nav nav-list">
                            <li class="nav-header">รายการสินค้า</li>  
                            <li>
                                <a href="#fakelink">
                                    ชุดทดลอง 5 ชิ้น
                                    <span class="badge pull-right">930.00฿ x 5</span>
                                </a>
                            </li>
                            <li>
                                <a href="#fakelink">
                                    เซรั่มลอกฝ้า Rochu White
                                    <span class="badge pull-right">490.00฿ x 1</span>
                                </a>
                            </li>
                            <li>
                                <a href="#fakelink">
                                    ครีมบำรุงผิวเนื้อแมทท์
                                    <span class="badge pull-right">590.00฿ x 1</span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li class="nav-header">สรุปยอด</li>
                            <li>
                                <a href="#fakelink">
                                    +ค่าจัดส่ง
                                    <span class="badge pull-right">50.00฿</span>
                                </a>
                            </li> 
                            <li class="active">
                                <a href="#fakelink">
                                    ยอดที่ต้องชำระ
                                    <span class="badge pull-right">5,780.00฿</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <h4 class="text-center head-section payment">Payment Method</h4>
                <div class="col-xs-12">
                    <label class="bank" for="checkbox1"> 
                        <input name="paymenttype"  type="radio" id="checkbox1" checked/>
                        <img src="http://www.magazinedee.com/share/images/icon_payment_kbank.gif " style="width: 30px; height: 30px;">
                        ธนาคาร กสิกรไทย ประเภท ออมทรัพย์ สาขามหาวิทยาลัยเกษตรศาสตร์ บางเขน ชื่อบัญชี ชนิกานต์ สงวนพันธุ์ เลขที่บัญชี 694-2-09854-3
                    </label> 
                    <label class="bank" for="checkbox3"> 
                        <input name="paymenttype" type="radio" id="checkbox3"/>
                        <img src="http://ext.truemoney.com/m/info/addmoney/instruction/images/logo-scb.png " style="width: 30px; height: 30px;">
                        ธนาคาร ไทยพานิชย์ ประเภท ออมทรัพย์ สาขามหาวิทยาลัยเกษตรศาสตร์ บางเขน ชื่อบัญชี ชนิกานต์ สงวนพันธุ์ เลขที่บัญชี 694-2-09854-3
                    </label> 
                    <a href="<?= base_url("order/payment/011547")?>" class="btn btn-hg btn-block btn-primary">แจ้งชำระเงิน</a>
                </div><!-- /.demo-col -->

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
    <script type="text/javascript" src="<?= base_url("res/bootstrap/js/bootstrap.min.js") ?>"></script>


    <script>

    </script>
</html>
