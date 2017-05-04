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
    <link href="<?= base_url("res/account/plugins/bower_components/register-steps/steps.css") ?>" rel="stylesheet">

    <!-- Custom -->
    <link href="<?= base_url("res/css/webcustom.css") ?>" rel="stylesheet" type="text/css"/>
</head>
<body class="nopadding grey">
<div class="overlay-loader">
    <div class="bg"></div>
    <div class="container">
        <div class="loader"></div>
        <p>กรุณารอสักครู่ระบบกำลังดำเนินการ...</p>
    </div>
</div>

<header class="header-index">

    <!-- Static navbar -->
    <div class="navbar" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                </button>
                <a href="#" class="logo"><img src="<?= base_url("res/img/web-logo.png") ?>"
                                              style="width: 50px;"/> PERDBILL </a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav main">
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


            <div class="container">
                <div class="row">
                    <div class="heading-wrapper">
                        <div class="col-lg-6 col-lg-offset-6 text-white text-right">
                            <h2 class="">ง่ายกว่าสั่งในเว็บก็ไลน์เนี่ยะแหละ</h2>
                            <p class="">ลูกค้าเยอะ ตอบไลน์ไม่ทัน โอ๊ยลืมอีกว่าลูกค้าจะสั่งอะไร ขอเปิดเว็บดูก่อนนะ
                                <br>
                                <u>ลองใช้บริการของเราสิ</u>
                                <br>
                                บริการเปิดบิลผ่านไลน์ @perdbill</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="step-wrapper">
                        <form id="msform">
                            <!-- progressbar -->
                            <ul id="eliteregister">
                                <li class="active">สร้างลิงค์การชำระเงิน</li>
                                <li>ส่งให้ลูกค้า</li>
                                <li>รอรับการแจ้งเตือนผ่านไลน์</li>
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
    </div>


</header>
<div class="container">
    <div class="feature text-center">
        <div class="row">
            <div class="col-lg-2">
                <i class="fa fa-dashboard fa-3x"></i>
                <h4>ระบบจัดการง่าย ไม่ซับซ้อน</h4>
            </div>
            <div class="col-lg-2">
                <i class="fa fa-bell-o fa-3x"></i>
                <h4>รับการแจ้งเตือนผ่าน LINE</h4>
            </div>
            <div class="col-lg-2">
                <i class="fa fa-code fa-3x"></i>
                <h4>ทำงานสะดวกรวดเร็วด้วย LINE BOT API</h4>
            </div>
            <div class="col-lg-2">
                <i class="fa fa-link fa-3x"></i>
                <h4>ส่งออเดอร์ให้ลูกค้าด้วย shorten link</h4>
            </div>
            <div class="col-lg-2">
                <i class="fa fa-line-chart fa-3x"></i>
                <h4>การวัดผลและสถิติย้อนหลัง</h4>
            </div>
            <div class="col-lg-2">
                <i class="fa fa-group fa-3x"></i>
                <h4>รองรับผู้ขายแบบ dropship</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p>กับบริการแบบใหม่ ตอบสนองความต้องการในยุคที่การค้าขายบนไซเชียลเน็ตเวิร์คกำลังมาแรง
                    แค่มีไลน์ก็ขายของได้แล้ว.</p>
            </div>
        </div>
    </div>


</div>
<div class="feature-ss text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>การขายสินค้าผ่านไลน์คุณจะไม่ยุ่งยากอีกต่อไป</h1>
                <p>รับผู้เข้าร่วมช่วง Beta test จำนวน 50 ท่าน</p>


                <ul>
                    <li data-id="1" class="br"><i class="fa fa-comment-o"></i>
                        <br/>พูดคุย
                    </li>
                    <li data-id="2" class="active br"><i class="fa fa-external-link-square"></i>
                        <br/>ส่งลิงค์
                    </li>
                    <li data-id="3"><i class="fa fa-check"></i>
                        <br/>รอรับการยืนยัน
                    </li>
                </ul>
                <div class="animated-images hidden-md">
                    <div class="image-wrapper left" data-id="1">
                        <img src="<?= base_url("res/img/exam3.png") ?>"/>
                    </div>
                    <div class="image-wrapper center" data-id="2">
                        <img src="<?= base_url("res/img/exam1.png") ?>"/>
                    </div>
                    <div class="image-wrapper right" data-id="3">
                        <img src="<?= base_url("res/img/exam2.png") ?>"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="user-quote text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <img class="img img-circle" style="width: 100px;"
                     src="https://scontent.fbkk2-4.fna.fbcdn.net/v/t1.0-1/p160x160/17952758_1555347854489212_4415242171106257259_n.jpg?_nc_eui2=v1%3AAeH4NDNjr-4phwJ9DRcqDe3MxwarffmSNGPBuX5aLJWmJaTd8yMco4Dt5hRbIWu10oxqPouO6cEHy64NqqZrskZeodm0TwgVPkPIDcxzxkNPNA&oh=32d276da3af66a261179e5202a8fff95&oe=59743C69"/>
            </div>
            <div class="col-lg-10">
                <div class="quote">
                    <div class="text">ปกตินั่งตอบลูกค้า นั่งรับออเดอร์ลูกค้าจำนวนมาก ไม่มีคนช่วยก็แย่แล้ว
                        ไหนจะต้องมานั่งเช็คยอดเงินลูกค้าอีก , พอมาทดสอบใช้ @perdbill ดูแล้วรู้สึกรักเลยค่ะ
                        สามารถตรวจสอบข้อมูลได้ง่ายขึ้น และยังทำทุกอย่างด้วยไลน์ทั้งหมดได้อีกด้วย
                    </div>
                    <div class="signature">Peijang Kyo</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="package text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h4>รายละเอียดแพ็กเกจ</h4>
                <table class="package table table-responsive">
                    <thead>
                    <tr>
                        <th width="15%"></th>
                        <th width="25%"></th>
                        <th width="60%">ใช้ฟรีไม่มีค่าใช้จ่าย</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-left" rowspan="2">Line @perdbill</td>
                        <td class="text-left">การใช้คำสั่งผ่านไลน์</td>
                        <td><i class="fa fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td class="text-left">การแจ้งเตือนผ่านไลน์</td>
                        <td><i class="fa fa-check text-success"></i></td>
                    </tr>
                    <tr>
                        <td class="text-left lc-lp-spec-black">จำกัด</td>
                        <td class="text-left">จำนวนผู้ค้า</td>
                        <td>ไม่จำกัด</td>
                    </tr>
                    <tr>
                        <td class="text-left lc-lp-spec-black">ฟังก์ชันอื่นๆ</td>
                        <td class="text-left">ฟังก์ชันต่างๆ ของ @perdbill</td>
                        <td>เร็วๆนี้</td>
                    </tr>
                    <tr>
                        <td class="text-left lc-lp-spec-black">ออพชัน</td>
                        <td class="text-left">ช่องทางการรับชำระเงิน</td>
                        <td>เร็วๆนี้</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            เพิ่มเราเป็นเพื่อนเลย!
                <br/>
                <a href="https://line.me/R/ti/p/%40hkw0659s"><img height="36" border="0" alt="เพิ่มเพื่อน" src="https://scdn.line-apps.com/n/line_add_friends/btn/en.png"></a>
                <hr>
            </div>
        </div>
    </div>
</div>
<div class="startnow text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a class="startusing" href="http://localhost/perdbill/login">เริ่มใช้เลยฟรี!</a>
            </div>
        </div>
    </div>
</div>
<div class="mtl pbl">
    <div class="bottom-menu">
        <div class="container">
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
