<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<!--    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $merchant->title ?></title>
    <meta name="description" content="<?= $merchant->description ?>">
    <link href="<?= base_url("res/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css"/>
    <!-- Loading Bootstrap -->
    <link href="<?= base_url("res/dist/css/vendor/bootstrap.min.css") ?>" rel="stylesheet">

    <link href="<?= base_url("res/account/css/style.css") ?>" rel="stylesheet">
    <!-- Custom -->
    <link href="<?= base_url("res/css/merchantwebcustom.css") ?>" rel="stylesheet" type="text/css"/>

    <!-- animation CSS -->
    <link href="<?= base_url("res/account/css/animate.css") ?>" rel="stylesheet">


</head>
<body class="nopadding grey">

<header class="header-perdbill" style=" ">
    <div class="container">
        <a href="<?= base_url() ?>" class="logo-perdbill"><img src="<?= base_url("res/img/web-logo.png") ?>"
                                                               style="width: 50px;"/> </a>

        <ul class="nav navbar-nav navbar-right" style="padding-right: 15px;">
            <li class="text-success"><a href="<?= base_url("login") ?>"><i class="fa fa-lock"></i> เข้าสู่ระบบ</a></li>
            <li class="text-success"><a href="<?= base_url("register") ?>"><i class="fa fa-user"></i> สมัครสมาชิก</a>
            </li>
        </ul>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="logo">
                <img src="<?= $merchant->image ?>"/>
                <h1><?= $merchant->name ?></h1>
                <p><?= $merchant->description ?></p>
            </div>
            <div class="menu">
                <ul>
                    <li class="active"><a href="">หน้าหลัก</a></li>
                    <li><a href="">เกี่ยวกับเรา</a></li>
                    <li><a href="">ติดต่อเรา</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <a class="startusing" href="<?= $merchant->lineaddurl ?>">แอดไลน์เพื่อสอบถาม คลิก!</a>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="row">
                <div class="header-index" style="    background: url(<?= $merchant->imagecover ?>);
                        }">

                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="white-box">
                            <?= $merchant->textcustom; ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row el-element-overlay m-b-40 block1">
                        <div class="col-md-12">
                            <?php if ($merchant->billtoken == "" || $merchant->billtoken == null): ?>
                                <div class="text-center">
                                    <div class="badge badge-info">no billiing</div>
                                </div>
                            <?php else: ?>
                                <?php foreach ($items as $item): ?>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="white-box">
                                            <div class="el-card-item">
                                                <div class="el-card-avatar el-overlay-1"
                                                     style="width:100%;overflow: hidden">
                                                    <img
                                                            src="<?= $item->image ?>"/>
                                                    <div class="el-overlay">
                                                        <ul class="el-info">
                                                            <li>
                                                                <a class="btn default btn-outline image-popup-vertical-fit"
                                                                   href="javascript:void(0);"
                                                                   onclick="addremove('remove','<?= $item->id; ?>','<?= $item->name ?>','<?= $item->price ?>')"><i
                                                                            class="ti-minus"></i></a></li>

                                                            <li>
                                                                <a class="btn default btn-outline image-popup-vertical-fit"
                                                                   href="javascript:void(0);"
                                                                   onclick="addremove('add','<?= $item->id; ?>','<?= $item->name ?>','<?= $item->price ?>')"><i
                                                                            class="ti-plus"></i></a></li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="el-card-content">
                                                    <h3 class="box-title text-info"><?= $item->name ?></h3>
                                                    <small>฿<?= number_format($item->price) ?></small>
                                                    <br></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>
</div>


<div class="mtl pbl">

    <div class="bottom-menu">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <img src="<?= base_url("res/img/web-logo.png") ?>" style="width: 50px;"/>
                    <br/> <br/>
                    <a href="<?= base_url() ?>" class="bottom-menu-brand">Powered by Perdbill.co</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12  text-center">
                    <ul class="bottom-menu-iconic-list">
                        <br/>
                        <i class="fa fa-phone-square" aria-hidden="true"></i> Hotline : 062-229-2917
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div> <!-- /bottom-menu-inverse -->
</div>
<div id="billing">
    <div class="billing toogleoff">
        <div class="overlay-loader">
            <div class="bg"></div>
            <div class="container">
                <div class="loader"></div>
                <p>กรุณารอสักครู่ระบบกำลังดำเนินการ...</p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="white-box billpanel">
                    <div onclick="billtoogle(null)" class="btn-toogle"><i
                                class="fa fa-2x fa-arrow-right fa-rotate-180"></i></div>
                    <h3>รายการสินค้า</h3>
                    <div id="cartitems">
                        <div class="row items">
                            <div class="col-xs-8">
                                <h4>เซรั่มท่อคู่ Rochu White</h4>
                            </div>
                            <div class="col-xs-4">
                                <span class="badge">จำนวน 1</span>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xs-12">
                            <h3>สรุปยอด</h3>
                            <div class="row items">
                                <div class="col-xs-8">
                                    + ค่าจัดส่ง
                                </div>
                                <div class="col-xs-4">
                                    <span class="badge" style="margin-top: 0px;" id="shipingrate"></span>
                                    <input type="hidden"   id="shipingratehidden" />
                                </div>
                            </div>
                            <div class="row items summary">
                                <div class="col-xs-8">
                                    ยอดที่ต้องชำระทั้งสิ้น
                                </div>
                                <div class="col-xs-4">
                                    <span class="badge" style="margin-top: 0px;" id="total"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <a class="startusing text-center" style="width: 100%;" href="<?= $merchant->lineaddurl ?>">แอดไลน์เพื่อสอบถาม คลิก!</a>
