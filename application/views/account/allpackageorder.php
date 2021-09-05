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
                        <h4 class="page-title">ออเดอร์</h4>
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


                <div class="row el-element-overlay m-b-40 block1">


                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">รายการสั่งซื้อลูกค้า</div>
                            <div class="white-box">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>สินค้า</th>
                                                <th style="min-width:120px;">timestamp</th>
                                                <th style="min-width:140px;">วันเวลาที่โอน</th>
                                                <th style="min-width:150px;">ชื่อผู้ใช้</th>
                                                <th style="min-width:150px;">ชื่อร้าน</th>
                                                <!-- <th>รายการสั่ง</th> -->
                                                <!-- <th>ยอดสั่งรวม</th> -->
                                                <th style="min-width:80px;">ยอดสั่งซื้อ</th>
                                                <th>สถานะ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="orderlist">
                                            <?php foreach ($packageorder as $key => $value) : ?>
                                                <?php
                                                $status = "<div class=\"label label-table label-warning\">รอชำระเงิน</div>";
                                                if ($value->ispaid == 1) {
                                                    $status = "<div class=\"label label-table label-success\">แจ้งชำระเงินแล้ว</div>";
                                                }

                                                ?>

                                                <?php
                                                $PACKICON = '';
                                                switch ($value->packageid) {
                                                    case '1':
                                                        $PACKICON = '<span class="badge" style="background:blue"><i class="fa fa-star"> Free StartUP</span>';
                                                        break;
                                                    case '2':
                                                        $PACKICON = '<span class="badge" style="background:silver"><i class="fa fa-star"> Silver</span>';
                                                        break;
                                                    case '3':
                                                        $PACKICON = '<span class="badge" style="background:gold"><i class="fa fa-star"> Gold</span>';
                                                        break;
                                                    case '4':
                                                        $PACKICON = '<span class="badge" style="background:platinum"><i class="fa fa-star"> Platinum</span>';
                                                        break;

                                                    default:
                                                        # code...
                                                        break;
                                                }
                                                ?>
                                                <tr>
                                                    <td><a class="badge badge-info " target="_blank" href="<?= base_url("account/$token/packagecheckoutdetail/$value->id") ?>"><?= $value->orderno ?></a></td>
                                                    <td><?= $PACKICON ?></td>
                                                    <td><?= $value->createdate ?></td>
                                                    <td><?= $value->ispaid == 1 ? $value->paiddate : '-' ?></td>
                                                    <td><?= $value->firstname ?> <?= $value->lastname ?></td>
                                                    <td><?= $value->name ?></td>
                                                    <td><?= $value->total ?></td>
                                                    <td><?= $status ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
            <form action="<?= base_url("account/$token/addnewdeliverydetail") ?>" method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" id="form-submit">
                <div class="panel panel-default">
                    <div class="panel-heading">แจ้งจัดส่งสินค้า</div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-info ">
                                        <div class="panel-body">

                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">บริษัทขนส่ง</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="comp" id="comp" placeholder="เช่น Kerry, J&T , ไปรษณีย์ไทย" required class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">หมายเลขติดตาม</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="trackid" id="trackid" required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">อื่นๆเพิ่มเติม</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="other" id="other" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-offset-9 col-md-3">
                                                                    <button type="submit" id="btnsubmit" class="btn btn-success"> <i class="fa fa-check"></i> บันทึก/แก้ไขข้อมูล</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" id="did" name="did" />

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


            </form>

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