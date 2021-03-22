<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('account/template/header'); ?>
<style>


    .cropit-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 0px solid #ccc;
        margin-top: 7px;
        width: 250px;
        height: 250px;
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

    input, .export {
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
                    <h4 class="page-title">โพส</h4></div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li class="active"><a href="#">โพสบทความ</a></li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- ============================================================== -->
            <!-- Different data widgets -->
            <!-- ============================================================== -->


            <div class="row el-element-overlay m-b-40 block1">
                <!--                        <div class="col-md-12">

                                            <button class="btn-item-modal btn btn-outline btn-primary waves-effect waves-light"> <i class="fa fa-user-plus m-r-5"></i> <span>เพิ่มลูกค้า</span></button>

                                            <hr>
                                        </div> -->

                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">เรื่อง <span
                                    class="label label-primary m-l-5"><a href="javascript:;"
                                                                         class="btn-cover"
                                                                         style="color: #fff;"><i
                                            class="fa fa-plus"></i> เขียนเรื่องใหม่</a></span></div>
                        <div class="table-responsive">
                            <table class="table table-hover manage-u-table">
                                <thead>
                                <tr>
                                    <th width="70" class="text-center">#</th>
                                    <th>รูปหน้าปก</th>
                                    <th>หัวข้อ</th>
                                    <th>วันที่โพส</th>
                                    <th>วันที่แก้ไข</th>
                                    <th>MANAGE</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($article as $index => $item): ?>
                                    <tr>
                                        <td class="text-center" style="vertical-align: middle;"><?= $index + 1 ?></td>
                                        <td style="vertical-align: middle;"><img src="<?= $item->image ?>"
                                                                                 class="img img-thumbnail"
                                                                                 style="width: 100px;"/></td>
                                        <td style="vertical-align: middle;"><?= $item->title ?></td>
                                        <td style="vertical-align: middle;"><?= $item->createdate ?></td>
                                        <td style="vertical-align: middle;"><?= $item->updatedate ?></td>
                                        <td>
                                            <button type="button"   onclick="edit('<?= $item->id; ?>')"
                                                    class="btn btn-info btn-outline btn-circle btn-lg m-r-5"><i
                                                        class="ti-pencil-alt"></i></button>
                                            <button type="button"   onclick="remove('<?= $item->id; ?>')"
                                                    class="btn btn-info btn-outline btn-circle btn-lg m-r-5"><i
                                                        class="icon-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>


            <form method="post" action="<?= base_url("account/$token/addarticle") ?>"
                  class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft"
                  id="form-submit-post" style="    max-width: 800px;">
                <input type="hidden" id="articleid" name="articleid"/>
                <div class="panel panel-default">
                    <div class="panel-heading">เพิ่ม / แก้ไข</div>
                    <div class="panel-wrapper collapse in">
                        <div class="row">
                            <div class="panel panel-info ">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-12">หัวข้อ</label>
                                                <div class="col-md-12">
                                                    <input type="text" name="title" id="title"
                                                           class="form-control form-control-line"
                                                           placeholder="เพิ่มหัวข้อที่นี่" value="" required></div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-12">รายละเอียด</label>
                                                <div class="col-md-12">
                                                           <textarea id="customtext" name="customtext"
                                                                     class="summernote"></textarea>
                                                    <input value="" name="inputcustomtext" id="inputcustomtext"
                                                           type="hidden">

                                                </div>
                                                <label class="col-md-12">รูปหน้าปก</label>
                                                <div class="image-editor" style="margin: 0 auto;
    width: 735px;">
                                                    <input type="hidden" id="imageData" name="imageData"/>
                                                    <input type="file" class="cropit-image-input"
                                                           data-max-file-size="2M"
                                                           accept=".jpg,.png"/>
                                                    <div class="cropit-preview"></div>
                                                    <div class="image-size-label"></div>
                                                    <input type="range" class="cropit-image-zoom-input"
                                                           style="width:250px;">
                                                    <button class="select-image-btn btn btn-info waves-effect waves-light"
                                                            type="button"><span class="btn-label"><i
                                                                    class="fa fa-image"></i></span>เลือกรูปภาพ
                                                    </button>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-offset-9 col-md-3">
                                                        <button type="submit" id="btnaddcover" name="btnaddcover"
                                                                class="btn btn-success"><i
                                                                    class="fa fa-check"></i> บันทึก/แก้ไขข้อมูล
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="adminid" name="adminid"/>

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


<script src="<?= base_url("res/account/plugins/bower_components/summernote/dist/summernote.min.js") ?>"></script>
</body>
<script>

    function remove(id) {
        swal({
            title: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {

                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url('service/removearticle'); ?>",
                    data: {'id': id},
                    dataType: "json",
                    success: function (data) {
                        swal("Deleted!", "Your request has been deleted.", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                    },
                    error: function (XMLHttpRequest) {

                    }
                });

            } else {
                swal("Cancelled", "", "error");
            }
        });
    }
    function edit(id) {
        $("#articleid").val(id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getarticle'); ?>",
            data: JSON.stringify({'id': id}),
            dataType: "json",
            success: function (data) {
                if (data.result != null) {
                    $('.cropit-preview-image').attr("src",data.result.image);
                    $('#title').val(data.result.title);
                    $('#customtext').code(data.result.description);

                    $.magnificPopup.open({items: {src: '#form-submit-post'}, type: 'inline'}, 0);
                }

            },
            error: function (XMLHttpRequest) {
                $('div.block1').unblock();
            }
        });


    }


    $(document).ready(function () {
        $(".btn-cover").click(function () {
            $('.cropit-preview-image').attr("src", "");
            $("#articleid").val("");
            $('#title').val("");
            $('#customtext').code("");
            $.magnificPopup.open({items: {src: '#form-submit-post'}, type: 'inline'}, 0);
        });

        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });


        $('.select-image-btn').click(function () {
            $('.cropit-image-input').click();
        });
        $('.image-editor').cropit({
            //exportZoom: 1.25,
            imageBackground: true,
            imageBackgroundBorderWidth: 30,
//                imageState: {
//                    src: '<?= $merchant->image ?>',
//                },
        });


        $('#form-submit-post').submit(function () {
            var imageData = $('.image-editor').cropit('export');

            if (imageData != null) {
                $("#imageData").val(imageData.split(",")[1]);
            }

            var text = $('textarea[name="customtext"]').html($('#customtext').code());
            $("#inputcustomtext").val(text.val());

            return true;
        });


    });

</script>
</html>