<!--                        <button type="submit" class="btn btn-hg btn-block    startusing" style="width: 100%">ชำระเงิน-->
<!--                        </button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
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

    function billtoogle(istoogle) {

        if (istoogle == null) {
            console.log(istoogle);
            if ($(".billing").hasClass("toogleoff")) {
                $(".billing").removeClass("toogleoff");
                $(".fa-arrow-right").removeClass("fa-rotate-180");

            }
            else {
                $(".billing").addClass("toogleoff");
                $(".fa-arrow-right").addClass("fa-rotate-180");
            }
        }
        else {
            if (istoogle) {
                $(".billing").removeClass("toogleoff");
                $(".fa-arrow-right").removeClass("fa-rotate-180");
            }
            else {
                $(".billing").addClass("toogleoff");
                $(".fa-arrow-right").addClass("fa-rotate-180");
            }
        }


    }
    function init() {
        $(".overlay-loader").hide();
        var cart = JSON.parse(localStorage.getItem("cart"));
        if (cart != null) {
            if (cart.length > 0) {
                updatecart();
            }
        }
    }

    function updatecart() {
        var cart = JSON.parse(localStorage.getItem("cart"));
        var total = 0;
        var unit = 0;
        var hasitem = false;
        if (cart != null) {
            if (cart.length > 0) {
                var html = "";
                $.each(cart, function (index, value) {
                    if (value.amount > 0) {
                        html += '<div class="row items">';
                        html += '<div class="col-xs-8">';
                        html += '<h4>' + value.name + '</h4>';
                        html += '</div>';
                        html += '<div class="col-xs-4">';
                        html += '<span class="badge">' + value.price + ' x ' + value.amount + '</span>';
                        html += '<div class="amounttool">';
                        html += '<button onclick="addremove(\'add\',\'' + value.itemid + '\',\'' + value.name + '\',\'' + value.price + '\')"><i class="fa fa-plus"></i></button>';
                        html += '<button onclick="addremove(\'remove\',\'' + value.itemid + '\',\'' + value.name + '\',\'' + value.price + '\')"><i class="fa fa-minus"></i></button>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        hasitem = true;
                        total += parseFloat(value.price) * value.amount;
                        unit = unit + value.amount;
                    }
                });

                if (hasitem) {
                    billtoogle(true);
                }
                else {
                    billtoogle(false);
                }
                $("#cartitems").html(html);
            }
        }

        this.getshippingrate('<?=$merchant->id?>', unit, function (price) {
            if (price == 0) {
                $("#shipingrate").html("ฟรี");
                $("#shipingratehidden").val(0);
            } else {
                $("#shipingrate").html(price + "฿");
                $("#shipingratehidden").val(price);
            }

            total = total + parseFloat(price);
            var shippingdiscount = parseFloat($("#shippingdiscounthidden").val() == null ? 0 : $("#shippingdiscounthidden").val());
            var pricediscount = parseFloat($("#pricediscounthidden").val() == null ? 0 : $("#pricediscounthidden").val());
            total = total + shippingdiscount;
            total = total + pricediscount;

            $("#total").html(numberWithCommas(total) + "฿");
            $(".overlay-loader").hide();
        });
    }

    function getshippingrate(merchantid, unit, cb_func) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getshippingrate'); ?>",
            data: {'merchantid': merchantid, 'unit': unit},
            dataType: "json",
            success: function (data) {
                if (data.result != null) {
                    cb_func(data.result.price);
                } else {
                    cb_func('0');
                }


            },
            error: function (XMLHttpRequest) {
                $(".overlay-loader").hide();
            }
        });
    }

    function addremove(command, itemid, name, price) {
        $(".overlay-loader").show();
        $(".billing").removeClass("toogleoff");
        $(".fa-arrow-right").removeClass("fa-rotate-180");
        var hasitem = false;


        var cart = JSON.parse(localStorage.getItem("cart"));
        if (cart != null) {
            for (var i = 0; i < cart.length; i++) {
                if (parseInt(cart[i].itemid) === parseInt(itemid)) {
                    if (command == 'add') {
                        cart[i].amount = cart[i].amount + 1;
                    }
                    else {
                        if (cart[i].amount > 0) {
                            cart[i].amount = cart[i].amount - 1;
                        }

                    }
                    hasitem = true;
                    break;
                }
            }
        }
        else {
            cart = [];
        }


        if (hasitem == false) {
            var items =
                {
                    'itemid': itemid
                    , 'name': name
                    , 'price': price
                    , 'amount': 1
                }
            ;

            cart.push(items)
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        updatecart();

        $(".overlay-loader").hide();

    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>
</html>
