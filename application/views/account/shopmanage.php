<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('account/template/header'); ?>
<style>
    .cropit-preview-edit {
        background-color: #f8f8f8;
        background-size: cover;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-top: 7px;
        width: 300px;
        height: 300px;
    }

    .cropit-preview-edit img {
        width: 100%;
    }

    .cropit-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-top: 7px;
        width: 300px;
        height: 300px;
    }

    .cropit-image-input {
        visibility: hidden;
    }

    .cropit-preview-image-container {
        cursor: move;
    }

    .cropit-preview-background {
        opacity: .2;
        cursor: auto;
    }

    .image-size-label {
        margin-top: 10px;
    }

    input,
    .export {
        /* Use relative position to prevent from being covered by image background */
        position: relative;
        z-index: 10;
        display: block;
    }

    button {
        margin-top: 10px;
    }
</style>

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
                        <h4 class="page-title">การตลาด</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">การตลาด</a></li>
                            <li class="active">ร้านค้า</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Different data widgets -->
                <!-- ============================================================== -->
                <div class="col-md-12">
                    <form action="<?= base_url("account/$token/shopmanage") ?>" method="post" class=" " id="form-submit-search">
                        <div class="input-group m-t-10">
                            <input type="text" id="searchtxt" name="searchtxt" class="form-control" placeholder="ชื่อร้านค้า" value="<?= $searchtxt ?>"> <span class="input-group-btn">
                                <button type="submit" style="    margin-top: 0px;" class="btn waves-effect waves-light btn-info">ค้นหา</button>
                            </span>
                        </div>
                    </form>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">ร้านค้า</div>
                        <div class="table-responsive">
                            <table class="table table-hover manage-u-table">
                                <thead>
                                    <tr>
                                        <th width="70" class="text-center">#</th>

                                        <th>shopID</th>
                                        <th>ร้าน</th>
                                        <th>ระดับ</th>
                                        <th>คะแนนร้านค้า</th>
                                        <th>ขายแล้ว</th>
                                        <th>ร้านแนะนำ</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($merchant as $index => $item) :
                                        $PACKICON = '';
                                        switch ($item->packageid) {
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
                                        $RECOMMENDICON = '';
                                        if ($item->isrecommend  == 1) {
                                            $RECOMMENDICON = '<span class="badge" style="background:green"><i class="fa fa-star">ร้านค้าแนะนำ</span>';
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle;"><img src="<?= $item->image ?>" style="width: 80px;" /></td>
                                            <td class="text-center" style="vertical-align: middle;"><?= $index + 1 ?></td>
                                            <td style="vertical-align: middle;"><a href='<?= base_url("account/$token/itemmanage?shopid=$item->id") ?>'><?= $item->name ?  $item->name : $item->webname ?></a></td>
                                            <td style="vertical-align: middle;"><?= $PACKICON ?></td>
                                            <td class="text-center" style="vertical-align: middle;"><?= $item->rating != null ? $item->rating : 0 ?></td>
                                            <td class="text-center" style="vertical-align: middle;"><?= $item->sold?></td>
                                            <td class="text-center" style="vertical-align: middle;"><?= $RECOMMENDICON ?></td>
                                            <td style="vertical-align: middle;"><a class="badge  <?= $item->status == 0 ? 'badge-success' : 'badge-success' ?> btn-file-modal" onclick="openfile('<?= $item->id ?>')" href="javascript:;">view</a></td>
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <form action="<?= base_url("account/$token/changemerchantrecommend") ?>" method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" id="form-submit">
                <div class="panel panel-default">
                    <div class="panel-heading">ตั้งค่าร้านค้า</div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-info ">
                                        <div class="panel-body">

                                            <div class="form-body">
                                                <div class="form-group">
                                                    <img id="fileattached" src="" style="width:100%" class="img img-rounded" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">สถานะ</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="status" id="status" require>
                                                            <option value="0">ไม่อนุมัติ</option>
                                                            <option value="1">อนุมัติ</option>
                                                        </select>
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
                                            <input type="hidden" id="merchantid" name="merchantid" />

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


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
    <script src="<?= base_url("res/account/plugins/bower_components/summernote/dist/summernote.min.js") ?>"></script>
    <!-- Magnific popup JavaScript -->
    <script src="<?= base_url("res/account/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js") ?>"></script>
</body>
<script>
    $(document).ready(function() {

    });

    function openfile(id) {
        $("#merchantid").val(id);
        $.magnificPopup.open({
            items: {
                src: '#form-submit'
            },
            type: 'inline'
        }, 0);
    }
</script>

</html>