<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Perdbill.co - บริการเปิดบิลสินค้าผ่านไลน์ ใครๆก็ทำได้</title>
    <meta name="description" content="บริการเปิดบิลจาก <?= $merchant->name ?> ปลอดภัย สะดวก รวดเร็ว">
    <link href="<?= base_url("res/css/font-awesome.min.css") ?>" rel="stylesheet" type="text/css"/>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url("res/fav/favicon-16x16.png") ?>">
    <!-- Loading Bootstrap -->
    <link href="<?= base_url("res/dist/css/vendor/bootstrap.min.css") ?>" rel="stylesheet">

    <!-- Loading Flat UI Pro -->
    <link href="<?= base_url("res/dist/css/flat-ui-pro.css") ?>" rel="stylesheet" type="text/css"/>

    <!-- Custom -->
    <link href="<?= base_url("res/css/custom.css") ?>" rel="stylesheet" type="text/css"/>

    <link href="<?= base_url("res/account/plugins/bower_components/owl.carousel/owl.carousel.min.css") ?>"
          rel="stylesheet" type="text/css"/>
    <link href="<?= base_url("res/account/plugins/bower_components/owl.carousel/owl.theme.default.css") ?>"
          rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="overlay-loader">
    <div class="bg"></div>
    <div class="container">
        <div class="loader"></div>
        <p>กรุณารอสักครู่ระบบกำลังดำเนินการ...</p>
    </div>
</div>
<!-- Modal -->
<div class="modal" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close fui-cross" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title" id="imgModalLabel">รายละเอียดสินค้า</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="thumbnail">
                            <img id="itemimg" src="">
                            <div class="caption">
                                <h6 id="itemtitle"></h6>
                                <p id="itemprice"></p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>
