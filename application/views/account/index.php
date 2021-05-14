<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('account/template/header'); ?>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <!-- <?php $this->load->view('account/template/preloader'); ?> -->
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
                        <h4 class="page-title">แดชบอร์ด</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li class="active"><a href="#">แดชบอร์ด</a></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Different data widgets -->
                <!-- ============================================================== -->
                <!-- .row -->
                <?php if ($user['isadmin'] != 1) :  ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="white-box">
                                <h3 class="box-title m-b-0">Quick Start Guide</h3>

                                <div class="wizard-steps">
                                    <li style="cursor: pointer;" onclick="location.href = '<?= base_url("account/$token/setting") ?>'">
                                        <h4><span>1</span>ตั้งค่าร้านค้า</h4>
                                    </li>
                                    <!-- <li style="cursor: pointer;" onclick="addmerchant()">
                                    <h4><span>2</span>เพิ่มรายชื่อผู้ใช้งาน</h4>
                                </li>
                                <li style="cursor: pointer;" onclick="genbill()">
                                    <h4><span>3</span>เพิ่มบิล</h4>
                                </li> -->
                                    <li style="cursor: pointer;" onclick="location.href = '<?= base_url("account/$token/paymentmethod") ?>'">
                                        <h4><span>2</span>บัญชีธนาคาร</h4>
                                    </li>
                                    <li style="cursor: pointer;" onclick="location.href = '<?= base_url("account/$token/shippingrate") ?>'">
                                        <h4><span>3</span>ค่าจัดส่ง</h4>
                                    </li>
                                </div>


                            </div>
                        </div>
                    </div>
                <?php endif ?>

                <?php if ($user['isadmin'] == 1) :  ?>
                    <div class="row">
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">ออเดอร์ทั้งหมด</h3>
                                <ul class="list-inline">
                                    <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success"><?= $dashboarddata->bills ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">ออเดอร์เดือนนี้</h3>
                                <ul class="list-inline">
                                    <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple"><?= $dashboarddata->ordermonth ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">ออเดอร์วันนี้</h3>
                                <ul class="list-inline two-part">
                                    <li class="text-right"><i class="ti-arrow-up text-danger"></i> <span class="counter text-danger"><?= $dashboarddata->ordertoday ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">จำนวนผู้ใช้</h3>
                                <ul class="list-inline">
                                    <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="text-success"></span><span class="counter text-success"><?= $dashboarddata->usercount ?></span>
                                </ul>
                            </div>
                        </div>
                    </div>

                <?php endif ?>
                <!-- <?php if ($user['isadmin'] == 1) :  ?>
                    <div class="col-md-12 col-sm-12">
                        <div class="white-box panel-wrapper collapse in  p-b-0">
                            <div class="panel-body ">
                                <div class="col-xs-6">
                                    <h3 class="font-medium m-t-0">รายชื่อผู้ใช้งาน</h3>
                                </div>
                                <div class="col-xs-6">
                                    <div class="btn-group pull-right">
                                        <button type="button" class="btn-createadminlink btn btn-primary waves-effect"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <hr />
                            <div class="row">
                                <?php foreach ($lineadmin as $key => $value) : ?>
                                    <div class="col-lg-4 col-sm-4 col-md-6">
                                        <div class="panel panel-default" style="border:  1px #f5f5f5 solid">
                                            <div class="panel-heading"><?= $value->name ?>
                                                <small>- <a href="javascript:;" onclick="opensalehistory('<?= $value->lineuid ?>',0,30)">ยอดขาย <?= number_format($value->total) ?></a>
                                                </small>
                                                <?php if ($value->lineuid != "") : ?>
                                                    <i class="fa fa-circle text-success" style="font-size: 12px;"></i>
                                                <?php else : ?>
                                                    <i class="fa fa-circle text-warning" style="font-size: 12px;"></i>
                                                <?php endif; ?>
                                                <div class="pull-right"><a href="javascript:;" onclick="deleteadminuid('<?= $value->id ?>')"><i class="ti-close text-danger"></i></a></div>
                                            </div>
                                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                                <div class="panel-body">
                                                    <?php if ($value->lineuid != "") : ?>
                                                        <p>ลงทะเบียนผ่านไลน์เรียบร้อยแล้ว<br />
                                                            <code><?= $value->invitetoken ?></code>
                                                        </p>
                                                    <?php else : ?>
                                                        <p>นำรหัสนี้ไปให้ <strong><?= $value->name ?></strong>
                                                            ลงทะเบียนผ่านไลน์ <a href="https://line.me/R/ti/p/%40hkw0659s" target="_blank">@hkw0659s</a> <br />
                                                            <code><span style="display: inline-block;" id="<?= $value->invitetoken ?>"><?= $value->invitetoken ?></span></code></span>
                                                            <button class="btn btn-outline btn-default btn-xs" onclick="copyuid(event, '<?= $value->invitetoken ?>')">
                                                                copy
                                                            </button>
                                                        </p>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php endforeach; ?>


                            </div>
                        </div>
                    </div> -->
            <?php endif; ?>
            <!-- /.row -->
            <?php if ($user['isadmin'] == 0) :  ?>
                <!-- .row -->
                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">ออเดอร์ทั้งหมด</h3>
                            <ul class="list-inline">
                                <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success"><?= $dashboarddata->bills ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">ชำระเงินแล้ว</h3>
                            <ul class="list-inline">
                                <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple"><?= $dashboarddata->paid ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">ยังไม่ได้ชำระเงิน</h3>
                            <ul class="list-inline two-part">
                                <li class="text-right"><i class="ti-arrow-up text-danger"></i> <span class="counter text-danger"><?= $dashboarddata->unpaid ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="white-box analytics-info">
                            <h3 class="box-title">รายได้เดือนนี้</h3>
                            <ul class="list-inline">
                                <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="text-success">฿</span><span class="counter text-success"><?= number_format($dashboarddata->monthlytotal) ?></span>
                            </ul>
                        </div>
                    </div>
                </div>


            <?php endif; ?>



            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info ">
                        <div class="col-sm-12">
                            <div class="panel-header">
                                <h3>รายการขาย</h3>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <div class="input-group m-t-10">
                                    <input type="text" id="searchtxt" name="searchtxt" class="form-control" placeholder="Orderno"> <span class="input-group-btn">
                                        <button type="submit" onclick="searchorder()" style="   margin-top: 0px;" class="btn waves-effect waves-light btn-info">ค้นหา</button>
                                    </span>
                                </div>
                            </div>
                            <div style="    overflow-x: scroll;
    display: block;
    min-width: 100%;">
                                <table class="table table-hover manage-u-table">
                                    <thead>
                                        <tr>
                                            <th style="width: 70px;" class="text-center">#</th>
                                            <th>ร้านค้า</th>
                                            <th>Orderno</th>
                                            <th>สินค้า</th>
                                            <th>สถานะสินค้า</th>
                                            <th>ยอดขาย</th>
                                            <th>วันที่</th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemsalehistory">

                                    </tbody>
                                    <tfoot id="tsalehistoryfoot">
                                        <tr>
                                            <td colspan="7">
                                                <button type="button" onclick="loadmore()" class="btn btn-outline btn-default" style="width: 100%;">Loadmore
                                                </button>

                                                <input type="hidden" id="lineuid" />
                                                <input type="hidden" id="offset" value="0" />
                                                <input type="hidden" id="limit" value="10" />
                                            </td>
                                        </tr>

                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </div>

            <form method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft form-update-stock block1" id="form-update-stock">
                <input type="hidden" id="updateitemamount" name="updateitemamount" />
                <input type="hidden" id="billtokenid" name="billtokenid" />
                <div class="panel panel-default">
                    <div class="panel-heading">เพิ่ม/แก้ไขสินค้าคงคลัง</div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="checkbox" id="isstockenable" name="isstockenable" />
                                    <label for="isstockenable">เปิด/ปิดการใช้งาน</label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info ">
                                <div class="panel-body">
                                    <table class="table table-hover manage-u-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 70px;" class="text-center">#</th>
                                                <th>ชื่อสินค้า</th>
                                                <th>สินค้าคงคลัง</th>
                                                <th>เพิ่ม/ลบ</th>
                                            </tr>
                                        </thead>
                                        <tbody id="itemstock">

                                        </tbody>
                                    </table>


                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-offset-9 col-md-3">
                                                        <button type="submit" id="btnupdateamount" name="btnupdateamount" class="btn btn-success"><i class="fa fa-check"></i>
                                                            บันทึก/แก้ไขข้อมูล
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="adminid" name="adminid" />

                            </div>
                        </div>
                    </div>
                </div>
        </div>

    </div>
    </form>


    <form method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" id="form-submit-billtoken">
        <div class="panel panel-default">
            <div class="panel-heading">เพิ่ม / แก้ไข</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info ">
                                <div class="panel-body">

                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ชื่อบิล</label>
                                            <div class="col-md-9">
                                                <input type="text" name="name" id="name" required class="form-control">
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                        <label class="control-label col-md-3">ผู้ขาย</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="merchantuid" id="merchantuid"
                                                    required>
                                                <?php foreach ($merchants as $item) : ?>
                                                    <option value="<?= $item->lineuid ?>"><?= $item->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div> -->


                                        <div class="form-group">
                                            <label class="control-label col-md-3">ช่วงเวลา</label>
                                            <div class="col-md-9">
                                                <input class="form-control input-daterange-datepicker" type="text" name="daterange" id="daterange" value="<?= $daterange ?>" />
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                        <label class="control-label col-md-3">ส่งการแจ้งเตือนทางไลน์</label>
                                        <div class="col-md-9">
                                            <select class="select2 m-b-10 select2-multiple" multiple="multiple"
                                                    name="usernoti" id="usernoti" data-placeholder="Choose">
                                                <?php foreach ($merchants as $item) : ?>
                                                    <option value="<?= $item->lineuid ?>|<?= $item->name ?>"><?= $item->name ?></option>
                                                <?php endforeach; ?>
                                            </select>


                                        </div>
                                    </div> -->
                                    </div>


                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-offset-9 col-md-3">
                                                        <button type="submit" id="btnsubmit" class="btn btn-success"><i class="fa fa-check"></i>
                                                            บันทึก/แก้ไขข้อมูล
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="id" name="id" />

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

    <form method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" id="form-submit-createadminlink">
        <div class="panel panel-default">
            <div class="panel-heading">เพิ่ม / แก้ไข</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info ">
                                <div class="panel-body">

                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ชื่อ</label>
                                            <div class="col-md-9">
                                                <input type="text" name="adminname" id="adminname" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">อีเมลล์</label>
                                            <div class="col-md-9">
                                                <input type="email" name="adminemail" id="adminemail" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">เบอร์โทร</label>
                                            <div class="col-md-9">
                                                <input type="tel" name="admintel" id="admintel" required class="form-control">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-offset-9 col-md-3">
                                                        <button type="submit" id="btnadminubmit" class="btn btn-success"><i class="fa fa-check"></i> บันทึก/แก้ไขข้อมูล
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="adminid" name="adminid" />

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

    <form method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" id="form-submit-billtoken">
        <div class="panel panel-default">
            <div class="panel-heading">เพิ่ม / แก้ไข</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info ">
                                <div class="panel-body">

                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ชื่อบิล</label>
                                            <div class="col-md-9">
                                                <input type="text" name="name" id="name" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ผู้ขาย</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="merchantuid" id="merchantuid" required>
                                                    <?php foreach ($merchants as $item) : ?>
                                                        <option value="<?= $item->lineuid ?>"><?= $item->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">ช่วงเวลา</label>
                                            <div class="col-md-9">
                                                <input class="form-control input-daterange-datepicker" type="text" name="daterange" id="daterange" value="<?= $daterange ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ส่งการแจ้งเตือนทางไลน์</label>
                                            <div class="col-md-9">
                                                <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="usernoti" id="usernoti" data-placeholder="Choose">
                                                    <?php foreach ($merchants as $item) : ?>
                                                        <option value="<?= $item->lineuid ?>|<?= $item->name ?>"><?= $item->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-offset-9 col-md-3">
                                                        <button type="submit" id="btnsubmit" class="btn btn-success"><i class="fa fa-check"></i>
                                                            บันทึก/แก้ไขข้อมูล
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="id" name="id" />

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

    <form method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" id="form-submit-billtoken">
        <div class="panel panel-default">
            <div class="panel-heading">เพิ่ม / แก้ไข</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info ">
                                <div class="panel-body">

                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ชื่อบิล</label>
                                            <div class="col-md-9">
                                                <input type="text" name="name" id="name" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ผู้ขาย</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="merchantuid" id="merchantuid" required>
                                                    <?php foreach ($merchants as $item) : ?>
                                                        <option value="<?= $item->lineuid ?>"><?= $item->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">ช่วงเวลา</label>
                                            <div class="col-md-9">
                                                <input class="form-control input-daterange-datepicker" type="text" name="daterange" id="daterange" value="<?= $daterange ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ส่งการแจ้งเตือนทางไลน์</label>
                                            <div class="col-md-9">
                                                <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="usernoti" id="usernoti" data-placeholder="Choose">
                                                    <?php foreach ($merchants as $item) : ?>
                                                        <option value="<?= $item->lineuid ?>|<?= $item->name ?>"><?= $item->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>


                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-offset-9 col-md-3">
                                                        <button type="submit" id="btnsubmit" class="btn btn-success"><i class="fa fa-check"></i>
                                                            บันทึก/แก้ไขข้อมูล
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="id" name="id" />

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

    <form method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" id="form-submit-billtoken">
        <div class="panel panel-default">
            <div class="panel-heading">เพิ่ม / แก้ไข</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-info ">
                                <div class="panel-body">

                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ชื่อบิล</label>
                                            <div class="col-md-9">
                                                <input type="text" name="name" id="name" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ผู้ขาย</label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="merchantuid" id="merchantuid" required>
                                                    <?php foreach ($merchants as $item) : ?>
                                                        <option value="<?= $item->lineuid ?>"><?= $item->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="control-label col-md-3">ช่วงเวลา</label>
                                            <div class="col-md-9">
                                                <input class="form-control input-daterange-datepicker" type="text" name="daterange" id="daterange" value="<?= $daterange ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">ส่งการแจ้งเตือนทางไลน์</label>
                                            <div class="col-md-9">
                                                <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="usernoti" id="usernoti" data-placeholder="Choose">
                                                    <?php foreach ($merchants as $item) : ?>
                                                        <option value="<?= $item->lineuid ?>|<?= $item->name ?>"><?= $item->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>


                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-offset-9 col-md-3">
                                                        <button type="submit" id="btnsubmit" class="btn btn-success"><i class="fa fa-check"></i>
                                                            บันทึก/แก้ไขข้อมูล
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="id" name="id" />

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
    </div>

    <input type="hidden" id="activetoken" />
    <input type="hidden" id="activetokenid" />
    <input type="hidden" id="editnotiusers" />


    </form>


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


    <script src="<?= base_url("res/account/plugins/bower_components/flot/excanvas.min.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.pie.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.time.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.stack.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.crosshair.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js") ?>"></script>
    <!-- Magnific popup JavaScript -->
    <script src="<?= base_url("res/account/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js") ?>"></script>
    <!-- Plugin JavaScript -->
    <script src="<?= base_url("res/account/plugins/bower_components/moment/moment.js") ?>"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="<?= base_url("res/account/plugins/bower_components/timepicker/bootstrap-timepicker.min.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/blockUI/jquery.blockUI.js") ?>"></script>
    <!-- Sweet-Alert  -->
    <script src="<?= base_url("res/account/plugins/bower_components/sweetalert/sweetalert.min.js") ?>"></script>

    <script type="text/javascript" src="<?= base_url("res/account/plugins/bower_components/custom-select/custom-select.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("res/account/plugins/bower_components/bootstrap-select/bootstrap-select.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("res/account/plugins/bower_components/multiselect/js/jquery.multi-select.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("res/account/plugins/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js") ?>"></script>

    <script src="<?= base_url("res/account/plugins/bower_components/switchery/dist/switchery.min.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/toast-master/js/jquery.toast.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js") ?>" type="text/javascript"></script>
    <script>
        var $Multi = $(".select2").select2();

        function copylink(x) {
            $("#animationlink").removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
                $(this).removeClass();
            });
        }


        function copyuidlink(id, x) {
            id.removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
                $(this).removeClass();
            });
        }

        function todmy(datetime) {
            var d = datetime;
            d = d.substr(0, 10).split("-");
            d = d[2] + "/" + d[1] + "/" + d[0];
            return d;
        }
        //Flot Bar Chart

        $(function() {

            opensalehistory();


            $("#checkAll").click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });


            // Daterange picker
            $('.input-daterange-datepicker').daterangepicker({
                buttonClasses: ['btn', 'btn-sm'],
                locale: {
                    format: 'DD/MM/YYYY'
                },
                minDate: '<?= date('d/m/Y') ?>',
                applyClass: 'btn-danger',
                cancelClass: 'btn-inverse'
            });

            $('.btn-genbill').click(function() {
                genbill();
            });


            $('#copyanim').click(function(e) {
                e.preventDefault();
                var anim = "bounce";
                copylink(anim);
                copyToClipboard("billinkhd");
            });


            $("tbody.selected").on("click", "tr", function() {
                $(this).addClass('selected').siblings().removeClass("selected");
                getbilldata($(this).attr("id"));
            });

            $(".btn-createadminlink").click(function() {
                addmerchant();
            });


            $("#billtokenremove").click(function() {
                swal({
                    title: "Are you sure?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }, function(isConfirm) {
                    if (isConfirm) {

                        $.ajax({
                            type: "POST",
                            url: "<?php echo base_url('service/deletebilltoken'); ?>",
                            data: {
                                'id': $("#activetokenid").val()
                            },
                            dataType: "json",
                            success: function(data) {

                                $('div.block1').unblock();

                                reload_billtoken();
                                swal("Deleted!", "Your imaginary file has been deleted.", "success");


                            },
                            error: function(XMLHttpRequest) {

                                $('div.block1').unblock();

                            }
                        });

                    } else {
                        swal("Cancelled", "", "error");
                    }
                });
            });


            $("#form-update-stock").submit(function() {
                $('.form-update-stock.block1').block();
                var stockamount = $("a[name=stockamount]");
                var rs = "";
                $(stockamount).each(function(index, value) {
                    var itemid = $(this).attr("data-itemid");
                    var itemamount = $(this).html() == "Empty" ? 0 : $(this).html();
                    rs += itemid + ";" + itemamount + "|";
                });
                $("#updateitemamount").val(rs.slice(0, -1));

                setTimeout(function() {
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('service/updatestock'); ?>",
                        data: $("#form-update-stock").serialize(),
                        dataType: "json",
                        success: function(data) {
                            if (data.result = true) {
                                $.toast({
                                    heading: 'บันทึกข้อมูลสำเร็จ',
                                    text: 'ระบบจะทำการส่งการแจ้งเตือนกรณีสินค้าคงคลังมีจำนวนเหลือ 0.',
                                    position: 'top-right',
                                    loaderBg: '#ff6849',
                                    icon: 'success',
                                    hideAfter: 3500,
                                    stack: 6
                                });
                            }
                            $('.form-update-stock.block1').unblock();
                            $.magnificPopup.close();
                        },
                        error: function(XMLHttpRequest) {
                            console.log(XMLHttpRequest.responseText);
                            $('.form-update-stock.block1').unblock();
                            $.magnificPopup.close();
                            $.toast({
                                heading: 'ไม่สามารถบันทึกข้อมูลได้',
                                text: XMLHttpRequest.responseText,
                                position: 'top-right',
                                loaderBg: '#ff6849',
                                icon: 'error',
                                hideAfter: 3500

                            });
                        }
                    });
                }, 1000);


                return false;
            });
            $("#billupdatestock").click(function() {
                var token = $("#billtokenhd").val();
                getbillitemstock(token);
                $.magnificPopup.open({
                    items: {
                        src: '#form-update-stock'
                    },
                    type: 'inline'
                }, 0);
            });

            $("#billtokenedit").click(function() {
                $('div.block1').block();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('service/getbilltoken'); ?>",
                    data: {
                        'token': $("#activetoken").val()
                    },
                    dataType: "json",
                    success: function(data) {
                        $('div.block1').unblock();

                        if (data.result != null) {
                            $("#name").val(data.result.name);
                            $("#merchantuid").val(data.result.uid);

                            var from = todmy(data.result.datefrom);
                            var to = todmy(data.result.dateto);
                            $('.input-daterange-datepicker').daterangepicker({
                                locale: {
                                    format: 'DD/MM/YYYY'
                                },
                                startDate: from,
                                endDate: to
                            });

                            var selectednoti = [];
                            $.each(data.result2, function(index, value) {
                                selectednoti.push(value.lineuid + "|" + value.merchantlinename);
                            });

                            $Multi.val(selectednoti).trigger("change");
                            $("#editnotiusers").val(data.result.id);
                            $("#merchantuid").prop('disabled', 'disabled');

                            $.magnificPopup.open({
                                items: {
                                    src: '#form-submit-billtoken'
                                },
                                type: 'inline'
                            }, 0);
                        }

                        return false;

                    },
                    error: function(XMLHttpRequest) {
                        console.log(XMLHttpRequest);
                        $('div.block1').unblock();
                        return false;
                    }
                });


            });

            $("#merchantuid").change(function() {
                var val = $(this).val();
                var text = $(this).find(":selected").text();
                $Multi.val([val + "|" + text]).trigger("change");
            });

            $("#btn-refreshbilltoken").click(function() {
                reload_billtoken();
            });

            $("#form-submit-billtoken").submit(function() {
                $('div.block1').block();
                var name = $("#name").val();
                var merchantuid = $("#merchantuid").val();
                var daterange = $("#daterange").val();
                var usernoti = $("#usernoti").val();
                var editnotiusers = $("#editnotiusers").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('service/savebilltoken'); ?>",
                    data: {
                        'daterange': daterange,
                        'merchantuid': merchantuid,
                        'name': name,
                        'merchantid': <?= $merchant->id ?>,
                        'token': '<?= $token ?>',
                        'usernoti': usernoti,
                        'editnotiusers': editnotiusers
                    },
                    dataType: "json",
                    success: function(data) {

                        $('div.block1').unblock();
                        if (data.result != null) {
                            reload_billtoken();
                            $.magnificPopup.close();
                        }

                        return false;

                    },
                    error: function(XMLHttpRequest) {
                        $('div.block1').unblock();
                        return false;
                    }
                });

                return false;
            });

            $("#form-submit-createadminlink").submit(function() {

                $('div.block2').block();
                var adminname = $("#adminname").val();
                var adminemail = $("#adminemail").val();
                var admintel = $("#admintel").val();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('service/saveadminuid'); ?>",
                    data: {
                        'adminname': adminname,
                        'adminemail': adminemail,
                        'admintel': admintel,
                        'merchantid': <?= $merchant->id ?>,
                        'token': '<?= $token ?>'
                    },
                    dataType: "json",
                    success: function(data) {

                        $('div.block2').unblock();
                        if (data.result != null) {
                            $.magnificPopup.close();
                            location.reload();
                        }

                        return false;

                    },
                    error: function(XMLHttpRequest) {
                        $('div.block2').unblock();
                        return false;
                    }
                });

                return false;


            });

            reload_billtoken();
        });


        function loadmore() {
            var offset = $("#offset").val();
            $("#offset").val(parseInt(offset) + 10);
            opensalehistory();
        }

        function searchorder() {
            $("#offset").val(0);
            if (searchtxt != "") {
                $('#itemsalehistory').html("");
            }
            opensalehistory();
        }


        function opensalehistory() {

            var searchtxt = $("#searchtxt").val();
            var offset = $("#offset").val();
            var limit = $("#limit").val();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('service/getsalehistory'); ?>",
                data: JSON.stringify({
                    'merchantid': <?= $merchant->id ?>,
                    'searchtxt': searchtxt,
                    'offset': offset,
                    'limit': limit
                }),
                dataType: "html",
                success: function(data) {
                    if (searchtxt != "") {
                        $('#itemsalehistory').append(data);
                        $("#tsalehistoryfoot").hide();
                    } else {
                        $("#tsalehistoryfoot").show();
                        if (data == '') {
                            $("#tsalehistoryfoot").hide();
                        }
                        if (offset == 0) {
                            $('#itemsalehistory').html('');
                        }
                        $('#itemsalehistory').append(data);
                    }
                },
                error: function(XMLHttpRequest) {
                    $('div.block1').unblock();
                    return false;
                }
            });

        }

        function genbill() {
            $("#name").val("");
            $("#editnotiusers").val("");
            $("#id").val("");
            $("#merchantuid").removeAttr("disabled");
            var val = $("#merchantuid option:first").val();
            var text = $("#merchantuid option:first").text();
            $Multi.val([val + "|" + text]).trigger("change");
            $.magnificPopup.open({
                items: {
                    src: '#form-submit-billtoken'
                },
                type: 'inline'
            }, 0);
        }

        function addmerchant() {
            $.magnificPopup.open({
                items: {
                    src: '#form-submit-createadminlink'
                },
                type: 'inline'
            }, 0);
        }

        function copyuid(e, uid) {
            e.preventDefault();
            var anim = "bounce";
            copyuidlink($("#" + uid), anim);
            copyToClipboard(uid);
        }


        function reload_billtoken() {
            $('div.block1').block();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('service/getallbilltokenhtml'); ?>",
                data: {
                    'merchantid': '<?= $merchant->id ?>'
                },
                dataType: "html",
                success: function(data) {
                    if (data == "") {

                        $("#billtokenhead").hide();
                        $("#billtokengraph").hide();

                    }
                    $('div.block1').unblock();
                    $('#billtokenlist').html(data);
                    $('tbody.selected tr').first().trigger('click');
                    return false;

                },
                error: function(XMLHttpRequest) {
                    $('div.block1').unblock();
                    return false;
                }
            });


        }

        function getbilldata(token) {
            $("#billink").html('petto.co/' + '<b>' + token + '</b> ');
            $("#billinkhd").html('<?= base_url() ?>' + token);
            $("#billtokenhd").val(token);

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('service/getmerchantbilldata'); ?>",
                data: {
                    'token': token
                },
                dataType: "json",
                success: function(data) {
                    if (data.result.isstockenable == "1") {
                        $('#isstockenable').prop('checked', true);
                    } else {
                        $('#isstockenable').prop('checked', false);
                    }


                    $("#billtokenid").val(data.result.id);

                    $("#activetoken").val(data.result.token);
                    if (data != null) {
                        var arr = [];
                        $("#billtokenname").html(data.result.name);
                        $("#activetokenid").val(data.result.id);
                        var totalbill = 0;
                        $.each(data.result2, function(index, value) {
                            totalbill += parseInt(value.row2);
                            arr.push([parseInt(value.row1 + "000"), value.row2, value.row3]);
                        });
                        $("#billtotal").html("จำนวน " + totalbill + " บิล");

                        var html = "";
                        $.each(data.result3, function(index, value) {
                            html += value.merchantlinename + " ,";

                        });
                        html = html.substring(0, html.length - 1);
                        $("#billusernotification").html(html);


                        potbarchart(arr);
                        getbillitemstock(token);
                    }


                },
                error: function(XMLHttpRequest) {
                    $('div.block1').unblock();
                    return false;
                }
            });


        }

        function getbillitemstock(token) {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('service/getbillitiemswithstock'); ?>",
                data: {
                    'token': token
                },
                dataType: "html",
                success: function(data) {
                    //console.log(data);
                    $("#itemstock").html(data);


                    $('a[name=stockamount]').editable({
                        pk: 1,
                        name: 'amount',
                        title: 'Enter amount',
                        validate: function(value) {
                            if ($.trim(value) == '') return 'This field is required';
                            if (!$.isNumeric($.trim(value))) return 'ต้องระบุเป็นจำนวนเช่น -10 ถึง 10';
                        }
                    });

                },
                error: function(XMLHttpRequest) {
                    $('div.block1').unblock();
                    return false;
                }
            });
        }

        function potbarchart(data) {
            var barOptions = {
                series: {
                    bars: {
                        show: true,
                        barWidth: 43200000
                    }
                },
                xaxis: {
                    mode: "time",
                    timeformat: "%d/%m/%Y",
                    minTickSize: [1, "day"]
                },
                grid: {
                    hoverable: true
                },
                legend: {
                    show: false
                },
                colors: ["#fb9678"],
                grid: {
                    color: "#AFAFAF",
                    hoverable: true,
                    borderWidth: 0,
                    backgroundColor: '#FFF'
                },
                tooltip: true,
                tooltipOpts: {
                    content: "วันที่: %x, จำนวนบิล: %y",
                    defaultTheme: false
                }
            };
            var barData = {
                label: "bar",
                color: "#fb9678",
                data: data
            };
            $.plot($("#flot-bar-chart"), [barData], barOptions);
        }

        function copyToClipboard(elementId) {


            var aux = document.createElement("input");
            aux.setAttribute("value", document.getElementById(elementId).innerHTML);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");

            document.body.removeChild(aux);

        }

        function deleteadminuid(id) {
            swal({
                title: "Are you sure?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {

                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url('service/deletemerchantlineuid'); ?>",
                        data: {
                            'id': id
                        },
                        dataType: "json",
                        success: function(data) {

                            swal("Deleted!", "Your imaginary file has been deleted.", "success");
                            location.reload();

                        },
                        error: function(XMLHttpRequest) {}
                    });

                } else {
                    swal("Cancelled", "", "error");
                }
            });
        }
    </script>

</body>

</html>