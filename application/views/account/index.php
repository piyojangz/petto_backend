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
                            <h4 class="page-title">แดชบอร์ด</h4> </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                            <ol class="breadcrumb">
                                <li class="active"><a href="#" >แดชบอร์ด</a></li> 
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
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">บิลทั้งหมด</h3>
                                <ul class="list-inline">
                                    <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success"><?= $dashboarddata->bills ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">ชำระเงินแล้ว</h3>
                                <ul class="list-inline">
                                    <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple"><?= $dashboarddata->paid ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">ยังไม่ได้ชำระเงิน</h3>
                                <ul class="list-inline two-part">
                                    <li class="text-right"><i class="ti-arrow-up text-danger"></i> <span class="counter text-danger"><?= $dashboarddata->unpaid ?></span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <div class="white-box analytics-info">
                                <h3 class="box-title">รายได้เดือนนี้</h3>
                                <ul class="list-inline"> 
                                    <li class="text-right">  <i class="ti-arrow-up text-success"></i> <span class="text-success">฿</span><span class="counter text-success"><?= number_format($dashboarddata->monthlytotal) ?></span>  
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- row -->
                    <div class="row block1">
                        <!-- Left sidebar -->
                        <div class="col-md-12">
                            <div class="white-box">
                                <!-- row -->
                                <div class="row">
                                    <div class="col-lg-3 col-md-4  col-sm-12 col-xs-12 inbox-panel">
                                        <div class="row">
                                            <table class="table no-paging">
                                                <thead>
                                                    <tr>
