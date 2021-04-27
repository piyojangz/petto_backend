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
                    <form action="<?= base_url("account/$token/itemmanage") ?>" method="post" class=" " id="form-submit-search">
                        <div class="input-group m-t-10">
                            <input type="text" id="searchtxt" name="searchtxt" class="form-control" placeholder="ชื่อร้านค้า , itemID , สินค้า" value="<?= $searchtxt ?>"> <span class="input-group-btn">
                                <button type="submit" style="    margin-top: 0px;" class="btn waves-effect waves-light btn-info">ค้นหา</button>
                            </span>
                        </div>
                    </form>
                    <hr>
                </div>
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">รายการสินค้า</div>
                        <div class="table-responsive">
                            <table class="table table-hover manage-u-table">
                                <thead>
                                    <tr>
                                        <th width="70" class="text-center">#</th>

                                        <th>itemID</th>
                                        <th>สินค้า</th>
                                        <th>ร้าน</th>
                                        <th>ราคา</th>
                                        <th>ลดเหลือ</th>
                                        <th>Stock</th>
                                        <th>คะแนนสินค้า</th>
                                        <th>สินค้าแนะนำ</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($product as $index => $item) :
                                        $RECOMMENDICON = '';
                                        if ($item->isoffer  == 1) {
                                            $RECOMMENDICON = '<span class="badge" style="background:green"><i class="fa fa-star">สินค้าแนะนำ</span>';
                                        }
                                    ?>
                                        <tr>
                                            <td class="text-center" style="vertical-align: middle;"><img src="<?= $item->image ?>" style="width:40px;" /></td>
                                            <td class="text-center" style="vertical-align: middle;"><?= $item->id ?></td>
                                            <td style="vertical-align: middle;"><a href="javascript:;" onclick="openitem(<?= $item->id ?>)"><?= $item->name ?></a></td>
                                            <td style="vertical-align: middle;"><a href='<?= base_url("account/$token/itemmanage?shopid=$item->merchantid") ?>'><img src="<?= $item->shopimage ?>" style="width:20px;" /><?= $item->merchantname ?></a></td>
                                            <td class="text-center" style="vertical-align: middle;"><?= $item->price ?></td>
                                            <td class="text-center" style="vertical-align: middle;"><?= $item->discount ?></td>
                                            <td class="text-center" style="vertical-align: middle;"><?= $item->stock ?></td>
                                            <td class="text-center" style="vertical-align: middle;"><?= $item->rating ?></td>
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
            <form action="<?= base_url("account/$token/changeitemrecommend") ?>" method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" id="form-submit">
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


            <form action="<?= base_url("account/$token/addnewproduct") ?>" method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" style="max-width: 800px;" id="form-item">
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
                                                        <select id="category" name="category" class="form-control" disabled>
                                                            <option value="0">ไม่มี</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">หมวดหมู่ย่อย1</label>
                                                    <div class="col-md-9">
                                                        <select id="category1" name="category1" class="form-control" disabled> 
                                                            <option value="0">ไม่มี</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">หมวดหมู่ย่อย2</label>
                                                    <div class="col-md-9">
                                                        <select id="category2" name="category2" class="form-control" disabled>
                                                            <option value="0">ไม่มี</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">ราคา</label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="price" id="price" required class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">ราคาลด</label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="discount" id="discount" required class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">คลัง</label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="stock" id="stock" required class="form-control" disabled>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">รายละเอียดสินค้า</label>
                                                    <div class="col-md-9">
                                                        <textarea id="customtext" name="customtext" class="summernote" disabled></textarea>
                                                        <input value="" name="inputcustomtext" id="inputcustomtext" type="hidden">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">ลิงค์วีดีโอ <br /><code>ตัวอย่าง https://www.youtube.com/embed/714KiXU15eU</code></label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="vdourl" id="vdourl" class="form-control" disabled>
                                                    </div>
                                                </div>

                                                <div class="form-group">

                                                    <label class="control-label col-md-3">รูปภาพปก</label>
                                                    <div class="col-md-9">
                                                        <div class="cropit-preview-edit"><img id="imgedit" src="" /></div>
                                                        <!-- <button class="btn-edit-img btn btn-warning waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-edit"></i></span>แก้ไขรูปภาพ -->
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
</body>
<script>
    $(document).ready(function() {

        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getcateparent'); ?>",
            data: JSON.stringify({

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

    function openfile(id) {
        $("#merchantid").val(id);
        $.magnificPopup.open({
            items: {
                src: '#form-submit'
            },
            type: 'inline'
        }, 0);
    }


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

    function openitem(id) {
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
                                    class: 'multipleimages',
                                    name: 'multipleimages[]',
                                    value: images[i]
                                }).appendTo('#form-item');
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
                            src: '#form-item'
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
</script>

</html>