<nav class="navbar navbar-default navbar-static-top m-b-0">
    <div class="navbar-header">
        <div class="top-left-part">
            <!-- Logo -->
            <a class="logo" href="<?= base_url("account/$token/dashboard") ?>">
                <!-- Logo icon image, you can use font-icon also --><b>
                    <!--This is dark logo icon--><img src="<?= base_url("res/account/plugins/images/admin-logo.png") ?>" style="width: 50px;" alt="home" class="dark-logo" />
                    <!--This is light logo icon--><img src="https://pettodemo.web.app/assets/images/icon/logo/petto_logo.png" alt="home" class="light-logo" style="width:60px;" />
                </b>
                <!-- Logo text image you can use text also --><span class="hidden-xs" style="color: #0072be;
    font-weight: 500;
    font-size: 1em;">
                    <!--This is dark logo text-->Admin<small style="font-size: 1em;
    font-weight: 400;
    color: #0072be;">CONTROL</small>
                    <!--This is light logo text-->
                </span>
            </a>
        </div>
        <!-- /Logo -->
        <!-- Search input and Toggle icon -->
        <ul class="nav navbar-top-links navbar-left">
            <li><a href="javascript:void(0)" class="open-close waves-effect waves-light"><i class="ti-menu"></i></a>
            </li>
            <?php if ($paidorder > 0) : ?>
                <li class="dropdown">
                    <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#"> <i class="fa fa-envelope"></i>
                        <div class="notify"><span class="heartbit"></span> <span class="point"></span></div>
                    </a>
                    <ul class="dropdown-menu mailbox animated bounceInDown">
                        <li>
                            <div class="drop-title text-center">คุณมีการชำระเงินเข้ามาใหม่</div>
                        </li>
                        <li>
                            <a class="text-center" href="<?= base_url("account/$token/order/all") ?>">
                                <strong>ดูทั้งหมด</strong> <i class="fa fa-angle-right"></i> </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
            <!-- <li><a href="http://<?= $user["webname"] ?>.perdbill.co" class="waves-effect waves-light"><i
                            class="ti-arrow-top-right"></i> ดูหน้าเว็บ</a></li> -->

            <!-- <li><a href="<?= base_url('web/') ?><?= $user["webname"] ?>" class="waves-effect waves-light"><i
                            class="ti-arrow-top-right"></i> ดูหน้าเว็บ</a></li> --> 

        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right">
            <!--            <li>
                            <form role="search" class="app-search hidden-sm hidden-xs m-r-10">
                                <input type="text" placeholder="Search..." class="form-control"> <a href=""><i class="fa fa-search"></i></a> </form>
                        </li>-->
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?= $user["image"] ?>" alt="user-img" width="36" class="img-circle"><b class="hidden-xs"><?= $user["name"] ?></b><span class="caret"></span> </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-img"><img src="<?= $user["image"] ?>" alt="user" /></div>
                            <div class="u-text">
                                <h4><?= $user["name"] ?></h4>
                                <p class="text-muted"><?= $user["email"] ?></p>
                                <!--                                <a href="<?= base_url("account/$token/info") ?>" class="btn btn-rounded btn-danger btn-sm">View Profile</a>-->
                            </div>
                        </div>
                    </li>
                    <!--                    <li role="separator" class="divider"></li>-->
                    <!--                    <li><a href="<?= base_url("account/$token/info") ?>"><i class="ti-user"></i> ข้อมูลร้านค้า</a></li>-->
                    <li role="separator" class="divider"></li>
                    <li><a href="<?= base_url("account/$token/setting") ?>"><i class="ti-settings"></i> ตั้งค่า</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?= base_url("logout") ?>"><i class="fa fa-power-off"></i> ออกจากระบบ</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
    </div>
    <!-- /.navbar-header -->
    <!-- /.navbar-top-links -->
    <!-- /.navbar-static-side -->
</nav>