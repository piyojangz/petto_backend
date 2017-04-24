<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('account/template/header'); ?>
    <style>
        .cropit-preview-edit{
            background-color: #f8f8f8;
            background-size: cover;
            border: 1px solid #ccc;
            border-radius: 3px;
            margin-top: 7px;
            width: 300px;
            height: 300px;
        }
        .cropit-preview-edit img{
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
        .cropit-image-input{
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
                            <h4 class="page-title">สินค้า</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                            <ol class="breadcrumb">
                                <li ><a href="#" >คลังสินค้า</a></li> 
                                <li class="active">สินค้า</li> 
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
                            <div class="row">
                                <div class="col-sm-offset-11 col-lg-1  text-center"> 
                                    <button type="button" class="btn-item-modal btn btn-success btn-circle btn-lg btn-outline"  ><i class="fa fa-plus"></i> </button>
                                </div>
                            </div>
                            <hr>
                        </div> 
                        <?php foreach ($items as $item): ?> 

                            <!-- /.usercard -->
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                <div class="white-box">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1" style="width:100%;overflow: hidden"> <img src="<?= $item->image ?>"   />
                                            <div class="el-overlay">
                                                <ul class="el-info">
                                                    <li><a class="btn default btn-outline image-popup-vertical-fit" href="javascript:void(0);"  onclick="edititem('<?= $item->id ?>')"><i class="ti-pencil-alt"></i></a></li>
                                                    <li><a class="btn default btn-outline" href="javascript:void(0);" onclick="removeitem('<?= $item->id ?>', '<?= $token ?>', 'true')"><i class="ti-trash"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="el-card-content" >
                                            <h3 class="box-title text-info" ><?= $item->name ?></h3> <small>฿<?= number_format($item->price) ?></small>
                                            <br> </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.usercard--> 
                        <?php endforeach; ?>
                    </div> 

                </div>


                <!-- sample modal content -->
                <div class="modal  bs-example-modal-lg fade" id="itemmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-info ">

                                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                                <div class="panel-body">
                                                    <form action="<?= base_url("account/$token/addnewproduct") ?>" method="post" class="form-horizontal form-bordered"  id="form-submit">
                                                        <div class="form-body">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">ชื่อสินค้า</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="name" id="name" class="form-control" maxlength="35" required>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">ราคา</label>
                                                                <div class="col-md-9">
                                                                    <input type="number" name="price" id="price" required  class="form-control"> 
                                                                </div>
                                                            </div>

                                                            <div class="form-group"> 

                                                                <label class="control-label col-md-3">รูปภาพ</label>  
                                                                <div class="col-md-9"> 
                                                                    <div class="cropit-preview-edit"><img id="imgedit" src=""/>        </div> 
                                                                    <button class="btn-edit-img btn btn-warning waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-edit"></i></span>แก้ไขรูปภาพ</button>



                                                                    <div class="image-editor">
                                                                        <input type="hidden" id="imageData" name="imageData" />
                                                                        <input type="file"   class="cropit-image-input"   data-max-file-size="2M"  accept=".jpg,.png" /> 
                                                                        <div class="cropit-preview"></div>  
                                                                        <div class="image-size-label">
                                                                            ย่อ / ขยายรูป
                                                                        </div>
                                                                        <input type="range" class="cropit-image-zoom-input" style="width:300px;" >    
                                                                        <button class="select-image-btn btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-image"></i></span>เลือกรูปภาพ</button>
<!--                                                                        <button class="export   btn btn-danger waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-crop"></i></span>CROP</button>-->
                                                                    </div> 
                                                                </div>
                                                            </div>


                                                            <div class="form-actions">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="row">
                                                                            <div class="col-md-offset-9 col-md-3">
                                                                                <button type="submit" id="btnsubmit"  class="btn btn-success"> <i class="fa fa-check"></i> บันทึก/แก้ไขข้อมูล</button> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="id" name="id" />
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>   
                            </div>
                            <div class="modal-footer">
                                <button type="button"  class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
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
    </body>
    <script>
                                                    $(document).ready(function () {



                                                        // Basic
                                                        $('.dropify').dropify();
                                                        // Translated
                                                        $('.dropify-fr').dropify({
                                                            messages: {
                                                                default: 'Glissez-déposez un fichier ici ou cliquez',
                                                                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                                                                remove: 'Supprimer',
                                                                error: 'Désolé, le fichier trop volumineux'
                                                            }
                                                        });
                                                        // Used events
                                                        var drEvent = $('#input-file-events').dropify();
                                                        drEvent.on('dropify.beforeClear', function (event, element) {
                                                            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
                                                        });
                                                        drEvent.on('dropify.afterClear', function (event, element) {
                                                            alert('File deleted');
                                                        });
                                                        drEvent.on('dropify.errors', function (event, element) {
                                                            console.log('Has Errors');
                                                        });
                                                        var drDestroy = $('#input-file-to-destroy').dropify();
                                                        drDestroy = drDestroy.data('dropify')
                                                        $('#toggleDropify').on('click', function (e) {
                                                            e.preventDefault();
                                                            if (drDestroy.isDropified()) {
                                                                drDestroy.destroy();
                                                            } else {
                                                                drDestroy.init();
                                                            }
                                                        });



                                                        $('.select-image-btn').click(function () {
                                                            $('.cropit-image-input').click();
                                                        });
                                                        $('.image-editor').cropit({
                                                            exportZoom: 1.25,
                                                            imageBackground: true,
                                                            imageBackgroundBorderWidth: 30,
                                                        });
                                                        $('.rotate-cw').click(function () {
                                                            $('.image-editor').cropit('rotateCW');
                                                        });
                                                        $('.rotate-ccw').click(function () {
                                                            $('.image-editor').cropit('rotateCCW');
                                                        });
                                                        $('#form-submit').submit(function () {
                                                            var imageData = $('.image-editor').cropit('export');
                                                            if (imageData != null) {
                                                                $("#imageData").val(imageData.split(",")[1]);
                                                            }

                                                            return true;
                                                        });

                                                        $('.btn-edit-img').click(function () {
                                                            $(".image-editor").show();
                                                        });

                                                        $('.btn-item-modal').click(function () {
                                                            $("#id").val("");
                                                            $("#name").val("");
                                                            $("#price").val("");
                                                            $(".cropit-preview-edit").hide();
                                                            $(".btn-edit-img").hide();
                                                            $('#itemmodal').modal('show');
                                                        });



                                                    });

                                                    function edititem(id) {
                                                        $('div.block1').block({
                                                            message: '<h3>กรุณารอสักครู่...</h3>',
                                                            css: {
                                                                border: '1px solid #fff'
                                                            }
                                                        });
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "<?php echo base_url('service/getitem'); ?>",
                                                            data: {'id': id},
                                                            dataType: "json",
                                                            success: function (data) {
                                                                $('div.block1').unblock();
                                                                if (data.result != null) {
                                                                    $("#id").val(data.result.id);
                                                                    $("#name").val(data.result.name);
                                                                    $("#price").val(data.result.price);

                                                                    if (data.result.image != "") {
                                                                        $("#imgedit").attr("src", data.result.image);
                                                                        $(".image-editor").hide();
                                                                        $(".cropit-preview-edit").show();
                                                                        $(".btn-edit-img").show();
                                                                    } else {
                                                                        $("#imgedit").attr("src", "");
                                                                        $(".image-editor").show();
                                                                        $(".cropit-preview-edit").hide();
                                                                        $(".btn-edit-img").hide();
                                                                    }

                                                                    $('#itemmodal').modal('show');
                                                                }

                                                            },
                                                            error: function (XMLHttpRequest) {
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
                                                        }, function (isConfirm) {
                                                            if (isConfirm) {
                                                                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                                                                location.href = '<?= base_url("account/updateproduct/") ?>' + id + '/' + token + '/' + isdelete;

                                                            } else {
                                                                swal("Cancelled", "", "error");
                                                            }
                                                        });
                                                    }


    </script>
</html>
