<div class="mtl pbl">

    <div class="bottom-menu">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-xs-12 text-center">
                    <img src="<?= base_url("res/img/web-logo.png") ?>" style="width: 50px;"/>
                    <br/> <br/>
                    <a href="<?= base_url() ?>" class="bottom-menu-brand">Powered by Perdbill.co</a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12  text-center">
                    <ul class="bottom-menu-iconic-list">
                        <br/>
                        <i class="fa fa-phone-square" aria-hidden="true"></i> Hotline : 062-229-2917
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div> <!-- /bottom-menu-inverse -->
</div>
<div id="billing" class="hidden-xs hidden-sm">

    <div class="body">
        <div class="billing toogleoff">
            <div onclick="billtoogle(null)" class="btn-toogle"><i
                        class="fa fa-2x fa-arrow-right fa-rotate-180"></i></div>
            <div class="overlay-loader">
                <div class="bg"></div>
                <div class="container">
                    <div class="loader"></div>
                    <p>กรุณารอสักครู่ระบบกำลังดำเนินการ...</p>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <form action="<?= base_url("order/paymentwithmerchant/$ordertoken") ?>" method="post"
                          enctype="multipart/form-data">
                        <input type="hidden" id="unit">
                        <div class="white-box billpanel">
                            <div class="body">
                                <h3>รายการสินค้า</h3>
                                <div id="cartitems">
                                    <center> ไม่มี</center>
                                </div>


                                <div class="row">
                                    <div class="col-xs-12">
                                        <h3>สรุปยอด</h3>
                                        <div class="row items">
                                            <div class="col-xs-8">
                                                + ค่าจัดส่ง
                                            </div>
                                            <div class="col-xs-4">
                                                <span class="badge" style="margin-top: 0px;"
                                                      id="shipingrate">ไม่มี</span>
                                                <input type="hidden" id="shipingratehidden"/>
                                            </div>
                                        </div>
                                        <div class="row items summary">
                                            <div class="col-xs-8">
                                                ยอดที่ต้องชำระทั้งสิ้น
                                            </div>
                                            <div class="col-xs-4">
                                                <span class="badge" style="margin-top: 0px;" id="total">0</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <h3>Shipping info</h3>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" id="txtfullname" name="txtfullname" type="text"
                                                   placeholder="ชื่อ - นามสกุล" value="" required autocomplete="off">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" type="button"><span
                                                            class="fa fa-user-circle-o"
                                                            aria-hidden="true"></span></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" id="txttel" name="txttel" type="tel"
                                                   placeholder="เบอร์โทร" value=""
                                                   required autocomplete="off">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" type="button"><i
                                                            class="fa fa-phone-square"
                                                            aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" id="txtemail" name="txtemail" type="email"
                                                   placeholder="อีเมลล์"
                                                   autocomplete="off">
                                            <div class="input-group-btn">
                                                <button class="btn btn-default" type="button"><i
                                                            class="fa fa-envelope-open-o"
                                                            aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="input">
                                            <input class="form-control" id="txtaddress" name="txtaddress" type="text"
                                                   placeholder="บ้านเลขที่/หมู่บ้าน" required value=""
                                                   autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <select class="selectpicker" name="txtprovince" id="txtprovince" required>
                                            <option value="">== กรุณาเลือกจังหวัด ==</option>
                                            <?php foreach ($province as $value): $provid = isset($customer) ? $customer->provinceid : ''; ?>
                                                <option value="<?= $value->PROVINCE_ID ?>"><?= $value->PROVINCE_NAME ?></option>
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
                                        จำนวนเงินที่โอน <span
                                                style="color: red;font-size: 12px;">*กรุณาชำระเงินก่อนระบุ</span>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="input">
                                                        <input type="number" class="form-control" value=""
                                                               id="txtpaidamount"
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
                                                <a href="#" class="btn btn-primary btn-embossed fileinput-exists"
                                                   data-dismiss="fileinput"><span
                                                            class="fui-trash"></span> Remove</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        วันที่ชำระเงิน <span
                                                style="color: red;font-size: 12px;">*กรุณาชำระเงินก่อนระบุ</span>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="input-group">

                                                        <input type="text" class="form-control"
                                                               value="<?= date('d/m/Y') ?>" id="txtpaiddate"
                                                               name="txtpaiddate" required/>
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-default" type="button"><i
                                                                        class="fa fa-calendar" aria-hidden="true"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        เวลาชำระเงิน <span
                                                style="color: red;font-size: 12px;">*กรุณาชำระเงินก่อนระบุ</span>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <select class="selectpicker" name="txtpaidhour" id="txtpaidhour"
                                                            required>
                                                        <?php for ($i = 1; $i <= 24; $i++): ?>
                                                            <option <?= sprintf("%02d", $i) == date('H') ? 'selected' : '' ?>
                                                                    value="<?= sprintf("%02d", $i); ?>"><?= sprintf("%02d", $i); ?></option>
                                                        <?php endfor ?>
                                                    </select>

                                                </div>
                                                <div class="col-xs-6">

                                                    <select class="selectpicker" name="txtpaidmin" id="txtpaidmin"
                                                            required>
                                                        <?php for ($i = 1; $i <= 60; $i++): ?>
                                                            <option <?= sprintf("%02d", $i) == date('i') ? 'selected' : '' ?>
                                                                    value="<?= sprintf("%02d", $i); ?>"><?= sprintf("%02d", $i); ?></option>
                                                        <?php endfor ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                    </div>


                                    <div class="row">
                                        <h3>Payment Method</h3>
                                        <div class="col-xs-12">
                                            <?php foreach ($paymentmethod as $index => $item): ?>
                                                <label class="bank" for="checkbox<?= $index ?>">
                                                    <input name="paymenttype" type="radio" id="checkbox<?= $index ?>"
                                                           required checked
                                                           value="<?= $item->id ?>"/>
                                                    <img src="<?= $item->banklogo ?>"
                                                         style="width: 30px; height: 30px;">
                                                    ธนาคาร <?= $item->bankname ?> ประเภท <?= $item->acctype ?>
                                                    ชื่อบัญชี <?= $item->accname ?>
                                                    เลขที่บัญชี <?= $item->accno ?>
                                                </label>
                                            <?php endforeach; ?>


                                            <input type="hidden" value="<?= $ordertoken ?>" id="ordertoken"/>

                                        </div><!-- /.demo-col -->

                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <!--                        <a class="startusing text-center" style="width: 100%;" href="-->
                                <? //= $merchant->lineaddurl ?><!--">แอดไลน์เพื่อสอบถาม-->
                                <!--                            คลิก!</a>-->
                                <button type="submit" class="btn btn-hg btn-block    startusing checkamount"
                                        style="width: 100%">
                                    แจ้งชำระเงิน
                                </button>
                            </div>

                            <input type="hidden" id="itemselectedhd" name="itemselectedhd"/>
                            <input type="hidden" id="shippinghd" name="shippinghd"/>
                            <input type="hidden" id="totalhd" name="totalhd"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
