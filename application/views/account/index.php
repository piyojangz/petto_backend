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
                            <h4 class="page-title">แดชบอร์ด</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                            <ol class="breadcrumb">
                                <li class="active"><a href="#" >แดชบอร์ด</a></li> 
                            </ol>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <!-- ============================================================== -->
                    <!-- Different data widgets -->
                    <!-- ============================================================== -->
                    <!-- .row -->
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">บิลทั้งหมด</h3>
                                <ul class="list-inline">
                                    <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">0</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">ชำระเงินแล้ว</h3>
                                <ul class="list-inline">
                                    <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">0</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">ยังไม่ได้ชำระเงิน</h3>
                                <ul class="list-inline two-part">
                                    <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">0</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">รายได้เดือนนี้</h3>
                                <ul class="list-inline"> 
                                    <li class="text-right">  <i class="ti-arrow-up text-success"></i><span class="counter text-success">0.00</span>  
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/.row -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12"> 
                            <div class="white-box p-b-0">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2 class="font-medium m-t-0">LINE ADMIN</h2> 
                                        <h5>จำนวน Admin ในร้าน</h5>
                                        <small>คุณสามารถเพิ่ม Admin โดยการพิมพ์คำว่า <code>ลงทะเบียน <?= $token ?>  <?=$user["lineid"]?></code> ในไลน์ @perdbill</small>
                                    </div>
                                </div>
                                <div class="row m-t-30 minus-margin">
                                    <?php foreach ($lineadmin as $key => $value): ?>
                                        <div class="col-sm-12 col-sm-4 b-t b-r">
                                            <ul class="expense-box">
                                                <li>
                                                    <i class="fa fa-dollar"> </i>
                                                    <span><h2><?= $value->name ?> (<?= $value->countorder ?>)</h2><h4>รายได้ <?= number_format($value->total) ?></h4></span></li>
                                            </ul>
                                        </div>
                                    <?php endforeach; ?>


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
        <!--Wave Effects -->
        <script src="<?= base_url("res/account/js/waves.js") ?>"></script>
        <!--Counter js -->
        <script src="<?= base_url("res/account/plugins/bower_components/waypoints/lib/jquery.waypoints.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/counterup/jquery.counterup.min.js") ?>"></script>
        <!-- chartist chart -->
        <script src="<?= base_url("res/account/plugins/bower_components/chartist-js/dist/chartist.min.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js") ?>"></script>
        <!-- Sparkline chart JavaScript -->
        <script src="<?= base_url("res/account/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js") ?>"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?= base_url("res/account/js/custom.min.js") ?>"></script>
        <script src="<?= base_url("res/account/js/dashboard1.js") ?>"></script>
        <script src="<?= base_url("res/account/plugins/bower_components/toast-master/js/jquery.toast.js") ?>"></script>
        <!--Style Switcher -->
        <script src="<?= base_url("res/account/plugins/bower_components/styleswitcher/jQuery.style.switcher.js") ?>"></script>
    </body>

</html>
