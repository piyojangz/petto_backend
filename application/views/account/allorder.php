<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('account/template/header'); ?>

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
                            <h4 class="page-title">ออเดอร์</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                            <ol class="breadcrumb"> 
                                <li  ><a href="#" >ออเดอร์</a></li> 
                                <li class="active">จัดการออเดอร์</li> 
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
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-md-9 col-lg-10" style="margin-bottom: 15px;"> 
                                            <div class="checkbox checkbox-success checkbox-order " style="display: block;
                                                 float: left;
                                                 padding: 8px;
                                                 height: 34px !important; ">
                                                <input  id="checkAll" type="checkbox">
                                                <label for="checkbox1"> </label>
                                            </div>

                                            <div  style="display: block; float: left; ">

                                                <div class="btn-group m-r-10">
                                                    <button aria-expanded="false" data-toggle="dropdown" class="btn btn-primary dropdown-toggle waves-effect waves-light" type="button">คำสั่ง <span class="caret"></span></button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        <li><a href="javascript:;" onclick="changstatus(2)">ยืนยันการชำระ</a></li>
                                                        <li><a href="javascript:;" onclick="changstatus(3)">แจ้งจัดส่ง</a></li> 
                                                        <li><a href="javascript:;" onclick="changstatus(4)">ยกเลิก</a></li> 
                                                    </ul>
                                                </div> 

                                            </div>
                                            <div  style="display: block; float: left; ">

                                                <div class="btn-group m-r-10">
                                                    <button id="orderstatus" aria-expanded="false" data-toggle="dropdown" class="btn btn-default btn-outline dropdown-toggle waves-effect waves-light" type="button">สถานะ <span class="caret"></span></button>
                                                    <ul role="menu" class="dropdown-menu"> 
                                                        <li><a href="javascript:;" onclick="getorderstatus(0, 'ทั้งหมด')">ทั้งหมด</a></li>
                                                        <li><a href="javascript:;" onclick="getorderstatus(1, 'ยังไม่จ่าย')">ยังไม่จ่าย</a></li> 
                                                        <li><a href="javascript:;" onclick="getorderstatus(2, 'จ่ายแล้ว')">จ่ายแล้ว</a></li> 
                                                        <li><a href="javascript:;" onclick="getorderstatus(3, 'ส่งแล้ว')">ส่งแล้ว</a></li> 
                                                        <li><a href="javascript:;" onclick="getorderstatus(4, 'ยกเลิก')">ยกเลิก</a></li> 
                                                    </ul>
                                                    <input type="hidden" id="currentstatus" value="0" />


                                                </div> 

                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-md-3 col-lg-2">
                                            <form id="export-csv-form" method="POST" action="<?= base_url("service/exportorderexcel")?>">
                                                <input type="hidden" name="merchantid" value="<?= $merchant->id ?>">
                                                <input type="hidden" name="exportorderstatus" id="exportorderstatus" value="0">
                                                <button   class="btn-item-modal btn btn-outline btn-primary waves-effect waves-light"> <i class="fa fa-file-excel-o m-r-5"></i> <span>EXPORT</span></button>
                                            </form>
                                            <div class="clearfix"></div>
                                        </div> 
                                    </div>
                                    <hr>
                                </div> 
                                <div class="panel-heading">รายการสั่งซื้อลูกค้า</div> 
                                <div class="white-box"> 
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr> 
                                                    <th colspan="2" style="min-width: 80px; text-align: center;">บิลสั่งซื้อ</th>
                                                    <th  style="min-width:80px;">ยอดสั่งซื้อ</th>
                                                    <th  style="min-width:140px;">รายละเอียดการโอน</th>
                                                    <th style="min-width:150px;">ชื่อ</th>
                                                    <th style="min-width:150px;">ที่อยู่จัดส่ง</th>
                                                    <th>สถานะ</th> 
                                                </tr>
                                            </thead>
                                            <tbody id="orderlist">
                                                <?php foreach ($order as $index => $item): ?> 
                                                    <tr>
                                                        <td> 
                                                            <div class="checkbox checkbox-success checkbox-order ">
                                                                <input id="orderid<?= $item->id ?>" name="orderid"  type="checkbox" value="<?= $item->id ?>">
                                                                <label for="orderid<?= $item->id ?>"> </label>
                                                            </div>
                                                        </td>
                                                        <td><a class="badge badge-info " target="_blank" href="<?= base_url($item->token) ?>"><?= $item->token ?></a></td>
                                                        <td><?= number_format($item->total) ?></td>
                                                        <td><?= $item->paymentinfo ?></td>
                                                        <td><?= $item->fullname ?></td>
                                                        <td><?= $item->billingaddress ?></td>
                                                        <td>
                                                            <?= $obj->getorderstatus($item->status,$item->closestatus); ?> 
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

                                                        $("#checkAll").click(function () {
                                                            $('input:checkbox').not(this).prop('checked', this.checked);
                                                        });



                                                    });

                                                  


                                                    function getorderstatus(status, statusname) {
                                                        
                                                        $("#exportorderstatus").val(status);
                                                        $("#currentstatus").val(status);
                                                        $('div.block1').block();
                                                        $("#orderlist").html("");
                                                        if (statusname != "") {
                                                            $("#orderstatus").html(statusname + " <span class=\"caret\"></span>");
                                                        }

                                                        $.ajax({
                                                            type: "POST",
                                                            url: "<?php echo base_url('service/getorderstatus'); ?>",
                                                            data: {'merchantid': '<?= $merchant->id ?>', status: status},
                                                            dataType: "html",
                                                            success: function (data) {
                                                                $("#orderlist").html(data);
                                                                $('div.block1').unblock();
                                                            },
                                                            error: function (XMLHttpRequest) {
                                                                $('div.block1').unblock();
                                                            }
                                                        });
                                                    }

                                                    function changstatus(status) {
                                                        var itemchecked = 0;
                                                        var items = "";
                                                        var allcheck = $('input:checkbox:checked').not("#checkAll");
                                                        $(allcheck).each(function () {
                                                            console.log(this.value);
                                                            items = items + this.value + "|";
                                                            itemchecked++;
                                                        });


                                                        if (itemchecked > 0) {
                                                            $('div.block1').block();
                                                            $.ajax({
                                                                type: "POST",
                                                                url: "<?php echo base_url('service/updateorderstatus'); ?>",
                                                                data: {'items': items, status: status},
                                                                dataType: "json",
                                                                success: function (data) {
                                                                    $('div.block1').unblock();
                                                                    if (data.result != null) {

                                                                        swal("Good job!", "สถานะได้ถูกเปลี่ยนแล้ว.", "success");

                                                                        getorderstatus($("#currentstatus").val(), "");
                                                                    }

                                                                },
                                                                error: function (XMLHttpRequest) {
                                                                    $('div.block1').unblock();
                                                                }
                                                            });


                                                        } else {
                                                            alert("กรุณาเลือกอย่างน้อย 1 รายการ")
                                                        }



                                                    }

</script>
</html>
