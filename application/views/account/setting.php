<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('account/template/header'); ?>
<style>
    .cropit-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 0px solid #ccc;
        margin-top: 7px;
        width: 150px;
        height: 150px;
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
                        <h4 class="page-title">ตั้งค่าร้าน</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li class="active"><a href="#">ตั้งค่าร้าน</a></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Different data widgets -->
                <!-- ============================================================== -->
                <!-- .row -->

                <?php if ($merchant->status == 0) : ?>
                    <?php if ($merchant->fileattached == "") : ?>
                        <div class="alert alert-warning" id="passwordnotmath">
                            กรุณาแนบบัตรประชาชน
                        </div>
                    <?php else : ?>
                        <?php if ($merchant->reason != '') : ?>
                            <div class="alert alert-warning" id="passwordnotmath">
                                <?= $merchant->reason ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if ($this->input->get('update') == 'success') : ?>
                    <div class="alert alert-success" id="passwordnotmath">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        อัพเดทข้อมูลเรียบร้อย
                    </div>
                <?php endif; ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box p-l-20 p-r-20">
                            <h3 class="box-title m-b-0">ตั้งค่าร้านค้า</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-horizontal" method="post" action="<?= base_url("account/$token/updatesetting") ?>" id="form-submit" enctype="multipart/form-data">



                                        <div class="form-group">
                                            <label class="col-md-12">โลโก้</label>
                                            <div class="col-md-12">

                                                <div class="image-editor">
                                                    <input type="hidden" id="imageData" name="imageData" />
                                                    <input type="file" class="cropit-image-input" data-max-file-size="2M" accept=".jpg,.png" />
                                                    <div class="cropit-preview"></div>
                                                    <div class="image-size-label"></div>
                                                    <input type="range" class="cropit-image-zoom-input" style="width:150px;">
                                                    <button class="select-image-btn btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-image"></i></span>เลือกรูปภาพ
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">ชื่อร้าน</label>
                                            <div class="col-md-12">
                                                <input type="text" name="name" id="name" class="form-control form-control-line" value="<?= $merchant->name ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Title</label>
                                            <div class="col-md-12">
                                                <input required type="text" name="title" id="title" class="form-control form-control-line" value="<?= $merchant->title ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">รายละเอียด (Meta description)</label>
                                            <div class="col-md-12">
                                                <textarea required rows="4" name="detail" class="form-control form-control-line"><?= $merchant->description ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">อีเมลล์</label>
                                            <div class="col-md-12">
                                                <input disabled type="text" name="email" class="form-control form-control-line" value="<?= $merchant->email ?>">
                                                <input type="hidden" name="hemail" class="form-control form-control-line" value="<?= $merchant->email ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">เปลี่ยนพาสเวิร์ด</label>
                                            <div class="col-md-12">
                                                <input type="password" name="password" id="password" class="form-control form-control-line" autocomplete="new-password" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">เบอร์โทรศัพท์</label>
                                            <div class="col-md-12">
                                                <input required type="text" name="tel" class="form-control form-control-line" value="<?= $merchant->tel ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">บัตรประชาชน</label>
                                            <img id="img" src="<?= $merchant->fileattached ?>" style="width: 200px;margin-bottom:20px;" />
                                            <div class="col-md-12">
                                                <input id="inp" type='file' accept=".jpg,.png">
                                                <input type="hidden" id="b64" name="imageidcard" />
                                            </div>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label class="col-md-12">LINEID</label>
                                            <div class="col-md-12">
                                                <input type="text" name="lineid" class="form-control form-control-line" value="<?= $merchant->lineid ?>">
                                            </div>
                                        </div> -->
                                        <!-- <div class="form-group">
                                            <label class="col-md-12">TOKEN</label>
                                            <div class="col-md-12">
                                                <input type="text" disabled class="form-control form-control-line" value="<?= $token ?>">
                                            </div>
                                        </div> -->

                                        <!-- <div class="form-group">
                                            <label class="col-md-12">ลิงค์สำหรับ Add Line <a href="https://www.youtube.com/watch?v=53uNH4jgndU" target="_blank"><i class="fa fa-external-link-square"></i> ดูวิธีที่นี่</a> </label>
                                            <div class="col-md-12">
                                                <input type="text" name="lineaddurl" class="form-control form-control-line" value="<?= $merchant->lineaddurl ?>">
                                            </div>
                                        </div> -->

                                        <button class="btn btn-block btn-outline btn-rounded btn-primary">บันทึก</button>
                                    </form>
                                </div>
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
    function readFile() {

        if (this.files && this.files[0]) {

            var FR = new FileReader();

            FR.addEventListener("load", function(e) {
                document.getElementById("img").src = e.target.result;
                document.getElementById("b64").value = e.target.result;
            });

            FR.readAsDataURL(this.files[0]);
        }

    }

    document.getElementById("inp").addEventListener("change", readFile);


    $(document).ready(function() {


        $('.select-image-btn').click(function() {
            $('.cropit-image-input').click();
        });
        $('.image-editor').cropit({
            //exportZoom: 1.25,
            imageBackground: true,
            imageBackgroundBorderWidth: 30,
            imageState: {
                src: '<?= $merchant->image ?>',
            },
        });

        $('.cropit-preview-image').attr("src", '<?= $merchant->image ?>');
        $('.rotate-cw').click(function() {
            $('.image-editor').cropit('rotateCW');
        });
        $('.rotate-ccw').click(function() {
            $('.image-editor').cropit('rotateCCW');
        });
        $('#form-submit').submit(function() {
            if ($("#password").val() != "") {
                if (confirm("ยืนยันการเปลี่ยนพาสเวิร์ด?")) {
                    return true;
                } else {
                    return false;
                }
            }

            var imageData = $('.image-editor').cropit('export');

            if (imageData != null) {
                $("#imageData").val(imageData.split(",")[1]);
            }

            return true;
        });


        //        $('#name').bind('input', function () {
        //            $(this).val(function (_, v) {
        //                return v.replace(/[^a-z0-9\s]/gi, '').replace(/[_\s]/g, '-');
        //            });
        //        });


    });
</script>


</html>