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
                        <h4 class="page-title">รายการผู้ใช้ที่ถูกระงับ</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li class="active"><a href="#">บัญชีผู้ใช้</a></li>
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
                        <form action="<?= base_url("account/$token/banlist") ?>" method="post" class=" " id="form-submit-search">
                            <div class="input-group m-t-10">
                                <input type="text" id="searchtxt" name="searchtxt" class="form-control" placeholder="ชื่อ  , เบอร์โทร , อีเมลล์" value="<?= $searchtxt ?>"> <span class="input-group-btn">
                                    <button type="submit" style="    margin-top: 0px;" class="btn waves-effect waves-light btn-info">ค้นหา</button>
                                </span>
                            </div>
                        </form>
                        <hr>
                    </div>

                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">บัญชีผู้ใช้</div>
                            <div class="table-responsive">
                                <table class="table table-hover manage-u-table">
                                    <thead>
                                        <tr>
                                            <th width="70" class="text-center">#</th>
                                            <th>ชื่อ</th>
                                            <th>อีเมลล์</th>
                                            <th>เบอร์โทร</th>
                                            <th>หมายเหตุ</th>
                                            <!-- <th>ไฟล์แนบ</th> -->
                                            <th>สถานะ</th>
                                            <th>การยกเลิกการระงับบัญชี</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($merchant as $index => $item) : ?>
                                            <tr>
                                                <td class="text-center" style="vertical-align: middle;"><?= $index + 1 ?></td>
                                                <td style="vertical-align: middle;"><?= $item->title ?></td>
                                                <td style="vertical-align: middle;"><?= $item->email ?></td>
                                                <td style="vertical-align: middle;"><?= $item->tel ?></td>
                                                <td style="vertical-align: middle;color:red"><?= $item->reason ?></td>
                                                <!-- <td style="vertical-align: middle;"><a class="badge  <?= $item->status == 0 ? 'badge-danger' : 'badge-danger' ?> btn-file-modal" onclick="openfile('<?= $item->id ?>','<?= $item->fileattached ?>')" href="javascript:;">view</a></td> -->
                                                <td style="vertical-align: middle;"><span class="badge  <?= $item->status == 0 ? 'badge-danger' : 'badge-danger' ?> " href="#"><?= 'ถูกระงับบัญชี' ?></span> </td>
                                                <td style="vertical-align: middle;"><a class="badge  <?= $item->status == 0 ? 'badge-danger' : 'badge-danger' ?> btn-file-modal" onclick="openfile('<?= $item->id ?>','<?= $item->fileattached ?>')" href="javascript:;">คลิก</a></td>
                                            </tr>
                                        <?php endforeach; ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>





                <form action="<?= base_url("account/$token/changeuserstatus") ?>" method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" id="form-submit">
                    <div class="panel panel-default">
                        <div class="panel-heading">ไฟล์แนบ</div>
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
                                                            <select class="form-control" name="status" id="status" required>
                                                                <option value="">เลือกคำสั่ง</option>
                                                                <option value="0">ยกเลิกการระงับ</option>
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

        $('.popup-with-form').magnificPopup({
            type: 'inline',
            preloader: true,
            focus: '#name',
            callbacks: {
                beforeOpen: function() {
                    if ($(window).width() < 700) {
                        this.st.focus = false;
                    } else {
                        this.st.focus = '#name';
                    }
                }
            }
        });



    });


    function openfile(id, _file) {
        $("#fileattached").attr("src", _file);


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