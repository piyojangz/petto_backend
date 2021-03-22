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
        width: 150px;
        height: 150px;
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
                        <h4 class="page-title">กำหนดค่า</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">กำหนดค่า</a></li>
                            <li class="active">เพิ่มบัญชี</li>
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

                        <button class="btn-item-modal btn btn-outline btn-primary waves-effect waves-light"><i class="fa fa-plus m-r-5"></i> <span>เพิ่มหมวด</span></button>

                        <hr>
                    </div>

                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">รายการบัญชี</div>
                            <div class="table-responsive">
                                <table class="table table-hover manage-u-table">
                                    <thead>
                                        <tr>
                                            <th width="70" class="text-center">#</th>
                                            <th>ชื่อ</th>
                                            <th width="150">MANAGE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($cate as $index => $item) : ?>
                                            <?php
                                            $iconLevel = '';

                                            switch ($item->level) {
                                                case '1':
                                                    $iconLevel = '';
                                                    break;
                                                case '2':
                                                    $iconLevel = '';
                                                    break;
                                                case '3':
                                                    $iconLevel = '';
                                                    break;
                                            }
                                            ?>
                                            <tr>
                                                <td class="text-right" style="vertical-align: center;"><?= $item->level == 1 ? $item->rowno : '' ?></td>
                                                <?php if ($item->level == 1) : ?>
                                                    <td style="vertical-align: middle;"> <?= $item->name ?></td>
                                                <?php endif; ?>
                                                <?php if ($item->level == 2) : ?>
                                                    <td style="vertical-align: middle;"><i style="color:red" class="fa fa-angle-right" aria-hidden="true"></i><i style="color:red" class="fa fa-angle-right" aria-hidden="true"></i><?= $item->level == 2 ? $item->rowno : '' ?> <?= $item->name ?></td>
                                                <?php endif; ?>
                                                <?php if ($item->level == 3) : ?>
                                                    <td style="vertical-align: middle;"><i style="color:blue" class="fa fa-angle-right" aria-hidden="true"></i><i style="color:blue" class="fa fa-angle-right" aria-hidden="true"></i><i style="color:blue" class="fa fa-angle-right" aria-hidden="true"></i><i style="color:blue" class="fa fa-angle-right" aria-hidden="true"></i><?= $item->level == 3 ? $item->rowno : '' ?> <?= $item->name ?></td>
                                                <?php endif; ?>
                                                </td>
                                                <td class="text-right">
                                                    <?php if ($item->level != 3) : ?>
                                                        <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5" onclick="additem('<?= $item->id ?>');"><i class="ti-plus"></i></button>
                                                    <?php endif; ?>
                                                    <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5" onclick="edititem('<?= $item->id ?>');"><i class="ti-pencil-alt"></i></button>
                                                    <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5" onclick="removeitem('<?= $item->id ?>', '<?= $token ?>', 'true')"><i class="ti-trash"></i></button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


                <form action="<?= base_url("account/$token/addnewcate") ?>" method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" id="form-submit">
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
                                                            <input type="text" name="name" id="name" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">รูป</label>
                                                        <div class="col-md-9">
                                                            <div class="image-editor" style="margin: 0 auto; width: 500px;">
                                                                <input type="hidden" id="imageData" name="imageData" />
                                                                <input type="file" class="cropit-image-input" data-max-file-size="2M" accept=".jpg,.png" />
                                                                <div class="cropit-preview"></div>
                                                                <div class="image-size-label"></div>
                                                                <input type="range" class="cropit-image-zoom-input" style="width:100%;">
                                                                <button class="select-image-btn btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-image"></i></span>เลือกรูปภาพ
                                                                </button>
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
                                                <input type="hidden" id="parentid" name="parentid" />

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

        $('.select-image-btn').click(function() {
            $('.cropit-image-input').click();
        });
        $('.image-editor').cropit({
            //exportZoom: 1.25,
            imageBackground: true,
            imageBackgroundBorderWidth: 30, 
        });


        $('.rotate-cw').click(function() {
            $('.image-editor').cropit('rotateCW');
        });
        $('.rotate-ccw').click(function() {
            $('.image-editor').cropit('rotateCCW');
        });
        $('#form-submit').submit(function() { 
            var imageData = $('.image-editor').cropit('export'); 

            if (imageData != null) {
                $("#imageData").val(imageData.split(",")[1]);
            }

            return true;
        });




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


        $('.btn-item-modal').click(function() {
            $("#id").val("");
            $("#name").val("");
            $("#parentid").val("");
            $("#bankaccount").val("");
            $("#accounttype").val("");
            $("#accountbranch").val("");
            $("#accountno").val("");
            $("#accountname").val("");
            $.magnificPopup.open({
                items: {
                    src: '#form-submit'
                },
                type: 'inline'
            }, 0);
        });


    });



    function additem(id) {
        $('div.block1').block({
            message: '<h3>กรุณารอสักครู่...</h3>',
            css: {
                border: '1px solid #fff'
            }
        });
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getcate'); ?>",
            data: JSON.stringify({
                'id': id
            }),
            dataType: "json",
            success: function(data) {
                $('div.block1').unblock();
                console.log(data.result);
                if (data.result != null) {
                    $("#title").val("");
                    $("#parentid").val(data.result.id);
                    $('.cropit-preview-image').attr("src", "");
                    $.magnificPopup.open({
                        items: {
                            src: '#form-submit'
                        },
                        type: 'inline'
                    }, 0);
                }

            },
            error: function(XMLHttpRequest) {
                $('div.block1').unblock();
            }
        });
    }

    function edititem(id) {
        $('div.block1').block({
            message: '<h3>กรุณารอสักครู่...</h3>',
            css: {
                border: '1px solid #fff'
            }
        });
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getcate'); ?>",
            data: JSON.stringify({
                'id': id
            }),
            dataType: "json",
            success: function(data) {
                $('div.block1').unblock();
                console.log(data.result);
                if (data.result != null) {
                    $("#id").val(data.result.id);
                    $("#name").val(data.result.name);
                    $('.cropit-preview-image').attr("src", data.result.picture);
                    $.magnificPopup.open({
                        items: {
                            src: '#form-submit'
                        },
                        type: 'inline'
                    }, 0);
                }

            },
            error: function(XMLHttpRequest) {
                $('div.block1').unblock();
            }
        });
    }

    function removeitem(id, token, isdelete) {

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
                swal("Deleted!", "Your data been deleted.", "success");
                location.href = '<?= base_url("account/updatecate/") ?>' + id + '/' + token + '/' + isdelete;

            } else {
                swal("Cancelled", "", "error");
            }
        });
    }
</script>

</html>