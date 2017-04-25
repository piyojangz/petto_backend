<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Perdbill.co - บริการเปิดบิลสินค้าผ่านไลน์ ใครๆก็ทำได้</title> 
        <meta name="description" content="บริการเปิดบิลจาก <?= $merchant->name ?> ปลอดภัย สะดวก รวดเร็ว">
        <link href="<?= base_url("res/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css"/>
        <!-- Loading Bootstrap -->
        <link href="<?= base_url("res/dist/css/vendor/bootstrap.min.css") ?>" rel="stylesheet">

        <!-- Loading Flat UI Pro -->
        <link href="<?= base_url("res/dist/css/flat-ui-pro.css") ?>" rel="stylesheet" type="text/css"/>

        <!-- Custom -->
        <link href="<?= base_url("res/css/custom.css") ?>" rel="stylesheet" type="text/css"/>   
    </head>
    <body>
        <div class="overlay-loader">
            <div class="bg"></div>
            <div class="container">
                <div class="loader"></div>
                <p>กรุณารอสักครู่ระบบกำลังดำเนินการ...</p>
            </div>
        </div>
        <div class="container">
            <div class="header">
                <div class="row">
                    <div class="logo">
                        <img src="<?= $merchant->image ?>"/>
                    </div>
                </div>




                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="text-center head-section userdetail">Shipping info</h4>
                    </div>
                </div>
                <!--                <div class="row" id="lookup">
                                    <div class="col-xs-12"> 
                                        <form id="formlookup"> 
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input class="form-control" id="txttellookup" name="txttellookup" type="tel" required placeholder="เบอร์โทร">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-default" type="button"><i class="fa fa-phone-square" aria-hidden="true"></i></button> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input class="form-control" id="txtidcard" name="txtidcard" type="number" required placeholder="เลขบัตรประชาชน" maxlength="13"> 
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-default" type="button"><i class="fa fa-id-card" aria-hidden="true"></i></button> 
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-hg btn-block btn-primary" id="btnlookup">LOOKUP</button>
                                        </form>
                                    </div>
                                </div>-->
                <div class="row">
                    <div class="col-xs-12">
                        <ul class="nav nav-list">
                            <li class="nav-header">รายการสินค้าที่สั่ง</li>  
                            <?php foreach ($items as $item): ?>
                                <?php if ($obj->getamount($orderdetail, $item->id) > 0): ?>
                                    <li> 
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <span class="itemname"> <?= $item->name ?></span> <br/>  <span class="itemprice"><?= number_format($item->price, 2, '.', ','); ?></span>
                                            </div>
                                            <div class="col-xs-4 text-right"> 
                                                <span class="badge">จำนวน <?= $obj->getamount($orderdetail, $item->id) ?></span>
                                            </div>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?> 
                            <li class="divider"></li>
                            <li class="nav-header">สรุปยอด</li>
                            <li>
                                <a href="#fakelink">
                                    +ค่าจัดส่ง
                                    <span class="badge pull-right"><?= number_format($order->shipingrate, 2, '.', ',') ?>฿</span>
                                </a>
                            </li> 
                            <?php if ($uid != ""): ?>
                                <li class="divider"></li>
                                <li class="nav-header">รายการส่วนลด</li>
                                <li>
                                    <a href="#fakelink">
                                        - ส่วนลดค่าจัดส่ง
                                        <span class="badge pull-right"><?= number_format($order->shippingdiscount, 2, '.', ',') ?>฿</span>
                                    </a>
                                </li> 
                                <li>
                                    <a href="#fakelink">
                                        - ส่วนลดค่าสินค้า
                                        <span class="badge pull-right"><?= number_format($order->pricediscount, 2, '.', ',') ?>฿</span>
                                    </a>
                                </li> 

                            <?php endif; ?>
                            <li class="active">
                                <a href="#fakelink">
                                    ยอดที่ต้องชำระทั้งสิ้น
                                    <span class="badge pull-right" id="total"><?= number_format($order->total, 2, '.', ',') ?>฿</span>
                                </a>
                            </li>
                            <li class="divider"></li>
                        </ul>
                        <?php if ($uid == ""): ?>
                            <button type="button" class="btn btn-warning btn-xs" onclick="location.href = '<?= base_url("/$ordertoken") ?>'">กลับไปแก้ไข</button>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="row" id="fulladdress">
                    <div class="col-xs-12"> 
                        <h4 class="text-center head-sectionsmall userdetail">กรุณากรอกข้อมูลให้ครบถ้วน</h4>

                        <form  action="<?= base_url("order/payment/$ordertoken") ?>" method="post" enctype="multipart/form-data"> 
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" id="txtfullname" name="txtfullname" type="text" placeholder="ชื่อ - นามสกุล" value="" required  autocomplete="off" >
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="button"><span class="fa fa-user-circle-o" aria-hidden="true"></span></button> 
                                    </div>
                                </div>
                            </div> 

                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" id="txttel" name="txttel" type="tel" placeholder="เบอร์โทร" value="" required  autocomplete="off" >
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-phone-square" aria-hidden="true"></i></button> 
                                    </div>
                                </div>
                            </div>

                            <!--                            <div class="form-group">
                                                            <div class="input-group">
                                                                <input class="form-control" id="appendedInputButton-03" type="email" placeholder="อีเมลล์">
                                                                <div class="input-group-btn">
                                                                    <button class="btn btn-default" type="button"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></button> 
                                                                </div>
                                                            </div>
                                                        </div>-->


                            <div class="form-group">
                                <div class="input">
                                    <input class="form-control" id="txtaddress" name="txtaddress" type="text" placeholder="บ้านเลขที่/หมู่บ้าน" required value=""  autocomplete="off" > 
                                </div>
                            </div> 

                            <div class="form-group"> 
                                <select class="selectpicker" name="txtprovince" id="txtprovince" required>
                                    <option value="">== กรุณาเลือกจังหวัด ==</option>
                                    <?php foreach ($province as $value): $provid = isset($customer) ? $customer->provinceid : ''; ?>
                                        <option value="<?= $value->PROVINCE_ID ?>"   ><?= $value->PROVINCE_NAME ?></option>
                                    <?php endforeach; ?> 
                                </select>

                            </div>
                            <div class="form-group"> 
                                <select class="selectpicker" name="txtaumpure" id="txtaumpure" required>
                                    <option  value="">== กรุณาเลือกอำเภอ ==</option>
                                </select>

                            </div>
                            <div class="form-group"> 
                                <select class="selectpicker" name="txttumbol" id="txttumbol" required>
                                    <option  value="">== กรุณาเลือกตำบล ==</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <div class="input">
                                    <input class="form-control" id="txtzipcode" name="txtzipcode" type="number" placeholder="รหัสไปรษณีย์"  value="" required  autocomplete="off" > 
                                </div>
                            </div>
                            <div class="form-group">
                                <h4 class="text-center head-section payment">Payment Method</h4>
                                <?php foreach ($paymentmethod as $index => $item): ?>
                                    <label class="bank" for="checkbox<?= $index ?>"> 
                                        <input name="paymenttype"  type="radio" id="checkbox<?= $index ?>"  required value="<?= $item->id ?>" <?= $item->id == $order->paymentmethodid ? 'checked' : '' ?>/>
                                        <img src="<?= $item->banklogo ?>" style="width: 30px; height: 30px;">
                                        ธนาคาร <?= $item->bankname ?> ประเภท <?= $item->acctype ?> ชื่อบัญชี <?= $item->accname ?> เลขที่บัญชี <?= $item->accno ?>
                                    </label> 
                                <?php endforeach; ?> 
                            </div>
                            <div class="form-group">
                                รูปถ่าย/สลิป
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100%; height: 150px;"></div>
                                    <div>
                                        <span class="btn btn-info btn-embossed btn-file">
                                            <span class="fileinput-new"><span class="fui-image"></span>  Select image</span>
                                            <span class="fileinput-exists"><span class="fui-gear"></span>  Change</span>
                                            <input type="file" name="txtfileupload" id="txtfileupload" accept="image/*">
                                        </span>
                                        <a href="#" class="btn btn-primary btn-embossed fileinput-exists" data-dismiss="fileinput"><span class="fui-trash"></span>  Remove</a>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                วัน / เวลา ที่ชำระเงิน <span style="color: red;font-size: 12px;">*กรุณาชำระเงินก่อนระบุ</span>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button class="btn" type="button"><span class="fui-calendar"></span></button>
                                                </span>
                                                <input type="text"  class="form-control" value="<?= date('d/m/Y') ?>" id="txtpaiddate"  name="txtpaiddate" required/>
                                            </div>
                                        </div>
                                        <div class="col-xs-5">
                                            <input class="form-control" id="txtpaidtime" name="txtpaidtime" type="text" placeholder="09:00" required  autocomplete="off" > 
                                        </div>
                                    </div> 
                                </div> 


                            </div>
                            <input type="hidden" value="<?= $ordertoken ?>" id="ordertoken" />
                            <button type="submit" class="btn btn-hg btn-block btn-inverse">ส่งข้อมูลการชำระเงิน</button>
                        </form>
                    </div>
                </div>

            </div> 

        </div> 
        <div class="mtl pbl">
            <div class="bottom-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="#fakelink" class="bottom-menu-brand">Powered by ServeWellSolution Co.,ltd.</a>
                        </div>

                        <div class="col-xs-12">
                            <ul class="bottom-menu-iconic-list"> 
                                <i class="fa fa-phone-square" aria-hidden="true"></i> Hotline : 062292917
                            </ul>
                        </div>
                    </div>
                </div>
            </div> <!-- /bottom-menu-inverse -->
        </div>
    </body>
    <script type="text/javascript" src="<?= base_url("res/dist/js/vendor/jquery.min.js") ?>"></script> 
    <script src="<?= base_url("res/dist/js/flat-ui-pro.min.js") ?>"></script>
    <script src="<?= base_url("res/js/application.js") ?>"></script>  
    <script type="text/javascript" src="<?= base_url("res/js/application-docs.js") ?>"></script>    
    <script>
                            var datepickerSelector = $('#txtpaiddate');
                            datepickerSelector.datepicker({
                                showOtherMonths: true,
                                selectOtherMonths: true,
                                dateFormat: 'dd/mm/yy',
                                yearRange: '-1:+1'
                            }).prev('.input-group-btn').on('click', function (e) {
                                e && e.preventDefault();
                                datepickerSelector.focus();
                            });
                            $.extend($.datepicker, {_checkOffset: function (inst, offset, isFixed) {
                                    return offset;
                                }});
                            // Now let's align datepicker with the prepend button
                            datepickerSelector.datepicker('widget').css({'margin-left': -datepickerSelector.prev('.input-group-btn').find('.btn').outerWidth() + 3});
                            $(document).ready(function () {

                                init();
//            var provinceid = '<?= isset($customer) ? $customer->provinceid : '' ?>';
//            var aumpureid = '<?= isset($customer) ? $customer->aumpureid : '' ?>';
//            var tumbolid = '<?= isset($customer) ? $customer->tumbolid : '' ?>';
//            if (provinceid != '') {
//                $.ajax({
//                    type: "POST",
//                    url: "<?php echo base_url('service/getaumphure'); ?>",
//                    data: {'provinceid': provinceid},
//                    dataType: "json",
//                    success: function (data) {
//                        var html = "<option  value=\"\">== กรุณาเลือกอำเภอ ==</option>";
//                        $.each(data.result, function (index, value) {
//                            if (value.AMPHUR_ID == aumpureid) {
//                                html += "<option selected value=\"" + value.AMPHUR_ID + "\">" + value.AMPHUR_NAME + "</option>";
//                            } else {
//                                html += "<option  value=\"" + value.AMPHUR_ID + "\">" + value.AMPHUR_NAME + "</option>";
//                            }
//
//                        });
//                        $("#txtaumpure").html(html);
//                        html = "<option  value=\"\">== กรุณาเลือกอำเภอ ==</option>";
//                        ;
//                        $(".overlay-loader").hide();
//                    },
//                    error: function (XMLHttpRequest) {
//                        $(".overlay-loader").hide();
//                    }
//                });
//
//
//                $.ajax({
//                    type: "POST",
//                    url: "<?php echo base_url('service/gettumbol'); ?>",
//                    data: {'aumpureid': aumpureid},
//                    dataType: "json",
//                    success: function (data) {
//
//                        var html = "<option  value=\"\">== กรุณาเลือกตำบล ==</option>";
//
//                        $.each(data.result, function (index, value) {
//
//                            if (value.DISTRICT_ID == tumbolid) {
//                                html += "<option selected value=\"" + value.DISTRICT_ID + "\">" + value.DISTRICT_NAME + "</option>";
//                            } else {
//                                html += "<option  value=\"" + value.DISTRICT_ID + "\">" + value.DISTRICT_NAME + "</option>";
//                            }
//
//                        });
//                        $("#txttumbol").html(html);
//                    },
//                    error: function (XMLHttpRequest) {
//                    }
//                });
//            }


                                $("#formlookup").submit(function () {
                                    $(".overlay-loader").show();
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_url('service/sendorder'); ?>",
                                        data: {'txttel': $("#txttellookup").val(), 'txtidcard': $("#txtidcard").val()},
                                        dataType: "json",
                                        success: function (data) {

                                            if (data.result != null) {
                                                console.log(data);
                                            }
                                            $(".overlay-loader").hide();
                                        },
                                        error: function (XMLHttpRequest) {
                                            $(".overlay-loader").hide();
                                        }
                                    });
                                    $("#txttel").val($("#txttellookup").val());
                                    return false;
                                });
                                $("#txtprovince").change(function () {
                                    $(".overlay-loader").show();
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_url('service/getaumphure'); ?>",
                                        data: {'provinceid': $(this).val()},
                                        dataType: "json",
                                        success: function (data) {
                                            var html = "<option  value=\"\">== กรุณาเลือกอำเภอ ==</option>";
                                            $.each(data.result, function (index, value) {
                                                html += "<option  value=\"" + value.AMPHUR_ID + "\">" + value.AMPHUR_NAME + "</option>";
                                            });
                                            $("#txtaumpure").html(html);
                                            html = "<option  value=\"\">== กรุณาเลือกตำบล ==</option>";
                                            $("#txttumbol").html(html);
                                            $(".overlay-loader").hide();
                                        },
                                        error: function (XMLHttpRequest) {
                                            $(".overlay-loader").hide();
                                        }
                                    });
                                });
                                $("#txtaumpure").change(function () {
                                    $(".overlay-loader").show();
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_url('service/gettumbol'); ?>",
                                        data: {'aumpureid': $(this).val()},
                                        dataType: "json",
                                        success: function (data) {
                                            var html = "<option  value=\"\">== กรุณาเลือกตำบล ==</option>";
                                            $.each(data.result, function (index, value) {
                                                html += "<option  value=\"" + value.DISTRICT_ID + "\">" + value.DISTRICT_NAME + "</option>";
                                            });
                                            $("#txttumbol").html(html);
                                            $(".overlay-loader").hide();
                                        },
                                        error: function (XMLHttpRequest) {
                                            $(".overlay-loader").hide();
                                        }
                                    });
                                });
                            });
                            function init() {
                                $(".overlay-loader").hide();
                            }
    </script>
    <input type="hidden" id="refreshed" value="no">
    <script type="text/javascript">
        onload = function () {
            var e = document.getElementById("refreshed");
            if (e.value == "no")
                e.value = "yes";
            else {
                e.value = "no";
                location.reload();
            }
        };
    </script>
</html>
