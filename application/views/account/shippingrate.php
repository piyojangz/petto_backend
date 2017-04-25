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
                            <h4 class="page-title">ข้อมูลการเงิน</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                            <ol class="breadcrumb">
                                <li ><a href="#" >ข้อมูลการเงิน</a></li> 
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

                            <button class="btn-item-modal btn btn-outline btn-primary waves-effect waves-light"> <i class="fa fa-truck m-r-5"></i> <span>เพิ่มรายการค่าจัดส่ง</span></button>

                            <hr>
                        </div> 

                        <div class="col-md-12">
                            <div class="panel">
                                <div class="panel-heading">รายการค่าจัดส่ง <code>* เพิ่มหน่วย = 0 กรณีต้องการให้มีขั้นต่ำ</code></div>
                                <div class="table-responsive">
                                    <table class="table table-hover manage-u-table">
                                        <thead>
                                            <tr>
                                                
                                                <th>ประเภท</th>
                                                <th>หน่วย</th>
                                                <th>ราคา</th> 
                                                <th width="150">MANAGE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($shippingrate as $index => $item): ?> 
                                                <tr>
                                                
                                                    <td style="vertical-align: middle;"><?= $item->type ?></td> 
                                                    <td style="vertical-align: middle;"><?= $item->unit ?></td>
                                                    <td style="vertical-align: middle;"><?= number_format($item->price) ?></td>

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





                    <form action="<?= base_url("account/$token/addnewshippingrate") ?>" method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft"  id="form-submit">
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
                                                            <label class="control-label col-md-3">ประเภท</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control" name="shippingtype" id="shippingtype" required>
                                                                    <option value="PEICE">ชิ้น/PEICE</option>
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">หน่วย</label>
                                                            <div class="col-md-9">
                                                                <input type="number" name="unit" id="unit"    required class="form-control"> 
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">ราคา</label>
                                                            <div class="col-md-9">
                                                                <input type="number" name="price" id="price"   required class="form-control"> 
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
                                                        $(document).ready(function () {

                                                            $('.popup-with-form').magnificPopup({
                                                                type: 'inline',
                                                                preloader: true,
                                                                focus: '#name',
                                                                callbacks: {
                                                                    beforeOpen: function () {
                                                                        if ($(window).width() < 700) {
                                                                            this.st.focus = false;
                                                                        } else {
                                                                            this.st.focus = '#name';
                                                                        }
                                                                    }
                                                                }
                                                            });



                                                            $('.btn-item-modal').click(function () {
                                                                $("#id").val("");
                                                                $("#bankaccount").val("");
                                                                $("#accounttype").val("");
                                                                $("#accountbranch").val("");
                                                                $("#accountno").val("");
                                                                $("#accountname").val("");
                                                                $.magnificPopup.open({items: {src: '#form-submit'}, type: 'inline'}, 0);
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
                                                                url: "<?php echo base_url('service/getshippingrateconfig'); ?>",
                                                                data: {'id': id},
                                                                dataType: "json",
                                                                success: function (data) {
                                                                    $('div.block1').unblock(); 
                                                                    if (data.result != null) {
                                                                        $("#id").val(data.result.id);
                                                                        $("#shippingtype").val(data.result.type);
                                                                        $("#unit").val(data.result.unit);
                                                                        $("#price").val(data.result.price); 
                                                                        $.magnificPopup.open({items: {src: '#form-submit'}, type: 'inline'}, 0);
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
                                                                    swal("Deleted!", "Your data been deleted.", "success");
                                                                    location.href = '<?= base_url("account/deleteshippingrate/") ?>' + id + '/' + token + '/' + isdelete;

                                                                } else {
                                                                    swal("Cancelled", "", "error");
                                                                }
                                                            });
                                                        }


    </script>
</html>
