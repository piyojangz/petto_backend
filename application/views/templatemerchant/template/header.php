<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php if (isset($item)): ?>
        <title><?= $item->name ?></title>
    <?php else: ?>
        <title><?= $merchant->title ?></title>
    <?php endif; ?>
    <meta name="description" content="<?= $merchant->description ?>">


    <link href="<?= base_url("res/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css"/>
    <!-- Loading Bootstrap -->
    <link href="<?= base_url("res/dist/css/vendor/bootstrap.min.css") ?>" rel="stylesheet">

    <link href="<?= base_url("res/account/css/style.css") ?>" rel="stylesheet">
    <!-- Custom -->
    <link href="<?= base_url("res/css/merchantwebcustom.css?ver=1.3") ?>" rel="stylesheet" type="text/css"/>

    <!-- animation CSS -->
    <link href="<?= base_url("res/account/css/animate.css") ?>" rel="stylesheet">

    <link href="<?= base_url("res/account/plugins/bower_components/owl.carousel/owl.carousel.min.css") ?>"
          rel="stylesheet" type="text/css"/>
    <link href="<?= base_url("res/account/plugins/bower_components/owl.carousel/owl.theme.default.css") ?>"
          rel="stylesheet" type="text/css"/>

</head>
<body class="nopadding grey">

<header class="header-perdbill hidden-xs hidden-md" style=" ">
    <div class="container">
        <a href="<?= base_url() ?>" class="logo-perdbill"><img src="<?= base_url("res/img/web-logo.png") ?>"
                                                               style="width: 50px;"/> </a>

        <ul class="nav navbar-nav navbar-right" style="padding-right: 15px;">
            <?php if ($islogin): ?>
                <li style="background: #dad9d9;"><a style="color: #fff;"
                                                    href="<?= base_url("account/$merchant->token") ?>">จัดการร้านค้า</a>
                </li>
                <li><a href="<?= base_url("logout") ?>">ออกจากระบบ</a></li>
            <?php else: ?>
                <li class="text-success"><a href="<?= base_url("login") ?>"><i class="fa fa-lock"></i> เข้าสู่ระบบ</a>
                </li>
                <li class="text-success"><a href="<?= base_url("register") ?>"><i class="fa fa-user"></i>
                        สมัครสมาชิก</a>
                </li>
            <?php endif; ?>

        </ul>
    </div>
</header>