<?php $this->load->view('templatemerchant/template/header'); ?>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4">
            <div id="sticky-anchor" style="height: 0px;"></div>
            <div id="sticky">
                <div class="logo">
                    <img src="<?= $merchant->image ?>"/>
                    <h1><?= $merchant->name ?></h1>
                    <p><?= $merchant->description ?></p>
                </div>
                <div class="menu">
                    <ul>
                        <!--  <li ><a href="
                    <?= base_url("web/$merchant->name") ?>">หน้าหลัก</a></li>
                    <li  ><a href="
                    <?= base_url("web/$merchant->name/items") ?>">สินค้า</a></li>
                    <li class="active"><a href="
                    <?= base_url("web/$merchant->name/about") ?>">เกี่ยวกับเรา</a></li>
                    <li  ><a href="
                   <?= base_url("web/$merchant->name/contact") ?>">ติดต่อเรา</a></li>-->

                        <li><a href="
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
                            <h3 class="title">   <?= $article->title; ?></h3>
                            <?= $article->description; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>

<?php $this->load->view('templatemerchant/template/footer'); ?>


