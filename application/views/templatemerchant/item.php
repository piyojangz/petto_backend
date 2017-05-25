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
                        <!-- <li ><a href="
                    <?= base_url("web/$merchant->name") ?>">หน้าหลัก</a></li>
                    <li class="active"><a href="
                    <?= base_url("web/$merchant->name/items") ?>">สินค้า</a></li>
                    <li><a href="
                    <?= base_url("web/$merchant->name/about") ?>">เกี่ยวกับเรา</a></li>
                    <li><a href="
                   <?= base_url("web/$merchant->name/contact") ?>">ติดต่อเรา</a></li> -->

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
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8">
            <div class="row">

                <div class="row">
                    <div class="col-xs-12">
                        <div class="white-box">
                            <h3 class="title"><?= $item->name ?></h3>
                            <div style="text-align: center">
                                <img class="img img-thumbnail" src="<?= $item->image ?>">
                                <h4 class="text-gray-dark">ราคา <?= number_format($item->price) ?></h4>

                                <div class="hidden-xs">
                                    <button onclick="addremove('remove','<?= $item->id; ?>','<?= $item->name ?>','<?= $item->price ?>')"
                                            type="button" class="btn btn-danger btn-circle btn-xl"><i
                                                class="fa fa-minus"></i></button>
                                    <button onclick="addremove('add','<?= $item->id; ?>','<?= $item->name ?>','<?= $item->price ?>')"
                                            type="button" class="btn btn-primary btn-circle btn-xl"><i
                                                class="fa fa-plus"></i></button>
                                </div>
                                </ul>
                            </div>
                            <?= $item->description; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>

<?php $this->load->view('templatemerchant/template/footer'); ?>


