<?php $this->load->view('templatemerchant/template/header'); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4">
            <div class="logo">
                <img src="<?= $merchant->image ?>"/>
                <h1><?= $merchant->name ?></h1>
                <p><?= $merchant->description ?></p>
            </div>
            <div class="menu">
                <ul>
                    <li ><a href="
                    <?= base_url("web/$merchant->name") ?>">หน้าหลัก</a></li>
                    <li class="active"><a href="
                    <?= base_url("web/$merchant->name/about") ?>">เกี่ยวกับเรา</a></li>
                    <li><a href="
                   <?= base_url("web/$merchant->name/contact") ?>">ติดต่อเรา</a></li>

                    <!--
                    <li class="active"><a href="<?= $http.$_SERVER['HTTP_HOST'] ?>">หน้าหลัก</a></li>
                    <li><a href="<?= $http.$_SERVER['HTTP_HOST'] ?>/about">เกี่ยวกับเรา</a></li>
                    <li><a href="<?= $http.$_SERVER['HTTP_HOST'] ?>/contact">ติดต่อเรา</a></li>
                    -->
                </ul>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <a class="startusing" href=" <?= $merchant->lineaddurl ?>">แอดไลน์เพื่อสอบถาม คลิก!</a>
                </div>
                <div class="col-lg-12   visible-sm visible-xs">
                    <a class="startusing" style="background: #000;" href=" <?= $merchant->billtoken ?>">เปิดบิลสั่งสินค้า
                        คลิก!</a>
                </div>
            </div>

        </div>
        <div class="col-lg-9 col-md-9 col-sm-8">
            <div class="row">
                <div class="header-index">
                    <img src="<?= $merchant->imagecover ?>"/>

                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="white-box page">
                            <h3>ติดต่อเรา</h3>
                            <div class="row" style="margin-top: 15px;">
                            <div class="col-sm-5" style="border-right: 1px solid #e9edef;">
                                <address style="    text-transform: uppercase;">
                                    <strong>ร้าน </strong>
                                    <?= $merchant->name ?>
                                </address>
                                <address>
                                    <strong>เบอร์โทร </strong>
                                    <a href="tel:<?=$merchant->tel ?>"><?= $merchant->tel ?></a>
                                </address>
                                <address>
                                    <strong>อีเมลล์ </strong>
                                    <?= $merchant->email ?>
                                </address>
                            </div>
                            <div class="col-sm-7">
                                <?= $merchant->textcontact; ?>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>

<?php $this->load->view('templatemerchant/template/footer'); ?>