<!-- Loading Flat UI Pro -->
<link href="<?= base_url("res/dist/css/flat-ui-merchantpage.css") ?>" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?= base_url("res/js/jquery-3.2.0.min.js") ?>"></script>
<script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
<script src="https://npmcdn.com/bootstrap@4.0.0-alpha.5/dist/js/bootstrap.min.js"></script
<script type="text/javascript" src="<?= base_url("res/bootstrap/js/bootstrap.min.js") ?>"></script>
<script src="<?= base_url("res/account/js/jquery.slimscroll.js") ?>"></script>
<script src="<?= base_url("res/dist/js/flat-ui-pro.min.js") ?>"></script>
<script src="<?= base_url("res/js/application.js") ?>"></script>
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

    $(document).ready(function () {
        init();
    });

    function billtoogle(istoogle) {

        if (istoogle == null) {
            console.log(istoogle);
            if ($(".billing").hasClass("toogleoff")) {
                $(".billing").removeClass("toogleoff");
                $(".fa-arrow-right").removeClass("fa-rotate-180");

            }
            else {
                $(".billing").addClass("toogleoff");
                $(".fa-arrow-right").addClass("fa-rotate-180");
            }
        }
        else {
            if (istoogle) {
                $(".billing").removeClass("toogleoff");
                $(".fa-arrow-right").removeClass("fa-rotate-180");
            }
            else {
                $(".billing").addClass("toogleoff");
                $(".fa-arrow-right").addClass("fa-rotate-180");
            }
        }


    }
    function init() {
        $(".overlay-loader").hide();
        var cart = JSON.parse(localStorage.getItem("cart"));
        if (cart != null) {
            if (cart.length > 0) {
                updatecart();
            }
        }

        //$(".billpanel").css({'height': ($(window).height()) + 'px'});
        $('.billpanel').slimScroll({
            height: $(window).height()
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


        $("input[type=number][name=amount]").change(function () {
            updateprice();
        });

    }

    function updatecart() {
        var cart = JSON.parse(localStorage.getItem("cart"));
        var total = 0;
        var unit = 0;
        var hasitem = false;
        var productselect = "";
        if (cart != null) {
            if (cart.length > 0) {
                var html = "";
                $.each(cart, function (index, value) {
                    if (value.amount > 0) {
                        html += '<div class="row items">';
                        html += '<div class="col-xs-8">';
                        html += '<h4>' + value.name + '</h4>';
                        html += '</div>';
                        html += '<div class="col-xs-4">';
                        html += '<span class="badge">' + value.price + ' x ' + value.amount + '</span>';
                        html += '<div class="amounttool">';
                        html += '<button onclick="addremove(\'add\',\'' + value.itemid + '\',\'' + value.name + '\',\'' + value.price + '\')"><i class="fa fa-plus"></i></button>';
                        html += '<button onclick="addremove(\'remove\',\'' + value.itemid + '\',\'' + value.name + '\',\'' + value.price + '\')"><i class="fa fa-minus"></i></button>';
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                        hasitem = true;
                        total += parseFloat(value.price) * value.amount;
                        unit = unit + value.amount;

                        var id = value.itemid;
                        var price = value.price;
                        var amount = value.amount;
                        productselect += id + "|" + price + "|" + amount + ";"
                    }
                });

                $("#itemselectedhd").val(productselect);

                if (hasitem) {
                    billtoogle(true);
                }
                else {
                    billtoogle(false);
                }
                $("#cartitems").html(html);
                $("#unit").val(unit);

            }
        }

        this.getshippingrate('<?=$merchant->id?>', unit, function (price) {
            if (price == 0) {
                $("#shipingrate").html("ฟรี");
                $("#shipingratehidden").val(0);
            } else {
                $("#shipingrate").html(price + "฿");
                $("#shipingratehidden").val(price);
            }

            total = total + parseFloat(price);
            var shippingdiscount = parseFloat($("#shippingdiscounthidden").val() == null ? 0 : $("#shippingdiscounthidden").val());
            var pricediscount = parseFloat($("#pricediscounthidden").val() == null ? 0 : $("#pricediscounthidden").val());
            total = total + shippingdiscount;
            total = total + pricediscount;

            $("#shippinghd").val(price);
            $("#totalhd").val(total);

            $("#total").html(numberWithCommas(total) + "฿");
            $(".overlay-loader").hide();
        });
    }

    function getshippingrate(merchantid, unit, cb_func) {
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('service/getshippingrate'); ?>",
            data: {'merchantid': merchantid, 'unit': unit},
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

    function addremove(command, itemid, name, price) {
        $(".overlay-loader").show();
        $(".billing").removeClass("toogleoff");
        $(".fa-arrow-right").removeClass("fa-rotate-180");
        var hasitem = false;


        var cart = JSON.parse(localStorage.getItem("cart"));
        if (cart != null) {
            for (var i = 0; i < cart.length; i++) {
                if (parseInt(cart[i].itemid) === parseInt(itemid)) {
                    if (command == 'add') {
                        cart[i].amount = cart[i].amount + 1;
                    }
                    else {
                        if (cart[i].amount > 0) {
                            cart[i].amount = cart[i].amount - 1;
                        }

                    }
                    hasitem = true;
                    break;
                }
            }
        }
        else {
            cart = [];
        }


        if (hasitem == false) {
            var items =
                {
                    'itemid': itemid
                    , 'name': name
                    , 'price': price
                    , 'amount': 1
                }
            ;

            cart.push(items)
        }
        localStorage.setItem('cart', JSON.stringify(cart));
        updatecart();

        $(".overlay-loader").hide();

    }

    $(".checkamount").click(function () {

        var unit = $("#unit").val();
        if (parseInt(unit) == 0) {
            alert("เลือกสินค้าอย่างน้อย 1 ชิ้น");
            $(".itemamount").first().focus();
            return false;
        }


        localStorage.removeItem("cart");

        return true;
    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>
</html>
