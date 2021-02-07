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
                        <h4 class="page-title">แพคเกจ</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li class="active"><a href="#">ตั้งค่าแพคเกจ</a></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Different data widgets -->
                <!-- ============================================================== -->

                <div class="row el-element-overlay m-b-40 block1">
                    <!-- <div class="col-md-12">
                        <form action="<?= base_url("account/$token/package") ?>" method="post" class=" " id="form-submit-search">
                            <div class="input-group m-t-10">
                                <input type="text" id="searchtxt" name="searchtxt" class="form-control" placeholder="ชื่อ  , เบอร์โทร , อีเมลล์" value="<?= $searchtxt ?>"> <span class="input-group-btn">
                                    <button type="submit" style="    margin-top: 0px;" class="btn waves-effect waves-light btn-info">ค้นหา</button>
                                </span>
                            </div>
                        </form>
                        <hr>
                    </div> -->

                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">รายการ</div>
                            <div class="table-responsive">
                                <form action="<?= base_url("account/$token/package") ?>" method="post" class="form-material " id="form-submit">
                                    <table class="table table-hover manage-u-table">
                                        <thead>
                                            <tr>
                                                <th width="70" class="text-center">#</th>
                                                <th>ประเภท</th>
                                                <th width="120">Sale slot <br><code>0 = unlimit</code></th>
                                                <th>Bidding</th>
                                                <th>Duration</th>
                                                <th width="120">Price <br><code>0 = free</code></th>
                                                <th width="80">Manage Users</th>
                                                <th>ร้านขายดี</th>
                                                <th>ร้านค้าแนะนำ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($packagelist as $index => $row) :
                                                $PACKICON = '';
                                                switch ($row->packagename) {
                                                    case 'STARTUP':
                                                        $PACKICON = '<span class="badge" style="background:blue"><i class="fa fa-star"> Free StartUP</span>';
                                                        break;
                                                    case 'SILVER':
                                                        $PACKICON = '<span class="badge" style="background:silver"><i class="fa fa-star"> Silver</span>';
                                                        break;
                                                    case 'GOLD':
                                                        $PACKICON = '<span class="badge" style="background:gold"><i class="fa fa-star"> Gold</span>';
                                                        break;
                                                    case 'PLATINUM':
                                                        $PACKICON = '<span class="badge" style="background:platinum"><i class="fa fa-star"> Platinum</span>';
                                                        break;

                                                    default:
                                                        # code...
                                                        break;
                                                }
                                            ?>
                                                <input id="packageid[]" name="packageid[]" type="hidden" class="form-control" value="<?= $row->id ?>">
                                                <tr>
                                                    <td class="text-center" style="vertical-align: middle;"><?= $index + 1 ?></td>
                                                    <td style="vertical-align: middle;"><?= $PACKICON ?></td>
                                                    <td style="vertical-align: middle;">
                                                        <input id="saleslot[]" name="saleslot[]" type="number" class="form-control" value="<?= $row->saleslot ?>">
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <select id="isbiding[]" name="isbiding[]" class="form-control">
                                                            <option value="0" <?= $row->isbiding == 0 ? 'selected' : '' ?>>FALSE</option>
                                                            <option value="1" <?= $row->isbiding == 1 ? 'selected' : '' ?>>TRUE</option>
                                                        </select>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <select id="duration[]" name="duration[]" class="form-control">
                                                            <option value="0" <?= $row->duration == 0 ? 'selected' : '' ?>>Life time</option>
                                                            <option value="15" <?= $row->duration == 15 ? 'selected' : '' ?>>15 Days</option>
                                                            <option value="30" <?= $row->duration == 30 ? 'selected' : '' ?>>30 Days</option>
                                                            <option value="45" <?= $row->duration == 45 ? 'selected' : '' ?>>45 Days</option>
                                                            <option value="60" <?= $row->duration == 60 ? 'selected' : '' ?>>60 Days</option>
                                                            <option value="120" <?= $row->duration == 120 ? 'selected' : '' ?>>120 Days</option>
                                                        </select>
                                                    </td>
                                                    <td style="vertical-align: middle;"><input id="price[]" name="price[]" type="number" class="form-control" value="<?= $row->price ?>"></td>
                                                    <td style="vertical-align: middle;"><input id="manageuser[]" name="manageuser[]" type="number" class="form-control" value="<?= $row->manageuser ?>"></td>
                                                    <td style="vertical-align: middle;">
                                                        <select id="isbestseller[]" name="isbestseller[]" class="form-control">
                                                            <option value="0" <?= $row->isbestseller == 0 ? 'selected' : '' ?>>ไม่มีสิทธิ์</option>
                                                            <option value="1" <?= $row->isbestseller == 1 ? 'selected' : '' ?>>มีสิทธิ์</option>
                                                        </select>
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <select id="isrecommend[]" name="isrecommend[]" class="form-control">
                                                            <option value="0" <?= $row->isrecommend == 0 ? 'selected' : '' ?>>ไม่มีสิทธิ์</option>
                                                            <option value="1" <?= $row->isrecommend == 1 ? 'selected' : '' ?>>มีสิทธิ์</option>
                                                        </select>
                                                    </td>
                                                </tr>

                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    <div class="col-md-offset-9 col-md-3">
                                        <div class="form-group">
                                            <button type="submit" id="btnsubmit" class="btn btn-success"> <i class="fa fa-check"></i> บันทึก/แก้ไขข้อมูล</button>
                                        </div>
                                    </div>
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


        $("#id").val(id);
        $.magnificPopup.open({
            items: {
                src: '#form-submit'
            },
            type: 'inline'
        }, 0);
    }
</script>

</html>