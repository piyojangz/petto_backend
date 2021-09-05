<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('account/template/header'); ?>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <?php $this->load->view('account/template/preloader'); ?>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php $this->load->view('account/template/nav'); ?>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <?php $this->load->view('account/template/sidebar'); ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <!-- <h4 class="page-title">ออเดอร์ - <?= $order->orderno ?></h4> -->
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">ออเดอร์</a></li>
                            <li class="active">จัดการออเดอร์</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Different data widgets -->
                <!-- ============================================================== -->


                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box printableArea">
                            <h3>รายการสั่งซื้อ Package ร้านค้า</h3>
                            <hr>
                            <div class="row">
                                <form action="" method="post" id="form-submit" enctype="multipart/form-data">
                                    <div class="col-md-12">
                                        <div class="pull-left">
                                            <user>
                                                <h3> &nbsp;<b class="text-danger">ชื่อผู้สั่ง</b></h3>
                                                <p class="text-muted m-l-5"><?= $merchant->firstname ?> <?= $merchant->lastname ?></p>
                                            </user>
                                            <tel>
                                                <h3> &nbsp;<b class="text-danger">เบอร์โทร</b></h3>
                                                <p class="text-muted m-l-5"><?= $merchant->tel ?></p>
                                            </tel>
                                            <email>
                                                <h3> &nbsp;<b class="text-danger">อีเมลล์</b></h3>
                                                <p class="text-muted m-l-5"><?= $merchant->email ?></p>
                                            </email>
                                            <hr />
                                            <?php if ($order->total > 0) : ?>
                                                <h3>รายละเอียดการชำระเงิน</h3>
                                                <h5>โอนเงินเข้าบัญชีออมทรัพย์ - ธนาคารกสิกรไทย - 7972083636</h5>
                                                <hr />
                                                <h3>จำนวนเงินที่ต้องชำระ <?= number_format($order->total, 2) ?> บาท</h3>
                                                <!-- <a href="javascript:;" onclick="displayslip()">
                                                <h3 style="text-decoration: underline;" class="" href="">ดูสลิป</h3>
                                            </a> -->
                                            <?php else : ?>
                                                <h3>ยังไม่ได้ชำระเงิน</h3>
                                            <?php endif; ?>
                                            <hr />
                                            <?php if ($user['isadmin'] != 1) : ?>
                                                <?php if ($order->ispaid != 1) : ?>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">แนบสลิป</label>
                                                        <div class="col-md-9">
                                                            <input type="file" name="imageData" id="imageData" required accept="image/jpeg, image/png">
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <img src="<?= $order->imgslip ?>" class="img img-rounded" style="height: 200px;" />
                                                    <h3 style="color:green">ชำระเงินแล้ว</h3>
                                                    <?php if ($order->isconfirm == 0) : ?>
                                                        <h3 style="color:orange">รอตรวจสอบจากเจ้าหน้าที่</h3>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php else : ?>
                                                <?php if ($order->ispaid == 1) : ?>
                                                    <div class="row">
                                                        <div class="label label-table label-success">แจ้งชำระเงินแล้ว</div>
                                                    </div>
                                                    <div class="row">
                                                        <img src="<?= $order->imgslip ?>" class="img img-rounded" style="height: 500px;" />
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="table-responsive m-t-40" style="clear: both;">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th>รายการสินค้า</th>
                                                            <th class="text-right">จำนวน</th>
                                                            <th class="text-right">ราคา</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                        $PACKICON = '';
                                                        switch ($order->packageid) {
                                                            case '1':
                                                                $PACKICON = '<span class="badge" style="background:blue"><i class="fa fa-star"></i> Free StartUP</span>';
                                                                break;
                                                            case '2':
                                                                $PACKICON = '<span class="badge" style="background:silver"><i class="fa fa-star"></i> Silver</span>';
                                                                break;
                                                            case '3':
                                                                $PACKICON = '<span class="badge" style="background:gold"><i class="fa fa-star"></i> Gold</span>';
                                                                break;
                                                            case '4':
                                                                $PACKICON = '<span class="badge" style="background:platinum"><i class="fa fa-star"></i> Platinum</span>';
                                                                break;

                                                            default:
                                                                # code...
                                                                break;
                                                        }

                                                        ?>
                                                        <tr>
                                                            <td class="text-center">1</td>
                                                            <td>PACKAGE <?= $PACKICON ?></td>
                                                            <td>1</td>
                                                            <td class="text-right"> <?= number_format($order->total, 2) ?> บาท </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <?php if ($user['isadmin'] != 1) : ?>
                                            <?php if ($order->ispaid != 1) : ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" id="btnsubmit" class="btn btn-success"><i class="fa fa-check"></i> ยืนยันการชำระเงิน
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </form>
                                <form method="post" method="post">
                                    <?php if ($user['isadmin'] == 1) : ?>
                                        <?php if ($order->ispaid != 1) : ?>
                                            <div class="label label-table label-warning">รอชำระเงิน</div>
                                        <?php else : ?>
                                            <?php if ($order->isconfirm != 1) : ?>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <button type="submit" id="btnsubmit" class="btn btn-success"><i class="fa fa-check"></i> ยืนยันการชำระเงินรายการนี้
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                                <div class="col-12">
                                                    <div class="label label-table label-success">ยืนยันรายการนี้แล้ว</div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>



                </div>

            </div>

            <!-- /.container-fluid -->

            <?php $this->load->view('account/template/footer'); ?>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= base_url("res/account/plugins/bower_components/jquery/dist/jquery.min.js") ?>"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url("res/account/bootstrap/dist/js/bootstrap.min.js") ?>"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?= base_url("res/account/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js") ?>"></script>
    <!--slimscroll JavaScript -->
    <script src="<?= base_url("res/account/js/jquery.slimscroll.js") ?>"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url("res/account/js/custom.min.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/toast-master/js/jquery.toast.js") ?>"></script>
    <!--Style Switcher -->
    <script src="<?= base_url("res/account/plugins/bower_components/styleswitcher/jQuery.style.switcher.js") ?>"></script>
    <!-- Sweet-Alert  -->
    <script src="<?= base_url("res/account/plugins/bower_components/sweetalert/sweetalert.min.js") ?>"></script>

    <script src="<?= base_url("res/account/plugins/bower_components/dropify/dist/js/dropify.min.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/cropit/jquery.cropit.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/blockUI/jquery.blockUI.js") ?>"></script>

    <!-- Magnific popup JavaScript -->
    <script src="<?= base_url("res/account/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js") ?>"></script>
</body>
<script>
    $(document).ready(function() {

    });
</script>

</html>