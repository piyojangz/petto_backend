<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span>
            </h3>
        </div>
        <ul class="nav" id="side-menu" style="margin-top: 60px;">
            <?php if ($user['isadmin'] == 0) :  ?>
                <li>
                    <a href="<?= base_url("account/$token/dashboard") ?>"><i class="icon-graph  fa-fw" data-icon="v"></i>
                        แดชบอร์ด <span class="fa arrow"></span></a>
                </li>
            <?php endif; ?>
            <!-- <?php if ($user['isadmin'] == 0) :  ?>
                <li>
                    <a href="<?= base_url("account/$token/customer") ?>"><i class="icon-user fa-fw" data-icon="v"></i> Manage User <span class="fa arrow"></span></a>
                </li>
            <?php endif; ?> -->
            <?php if ($user['isadmin'] == 1) :   ?>
                <li class="devider"></li>
                <li><a href="javascript:;"><i class="icon-user  fa-fw"></i> <span class="hide-menu">ผู้ใช้<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= base_url("account/$token/userlist") ?>"><i class="icon-user fa-fw"></i><span class="hide-menu">รายชื่อผู้ใช้</span></a></li>
                        <li><a href="<?= base_url("account/$token/banlist") ?>"><i class="icon-ban fa-fw"></i><span class="hide-menu">ผู้ใช้ที่ถูกระงับ</span></a></li>
                        <!-- <li><a href="<?= base_url("account/$token/customer") ?>"><i class="icon-star fa-fw"></i><span class="hide-menu">สิทธิ์ผู้ใช้งาน</span></a></li> -->
                    </ul>
                </li>
                <li class="devider"></li>
                <li>
                    <a href="#"><i class="ti-pie-chart fa-fw" data-icon="v"></i> รายงาน(Beta) <span class="fa arrow"></span></a>
                </li>
            <?php endif; ?>
            <!-- <li>
                <a href="<?= base_url("account/$token/customer") ?>"><i class="icon-user fa-fw" data-icon="v"></i>
                    ดูแลลูกค้า <span class="fa arrow"></span></a>
            </li> -->
            <?php if ($user['isadmin'] == 1) :  ?>
                <li>
                    <a href="<?= base_url("account/$token/package") ?>"><i class="ti-crown fa-fw" data-icon="v"></i> แพคเกจ <span class="fa arrow"></span></a>
                </li>
            <?php endif; ?>
            <li class="devider"></li>
            <li><a href="javascript:;"><i class="ti-package fa-fw"></i> <span class="hide-menu">คลังสินค้า<span class="fa arrow"></span></span></a>
                <ul class="nav nav-second-level">
                    <?php
                    if ($user['isadmin'] == 1) :
                    ?>
                        <li><a href="<?= base_url("account/$token/productcate") ?>"><i class="fa-fw">C</i><span class="hide-menu">หมวดหมู่</span></a></li>
                    <?php endif; ?>
                    <?php if ($user['isadmin'] == 0) :  ?>
                        <li><a href="<?= base_url("account/$token/products") ?>"><i class="fa-fw">P</i><span class="hide-menu">สินค้า</span></a></li>
                    <?php endif; ?>
                </ul>
            </li>
            <?php if ($user['isadmin'] == 0) :  ?>
                <li class="devider"></li>
                <li><a href="javascript:;"><i class="ti-pencil-alt2 fa-fw"></i> <span class="hide-menu">กำหนดค่า<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= base_url("account/$token/paymentmethod") ?>"><i class="ti-money fa-fw"></i><span class="hide-menu">เพิ่มบัญชี</span></a></li>
                        <li><a href="<?= base_url("account/$token/shippingrate") ?>"><i class="fa fa-truck fa-fw"></i><span class="hide-menu">เพิ่มค่าจัดส่ง</span></a></li>
                    </ul>
                </li>
                <li><a href="javascript:;"><i class="ti-paint-bucket fa-fw"></i> <span class="hide-menu">ตั้งค่าร้านค้า <span class="badge badge-danger">new</span> <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= base_url("account/$token/setting") ?>"><i class="fa fa-pencil fa-fw"></i><span class="hide-menu">ข้อมูลทั่วไป</span></a></li>
                        <li><a href="<?= base_url("account/$token/setting_home") ?>"><i class="fa fa-home fa-fw"></i><span class="hide-menu">หน้าหลัก</span></a></li>
                    </ul>
                </li>
                <li><a href="javascript:;"><i class="ti-receipt fa-fw"></i> <span class="hide-menu">ออเดอร์<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= base_url("account/$token/order/all") ?>"><i class="fa fa-bookmark-o fa-fw"></i><span class="hide-menu">รายการสั่งซื้อ</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url("account/$token/auction") ?>"><i class="fa fa-sort-numeric-asc   fa-fw" data-icon="v"></i> ประมูล <span class="fa arrow"></span></a>
                </li>
            <?php endif; ?>
            <?php if ($user['isadmin'] == 1) :  ?>
                <li class="devider"></li>
                <li><a href="javascript:;"><i class="ti-target fa-fw"></i> <span class="hide-menu">การตลาด<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= base_url("account/$token/setting_ads_banner") ?>"><i class=" ti-layout-slider fa-fw"></i><span class="hide-menu">แบนเนอร์</span></a></li>
                        <li><a href="<?= base_url("account/$token/shopslot") ?>"><i class="ti-eye fa-fw"></i><span class="hide-menu">Shop Slot</span></a></li>
                        <li><a href="<?= base_url("account/$token/products") ?>"><i class="ti-ticket fa-fw"></i><span class="hide-menu">คูปอง</span></a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url("account/$token/setting_post") ?>"><i class="fa   fa-pencil  fa-fw" data-icon="v"></i> โพส <span class="fa arrow"></span></a>
                </li>
                <li>
                    <a href="<?= base_url("account/$token/setting_gganalytic") ?>"><i class="fa   fa-google  fa-fw" data-icon="v"></i> Google Analytic <span class="fa arrow"></span></a>
                </li>
                <li>
                    <a href="<?= base_url("account/$token/setting_about") ?>"><i class="fa   fa-fw" data-icon="v"></i> เกี่ยวกับเรา <span class="fa arrow"></span></a>
                </li>
                <li>
                    <a href="<?= base_url("account/$token/setting_contact") ?>"><i class="fa    fa-fw" data-icon="v"></i> ติดต่อเรา <span class="fa arrow"></span></a>
                </li>

                <li>
                    <a href="<?= base_url("account/$token/setting_lang") ?>"><i class="fa fa-language    fa-fw" data-icon="v"></i> ภาษา <span class="fa arrow"></span></a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>