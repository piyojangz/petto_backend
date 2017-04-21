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
        <div class="overlay-loader">
            <div class="bg"></div>
            <div class="container">
                <div class="loader"></div>
                <p>กรุณารอสักครู่ระบบกำลังดำเนินการ...</p>
            </div>
        </div>
        <div class="container">
            <div class="header">
                <div class="row">
                    <div class="logo">
                        <img src="<?= $merchant->image ?>"/>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-xs-12">
                    <h4 class="text-center head-section userdetail">Tracking</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-list">
                        <li class="nav-header">รายการสินค้า</li>  
                        <?php foreach ($items as $item): ?>
                            <?php if ($obj->getamount($orderdetail, $item->id) > 0): ?>
                                <li> 
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <span class="itemname"><?= $item->name ?></span> <br/>  <span class="itemprice"><?= number_format($item->price, 2, '.', ','); ?></span>
                                        </div>
                                        <div class="col-xs-4 text-right"> 
                                            <span class="badge">จำนวน <?= $obj->getamount($orderdetail, $item->id) ?></span>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?> 
                        <li class="divider"></li>
                        <li class="nav-header">สรุปยอด</li>
                        <li>
                            <a href="#fakelink">
                                +ค่าจัดส่ง
                                <span class="badge pull-right"><?= number_format($merchant->deliverycharge, 2, '.', ',') ?>฿</span>
                            </a>
                        </li> 
                        <li class="active">
                            <a href="#fakelink">
                                ยอดที่ต้องชำระ
                                <span class="badge pull-right" id="total"><?= number_format($order->total, 2, '.', ',') ?>฿</span>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li class="nav-header">ข้อมูลการชำระเงิน</li>
                        <li class="active">
                            <p style="font-size: 14px;width: 100%;">เวลา <?= $order->paymentinfo ?></p>
                            <div class="clearfix"></div>
                        </li>
                        <li class="active">
                            <p style="font-size: 14px;width: 100%;"><?= $obj->getpaymentmethoddetail($order->paymentmethodid); ?></p>
                            <div class="clearfix"></div>
                        </li>
                        <li class="active">
                            <p style="font-size: 14px;width: 100%;">เวลา <?= $order->paymentinfo ?></p>
                            <div class="clearfix"></div>
                        </li>
                        <?php if ($order->slipimage != ""): ?>
                            <li class="active">
                                <p style="font-size: 14px;width: 100%;"><img style="max-width: 100%;" src="<?= base_url($order->slipimage) ?>" /></p>
                                <div class="clearfix"></div>
                            </li>
                        <?php endif; ?>
                        <li class="divider"></li>
                        <li class="nav-header">ข้อมูลผู้สั่ง</li>
                        <li class="active">
                            <p style="font-size: 14px;width: 100%;"><?= $custdetail->fullname ?> <br/><i class="fa fa-phone-square"></i> <?= $custdetail->tel ?></p>
                            <div class="clearfix"></div>

                        </li>
                        <li class="divider"></li>
                        <li class="nav-header">ที่อยู่สำหรับจัดส่ง</li>
                        <li class="active">
                            <p style="font-size: 14px;width: 100%;"><?= $order->billingaddress ?></p>
                            <div class="clearfix"></div>

                        </li>
                        <?php if ($canedit): ?>

                            <li class="divider"></li>
                            <li class="nav-header">ยืนยันการชำระเงิน</li>
                            <li class="active">
                                <div class="row"  >
                                    <div class="col-xs-12 text-center" style="margin-top: 20px;"> 
                                        <button class="btn btn-embossed btn-primary" id="btnconfirmpaid"  <?= $order->status == "2" ? 'disabled' : '' ?> >
                                            คลิกเพื่อยืนยัน
                                        </button>
                                        </select>
                                    </div>
                                </div>
                            </li>

                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="row"  >
                <div class="col-xs-12 text-center" style="margin-top: 50px;">
                    <?php if ($order->status == "1"): ?>
                        <h7 id="headpaid"><i class="fa fa-warning"></i> กำลังรอตรวจสอบยอดเงิน...</h7>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning" style="width: 70%;"></div>
                        </div>
                    <?php elseif ($order->status == "2"): ?>
                        <h7><i class="fa fa-check-circle"></i> ยืนยันการชำระเงินแล้ว...</h7>
                        <div class="progress">
                            <div class="progress-bar" style="width: 100%;"></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>


            <!-- Switch with customized icons -->

        </div>
        <div class="mtl pbl" >
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
    <script type="text/javascript" src="<?= base_url("res/dist/js/flat-ui-pro.js") ?>"></script>  
    <script type="text/javascript" src="<?= base_url("res/dist/js/bootstrap-switch.js") ?>"></script> 
    <script type="text/javascript" src="<?= base_url("res/bootstrap/js/bootstrap.min.js") ?>"></script> 


    <script>
        $(document).ready(function () {
            init();
            $("#btnconfirmpaid").click(function () {

                if (confirm('คุณต้องการยืนยันใช่หรือไม่?')) {
                    $(".overlay-loader").show();
                    var orderid = "<?= $order->id ?>";
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('service/confirmpayment'); ?>",
                        data: {'orderid': orderid},
                        dataType: "json",
                        success: function (data) {
                            if (data) {
                                $(".progress-bar").removeClass("progress-bar-warning");
                                $(".progress-bar").css({width: "100%"});
                                $("#headpaid").html("<i class=\"fa fa-check-circle\"></i> ยืนยันการชำระเงินแล้ว...");
                                $("#btnconfirmpaid").attr("disabled", "disabled");

                            }
                            $(".overlay-loader").hide();
                        },
                        error: function (XMLHttpRequest) {
                            $(".overlay-loader").hide();
                        }
                    });

                }
            });
        });


        function init() {
            $(".overlay-loader").hide();
        }
    </script>
</html>
