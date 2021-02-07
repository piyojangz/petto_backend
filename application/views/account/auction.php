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
                        <h4 class="page-title">ประมูล</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li><a href="#">ประมูล</a></li>
                            <li class="active">รายการประมูล</li>
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

                        <button class="btn-item-modal btn btn-outline btn-primary waves-effect waves-light"><i class="fa fa-cart-plus m-r-5"></i> <span>เพิ่มสินค้าประมูล</span></button>

                        <hr>
                    </div>

                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">รายการประมูล</div>
                            <div class="table-responsive">
                                <table class="table table-hover manage-u-table">
                                    <thead>
                                        <tr>
                                            <th width="70" class="text-center">#</th>
                                            <th width="70" class="text-center">#</th>
                                            <th width="100">ชื่อสินค้า</th>
                                            <th>ราคาเริ่มต้น</th>
                                            <th>ราคาบิดขั้นต่ำ</th>
                                            <th>ราคา Buy out</th>
                                            <th>ระยะเวลา</th>
                                            <th>สถานะ</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($auctionlist as $index => $item) : ?>
                                            <tr>
                                                <td class="text-center" style="vertical-align: middle;"><?= $index + 1 ?></td>
                                                <td style="vertical-align: middle;"><img src="data:image/jpeg;base64,<?= $item->image ?>" style="width:100px;" /></td>
                                                <td style=" vertical-align: middle;"><?= $item->name ?></td>
                                                <td style="vertical-align: middle;"><span class="badge" style="background:#555;"><?= number_format($item->startprice) ?></span></td>
                                                <td style="vertical-align: middle;"><span class="badge"><?= number_format($item->minimumbidamount) ?></span></td>
                                                <td style="vertical-align: middle;color:red"><span class="badge"><?= number_format($item->buyoutprice) ?></span></td>
                                                <td style=" vertical-align: middle;"><?= date('d/m/Y เวลา H:i', strtotime($item->dfrom)) ?><br /><i class="fa fa-long-arrow-down"></i></br /><?= date('d/m/Y เวลา H:i', strtotime($item->dto)) ?></td>
                                                <td style="vertical-align: middle;"><span class="badge  <?= $item->status == 0 ? 'badge-danger' : 'badge-success' ?> " href="#"><?= $item->status == 0 ? 'สิ้นสุดการประมูล' : 'ปกติ' ?></span> </td>
                                                <td>
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

            </div>
            <form action="<?= base_url("account/$token/addnewauction") ?>" method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" style="max-width: 800px;" id="form-submit">
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
                                                        <input type="text" name="name" id="name" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">ราคาเริ่มต้น</label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="startprice" id="startprice" required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">ราคา buyout <code>ถ้าไม่มีให้ใส่ 0</code></label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="buyout" id="buyout" required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">ราคา bid ขั้นต่ำ <code>เช่น 50 , 100 , 150 , n</code></label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="minimumbidamount" id="minimumbidamount" required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">คลัง</label>
                                                    <div class="col-md-9">
                                                        <input type="number" name="stock" id="stock" class="form-control" value="1" disabled>
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
                                                    <label class="control-label col-md-3">ระยะเวลา</label>
                                                    <div class="col-md-9">
                                                        <input required type="text" name="daterange" id="daterange" class="form-control input-daterange-timepicker" name="daterange" value="">
                                                    </div>
                                                </div>


                                                <div class="form-group">

                                                    <label class="control-label col-md-3">รูปภาพ</label>
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
    <script src="<?= base_url("res/account/plugins/bower_components/moment/moment.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/blockUI/jquery.blockUI.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/summernote/dist/summernote.min.js") ?>"></script>
    <!-- Magnific popup JavaScript -->
    <script src="<?= base_url("res/account/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js") ?>"></script>
    <script src="<?= base_url("res/account/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js") ?>"></script>
</body>
<script>
    $(document).ready(function() {

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


        //category
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getallcate'); ?>",
            data: {
                'merchantid': '<?= $merchant->id ?>'
            },
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

            return true;

            return true;
        });

        $('.btn-edit-img').click(function() {
            $(".image-editor").show();
        });

        $('.btn-item-modal').click(function() {
            $("#id").val("");
            $("#name").val("");
            $("#price").val("");
            $("#category").val("");
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

    function edititem(id) {
        $('div.block1').block({
            message: '<h3>กรุณารอสักครู่...</h3>',
            css: {
                border: '1px solid #fff'
            }
        });
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getauction'); ?>",
            data: {
                'id': id
            },
            dataType: "json",
            success: function(data) {
                $('div.block1').unblock();
                if (data.result != null) {
                    $("#id").val(data.result.id);
                    $("#name").val(data.result.name);
                    $("#buyout").val(data.result.buyoutprice);
                    $("#startprice").val(data.result.startprice);
                    $("#minimumbidamount").val(data.result.minimumbidamount); 
                    $("#daterange").val(moment(data.result.dfrom).format('DD/MM/YYYY H:mm') + " - " + moment(data.result.dto).format('DD/MM/YYYY H:mm'));
                    $("#stock").val(data.result.stock);
                    $(".summernote").code(data.result.description);
                    $("#category").val(data.result.cateid);

                    if (data.result.image != "") {
                        $("#imgedit").attr("src", "data:image/jpeg;base64," + data.result.image);
                        $(".image-editor").hide();
                        $(".cropit-preview-edit").show();
                        $(".btn-edit-img").show();
                        $("#imgedit").show();
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
                location.href = '<?= base_url("account/updateauctionlist/") ?>' + id + '/' + token + '/' + isdelete;

            } else {
                swal("Cancelled", "", "error");
            }
        });
    }
</script>

</html>