<!--                                                        <th width="30">
                                                            <div class="checkbox m-t-0 m-b-0 ">
                                                                <input id="checkAll" type="checkbox" class="checkbox-toggle" value="check all">
                                                                <label for="checkAll"></label>
                                                            </div>
                                                        </th>-->
                                                        <th>

                                                            <div class="btn-group">
                                                                <button id="btn-refreshbilltoken" type="button" class="btn btn-default waves-effect waves-light  dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <i class="fa fa-refresh"></i> </button>
                                                            </div>
                                                        </th>
                                                        <th class="hidden-xs" width="100">
                                                            <div class="btn-group pull-right">
                                                                <button type="button"  class="btn-genbill btn btn-default waves-effect"><i class="fa fa-plus"></i></button> 
                                                            </div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="selected" id="billtokenlist"> 


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12 mail_listing">
                                        <div class="inbox-center">

                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 m-t-20" id="billtokenhead"><h3 id="billtokenname"></h3> 
                                                <span id="animationlink" style="display: inline-block;">
                                                    <a href="#" id="billink" ></a></span> <button class="btn btn-outline btn-default btn-xs" id="copyanim" >copy</button>
                                            </div>
                                            <span type="hidden" id="billinkhd" style="display: none;" ></span>
                                        </div>
                                        <div class="row" id="billtokengraph">
                                            <div class="col-md-12 col-lg-12 col-xs-12">
                                                <div class="white-box">
                                                    <h3 class="box-title" id="billtotal"></h3>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <p>การแจ้งเตือนถึง <span id="billusernotification" class="text-purple"></span></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button id="billtokenremove" class="pull-right btn btn-outline btn-danger waves-effect waves-light">ลบ</button>
                                                            <button id="billtokenedit" class="pull-right btn btn-outline btn-default waves-effect waves-light" style="margin-right: 15px;">แก้ไข</button> 
                                                        </div>
                                                    </div>

                                                    <div class="flot-chart">
                                                        <div class="flot-chart-content" id="flot-bar-chart"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->



                    <!--/.row -->
                    <div class="row">
                        <div class="col-md-12 col-sm-12"> 
                            <div class="white-box p-b-0">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <h2 class="font-medium m-t-0">ยอดขาย</h2> 
                                        <h5>จำนวน Admin ในร้าน</h5>
                                        <small>คุณสามารถเพิ่ม Admin โดยการพิมพ์คำว่า <code>ลงทะเบียน <?= $token ?>  <?= $user["lineid"] ?></code> ในไลน์ @perdbill</small>
                                    </div>
                                </div>
                                <div class="row m-t-30 minus-margin">
                                    <?php foreach ($lineadmin as $key => $value): ?>
                                        <div class="col-sm-12 col-sm-4 b-t b-r">
                                            <ul class="expense-box">
                                                <li>
                                                    <i class="fa fa-dollar"> </i>
                                                    <span><h2><?= $value->name ?> (<?= $value->countorder ?>)</h2><h4>ยอดขาย <?= number_format($value->total) ?></h4></span></li>
                                            </ul>
                                        </div>
                                    <?php endforeach; ?>


                                </div> 
                            </div>
                        </div>
                    </div>

                </div>


                <form   method="post" class="form-material form-horizontal mfp-hide white-popup-block animate fadeInLeft"  id="form-submit-billtoken">
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
                                                        <label class="control-label col-md-3">ชื่อบิล</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="name" id="name" required class="form-control"> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">ผู้ขาย</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" name="merchantuid" id="merchantuid" required>
                                                                <?php foreach ($merchants as $item): ?>
                                                                    <option value="<?= $item->lineuid ?>"><?= $item->name ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">ช่วงเวลา</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control input-daterange-datepicker" type="text" name="daterange" id="daterange" value="<?= $daterange ?>" /> 
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">ส่งการแจ้งเตือนทางไลน์</label>
                                                        <div class="col-md-9"> 
                                                            <select class="select2 m-b-10 select2-multiple" multiple="multiple" name="usernoti" id="usernoti" data-placeholder="Choose" > 
                                                                <?php foreach ($merchants as $item): ?> 
                                                                    <option  value="<?= $item->lineuid ?>|<?= $item->name ?>"><?= $item->name ?></option>
                                                                <?php endforeach; ?>
                                                            </select>



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

                                        </div>
                                    </div>
                                </div>
                            </div>   
                        </div>

                    </div>
                </form>
            </div>

            <input type="hidden" id="activetoken"/>
            <input type="hidden" id="activetokenid"/>
            <input type="hidden" id="editnotiusers"/>


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
<!--Wave Effects -->
<script src="<?= base_url("res/account/js/waves.js") ?>"></script>
<!--Counter js -->
<script src="<?= base_url("res/account/plugins/bower_components/waypoints/lib/jquery.waypoints.js") ?>"></script>
<script src="<?= base_url("res/account/plugins/bower_components/counterup/jquery.counterup.min.js") ?>"></script>
<!-- chartist chart -->
<script src="<?= base_url("res/account/plugins/bower_components/chartist-js/dist/chartist.min.js") ?>"></script>
<script src="<?= base_url("res/account/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js") ?>"></script>
<!-- Sparkline chart JavaScript -->
<script src="<?= base_url("res/account/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js") ?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?= base_url("res/account/js/custom.min.js") ?>"></script>
<script src="<?= base_url("res/account/js/dashboard1.js") ?>"></script>
<script src="<?= base_url("res/account/plugins/bower_components/toast-master/js/jquery.toast.js") ?>"></script>
<!--Style Switcher -->
<script src="<?= base_url("res/account/plugins/bower_components/styleswitcher/jQuery.style.switcher.js") ?>"></script>


<script src="<?= base_url("res/account/plugins/bower_components/flot/excanvas.min.js") ?>"></script>
<script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.js") ?>"></script>
<script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.pie.js") ?>"></script>
<script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.time.js") ?>"></script>
<script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.stack.js") ?>"></script>
<script src="<?= base_url("res/account/plugins/bower_components/flot/jquery.flot.crosshair.js") ?>"></script>
<script src="<?= base_url("res/account/plugins/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js") ?>"></script>
<!-- Magnific popup JavaScript -->
<script src="<?= base_url("res/account/plugins/bower_components/Magnific-Popup-master/dist/jquery.magnific-popup.min.js") ?>"></script> 
<!-- Plugin JavaScript -->
<script src="<?= base_url("res/account/plugins/bower_components/moment/moment.js") ?>"></script>
<!-- Date range Plugin JavaScript -->
<script src="<?= base_url("res/account/plugins/bower_components/timepicker/bootstrap-timepicker.min.js") ?>"></script>
<script src="<?= base_url("res/account/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js") ?>"></script>
<script src="<?= base_url("res/account/plugins/bower_components/blockUI/jquery.blockUI.js") ?>"></script>
<!-- Sweet-Alert  -->
<script src="<?= base_url("res/account/plugins/bower_components/sweetalert/sweetalert.min.js") ?>"></script> 

