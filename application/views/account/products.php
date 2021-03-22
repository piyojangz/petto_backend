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

    .removeimg {
        background: rgb(237, 60, 32);
        padding: 5px;
        border-radius: 5px 5px 5px 5px;
        width: 30px;
        position: absolute;
        text-align: center;
        align-items: center;
        top: 0px;
        right: -20px;
        color: #fff !important;
        z-index: 999;
        display: block;
        cursor: pointer;
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
                        <h4 class="page-title">คลังสินค้า</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">คลังสินค้า</a></li>
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

                        <button class="btn-item-modal btn btn-outline btn-primary waves-effect waves-light"><i class="fa fa-cart-plus m-r-5"></i> <span>เพิ่มสินค้าใหม่</span></button>

                        <hr>
                    </div>
                    <?php foreach ($items as $item) : ?>

                        <!-- /.usercard -->
                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                            <div class="white-box">
                                <div class="el-card-item">
                                    <div class="el-card-avatar el-overlay-1" style="width:100%;overflow: hidden;min-height:100px"><img src="<?= $item->image ?>" />
                                        <div class="el-overlay">
                                            <ul class="el-info">
                                                <li><a class="btn default btn-outline image-popup-vertical-fit" href="javascript:void(0);" onclick="edititem('<?= $item->id ?>')"><i class="ti-pencil-alt"></i></a></li>
                                                <li><a class="btn default btn-outline" href="javascript:void(0);" onclick="removeitem('<?= $item->id ?>', '<?= $token ?>', 'true')"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="el-card-content">
                                        <h4 class="box-title text-info"><?= $item->name ?></h4>
                                        <small>฿<?= number_format($item->price) ?></small>
                                        <br>
                                        <code>คลัง <?= $item->stock ?></code>
                                        <br>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /.usercard-->
                    <?php endforeach; ?>
                </div>

            </div>
            <form action="<?= base_url("account/$token/addnewproduct") ?>" method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" style="max-width: 800px;" id="form-submit">
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
                                                    <label class="control-label col-md-3">ชื่อสินค้า</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="name" id="name" class="form-control" maxlength="120" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">หมวดหมู่</label>
                                                    <div class="col-md-9">
                                                        <select id="category" name="category" class="form-control">
                                                            <option value="0">ไม่มี</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">หมวดหมู่ย่อย1</label>
                                                    <div class="col-md-9">
                                                        <select id="category1" name="category1" class="form-control">
                                                            <option value="0">ไม่มี</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">หมวดหมู่ย่อย2</label>
                                                    <div class="col-md-9">
                                                        <select id="category2" name="category2" class="form-control">
                                                            <option value="0">ไม่มี</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">ราคา</label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="price" id="price" required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">ราคาลด</label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="discount" id="discount" required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">คลัง</label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="stock" id="stock" required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">รายละเอียดสินค้า</label>
                                                    <div class="col-md-9">
                                                        <textarea id="customtext" name="customtext" class="summernote"></textarea>
                                                        <input value="" name="inputcustomtext" id="inputcustomtext" type="hidden">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">ลิงค์วีดีโอ <br /><code>ตัวอย่าง https://www.youtube.com/embed/714KiXU15eU</code></label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="vdourl" id="vdourl" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group">

                                                    <label class="control-label col-md-3">รูปภาพปก</label>
                                                    <div class="col-md-9">
                                                        <div class="cropit-preview-edit"><img id="imgedit" src="" /></div>
                                                        <button class="btn-edit-img btn btn-warning waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-edit"></i></span>แก้ไขรูปภาพ
                                                        </button>


                                                        <div class="image-editor">
                                                            <input type="hidden" id="imageData" name="imageData" />
                                                            <input type="file" class="cropit-image-input" data-max-file-size="2M" accept=".jpg,.png" />
                                                            <div class="cropit-preview"></div>
                                                            <div class="image-size-label">
                                                                ย่อ / ขยายรูป
                                                            </div>
                                                            <input type="range" class="cropit-image-zoom-input" style="width:300px;">
                                                            <button class="select-image-btn btn btn-info waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-image"></i></span>เลือกรูปภาพ
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-horizontal">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">รูปอื่นๆ</label>
                                                        <div class="col-md-8">
                                                            <div class="row">
                                                                <div id="imagesother"></div>
                                                            </div>
                                                            <div class="row">
                                                                <div id="coba"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                                <div class="col-md-offset-9 col-md-3">
                                                                    <button type="submit" id="btnsubmit" class="btn btn-success"><i class="fa fa-check"></i> บันทึก/แก้ไขข้อมูล
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
    <script src="<?= base_url("res/js/spartan-multi-image-picker.js") ?>"></script>
</body>
<script>
    $(document).ready(function() {

        $("#category").change(function() {
            var id = $(this).val();
            getcate1(id,0);
        })


        $("#category1").change(function() {
            var id = $(this).val();
            getcate2(id,0);
        })

        $("#coba").spartanMultiImagePicker({
            fieldName: 'fileUpload[]',
            maxCount: 4,
            rowHeight: '200px',
            groupClassName: 'col-md-6 col-sm-6 col-xs-6',
            allowedExt: 'png|jpg|jpeg',
        });
        //category
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getcateparent'); ?>",
            data: JSON.stringify({
                'merchantid': '<?= $merchant->id ?>'
            }),
            dataType: "json",
            success: function(data) {
                var html = "";
                if (data.result != null) {
                    html += '<option value="">ไม่มี</option>';
                    $.each(data.result, function(index, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $("#category").html(html);
                }

            },
            error: function(XMLHttpRequest) {

            }
        });


        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
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


        $('.select-image-btn').click(function() {
            $('.cropit-image-input').click();
        });
        $('.image-editor').cropit({
            // exportZoom: 1.25,
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

            var text = $('textarea[name="customtext"]').html($('#customtext').code());
            $("#inputcustomtext").val(text.val());


            var elements = $(".img_");
            elements.each(function(i, e) {
                var val = $(e).attr('src');
                if (val != undefined) {
                    console.log(val);
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'multipleimages' + i,
                        name: 'multipleimages[]',
                        value: val
                    }).appendTo('#form-submit');
                }

            });


            return true;
        });

        $('.btn-edit-img').click(function() {
            $(".image-editor").show();
        });

        $('.btn-item-modal').click(function() {
            $("#id").val("");
            $("#name").val("");
            $("#price").val("");
            $("#vdourl").val("");
            $("#category").val("");
            $("#category1").val("");
            $("#category2").val("");

            $("#category1").html('<option value="0">ไม่มี</option>');
            $("#category2").html('<option value="0">ไม่มี</option>');
            
            $("input[class=multipleimages").remove();
            $("#imagesother").html("");
            $(".summernote").code("");
            $(".cropit-preview-edit").hide();
            $(".btn-edit-img").hide();
            $("#imgedit").hide();
            $(".image-editor").show();
            $.magnificPopup.open({
                items: {
                    src: '#form-submit'
                },
                type: 'inline'
            }, 0);
        });


    });


    function getcate1(parentid, id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getcatebyParentId'); ?>",
            data: JSON.stringify({
                'id': parentid
            }),
            dataType: "json",
            success: function(data) {
                var html = "";
                if (data.result != null) {
                    html += '<option value="0">ไม่มี</option>';
                    $.each(data.result, function(index, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $("#category1").html(html);
                }
                $("#category1").val(id);
            },
            error: function(XMLHttpRequest) {

            }
        });
    }


    function getcate2(parentid, id) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getcatebyParentId'); ?>",
            data: JSON.stringify({
                'id': parentid
            }),
            dataType: "json",
            success: function(data) {
                var html = "";
                if (data.result != null) {
                    html += '<option value="0">ไม่มี</option>';
                    $.each(data.result, function(index, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $("#category2").html(html);
                }
                $("#category2").val(id);
            },
            error: function(XMLHttpRequest) {

            }
        });
    }

    function removeimage(index) {
        $('#imagesother' + index).remove();
        $('#multipleimages' + index).remove();
    }

    function edititem(id) {
        $('div.block1').block({
            message: '<h3>กรุณารอสักครู่...</h3>',
            css: {
                border: '1px solid #fff'
            }
        });

        $('#imagesother').html("");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getitem'); ?>",
            data: JSON.stringify({
                'id': id
            }),
            dataType: "json",
            success: function(data) {
                $('div.block1').unblock();
                console.log(data);
                if (data.result != null) {
                    $("#id").val(data.result.id);
                    $("#name").val(data.result.name);
                    $("#price").val(data.result.price);
                    $("#discount").val(data.result.discount);
                    
                    $("#stock").val(data.result.stock);
                    $("#vdourl").val(data.result.video);
                    $(".summernote").code(data.result.description);
                    $("#category").val(data.result.cateid);

                    if (data.result.cateid1 != 0) {
                        getcate1(data.result.cateid, data.result.cateid1);
                    }

                    if (data.result.cateid2 != 0) {
                        getcate2(data.result.cateid1, data.result.cateid2);
                    }



                    if (data.result.image != "") {
                        var images = data.result.image.split('#');
                        console.log(images);
                        $("#imgedit").attr("src", images[0]);
                        $("#imageData").val(images[0]);
                        $(".image-editor").hide();
                        $(".cropit-preview-edit").show();
                        $(".btn-edit-img").show();
                        $("#imgedit").show();

                        for (var i = 0; i < images.length; i++) {
                            if (i > 0) {
                                $('#imagesother').append('<div    id="imagesother' + i + '" class="col-xs-4 imagesother" style="margin:5px;"><a onclick="removeimage(' + i + ')" class="removeimg"><i class="fa fa-times"></i></a><img id="imgedit" src="' + images[i] + '" style="width:150px"></div>');
                                $('<input>').attr({
                                    type: 'hidden',
                                    id: 'multipleimages' + i,
                                    class:'multipleimages',
                                    name: 'multipleimages[]',
                                    value: images[i]
                                }).appendTo('#form-submit');
                            }
                        }
                    } else {
                        $("#imgedit").attr("src", "");
                        $(".image-editor").show();
                        $(".cropit-preview-edit").hide();
                        $(".btn-edit-img").hide();
                        $("#imgedit").hide();
                    }


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
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
                location.href = '<?= base_url("account/updateproduct/") ?>' + id + '/' + token + '/' + isdelete;

            } else {
                swal("Cancelled", "", "error");
            }
        });
    }
</script>

</html>