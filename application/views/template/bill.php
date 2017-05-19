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
            <form method="POST" id="submitform" >
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
                    <div class="row">  
                        <div class="col-xs-12">
                            <ul class="nav nav-list">
                                <li class="nav-header">รายการสินค้า</li>  
                                <?php foreach ($items as $item): ?>
                                    <li  > 
                                        <div class="row">
                                            <div class="col-xs-8"> 
                                                <img src="<?= $item->image ?>" style="width:40px;" class="img img-thumbnail" />
                                                <span class="itemname"><a href="javascript:;" onclick="openimgmodal('<?= $item->name ?>', '<?= $item->image ?>', '<?= number_format($item->price, 2, '.', ','); ?>')"><?= $item->name ?><i class="fa fa-external-link-square" style="    font-size: .7em;  padding-left: 4px;"></i></a></span> <br/>  <span class="itemprice"><?= number_format($item->price, 2, '.', ','); ?>฿</span>
                                            </div>
                                            <div class="col-xs-4"> 
                                                <input type="hidden" value="<?= $item->id ?>"/>
                                                <input type="hidden" value="<?= $item->price ?>"/>
                                                <input type="number" name="amount" min="0" class="form-control input-sm itemamount" value="<?= $obj->getamount($orderdetail, $item->id) ?>"  placeholder="0" autocomplete="off" />
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?> 
                                <li class="divider"></li>
                                <li class="nav-header">สรุปยอด</li>
                                <li>
                                    <a href="#fakelink">
                                        +ค่าจัดส่ง
                                        <span class="badge pull-right" id="shipingrate"></span>
                                        <input type="hidden"   id="shipingratehidden" />
                                    </a>
                                </li> 
                                <?php if ($genstatus == 1): ?>
                                    <li class="divider"></li>
                                    <li class="nav-header">รายการส่วนลด(ถ้ามี)</li>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-7"> 
                                                <span class="itemname">- ส่วนลดค่าจัดส่ง</span>
                                            </div>
                                            <div class="col-xs-5"> 
                                                <input type="hidden" value="<?= $item->id ?>"/>
                                                <input type="hidden" value="<?= $item->price ?>"/>
                                                <input type="number" name="shippingdiscount"   class="form-control input-sm itemamount"   placeholder="0"  style="width: 100%;    margin: 0px 0px 10px 0px;"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-7"> 
                                                <span class="itemname">- ส่วนลดค่าสินค้า</span>
                                            </div>
                                            <div class="col-xs-5"> 
                                                <input type="hidden" value="<?= $item->id ?>"/>
                                                <input type="hidden" value="<?= $item->price ?>"/>
                                                <input type="number" name="pricediscount"   class="form-control input-sm itemamount"   placeholder="0" style="width: 100%;" />
                                            </div>
                                        </div>
                                        <input type="hidden" id="shippingdiscounthidden" value="0" />
                                        <input type="hidden" id="pricediscounthidden"  value="0" />
                                    </li> 
                                <?php endif; ?>

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

                <div class="row">
                    <h4 class="text-center head-section payment">Payment Method</h4>
                    <div class="col-xs-12">
                        <?php foreach ($paymentmethod as $index => $item): ?>
                            <label class="bank" for="checkbox<?= $index ?>"> 
                                <input  name="paymenttype"  type="radio" id="checkbox<?= $index ?>"  required value="<?= $item->id ?>"  <?= $item->id == $order->paymentmethodid ? 'checked' : '' ?>/>
                                <img src="<?= $item->banklogo ?>" style="width: 30px; height: 30px;">
                                ธนาคาร <?= $item->bankname ?> ประเภท <?= $item->acctype ?> ชื่อบัญชี <?= $item->accname ?> เลขที่บัญชี <?= $item->accno ?>
                            </label> 
                        <?php endforeach; ?> 
                        <input type="hidden" id="orderid" value="<?= $order->id ?>" /> 
                        <?php if ($genstatus == 1): ?>
                            <button type="submit"  class="btn btn-hg btn-block btn-primary">บันทึกรายการ</button>
                        <?php else: ?>
                            <button type="submit"  class="btn btn-hg btn-block btn-primary">แจ้งชำระเงิน</button>
                        <?php endif; ?>
                    </div><!-- /.demo-col -->

                </div>
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

    <script>
                                                    function openimgmodal(name, image, price) {
                                                        $("#itemimg").attr("src", image)
                                                        $("#itemtitle").html(name);
                                                        $("#itemprice").html(price + "฿");
                                                        $('#imgModal').modal('show');
                                                    }
                                                    $(document).ready(function () {
                                                        init();
                                                        $("input[type=number][name=amount]").change(function () {
                                                            updateprice();
                                                        });
<?php if ($genstatus == 1): ?>
                                                            $("input[type=number][name=shippingdiscount]").change(function () {
                                                                var shippingdiscount = -Math.abs($(this).val());
                                                                $(this).val(shippingdiscount);
                                                                $("#shippingdiscounthidden").val(shippingdiscount);
                                                                updateprice();

                                                            });

                                                            $("input[type=number][name=pricediscount]").change(function () {
                                                                var pricediscount = -Math.abs($(this).val());
                                                                $("#pricediscounthidden").val(pricediscount);
                                                                $(this).val(pricediscount);
                                                                updateprice();

                                                            });
<?php endif; ?>

                                                    });

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

                                                    function updateprice() {
                                                        $(".overlay-loader").show();
                                                        var merchantid = '<?= $merchant->id ?>';
                                                        var total = 0;
                                                        var unit = 0;

                                                        $('input[type=number][name=amount]').each(function () {
                                                            if ($(this).val()) {
                                                                total += parseFloat($(this).prev().val()) * parseFloat($(this).val() == "" ? 0 : $(this).val());
                                                                unit += parseInt($(this).val());
                                                            }
                                                        });





                                                        this.getshippingrate(merchantid, unit, function (price) {
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

                                                            $("#total").html(numberWithCommas(total) + "฿");
                                                            $(".overlay-loader").hide();
                                                        });


                                                    }


                                                    $("#submitform").submit(function () {
                                                        $(".overlay-loader").show();
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
                                                            $(".overlay-loader").hide();
                                                            alert("เลือกสินค้าอย่างน้อย 1 ชิ้น");

                                                            return false;
                                                        }
                                                        itemselected = itemselected.slice(0, -1);
                                                        total = total + parseFloat(shipingrate);

                                                        var paymenttype = $('input[name=paymenttype]:checked', '#submitform').val()
                                                        var shipingratehidden = $("#shipingratehidden").val();
                                                        var shippingdiscount = parseFloat($("#shippingdiscounthidden").val() == null ? 0 : $("#shippingdiscounthidden").val());
                                                        var pricediscount = parseFloat($("#pricediscounthidden").val() == null ? 0 : $("#pricediscounthidden").val());
                                                        var mnbillstatus = '<?= $genstatus ?>';

                                                        total = total + shippingdiscount;
                                                        total = total + pricediscount;
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "<?php echo base_url('service/submitorder'); ?>",
                                                            data: {'itemselected': itemselected, 'total': total, 'paymenttype': paymenttype, 'orderid': $("#orderid").val(), 'ordertoken': '<?= $ordertoken ?>', 'shipingrate': shipingratehidden
                                                                , 'shippingdiscount': shippingdiscount, 'pricediscount': pricediscount, 'mnbillstatus': mnbillstatus},
                                                            dataType: "json",
                                                            success: function (data) {
                                                                if (data.result != null) {
                                                                    location.href = "<?= base_url("shipinginfo/$ordertoken") ?>";
                                                                }
                                                                $(".overlay-loader").hide();
                                                            },
                                                            error: function (XMLHttpRequest) {
                                                                $(".overlay-loader").hide();
                                                            }
                                                        });


                                                        return false;
                                                    });


                                                    function numberWithCommas(x) {
                                                        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                                    }

                                                    function init() {
                                                        $(".overlay-loader").hide();
                                                        updateprice();
                                                    }
    </script>
</html>