<script type="text/javascript" src="<?= base_url("res/account/plugins/bower_components/custom-select/custom-select.min.js") ?>"></script>
<script type="text/javascript" src="<?= base_url("res/account/plugins/bower_components/bootstrap-select/bootstrap-select.min.js") ?>"></script>
<script type="text/javascript" src="<?= base_url("res/account/plugins/bower_components/multiselect/js/jquery.multi-select.js") ?>"></script>
<script>

    function copylink(x) {
        $("#animationlink").removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            $(this).removeClass();
        });

    }

    function todmy(datetime) {
        var d = datetime;
        d = d.substr(0, 10).split("-");
        d = d[2] + "/" + d[1] + "/" + d[0];
        return d;
    }
    //Flot Bar Chart

    $(function () {
        // For select 2
        var $Multi = $(".select2").select2();



        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });


        // Daterange picker
        $('.input-daterange-datepicker').daterangepicker({
            buttonClasses: ['btn', 'btn-sm'],
            locale: {
                format: 'DD/MM/YYYY'
            },
            minDate: '<?= date('d/m/Y') ?>',
            applyClass: 'btn-danger',
            cancelClass: 'btn-inverse'
        });

        $('.btn-genbill').click(function () {
            $("#name").val("");
            $("#editnotiusers").val("");
            $("#id").val("");
             $("#merchantuid").removeAttr("disabled");
            var val = $("#merchantuid option:first").val();
            var text = $("#merchantuid option:first").text();
            $Multi.val([val + "|" + text]).trigger("change");
            $.magnificPopup.open({items: {src: '#form-submit-billtoken'}, type: 'inline'}, 0);
        });


        $('#copyanim').click(function (e) {
            e.preventDefault();
            var anim = "bounce";
            copylink(anim);
            copyToClipboard("billinkhd");
        });




        $("tbody.selected").on("click", "tr", function () {
            $(this).addClass('selected').siblings().removeClass("selected");
            getbilldata($(this).attr("id"));
        });


        $("#billtokenremove").click(function () {
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
                        url: "<?php echo base_url('service/deletebilltoken'); ?>",
                        data: {'id': $("#activetokenid").val()},
                        dataType: "json",
                        success: function (data) {

                            $('div.block1').unblock();

                            reload_billtoken();
                            swal("Deleted!", "Your imaginary file has been deleted.", "success");


                        },
                        error: function (XMLHttpRequest) {

                            $('div.block1').unblock();

                        }
                    });

                } else {
                    swal("Cancelled", "", "error");
                }
            });
        });

        $("#billtokenedit").click(function () {
            $('div.block1').block();

            $.ajax({
                type: "POST",
                url: "<?php echo base_url('service/getbilltoken'); ?>",
                data: {'token': $("#activetoken").val()},
                dataType: "json",
                success: function (data) {
                    $('div.block1').unblock();

                    if (data.result != null) {
                        $("#name").val(data.result.name);
                        $("#merchantuid").val(data.result.uid);

                        var from = todmy(data.result.datefrom);
                        var to = todmy(data.result.dateto);
                        $('.input-daterange-datepicker').daterangepicker({
                            locale: {
                                format: 'DD/MM/YYYY'
                            },
                            startDate: from,
                            endDate: to
                        });

                        var selectednoti = [];
                        $.each(data.result2, function (index, value) {
                            selectednoti.push(value.lineuid + "|" + value.merchantlinename);
                        });

                        $Multi.val(selectednoti).trigger("change");
                        $("#editnotiusers").val(data.result.id);
                        $("#merchantuid").prop('disabled', 'disabled');

                        $.magnificPopup.open({items: {src: '#form-submit-billtoken'}, type: 'inline'}, 0);
                    }

                    return false;

                },
                error: function (XMLHttpRequest) {
                    console.log(XMLHttpRequest);
                    $('div.block1').unblock();
                    return false;
                }
            });



        });

        $("#merchantuid").change(function () {
            var val = $(this).val();
            var text = $(this).find(":selected").text();
            $Multi.val([val + "|" + text]).trigger("change");
        });

        $("#btn-refreshbilltoken").click(function () {
            reload_billtoken();
        });

        $("#form-submit-billtoken").submit(function () {
            $('div.block1').block();
            var name = $("#name").val();
            var merchantuid = $("#merchantuid").val();
            var daterange = $("#daterange").val();
            var usernoti = $("#usernoti").val();
            var editnotiusers = $("#editnotiusers").val();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('service/savebilltoken'); ?>",
                data: {'daterange': daterange, 'merchantuid': merchantuid, 'name': name, 'merchantid': <?= $merchant->id ?>, 'token': '<?= $token ?>', 'usernoti': usernoti, 'editnotiusers': editnotiusers},
                dataType: "json",
                success: function (data) {

                    $('div.block1').unblock();
                    if (data.result != null) {
                        reload_billtoken();
                        $.magnificPopup.close();
                    }

                    return false;

                },
                error: function (XMLHttpRequest) {
                    $('div.block1').unblock();
                    return false;
                }
            });

            return false;
        });

        reload_billtoken();
    });

    function reload_billtoken() {
        $('div.block1').block();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getallbilltokenhtml'); ?>",
            data: {'merchantid': '<?= $merchant->id ?>'},
            dataType: "html",
            success: function (data) {
                if (data == "") {

                    $("#billtokenhead").hide();
                    $("#billtokengraph").hide();

                }
                $('div.block1').unblock();
                $('#billtokenlist').html(data);
                $('tbody.selected tr').first().trigger('click');
                return false;

            },
            error: function (XMLHttpRequest) {
                $('div.block1').unblock();
                return false;
            }
        });


    }

    function getbilldata(token) {
        $("#billink").html('perdbill/' + '<b>' + token + '</b> ');
        $("#billinkhd").html('<?= base_url() ?>' + token);

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getmerchantbilldata'); ?>",
            data: {'token': token},
            dataType: "json",
            success: function (data) {
                $("#activetoken").val(data.result.token);
                if (data != null) {
                    var arr = [];
                    $("#billtokenname").html(data.result.name);
                    $("#activetokenid").val(data.result.id);
                    var totalbill = 0;
                    $.each(data.result2, function (index, value) {
                        totalbill += parseInt(value.row2);
                        arr.push([parseInt(value.row1 + "000"), value.row2, value.row3]);
                    });
                    $("#billtotal").html("จำนวน " + totalbill + " บิล");

                    var html = "";
                    $.each(data.result3, function (index, value) {
                        html += value.merchantlinename + " ,";

                    });
                    html = html.substring(0, html.length - 1);
                    $("#billusernotification").html(html);


                    potbarchart(arr);
                }


            },
            error: function (XMLHttpRequest) {
                $('div.block1').unblock();
                return false;
            }
        });


    }

    function potbarchart(data) {
        var barOptions = {
            series: {
                bars: {
                    show: true,
                    barWidth: 43200000
                }
            },
            xaxis: {
                mode: "time",
                timeformat: "%d/%m/%Y",
                minTickSize: [1, "day"]
            },
            grid: {
                hoverable: true
            },
            legend: {
                show: false
            },
            colors: ["#fb9678"],
            grid: {
                color: "#AFAFAF",
                hoverable: true,
                borderWidth: 0,
                backgroundColor: '#FFF'
            },
            tooltip: true,
            tooltipOpts: {
                content: "วันที่: %x, จำนวนบิล: %y",
                defaultTheme: false
            }
        };
        var barData = {
            label: "bar",
            color: "#fb9678",
            data: data
        };
        $.plot($("#flot-bar-chart"), [barData], barOptions);
    }


    function copyToClipboard(elementId) {


        var aux = document.createElement("input");
        aux.setAttribute("value", document.getElementById(elementId).innerHTML);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");

        document.body.removeChild(aux);

    }
</script>

</body>

</html>
