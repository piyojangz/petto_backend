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
                        <h4 class="page-title">ออเดอร์ - <?= $order->orderno ?></h4>
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
                            <h3><b>ORDER</b> <span class="pull-right">#<?= $order->orderno ?></span></h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="pull-left">
                                        <address>
                                            <h3> &nbsp;<b class="text-danger">ที่อยู่สำหรับจัดส่ง</b></h3>
                                            <p class="text-muted m-l-5"><?= $order->shippingaddress ?></p>
                                        </address>
                                        <tel>
                                            <h3> &nbsp;<b class="text-danger">เบอร์โทร</b></h3>
                                            <p class="text-muted m-l-5"><?= $order->shippingtel ?></p>
                                        </tel>
                                        <?php if ($order->payamount > 0) : ?>
                                            <h3>รายละเอียดการชำระเงิน</h3>
                                            <h5><?= $order->paymentinfo ?></h5>
                                            <h3>จำนวนเงินที่ชำระ <?= number_format($order->payamount, 2) ?></h3>
                                            <a href="javascript:;" onclick="displayslip()">
                                                <h3 style="text-decoration: underline;" class="" href="">ดูสลิป</h3>
                                            </a>
                                        <?php else : ?>
                                            <h3>ยังไม่ได้ชำระเงิน</h3>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive m-t-40" style="clear: both;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>รูป</th>
                                                    <th>สินค้า</th>
                                                    <th class="text-right">จำนวน</th>
                                                    <th class="text-right">ราคา</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($orderdetail as $key => $value) : ?>
                                                    <tr>
                                                        <td class="text-center"><?= $key + 1 ?></td>
                                                        <td><img src="<?= $value->image ?>" style="width:100px;" /></td>
                                                        <td><?= $value->name ?></td>
                                                        <td><?= $value->amount ?></td>
                                                        <td class="text-right"> <?= number_format($value->price, 2) ?> บาท </td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="pull-right m-t-30 text-right">
                                        <p>ค่าจัดส่ง <?= number_format($order->shippingfee, 2) ?> บาท</p>
                                        <hr>
                                        <h3><b>รวม :</b> <?= number_format($order->total, 2) ?> บาท</h3>
                                    </div>
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="text-right">

                                        <?php if ($order->isconfirm  == 1) : ?>
                                            <h3>ยืนยันการชำระเงินแล้ว</h3>
                                        <?php else : ?>
                                            <?php if ($order->status == 2) : ?>
                                                <button onclick="confirmpayment('<?= $order->id ?>|')" class="btn btn-danger" type="submit"> ยืนยันการชำระเงิน </button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($order->status  == 3) : ?>
                                            <h3 style="color:greenyellow">จัดส่งแล้ว</h3>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <form class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" id="form-submit">
                <div class="panel panel-default">
                    <div class="panel-heading">สลิป</div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-info ">
                                        <div class="panel-body">

                                            <img src="<?= $order->imgslip ?>" style="width: 100%;" />
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

    function confirmpayment(items) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/confirmOrderPayment'); ?>",
            data: JSON.stringify({
                'items': items,
            }),
            dataType: "json",
            success: function(data) {
                $('div.block1').unblock();
                if (data.result != null) {

                    swal("Good job!", "ยืนยันการชำระเงินเรียบร้อย.", "success");

                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                }

            },
            error: function(XMLHttpRequest) {
                $('div.block1').unblock();
            }
        });
    }

    function displayslip() {
        $.magnificPopup.open({
            items: {
                src: '#form-submit'
            },
            type: 'inline'
        }, 0);

    }
</script>

</html>