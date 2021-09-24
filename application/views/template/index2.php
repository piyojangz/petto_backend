<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Petto.co </title>
    <meta name="description" content="บริการบิลออนไลน์ และเว็บไซต์สำเร็จรูป">
    <meta name="keywords" content="เว็บสำเร็จรูป,บิลออนไลน์,ขายของผ่านไลน์,ขายของออนไลน์">
    <link href="<?= base_url("res/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url("res/fav/favicon-16x16.png") ?>">
    <!-- Loading Bootstrap -->
    <link href="<?= base_url("res/dist/css/vendor/bootstrap.min.css") ?>" rel="stylesheet">

    <!-- Loading Flat UI Pro -->
    <link href="<?= base_url("res/dist/css/flat-ui-pro.css") ?>" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url("res/account/plugins/bower_components/register-steps/steps.css") ?>" rel="stylesheet">

    <!-- Custom -->
    <link href="<?= base_url("res/css/webcustom.css?v=1.2") ?>" rel="stylesheet" type="text/css"/>
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
                <a href="<?= base_url() ?>" class="logo"><img src="<?= base_url("res/img/218860.jpg") ?>"
                                                              style="width: 150px;"/> </a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav main">
                    <li><a href="<?= base_url() ?>">หน้าหลัก</a></li>
                    <li><a href="javascript:;" id="howto">วิธีใช้งาน</a></li>
                    <li><a href="javascript:;"  id="price">ราคา</a></li>
                    <li><a href="javascript:;"  id="contact">ติดต่อเรา</a></li>
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
            </div>
        </div>


    </div>
    </div>


</header>
<div class="container">
     


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

        $("#howto").click(function (){
            $('html, body').animate({
                scrollTop: $("#divhowto").offset().top
            }, 1000);
        });
        $("#price").click(function (){
            $('html, body').animate({
                scrollTop: $("#divprice").offset().top
            }, 1000);
        });
        $("#contact").click(function (){
            $('html, body').animate({
                scrollTop: $("#divcontact").offset().top
            }, 1000);
        });


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
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-39217117-10', 'auto');
    ga('send', 'pageview');

</script>
</html>
