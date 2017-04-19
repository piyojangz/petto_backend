<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>Social Billing</title> 
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
                                                <span class="itemname"><?= $item->name ?></span> <br/>  <span class="itemprice"><?= number_format($item->price, 2, '.', ','); ?></span>
                                            </div>
                                            <div class="col-xs-4"> 
                                                <input type="hidden" value="<?= $item->id ?>"/>
                                                <input type="hidden" value="<?= $item->price ?>"/>
                                                <input type="number" class="form-control input-sm itemamount" value="<?= $obj->getamount($orderdetail, $item->id) ?>"  placeholder="0" /> 
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?> 
                                <li class="divider"></li>
                                <li class="nav-header">สรุปยอด</li>
                                <li>
                                    <a href="#fakelink">
                                        +ค่าจัดส่ง
                                        <span class="badge pull-right"><?= number_format($merchant->deliverycharge, 2, '.', ',') ?>฿</span>
                                    </a>
                                </li> 
                                <li class="active">
                                    <a href="#fakelink">
                                        ยอดที่ต้องชำระ
                                        <span class="badge pull-right" id="total"><?= number_format($order->total, 2, '.', ',') ?>฿</span>
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
                                <input name="paymenttype"  type="radio" id="checkbox<?= $index ?>"  required value="<?= $item->id ?>"  <?= $item->id == $order->paymentmethodid ? 'checked' : '' ?>/>
                                <img src="<?= $item->banklogo ?>" style="width: 30px; height: 30px;">
                                ธนาคาร <?= $item->bankname ?> ประเภท <?= $item->acctype ?> ชื่อบัญชี <?= $item->accname ?> เลขที่บัญชี <?= $item->accno ?>
                            </label> 
                        <?php endforeach; ?> 
                        <input type="hidden" id="orderid" value="<?= $order->id ?>" />
                        <button type="submit"  class="btn btn-hg btn-block btn-primary">แจ้งชำระเงิน</button>
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
    <script type="text/javascript" src="<?= base_url("res/js/jquery-3.2.0.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("res/bootstrap/js/bootstrap.min.js") ?>"></script>


    <script>
        $(document).ready(function () {
            init();

            $("input[type=number]").change(function () {
                updateprice();
            });
        });

        function updateprice() {
            var deliverycharge = '<?= $merchant->deliverycharge ?>';
            var total = 0;
            $('input[type=number]').each(function () {
                total += parseFloat($(this).prev().val()) * parseFloat($(this).val() == "" ? 0 : $(this).val());
            });
            total += parseFloat(deliverycharge);
            $("#total").html(numberWithCommas(total) + "฿");
        }


        $("#submitform").submit(function () {
            $(".overlay-loader").show();
            var total = 0;
            var deliverycharge = '<?= $merchant->deliverycharge ?>';
            var itemselected = "";
            var hasitem = 0;
            $('input[type=number]').each(function () {
                hasitem += $(this).val();
                itemselected += $(this).prev().prev().val() + "," + parseFloat($(this).val() == "" ? 0 : $(this).val()) + "," + parseFloat($(this).prev().val()) * parseFloat($(this).val() == "" ? 0 : $(this).val()) + ";";
                total += parseFloat($(this).prev().val()) * parseFloat($(this).val() == "" ? 0 : $(this).val());
            });

            if (hasitem == 0) {
                $(".overlay-loader").hide();
                alert("เลือกสินค้าอย่างน้อย 1 ชิ้น");

                return false;
            }
            itemselected = itemselected.slice(0, -1);
            total += parseFloat(deliverycharge);
            var paymenttype = $('input[name=paymenttype]:checked', '#submitform').val()


            $.ajax({
                type: "POST",
                url: "<?php echo base_url('service/submitorder'); ?>",
                data: {'itemselected': itemselected, 'total': total, 'paymenttype': paymenttype, 'orderid': $("#orderid").val(), 'ordertoken': '<?= $ordertoken ?>', 'deliverycharge': '<?= $merchant->deliverycharge ?>'},
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
