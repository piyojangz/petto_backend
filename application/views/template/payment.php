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
            <div class="header">
                <div class="row">
                    <div class="logo">
                        <img src="http://www.rochubeauty.com//public/images/logo_white.png"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="text-center head-section userdetail">Shipping info</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">

                        <form> 
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" id="appendedInputButton-03" type="text" placeholder="ชื่อ - นามสกุล" required>
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="button"><span class="fa fa-user-circle-o" aria-hidden="true"></span></button> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" id="appendedInputButton-03" type="tel" placeholder="เบอร์โทร">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-phone-square" aria-hidden="true"></i></button> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input class="form-control" id="appendedInputButton-03" type="email" placeholder="อีเมลล์">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></button> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input">
                                    <input class="form-control" id="appendedInputButton-03" type="text" placeholder="บ้านเลขที่/หมู่บ้าน"> 
                                </div>
                            </div> 

                            <div class="form-group"> 
                                <select class="selectpicker">
                                    <option>== กรุณาเลือกจังหวัด ==</option>
                                    <option>Ketchup</option>
                                    <option>Relish</option>
                                </select>

                            </div>
                            <div class="form-group"> 
                                <select class="selectpicker">
                                    <option>== กรุณาเลือกอำเภอ ==</option>
                                    <option>Ketchup</option>
                                    <option>Relish</option>
                                </select>

                            </div>
                            <div class="form-group"> 
                                <select class="selectpicker">
                                    <option>== กรุณาเลือกตำบล ==</option>
                                    <option>Ketchup</option>
                                    <option>Relish</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <div class="input">
                                    <input class="form-control" id="appendedInputButton-03" type="number" placeholder="รหัสไปรษณีย์" max="5"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <h4 class="text-center head-section payment">Payment Method</h4>
                                <label class="bank" for="checkbox1"> 
                                    <input name="paymenttype"  type="radio" id="checkbox1" checked/>
                                    <img src="http://www.magazinedee.com/share/images/icon_payment_kbank.gif " style="width: 30px; height: 30px;">
                                    ธนาคาร กสิกรไทย ประเภท ออมทรัพย์ สาขามหาวิทยาลัยเกษตรศาสตร์ บางเขน ชื่อบัญชี ชนิกานต์ สงวนพันธุ์ เลขที่บัญชี 694-2-09854-3
                                </label> 
                                <label class="bank" for="checkbox3"> 
                                    <input name="paymenttype" type="radio" id="checkbox3"/>
                                    <img src="http://ext.truemoney.com/m/info/addmoney/instruction/images/logo-scb.png " style="width: 30px; height: 30px;">
                                    ธนาคาร ไทยพานิชย์ ประเภท ออมทรัพย์ สาขามหาวิทยาลัยเกษตรศาสตร์ บางเขน ชื่อบัญชี ชนิกานต์ สงวนพันธุ์ เลขที่บัญชี 694-2-09854-3
                                </label> 
                            </div>
                            <div class="form-group">
                                รูปถ่าย/สลิป
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100%; height: 150px;"></div>
                                    <div>
                                        <span class="btn btn-info btn-embossed btn-file">
                                            <span class="fileinput-new"><span class="fui-image"></span>  Select image</span>
                                            <span class="fileinput-exists"><span class="fui-gear"></span>  Change</span>
                                            <input type="file" name="...">
                                        </span>
                                        <a href="#" class="btn btn-primary btn-embossed fileinput-exists" data-dismiss="fileinput"><span class="fui-trash"></span>  Remove</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                วัน / เวลา ที่ชำระเงิน
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button class="btn" type="button"><span class="fui-calendar"></span></button>
                                                </span>
                                                <input type="text" class="form-control" value="02/04/2017" id="datepicker-01" />
                                            </div>
                                        </div>
                                        <div class="col-xs-5">
                                            <input class="form-control" id="appendedInputButton-03" type="text" placeholder="09:00"> 
                                        </div>
                                    </div> 
                                </div> 


                            </div>
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
    <script type="text/javascript" src="<?= base_url("res/js/jquery-3.2.0.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("res/bootstrap/js/bootstrap.min.js") ?>"></script>
    <script type="text/javascript" src="<?= base_url("res/dist/js/flat-ui-pro.js") ?>"></script> 
    <script type="text/javascript" src="<?= base_url("res/js/prettify.js") ?>"></script> 
    <script type="text/javascript" src="<?= base_url("res/js/application-docs.js") ?>"></script>    
    <script>
        var datepickerSelector = $('#datepicker-01');
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
            $(".overlay-loader").hide();
        });
    </script>
</html>
