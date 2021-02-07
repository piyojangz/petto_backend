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
                            <li class="active">shopslot</li>
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

                        <button class="btn-item-modal btn btn-outline btn-primary waves-effect waves-light"><i class="fa fa-cart-plus m-r-5"></i> <span>เพิ่มร้านค้า</span></button>

                        <hr>
                    </div>
                    <?php foreach ($shopslot as $item) :
                        $PACKICON = '';
                        switch ($item->packageid) {
                            case '1':
                                $PACKICON = '<span class="badge" style="background:blue">Free StartUP</span>';
                                break;
                            case '2':
                                $PACKICON = '<span class="badge" style="background:silver">Silver</span>';
                                break;
                            case '3':
                                $PACKICON = '<span class="badge" style="background:gold">Gold</span>';
                                break;
                            case '4':
                                $PACKICON = '<span class="badge" style="background:platinum">Platinum</span>';
                                break;

                            default:
                                # code...
                                break;
                        }
                    ?>

                        <!-- /.usercard -->
                        <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                            <div class="white-box">
                                <div class="el-card-item">
                                    <div class="el-card-avatar el-overlay-1" style="width:100%;overflow: hidden"><img src="<?= $item->image ?>" />
                                        <div class="el-overlay">
                                            <ul class="el-info">
                                                <li><a class="btn default btn-outline" href="javascript:void(0);" onclick="removeitem('<?= $item->shopslotid ?>', '<?= $token ?>', 'true')"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="el-card-content">
                                        <h4 class="box-title text-info"><?= $item->webname ?> <?= $PACKICON ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.usercard-->
                    <?php endforeach; ?>
                </div>

            </div>
            <form action="<?= base_url("account/$token/shopslot") ?>" method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft" style="max-width: 800px;" id="form-submit">
                <div class="panel panel-default">
                    <div class="panel-heading">เพิ่ม / แก้ไข</div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-info ">
                                        <div class="panel-body">

                                            <div class="form-body">
                                                <table class="table table-hover manage-u-table">
                                                    <thead>
                                                        <tr>
                                                            <th width="70" class="text-center">#</th>
                                                            <th width="70" class="text-center">#</th>
                                                            <th>ชื่อร้าน</th>
                                                            <th>แพคเกจ</th>
                                                            <th width="150">MANAGE</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($merchant as $index => $item) :   $PACKICON = '';
                                                            switch ($item->packageid) {
                                                                case '1':
                                                                    $PACKICON = '<span class="badge" style="background:blue"><i class="fa fa-star"/> Free StartUP</span>';
                                                                    break;
                                                                case '2':
                                                                    $PACKICON = '<span class="badge" style="background:silver"><i class="fa fa-star"/> Silver</span>';
                                                                    break;
                                                                case '3':
                                                                    $PACKICON = '<span class="badge" style="background:gold">Gold</span>';
                                                                    break;
                                                                case '4':
                                                                    $PACKICON = '<span class="badge" style="background:platinum">Platinum</span>';
                                                                    break;
                                                                default:
                                                                    # code...
                                                                    break;
                                                            }
                                                        ?>
                                                            <tr>
                                                                <td class="text-center" style="vertical-align: middle;"><?= $index + 1 ?></td>
                                                                <td style="vertical-align: middle;"><img src="<?= $item->image ?>" class="img img-rouned" style="height: 100px;" /></td>
                                                                <td style="vertical-align: middle;"><?= $item->webname ?></td>
                                                                <td style="vertical-align: middle;"><?=$PACKICON?></td>
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-info btn-outline btn-circle btn-lg m-r-5" onclick="addtem('<?= $item->id ?>');"><i class="ti-plus"></i></button>
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
        //category



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

    function addtem(id) {
        $('div.block1').block({
            message: '<h3>กรุณารอสักครู่...</h3>',
            css: {
                border: '1px solid #fff'
            }
        });
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/saveshopslot'); ?>",
            data: {
                'merchantid': id
            },
            dataType: "json",
            success: function(data) {
                $('div.block1').unblock();
            },
            error: function(XMLHttpRequest) {
                $('div.block1').unblock();
            }
        });

        location.reload();

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
                location.href = '<?= base_url("account/updateshopslot/") ?>' + id + '/' + token + '/' + isdelete;

            } else {
                swal("Cancelled", "", "error");
            }
        });
    }
</script>

</html>