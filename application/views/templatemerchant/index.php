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
                    <!--
                    <li class="active"><a href="
                    <?= base_url("web/$merchant->name") ?>">หน้าหลัก</a></li>
                    <li><a href="
                    <?= base_url("web/$merchant->name/items") ?>">สินค้า</a></li>
                    <li><a href="
                    <?= base_url("web/$merchant->name/about") ?>">เกี่ยวกับเรา</a></li>
                    <li><a href="
                   <?= base_url("web/$merchant->name/contact") ?>">ติดต่อเรา</a></li>
                   -->

                    <li class="active"><a href="
                    <?= $http . $_SERVER['HTTP_HOST'] ?>">หน้าหลัก</a></li>
                    <li><a href="
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
                <?php if (isset($imagescover)): ?>
                    <?php if (count($imagescover) > 0): ?>
                        <div class="header-index">
                            <!-- START carousel-->
                            <div id="carousel-example-captions" data-ride="carousel" class="carousel slide">
                                <ol class="carousel-indicators">
                                    <?php foreach ($imagescover as $index => $item): ?>
                                        <li data-target="#carousel-example-captions" data-slide-to="<?= $index ?>"
                                            class=" <?= $index == 0 ? 'active' : '' ?>"></li>
                                    <?php endforeach; ?>

                                </ol>
                                <div role="listbox" class="carousel-inner">
                                    <?php foreach ($imagescover as $index => $item): ?>
                                        <div style="cursor: pointer;"
                                             onclick="location.href='<?= $item->externallink == "" ? 'javascript:;' : $item->externallink ?>'"
                                             class="item <?= $index == 0 ? 'active' : '' ?>"><img
                                                    src="<?= $item->image ?>"
                                                    alt="<?= $item->caption ?>">
                                            <div class="carousel-caption">
                                                <h3 class="text-white font-600"><?= $item->title ?></h3>
                                                <p><?= $item->caption ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>
                                <a href="#carousel-example-captions" role="button" data-slide="prev"
                                   class="left carousel-control"> <span aria-hidden="true"
                                                                        class="fa fa-angle-left"></span>
                                    <span class="sr-only">Previous</span> </a>
                                <a href="#carousel-example-captions" role="button" data-slide="next"
                                   class="right carousel-control"> <span aria-hidden="true"
                                                                         class="fa fa-angle-right"></span> <span
                                            class="sr-only">Next</span> </a>
                            </div>
                            <!-- END carousel-->
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
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
                                                    <h3 class="box-title text-info"><a
                                                                href="<?= $http . $_SERVER['HTTP_HOST'] . "/item/$item->id/$item->name" ?>"
                                                                title="<?= $item->name ?>"> <?= $item->name ?></a>
                                                    </h3>
                                                    <small>฿<?= number_format($item->price) ?></small>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>

                </div>
                <?php if (isset($article)): ?>
                    <div class="row el-element-overlay m-b-40 block1">
                        <?php foreach ($article as $item): ?>
                            <div class="col-md-6 col-xs-12">
                                <div class="white-box">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1"
                                             style="width:100%;overflow: hidden">
                                            <img src="<?= $item->image ?>" alt="<?= $item->title ?>"
                                                 class="img"/>
                                        </div>
                                        <div class="el-card-content content">
                                            <h3 class="box-title text-info"><a
                                                        href="<?= $http . $_SERVER['HTTP_HOST'] . "/post/$item->id/$item->title" ?>"
                                                        title="<?= $item->title ?>"><?= $item->title ?></a>
                                            </h3>

                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <button onclick="location.href='<?= $http . $_SERVER['HTTP_HOST'] . "/post/$item->id/$item->title" ?>'"
                                                            class="btn   btn-outline btn-default  "
                                                            style="margin-top: 15px;">
                                                        ดูเพิ่มเติม
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>


                    </div>
                <?php endif; ?>
            </div>


        </div>
    </div>


    <?php $this->load->view('templatemerchant/template/footer'); ?>