<div class="container mb">
    <form action="<?= base_url("order/paymentwithmerchant/$ordertoken") ?>" method="post" enctype="multipart/form-data">
        <div class="header">
            <div class="row">
                <div class="logo">
                    <img src="<?= $merchant->image ?>"/>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <h4 class="text-center head-section">Billing Detail</h4>
                </div>
            </div>
            <!-- .row -->
            <div class="row">
                <div class="col-lg-12">
                    <div id="owl-demo2" class="owl-carousel owl-theme" style="margin-top:15px;">
                        <?php foreach ($items as $item): ?>
                            <div class="item"><img src="<?= $item->image ?>">
                                <p class="itemname"
                                   style="font-size:11px;     height: 40px;line-height: 14px; font-weight:500;padding-top: 10px;text-align: center;"><?= $item->name ?></p>
                                <p class="itemprice"
                                   style="text-align:center;"><?= number_format($item->price, 2, '.', ','); ?>฿</p>
                                <div class="col-xs-12 ">
                                    <input type="hidden" value="<?= $item->id ?>"/>
                                    <input type="hidden" value="<?= $item->price ?>"/>
                                    <input style="width:100%;" type="number" name="amount" min="0"
                                           class="input-sm itemamount" value="" placeholder="0" autocomplete="off"/>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <ul class="nav nav-list">
                        <!--                                <li class="nav-header">รายการสินค้า</li>
                                <?php foreach ($items as $item): ?>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <img src="<?= $item->image ?>" style="width:40px;" class="img img-thumbnail" />
                                                <span class="itemname"><a href="javascript:;" onclick="openimgmodal('<?= $item->name ?>', '<?= $item->image ?>', '<?= number_format($item->price, 2, '.', ','); ?>')"><?= $item->name ?><i class="fa fa-external-link-square" style="    font-size: .7em;  padding-left: 4px;"></i></a></span> <br/>  <span class="itemprice"><?= number_format($item->price, 2, '.', ','); ?>฿</span>
                                            </div>
                                            <div class="col-xs-4">
                                                <input type="hidden" value="<?= $item->id ?>"/>
                                                <input type="hidden" value="<?= $item->price ?>"/>
                                                <input type="number" name="amount" min="0" class="form-control input-sm itemamount" value=""  placeholder="0" autocomplete="off" />
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                                <li class="divider"></li>-->
                        <li class="nav-header">สรุปยอด</li>
                        <li>
                            <a href="#fakelink">
                                +ค่าจัดส่ง
                                <span class="badge pull-right" id="shipingrate"></span>
                                <input type="hidden" id="shipingratehidden"/>
                            </a>
                        </li>


                        <li class="active">
                            <a href="#fakelink">
                                ยอดที่ต้องชำระทั้งสิ้น
                                <span class="badge pull-right" id="total"></span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>


        </div>
        <div>
            <div class="row">
                <h4 class="text-center head-section payment">Payment Method</h4>
                <div class="col-xs-12">
                    <?php foreach ($paymentmethod as $index => $item): ?>
                        <label class="bank" for="checkbox<?= $index ?>">
                            <input name="paymenttype" type="radio" id="checkbox<?= $index ?>" required checked
                                   value="<?= $item->id ?>"/>
                            <img src="<?= $item->banklogo ?>" style="width: 30px; height: 30px;">
                            ธนาคาร <?= $item->bankname ?> ประเภท <?= $item->acctype ?> ชื่อบัญชี <?= $item->accname ?>
                            เลขที่บัญชี <?= $item->accno ?>
                        </label>
                    <?php endforeach; ?>

                </div><!-- /.demo-col -->

            </div>
            <div class="row">
                <div class="col-xs-12">
                    <h4 class="text-center head-section userdetail" style="margin-top: 25px;">Shipping info</h4>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <input class="form-control" id="txtfullname" name="txtfullname" type="text"
                           placeholder="ชื่อ - นามสกุล" value="" required autocomplete="off">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="fa fa-user-circle-o"
                                                                            aria-hidden="true"></span></button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <input class="form-control" id="txttel" name="txttel" type="tel" placeholder="เบอร์โทร" value=""
                           required autocomplete="off">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-phone-square"
                                                                         aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <input class="form-control" id="txtemail" name="txtemail" type="email" placeholder="อีเมลล์"
                           autocomplete="off">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-envelope-open-o"
                                                                         aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="input">
                    <input class="form-control" id="txtaddress" name="txtaddress" type="text"
                           placeholder="บ้านเลขที่/หมู่บ้าน" required value="" autocomplete="off">
                </div>
            </div>

            <div class="form-group">
                <select class="selectpicker" name="txtprovince" id="txtprovince" required>
                    <option value="">== กรุณาเลือกจังหวัด ==</option>
                    <?php foreach ($province as $value): $provid = isset($customer) ? $customer->provinceid : ''; ?>
                        <option value="<?= $value->code ?>"><?= $value->name_th ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
            <div class="form-group">
                <select class="selectpicker" name="txtaumpure" id="txtaumpure" required>
                    <option value="">== กรุณาเลือกอำเภอ ==</option>
                </select>

            </div>
            <div class="form-group">
                <select class="selectpicker" name="txttumbol" id="txttumbol" required>
                    <option value="">== กรุณาเลือกตำบล ==</option>
                </select>

            </div>
            <div class="form-group">
                <div class="input">
                    <input class="form-control" id="txtzipcode" name="txtzipcode" type="number"
                           placeholder="รหัสไปรษณีย์" value="" required autocomplete="off">
                </div>
            </div>
            <div class="form-group">
                จำนวนเงินที่โอน <span style="color: red;font-size: 12px;">*กรุณาชำระเงินก่อนระบุ</span>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="input">
                                <input type="number" class="form-control" value="" id="txtpaidamount"
                                       name="txtpaidamount" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                รูปถ่าย/สลิป <span style="color: red;font-size: 12px;">*เพื่อความรวดเร็วในการตรวจสอบ</span>
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                         style="width: 100%; height: 150px;"></div>
                    <div>
                                <span class="btn btn-info btn-embossed btn-file">
                                    <span class="fileinput-new"><span class="fui-image"></span>  Select image</span>
                                    <span class="fileinput-exists"><span class="fui-gear"></span>  Change</span>
                                    <input type="file" name="txtfileupload" id="txtfileupload" accept="image/*">
                                </span>
                        <a href="#" class="btn btn-primary btn-embossed fileinput-exists" data-dismiss="fileinput"><span
                                    class="fui-trash"></span> Remove</a>
                    </div>
                </div>
            </div>

            <div class="form-group">
                วันที่ชำระเงิน <span style="color: red;font-size: 12px;">*กรุณาชำระเงินก่อนระบุ</span>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="input-group">
                                        <span class="input-group-btn">
                                            <button class="btn" type="button"><span
                                                        class="fui-calendar"></span></button>
                                        </span>
                                <input type="text" class="form-control" value="<?= date('d/m/Y') ?>" id="txtpaiddate"
                                       name="txtpaiddate" required/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                เวลาชำระเงิน <span style="color: red;font-size: 12px;">*กรุณาชำระเงินก่อนระบุ</span>
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-6">
                            <select class="selectpicker" name="txtpaidhour" id="txtpaidhour" required>
                                <?php for ($i = 1; $i <= 24; $i++): ?>
                                    <option <?= sprintf("%02d", $i) == date('H') ? 'selected' : '' ?>
                                            value="<?= sprintf("%02d", $i); ?>"><?= sprintf("%02d", $i); ?></option>
                                <?php endfor ?>
                            </select>

                        </div>
                        <div class="col-xs-6">

                            <select class="selectpicker" name="txtpaidmin" id="txtpaidmin" required>
                                <?php for ($i = 1; $i <= 60; $i++): ?>
                                    <option <?= sprintf("%02d", $i) == date('i') ? 'selected' : '' ?>
                                            value="<?= sprintf("%02d", $i); ?>"><?= sprintf("%02d", $i); ?></option>
                                <?php endfor ?>
                            </select>
                        </div>
                    </div>
                </div>


            </div>


            <input type="hidden" value="<?= $ordertoken ?>" id="ordertoken"/>
            <button type="submit" class="btn btn-hg btn-block btn-inverse checkamount">ส่งข้อมูลการชำระเงิน
            </button>

        </div>
        <input type="hidden" id="itemselectedhd" name="itemselectedhd"/>
        <input type="hidden" id="shippinghd" name="shippinghd"/>
        <input type="hidden" id="totalhd" name="totalhd"/>
    </form>

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
<!-- jQuery for carousel -->
<script src="<?= base_url("res/account/plugins/bower_components/owl.carousel/owl.carousel.min.js") ?>"></script>
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
    $.extend($.datepicker, {
        _checkOffset: function (inst, offset, isFixed) {
            return offset;
        }
    });
    // Now let's align datepicker with the prepend button
    datepickerSelector.datepicker('widget').css({'margin-left': -datepickerSelector.prev('.input-group-btn').find('.btn').outerWidth() + 3});


    function openimgmodal(name, image, price) {
        $("#itemimg").attr("src", image)
        $("#itemtitle").html(name);
        $("#itemprice").html(price + "฿");
        $('#imgModal').modal('show');
    }
    $(document).ready(function () {
        init();
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
                        html += "<option  value=\"" + value.code + "\">" + value.name_th + "</option>";
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
                        html += "<option  value=\"" + value.code + "\">" + value.name_th + "</option>";
                    });
                    $("#txttumbol").html(html);
                    $(".overlay-loader").hide();
                },
                error: function (XMLHttpRequest) {
                    $(".overlay-loader").hide();
                }
            });
        });


        $("input[type=number][name=amount]").change(function () {
            updateprice();
        });


        <?php if(count($items) == 1):?>
        $('#owl-demo2').owlCarousel({
            margin: 50,
            nav: true,
            autoplay: false,
            responsive: {
                0: {
                    items: 1
                },
            }
        });
        <?php elseif (count($items) == 2):?>
        $('#owl-demo2').owlCarousel({
            margin: 20,
            nav: true,
            autoplay: false,
            responsive: {
                0: {
                    items: 2
                },
            }
        });
        <?php else: ?>
        $('#owl-demo2').owlCarousel({
            margin: 20,
            nav: true,
            autoplay: false,
            responsive: {
                0: {
                    items: 2
                },
                480: {
                    items: 3
                },
            }
        });
        <?php endif;?>




    });

    function getshippingrate(merchantid, unit, cb_func) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getshippingrate'); ?>",
            data: JSON.stringify({'merchantid': merchantid, 'unit': unit}),
            dataType: "json",
            success: function (data) {
                if (data.result != null) {
                    cb_func(data.result.price);
                } else {
                    cb_func('0');
                }


            },
            error: function (XMLHttpRequest) {
                $(".overlay-loader").hide();
            }
        });
    }

    function updateprice() {
        $(".overlay-loader").show();
        var merchantid = '<?= $merchant->id ?>';
        var total = 0;
        var unit = 0;
        var productselect = "";

        $('input[type=number][name=amount]').each(function () {
            if ($(this).val()) {
                total += parseFloat($(this).prev().val()) * parseFloat($(this).val() == "" ? 0 : $(this).val());
                unit += parseInt($(this).val());

                var id = $(this).prev().prev().val();
                var price = $(this).prev().val();
                var amount = $(this).val();
                productselect += id + "|" + price + "|" + amount + ";"
            }
        });

        $("#itemselectedhd").val(productselect);


        this.getshippingrate(merchantid, unit, function (price) {
            if (price == 0) {
                $("#shipingrate").html("ฟรี");
                $("#shipingratehidden").val(0);
            } else {
                $("#shipingrate").html(price + "฿");
                $("#shipingratehidden").val(price);
            }

            total = total + parseFloat(price);

            $("#shippinghd").val(price);
            $("#totalhd").val(total);

            var shippingdiscount = parseFloat($("#shippingdiscounthidden").val() == null ? 0 : $("#shippingdiscounthidden").val());
            var pricediscount = parseFloat($("#pricediscounthidden").val() == null ? 0 : $("#pricediscounthidden").val());
            total = total + shippingdiscount;
            total = total + pricediscount;

            $("#total").html(numberWithCommas(total) + "฿");


            $(".overlay-loader").hide();
        });


    }


    $(".checkamount").click(function () {

        var total = 0;
        var shipingrate = $("#shipingratehidden").val();
        var itemselected = "";
        var hasitem = 0;
        $('input[type=number][name=amount]').each(function () {
            if ($(this).val()) {
                hasitem += $(this).val();
                itemselected += $(this).prev().prev().val() + "," + parseFloat($(this).val() == "" ? 0 : $(this).val()) + "," + parseFloat($(this).prev().val()) * parseFloat($(this).val() == "" ? 0 : $(this).val()) + ";";
                total += parseFloat($(this).prev().val()) * parseFloat($(this).val() == "" ? 0 : $(this).val());
            }
        });

        if (hasitem == 0) {
            alert("เลือกสินค้าอย่างน้อย 1 ชิ้น");
            $(".itemamount").first().focus();
            return false;
        }


        return true;
    });


    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function init() {
        $(".overlay-loader").hide();
        updateprice();
    }
</script>
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-39217117-10', 'auto');
    ga('send', 'pageview');

</script>
</html>
