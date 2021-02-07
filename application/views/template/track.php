<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Perdbill.co - บริการเปิดบิลสินค้าผ่านไลน์ ใครๆก็ทำได้</title>
    <meta name="description" content="บริการเปิดบิลจาก <?= $merchant->name ?> ปลอดภัย สะดวก รวดเร็ว">
    <link href="<?= base_url("res/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url("res/fav/favicon-16x16.png") ?>">
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

<!-- Modal -->
<div class="modal" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close fui-cross" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="imgModalLabel">รายละเอียดสินค้า</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="thumbnail">
                            <img id="itemimg" src="">
                            <div class="caption">
                                <h6 id="itemtitle"></h6>
                                <p id="itemprice"></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>
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
                                <div class="col-xs-8"><img src="<?= $item->image ?>" style="width:40px;"
                                                           class="img img-thumbnail"/>
                                    <span class="itemname"><a href="javascript:;"
                                                              onclick="openimgmodal('<?= $item->name ?>', '<?= $item->image ?>', '<?= number_format($item->price, 2, '.', ','); ?>')"><?= $item->name ?>
                                            <i class="fa fa-external-link-square"
                                               style="    font-size: .7em;  padding-left: 4px;"></i></a></span> <br/>
                                    <span class="itemprice"><?= number_format($item->price, 2, '.', ','); ?></span>
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
                        <span class="badge pull-right"><?= number_format($order->shipingrate, 2, '.', ',') ?>฿</span>
                    </a>
                </li>
                <?php if ($genstatus == 1): ?>
                    <li class="divider"></li>
                    <li class="nav-header">รายการส่วนลด</li>
                    <li>
                        <a href="#fakelink">
                            - ส่วนลดค่าจัดส่ง
                            <span class="badge pull-right"><?= number_format($order->shippingdiscount, 2, '.', ',') ?>
                                ฿</span>
                        </a>
                    </li>
                    <li>
                        <a href="#fakelink">
                            - ส่วนลดค่าสินค้า
                            <span class="badge pull-right"><?= number_format($order->pricediscount, 2, '.', ',') ?>
                                ฿</span>
                        </a>
                    </li>

                <?php endif; ?>
                <li class="active">
                    <a href="#fakelink">
                        ยอดที่ต้องชำระทั้งสิ้น
                        <span class="badge pull-right" id="total"><?= number_format($order->total, 2, '.', ',') ?>
                            ฿</span>
                    </a>
                </li>
                <li class="divider"></li>
                <li class="nav-header">ข้อมูลการชำระเงิน</li>
                <li class="active">
                    <p style="font-size: 14px;width: 100%;">ยอดเงินที่โอน <span class=" badge badge-success" style="background: #449d44;"><?= number_format($order->paymentamount) ?></span></p>
                    <div class="clearfix"></div>
                </li>
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
                        <p style="font-size: 14px;width: 100%;"><img style="max-width: 100%;"
                                                                     src="<?= base_url($order->slipimage) ?>"/></p>
                        <div class="clearfix"></div>
                    </li>
                <?php endif; ?>
                <li class="divider"></li>
                <li class="nav-header">ข้อมูลผู้สั่ง</li>
                <li class="active">
                    <p style="font-size: 14px;width: 100%;"><?= $custdetail->fullname ?> <br/><i
                                class="fa fa-phone-square"></i> <?= $custdetail->tel ?>
                        <br/><i  class="fa fa-envelope-open"></i> <?= $custdetail->email ?></p>

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
                        <div class="row">
                            <div class="col-xs-6 text-center" style="margin-top: 20px;">
                                <button class="btn btn-embossed btn-danger"
                                        id="btncancel" <?= $order->status >= "2" || $order->closestatus == "1" ? 'disabled' : '' ?> >
                                    คลิกเพื่อยกเลิก
                                </button>
                                </select>
                            </div>
                            <div class="col-xs-6 text-center" style="margin-top: 20px;">
                                <button class="btn btn-embossed btn-primary"
                                        id="btnconfirmpaid" <?= $order->status >= "2" || $order->closestatus == "1" ? 'disabled' : '' ?> >
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
    <div class="row">
        <div class="col-xs-12 text-center" style="margin-top: 50px;">
            <?php if ($order->closestatus == "1"): ?>
                <h7><i class="fa fa-close"></i> ออเดอร์ถูกยกเลิก...</h7>
                <div class="progress">
                    <div class="progress-bar  progress-bar-danger" style="width: 100%;"></div>
                </div>
            <?php else: ?>

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

                <?php elseif ($order->status == "3"): ?>
                    <h7><i class="fa fa-send-o"></i> จัดส่งแล้ว...</h7>
                    <div class="progress">
                        <div class="progress-bar progress-bar-warning" style="width: 100%;"></div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>


    <!-- Switch with customized icons -->

</div>
<div class="mtl pbl">
    <div class="bottom-menu">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <a href="#fakelink" class="bottom-menu-brand">Powered by Petto.co</a>
                </div>

                <div class="col-xs-12">
                    <ul class="bottom-menu-iconic-list">
                        <i class="fa fa-phone-square" aria-hidden="true"></i> Hotline : 0863647397
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- /bottom-menu-inverse -->
</div>
</body>
<script type="text/javascript" src="<?= base_url("res/dist/js/vendor/jquery.min.js") ?>"></script>
<script src="<?= base_url("res/dist/js/flat-ui-pro.min.js") ?>"></script>
<script src="<?= base_url("res/js/application.js") ?>"></script>


<script>


    function openimgmodal(name, image, price) {
        $("#itemimg").attr("src", image)
        $("#itemtitle").html(name);
        $("#itemprice").html(price + "฿");
        $('#imgModal').modal('show');
    }
    $(document).ready(function () {
        init();


        $("#btncancel").click(function () {

            if (confirm('คุณต้องการยกเลิกใช่หรือไม่?')) {
                $(".overlay-loader").show();
                var orderid = "<?= $order->id ?>";
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('service/cancelpayment'); ?>",
                    data: {'orderid': orderid},
                    dataType: "json",
                    success: function (data) {
                        if (data) {
                            $(".progress-bar").removeClass("progress-bar-warning");
                            $(".progress-bar").addClass("progress-bar-danger");
                            $(".progress-bar").css({width: "100%"});
                            $("#headpaid").html("<i class=\"fa fa-check-circle\"></i> ยกเลิกรายการแล้ว...");
                            $("#btncancel").attr("disabled", "disabled");
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
                            $("#btncancel").attr("disabled", "disabled");
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
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-39217117-10', 'auto');
    ga('send', 'pageview');

</script>
</html>
