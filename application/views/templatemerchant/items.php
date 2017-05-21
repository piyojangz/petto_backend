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
                   <!-- <li><a href="
                    <?= base_url("web/$merchant->name") ?>">หน้าหลัก</a></li>
                    <li  class="active"><a href="
                    <?= base_url("web/$merchant->name/items") ?>">สินค้า</a></li>
                    <li><a href="
                    <?= base_url("web/$merchant->name/about") ?>">เกี่ยวกับเรา</a></li>
                    <li><a href="
                   <?= base_url("web/$merchant->name/contact") ?>">ติดต่อเรา</a></li>-->

                    <li ><a href="
                    <?= $http . $_SERVER['HTTP_HOST'] ?>">หน้าหลัก</a></li>
                    <li class="active"><a href="
                    <?= $http . $_SERVER['HTTP_HOST'] ?>/items">สินค้า</a></li>
                    <li><a href="
                    <?= $http . $_SERVER['HTTP_HOST'] ?>/about">เกี่ยวกับเรา</a></li>
                    <li><a href="
                    <?= $http . $_SERVER['HTTP_HOST'] ?>/contact">ติดต่อเรา</a></li>
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



                <div class="row">
                    <div class="row el-element-overlay m-b-40 block1">
                        <div class="col-md-12">
                            <?php if ($merchant->billtoken == "" || $merchant->billtoken == null): ?>
                                <div class="text-center">
                                    <div class="badge badge-info">no billiing</div>
                                </div>
                            <?php else: ?>
                                <?php foreach ($items as $item): ?>
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                                        <div class="white-box">
                                            <div class="el-card-item">
                                                <div class="el-card-avatar el-overlay-1"
                                                     style="width:100%;overflow: hidden">
                                                    <img alt="<?= $item->name ?>"
                                                            src="<?= $item->image ?>"/>
                                                    <div class="el-overlay   hidden-xs">
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
                                                    <h3 class="box-title text-info"><a href="<?= $http . $_SERVER['HTTP_HOST'] ."/item/$item->id/$item->name" ?>"
                                                                                       title="<?= $item->name ?>"> <?= $item->name ?></a>
                                                    </h3>
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


<?php $this->load->view('templatemerchant/template/footer'); ?>


