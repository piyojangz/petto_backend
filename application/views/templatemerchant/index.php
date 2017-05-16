<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Perdbill.co บริการเปิดบิลสั่งสินค้าและชำระเงินผ่านไลน์</title>
    <link href="<?= base_url("res/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css"/>
    <!-- Loading Bootstrap -->
    <link href="<?= base_url("res/dist/css/vendor/bootstrap.min.css") ?>" rel="stylesheet">

    <link href="<?= base_url("res/account/css/style.css") ?>" rel="stylesheet">
    <!-- Custom -->
    <link href="<?= base_url("res/css/merchantwebcustom.css") ?>" rel="stylesheet" type="text/css"/>
</head>
<body class="nopadding grey">
<div class="overlay-loader">
    <div class="bg"></div>
    <div class="container">
        <div class="loader"></div>
        <p>กรุณารอสักครู่ระบบกำลังดำเนินการ...</p>
    </div>
</div>
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
                    <a class="startusing" href="https://line.me/R/ti/p/jubajuba">แอดไลน์เพื่อสอบถาม คลิก!</a>
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
                                                        <li><a class="btn default btn-outline image-popup-vertical-fit"
                                                               href="javascript:void(0);"
                                                               onclick="edititem('<?= $item->id ?>')"><i
                                                                        class="ti-minus"></i></a></li>

                                                        <li><a class="btn default btn-outline image-popup-vertical-fit"
                                                               href="javascript:void(0);"
                                                               onclick="edititem('<?= $item->id ?>')"><i
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
                    <a href="#" class="bottom-menu-brand">Powered by Perdbill.co</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12  text-center">
                    <ul class="bottom-menu-iconic-list">
                        <br/>
                        <i class="fa fa-phone-square" aria-hidden="true"></i> Hotline : 062292917
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div> <!-- /bottom-menu-inverse -->
</div>

<div class="billing">
    <div class="row">
        <div class="col-xs-12">
            <div class="white-box">
                <h3>รายการสินค้า</h3>
                <div class="row items">
                    <div class="col-xs-8">
                        <h4>
                            <img src="https://perdbill.co/public/upload/item/AbrH2JG210/db97b7e870f8bff49f7101cd5f3a357b.png"
                                 style="width:40px;" class="img img-thumbnail">เซรั่มท่อคู่ Rochu White</h4>

                    </div>
                    <div class="col-xs-4">
                        <span class="badge">จำนวน 1</span>
                        <div class="amounttool">
                            <button><i class="fa fa-plus"></i></button>
                            <button><i class="fa fa-minus"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row items">
                    <div class="col-xs-8">
                        <h4>
                            <img src="https://perdbill.co/public/upload/item/AbrH2JG210/c3229480a9dbb53840ea342ed21f734b.png"
                                 style="width:40px;" class="img img-thumbnail">ครีมบำรุงผิวเนื้อแมทท์ ROCHU WHITE</h4>

                    </div>
                    <div class="col-xs-4">
                        <span class="badge">จำนวน 2</span>
                        <div class="amounttool">
                            <button><i class="fa fa-plus"></i></button>
                            <button><i class="fa fa-minus"></i></button>
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
                                <span class="badge" style="margin-top: 0px;">70฿</span>
                            </div>
                        </div>
                        <div class="row items summary">
                            <div class="col-xs-8">
                                ยอดที่ต้องชำระทั้งสิ้น
                            </div>
                            <div class="col-xs-4">
                                <span class="badge" style="margin-top: 0px;">460.00฿</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-hg btn-block   btnperbill" style="width: 100%">เปิดบิล</button>
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


        $(".feature-ss li, .image-wrapper").click(function () {

            var e = $(this).data("id");
            $(".animated-images[data-id=" + e + "]");
            if ($(".animated-images .image-wrapper[data-id=" + e + "]").hasClass("center")) {
                return;
            }
            $.each($(".animated-images .image-wrapper"), function (index, value) {
                $(".feature-ss ul li").removeClass("active");
                $(value).removeClass("left").removeClass("right").removeClass("center");
            });

            if (e == 1) {
                $(".animated-images .image-wrapper[data-id=" + 1 + "]").addClass("center");
                $(".animated-images .image-wrapper[data-id=" + 2 + "]").addClass("left");
                $(".animated-images .image-wrapper[data-id=" + 3 + "]").addClass("right");
            }
            if (e == 2) {
                $(".animated-images .image-wrapper[data-id=" + 2 + "]").addClass("center");
                $(".animated-images .image-wrapper[data-id=" + 1 + "]").addClass("left");
                $(".animated-images .image-wrapper[data-id=" + 3 + "]").addClass("right");
            }
            if (e == 3) {
                $(".animated-images .image-wrapper[data-id=" + 3 + "]").addClass("center");
                $(".animated-images .image-wrapper[data-id=" + 1 + "]").addClass("left");
                $(".animated-images .image-wrapper[data-id=" + 2 + "]").addClass("right");
            }

            $(".feature-ss ul li[data-id=" + e + "]").addClass("active");
            $(".animated-images .image-wrapper[data-id=" + e + "]").addClass("center");


            return $(this).data("id");
        });

    });


    function init() {
        $(".overlay-loader").hide();
    }
</script>
</html>
