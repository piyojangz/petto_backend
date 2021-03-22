<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('account/template/header'); ?>
<style>
    .cropit-preview {
        background-color: #f8f8f8;
        background-size: cover;
        border: 0px solid #ccc;
        margin-top: 7px;
        width: 735px;
        height: 500px;
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
                        <h4 class="page-title">การรตลาด</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li class="active"><a href="#">แบนเนอร์</a></li>
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
                    <div class="col-sm-12">
                        <div class="white-box p-l-20 p-r-20">
                            <h3 class="box-title m-b-0">ตั้งค่าแบนเนอร์</h3>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label class="col-md-12">รูป Cover (735*500) <span class="label label-primary m-l-5"><a href="javascript:;" class="btn-cover" style="color: #fff;"><i class="fa fa-plus"></i> เพิ่ม</a></span></label>

                                        <div class="row">
                                            <?php foreach ($imagescover as $item) : ?>
                                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading"> <span class="label label-danger m-l-5"> <a href="javascript:;" onclick="removecover('<?= $item->id; ?>')" style="color: #fff;"><i class="fa fa-remove"></i> ลบ</a></span>
                                                            <span class="label label-primary m-l-5"> <a href="javascript:;" onclick="editcover('<?= $item->id; ?>')" style="color: #fff;"><i class="fa fa-edit"></i> แก้ไข</a></span>
                                                        </div>
                                                        <div class="panel-wrapper collapse in">
                                                            <div class="panel-body">
                                                                <img src="<?= $item->image; ?>" width="100%" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <form method="post" action="<?= base_url("account/$token/addcover") ?>" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" id="form-submit-cover" style="    max-width: 800px;">
                <input type="hidden" id="imagescoverid" name="imagescoverid" />
                <div class="panel panel-default">
                    <div class="panel-heading">เพิ่ม / แก้ไข</div>
                    <div class="panel-wrapper collapse in">
                        <div class="row">
                            <div class="panel panel-info ">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-12">Title</label>
                                                <div class="col-md-12">
                                                    <input type="text" name="title" id="title" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Caption</label>
                                                <div class="col-md-12">
                                                    <input type="text" name="caption" id="caption" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">External link</label>
                                                <div class="col-md-12">
                                                    <input type="text" name="externallink" id="externallink" class="form-control form-control-line" placeholder="eg. http://www.google.com">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-md-12">ระยะเวลา</label>
                                                <div class="col-md-12">
                                                    <input required type="text" name="daterange" id="daterange" class="form-control input-daterange-timepicker" name="daterange" value="">
                                                </div>
                                            </div>

                                            <div class="image-editor" style="margin: 0 auto; width: 735px;">
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
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-offset-9 col-md-3">
                                                    <button type="submit" id="btnaddcover" name="btnaddcover" class="btn btn-success"><i class="fa fa-check"></i> บันทึก/แก้ไขข้อมูล
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
    <script src="<?= base_url("res/account/plugins/bower_components/moment/moment.js") ?>"></script>
    <!-- Magnific popup JavaScript -->
    <script src="<?= base_url("res/account/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js") ?>"></script>


    <script src="<?= base_url("res/account/plugins/bower_components/summernote/dist/summernote.min.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js") ?>"></script>
</body>


<script>
    // Daterange picker
    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'DD/MM/YYYY h:mm A',
        // startDate: moment().startOf('hour'),
        // endDate: moment().startOf('hour').add(24, 'hour'),
        timePickerIncrement: 15,
        timePicker24Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        locale: {
            format: 'DD/MM/YYYY H:mm'
        }
    });


    function removecover(id) {
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
                    url: "<?php echo base_url('service/removeimagecover'); ?>",
                    data: JSON.stringify({
                        'id': id
                    }),
                    dataType: "json",
                    success: function(data) { 
                        swal("Deleted!", "Your request has been deleted.", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);

                    },
                    error: function(XMLHttpRequest) {

                    }
                });

            } else {
                swal("Cancelled", "", "error");
            }
        });
    }

    function editcover(id) {
        $("#imagescoverid").val(id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getimagecover'); ?>",
            data: JSON.stringify({
                'id': id
            }),
            dataType: "json",
            success: function(data) {
                console.log(data);
                if (data.result != null) {
                    $('.cropit-preview-image').attr("src", data.result.image);
                    $('#title').val(data.result.title);
                    $('#caption').val(data.result.caption);
                    $('#externallink').val(data.result.externallink);


                    dfrom = moment(data.result.dfrom).format('DD/MM/YYYY H:mm');
                    dto = moment(data.result.dto).format('DD/MM/YYYY H:mm'); 

                    $('#daterange').val(dfrom + " - " + dto);


                    $.magnificPopup.open({
                        items: {
                            src: '#form-submit-cover'
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
    $(document).ready(function() {

        $(".btn-cover").click(function() {
            $("#imagescoverid").val("");
            $('#title').val("");
            $('#caption').val("");
            $('#daterange').val("");
            $('#externallink').val("");
            $('.cropit-preview-image').attr("src", "");
            $.magnificPopup.open({
                items: {
                    src: '#form-submit-cover'
                },
                type: 'inline'
            }, 0);
        });

        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });


        $('.inline-editor').summernote({
            airMode: true
        });

        $('.select-image-btn').click(function() {
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


        $('.rotate-cw').click(function() {
            $('.image-editor').cropit('rotateCW');
        });
        $('.rotate-ccw').click(function() {
            $('.image-editor').cropit('rotateCCW');
        });
        $('#form-submit').submit(function() {

            var text = $('textarea[name="customtext"]').html($('#customtext').code());
            $("#inputcustomtext").val(text.val());

            return true;
        });


        $('#form-submit-cover').submit(function() {
            var imageData = $('.image-editor').cropit('export');

            if (imageData != null) {
                $("#imageData").val(imageData.split(",")[1]);
            }

            return true;
        });


    });
</script>


</html>