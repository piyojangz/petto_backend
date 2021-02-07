<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Insert_model', 'put');
        $this->load->model('Select_model', 'get');
        $this->load->model('Update_model', 'set');
        $this->load->model('Email', 'mail');
        $this->load->library('upload');
        $this->load->library('lineapi');
        $this->load->library('common');
    }

    public function Summary($orderid = "")
    {
        $this->load->view('template/bill');
    }

    public function paymentsuccess($token = "")
    {
        $data["ordertoken"] = $this->get->ordertoken(array('token' => $token))->row();
        if ($data["ordertoken"] == null) {
            redirect(base_url());
        }


        $data["obj"] = $this;
        $uid = $data["ordertoken"]->uid;
        $merchantid = $data["ordertoken"]->merchantid;
        $data["merchant"] = $this->get->merchant(array('id' => $merchantid))->row();
        $this->load->view('template/paymentsuccess', $data);
    }

    public function trackorder($token = "", $merchantuid = "")
    {
        $ordertoken = $this->get->ordertoken(array('token' => $token))->row();
        if ($ordertoken == null) {
            redirect(base_url());
        }
        $data["obj"] = $this;
        $data["uid"] = $ordertoken->uid;

        $merchantid = $ordertoken->merchantid;
        $orderid = $ordertoken->orderid;
        $data["genstatus"] = $ordertoken->genstatus;
        $data["merchant"] = $this->get->merchant(array('id' => $merchantid))->row();
        $data["order"] = $this->get->order(array('id' => $orderid))->row();
        $data["custdetail"] = $this->get->customer(array('id' => $data["order"]->custid))->row();
        $data["orderdetail"] = $this->get->orderdetail(array('orderid' => $orderid))->result();
        $data["items"] = $this->get->items(array('merchantid' => $merchantid))->result();
        $data["order"] = $this->get->order(array('id' => $orderid))->row();


        // $meruid = $this->get->v_merchantlineuid(array('token' => $token, 'lineuid' => $merchantuid))->num_rows();
        // $data["canedit"] = $meruid > 0 ? true : false;
        $data["canedit"] = true;

        $this->load->view('template/track', $data);
    }

    public function getpaymentmethoddetail($id)
    {
        $res = "";
        $paymentmethod = $this->get->paymentmethod(array('id' => $id))->row();
        $res .= "ธนาคาร " . $paymentmethod->bankname;
        $res .= "ประเภท " . $paymentmethod->acctype;
        $res .= "เลขที่บัญชี " . $paymentmethod->accno;
        $res .= "ชื่อบัญชี " . $paymentmethod->accname;
        return $res;
    }

    public function getamount($orderdetail, $itemid)
    {
        foreach ($orderdetail as $item) {
            if ($item->itemid == $itemid) {
                return $item->amount;
            }
        }

        return "0";
    }

    public function promoinfo($token = "")
    {
        $data["ordertoken"] = $this->get->ordertoken(array('token' => $token))->row();
        if ($data["ordertoken"] == null) {
            redirect(base_url());
        }


        $data["obj"] = $this;
        $uid = $data["ordertoken"]->uid;
        $merchantid = $data["ordertoken"]->merchantid;
        $data["merchant"] = $this->get->merchant(array('id' => $merchantid))->row();
        $this->load->view('template/promobillsuccess.php', $data);
    }


    public function payment($token = "")
    {
        $data["ordertoken"] = $token;

        $ordertoken = $this->get->ordertoken(array('token' => $token))->row();
        $data["uid"] = $ordertoken->uid;
        $merchantid = $ordertoken->merchantid;
        $orderid = $ordertoken->orderid;
        $data["genstatus"] = $ordertoken->genstatus;
        $data["obj"] = $this;
        $data["merchant"] = $this->get->merchant(array('id' => $merchantid))->row();
        $data["orderdetail"] = $this->get->orderdetail(array('orderid' => $orderid))->result();
        $data["items"] = $this->get->items(array('merchantid' => $merchantid))->result();
        $data["order"] = $this->get->order(array('id' => $orderid))->row();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $merchantid, 'status' => '1'))->result();
        $data["customer"] = $this->get->customer(array('uid' => $data["uid"]))->row();


        if ($data["order"]->status >= 1) {
            redirect(base_url("/track/$token"));
        }

        $data["province"] = $this->get->province(array())->result();
        if ($_POST) {
            $image = "";
            if (!empty($_FILES['txtfileupload']['name'])) {

                $upPath = "./public/upload/slip";

                $config['upload_path'] = "$upPath";
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '0';
                $config['max_width'] = '0';
                $config['max_height'] = '0';

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('txtfileupload')) {
                    $data['imageError'] = $this->upload->display_errors();
                } else {
                    $imageDetailArray = $this->upload->data();
                    $image = $imageDetailArray['file_name'];
                }
            }
            $imagepath = "";
            if ($image != "") {
                $imagepath = "/public/upload/slip/$image";
            }

            $txtfullname = $this->input->post("txtfullname");
            $txttel = $this->input->post("txttel");
            $txtemail = $this->input->post("txtemail");
            $txtaddress = $this->input->post("txtaddress");
            $txtprovince = $this->input->post("txtprovince");
            $txtaumpure = $this->input->post("txtaumpure");
            $txttumbol = $this->input->post("txttumbol");
            $txtzipcode = $this->input->post("txtzipcode");
            $txtpaidamount = $this->input->post("txtpaidamount");
            $paymenttype = $this->input->post("paymenttype");
            $txtpaiddate = $this->input->post("txtpaiddate");
            $txtpaidhour = $this->input->post("txtpaidhour");
            $txtpaidmin = $this->input->post("txtpaidmin");

            $input = array(
                'fullname' => $txtfullname,
                'tel' => $txttel,
                'email' => $txtemail,
                'provinceid' => $txtprovince,
                'tumbolid' => $txttumbol,
                'aumpureid' => $txtaumpure,
                'zipcode' => $txtzipcode,
                'fulladdress' => $txtaddress,
                'uid' => $data["uid"],
                'updatedate' => date('Y-m-d H:i:s'),
            );
            $custid = $this->put->customer($input);

//            $cond = array('uid' => $input['uid']);
//            if ($this->get->customer($cond)->num_rows() == 0) {
//                $this->put->customer($input);
//            } else {
//                $this->set->customer($input);
//            }


            $input = array(
                'id' => $orderid,
                'custid' => $custid,
                'billingaddress' => $this->getfulladdress($txtaddress, $txttumbol, $txtaumpure, $txtprovince, $txtzipcode),
                'status' => '1',
                'status' => '1',
                'paymentamount' => $txtpaidamount,
                'slipimage' => $imagepath,
                'paymentmethodid' => $paymenttype,
                'paymentinfo' => $txtpaiddate . ' ' . $txtpaidhour . ':' . $txtpaidmin,
                'submitdate' => date('Y-m-d H:i:s'),
                'updatedate' => date('Y-m-d H:i:s'),
            );
            $this->set->order($input);
            //$this->lineapi->pushmsg($data["uid"], "ขอบคุณที่อุดหนุนค่ะ ลูกค้าสามารถติดตามการสั่งซื้อได้ที่ลิงค์นี้ https://perdbill.co/track/$token");
//            $v_merchantuid = $this->get->v_merchantuid(array('ordertoken' => $token))->result();
//            foreach ($v_merchantuid as $item) {
//                $this->lineapi->pushmsg($item->lineuid, "ลูกค้าได้ส่งคำสั่งการสั่งซื้อ สามารถดูได้ที่ https://perdbill.co/track/$token/$item->lineuid");
//            }

            $this->lineapi->pushmsg($data["uid"], "ลูกค้าได้ส่งคำสั่งการสั่งซื้อ สามารถดูได้ที่ https://perdbill.co/track/$token/" . $data["uid"]);

            redirect(base_url("/paymentsuccess/$token"));
        }


        $this->load->view('template/payment', $data);
    }

    public function generatebilltoken($merchantid, $merchantuid, $orderid, $billtoken, $billtokenid)
    {
        $uniqid = $this->common->getToken(6);
        $cond = array('token' => $uniqid);
        if ($this->get->ordertoken($cond)->num_rows() > 0) {
            return $this->generatebilltoken($merchantid, $merchantuid, $orderid, $billtoken, $billtokenid);
        }

        $input = array(
            'orderid' => $orderid,
            'billtoken' => $billtoken,
            'billtokenid' => $billtokenid,
            'merchantid' => $merchantid,
            'token' => $uniqid,
            'uid' => $merchantuid,
            'genstatus' => 0
        );

        if ($this->put->ordertoken($input)) {
            return $uniqid;
        }
        return $uniqid;
    }

    public function paymentwithmerchant($token = "")
    {

        if ($_POST) {
            // สร้าง ordertoken ก่อน
            $image = "";
            if (!empty($_FILES['txtfileupload']['name'])) {

                $upPath = "./public/upload/slip";

                $config['upload_path'] = "$upPath";
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '0';
                $config['max_width'] = '0';
                $config['max_height'] = '0';

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('txtfileupload')) {
                    $data['imageError'] = $this->upload->display_errors();
                } else {
                    $imageDetailArray = $this->upload->data();
                    $image = $imageDetailArray['file_name'];
                }
            }
            $imagepath = "";
            if ($image != "") {
                $imagepath = "/public/upload/slip/$image";
            }

            $itemselectedhd = $this->input->post("itemselectedhd");
            $shippinghd = $this->input->post("shippinghd");
            $totalhd = $this->input->post("totalhd");
            // new

            $txtfullname = $this->input->post("txtfullname");
            $txtemail = $this->input->post("txtemail");
            $txttel = $this->input->post("txttel");
            $txtaddress = $this->input->post("txtaddress");
            $txtprovince = $this->input->post("txtprovince");
            $txtaumpure = $this->input->post("txtaumpure");
            $txttumbol = $this->input->post("txttumbol");
            $txtzipcode = $this->input->post("txtzipcode");
            $paymenttype = $this->input->post("paymenttype");
            $txtpaiddate = $this->input->post("txtpaiddate");
            $txtpaidhour = $this->input->post("txtpaidhour");
            $txtpaidmin = $this->input->post("txtpaidmin");
            $paymentamount = $this->input->post("txtpaidamount");

            $billtoken = $this->get->billtoken(array("token" => $token))->row();


            $input = array(
                'fullname' => $txtfullname,
                'tel' => $txttel,
                'email' => $txtemail,
                'provinceid' => $txtprovince,
                'tumbolid' => $txttumbol,
                'aumpureid' => $txtaumpure,
                'zipcode' => $txtzipcode,
                'fulladdress' => $txtaddress,
                'updatedate' => date('Y-m-d H:i:s'),
            );
            $custid = $this->put->customer($input);


            $input = array(
                'custid' => $custid,
                'merchantid' => $billtoken->merchantid,
                'shipingrate' => $shippinghd,
                'total' => $totalhd,
                'billingaddress' => $this->getfulladdress($txtaddress, $txttumbol, $txtaumpure, $txtprovince, $txtzipcode),
                'status' => '1',
                'slipimage' => $imagepath,
                'paymentamount' => $paymentamount,
                'paymentmethodid' => $paymenttype,
                'paymentinfo' => $txtpaiddate . ' ' . $txtpaidhour . ':' . $txtpaidmin,
                'submitdate' => date('Y-m-d H:i:s'),
                'updatedate' => date('Y-m-d H:i:s'),
            );
            $orderid = $this->put->order($input);

            //สร้าง ordertoken
            $token = $this->generatebilltoken($billtoken->merchantid, $billtoken->uid, $orderid, $billtoken->token, $billtoken->id);


            // loop เพื่อเพิ่มรายการสินค้า
            $productselecteds = rtrim($itemselectedhd, ";");
            $productselecteds = explode(";", $productselecteds);

            foreach ($productselecteds as $item) {
                $arritem = explode("|", $item);
                $itemid = $arritem[0];
                $price = $arritem[1];
                $amount = $arritem[2];

                $input = array(
                    'orderid' => $orderid,
                    'amount' => $amount,
                    'price' => $price,
                    'itemid' => $itemid
                );
                $this->put->orderdetail($input);

                if ($billtoken->isstockenable == 1) {
                    $input = array(
                        'billtokenid' => $billtoken->id,
                        'amount' => ($amount * -1),
                        'merchantid' => $billtoken->merchanttoken,
                        'itemid' => $itemid
                    );
                    $this->put->billtokenstock($input);
                }
            }

            // $v_notificationtousers = $this->get->v_notificationtousers(array('token' => $token))->result();
            // foreach ($v_notificationtousers as $item) {
            //     $this->lineapi->pushmsg($item->lineuid, "ลูกค้าได้ส่งคำสั่งการสั่งซื้อ สามารถดูได้ที่ https://perdbill.co/track/$token/$item->lineuid");
            // }

            // $this->sendinfotouser($txtfullname, $token, $txtemail, $billtoken->merchantid);

            redirect(base_url("/paymentsuccess/$token"));
        }
    }

    public function sendinfotouser($txtfullname, $billtoken, $email, $merchantid)
    {
        $merchant = $this->get->merchant(array("id" => $merchantid))->row();
        $subject = "Receipt for Your Ordered to $merchant->name";
        $msg = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\"  jstcache=\"0\">
<head>
<meta name=\"viewport\" content=\"width=device-width\" />
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<title>Perdbill.co order info</title>
</head>
<body style=\"margin:0px; background: #f8f8f8; \"  jstcache=\"0\">
<div  jstcache=\"0\" width=\"100%\" style=\"background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;\">
  <div  jstcache=\"0\" style=\"padding:50px 0;  margin: 0px auto; font-size: 14px\">
    <table  jstcache=\"0\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%; margin-bottom: 20px\">
      <tbody  jstcache=\"0\">
        <tr  jstcache=\"0\" >
          <td  jstcache=\"0\"  style=\"vertical-align: top; padding-bottom:30px;\" align=\"center\"><a href=\"javascript:void(0)\" target=\"_blank\"><img src=\"$merchant->image\"   style=\"border:none;border-radius: 50%;\"></a> </td>
        </tr>
      </tbody>
    </table>
    <div  jstcache=\"0\" style=\"padding: 40px; background: #fff;\">
      <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width: 100%;\">
        <tbody  jstcache=\"0\">
          <tr  jstcache=\"0\">
            <td  jstcache=\"0\" ><b>Dear  $txtfullname,</b>
              <p   jstcache=\"0\" >ขอบคุณที่อุดหนุนสินค้าที่ร้านเรา ลูกค้าสามารถติดตามสถานะสินค้าได้ที่ <br/><a href=\"https://perdbill.co/track/$billtoken\" style=\"background-color: #fb4;letter-spacing: .05em;
    border-radius: 60px;
    padding: 4px 12px 3px;
    font-weight: 500;text-decoration: none;color: #fff\">https://perdbill.co/track/$billtoken</a></p>

              <p  jstcache=\"0\"  style=\"margin-top: 50px;\">   <hr style=\"    border: 1px #f1f1f1 solid;\"/>This email just send Information, Please do not reply.</p>
              <b  jstcache=\"0\"  >- Thanks $merchant->name</b> </td>
          </tr  jstcache=\"0\">
        </tbody>
      </table>
    </div>
    <div  jstcache=\"0\" style=\"text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px\">
      <p  jstcache=\"0\"> Powered by Perdbill.co <br>
        <a href=\"https://perdbill.co/\" style=\"color: #b2b2b5; text-decoration: underline;\">สนใจเปิดร้านค้า</a> </p>
    </div>
  </div>
</div>
</body>
</html>
";
        $this->mail->sendinfo($msg, $email, $subject);

    }

    public function getfulladdress($txtaddress, $txttumbol, $txtaumpure, $txtprovince, $txtzipcode)
    {
        $fulladdr = $txtaddress;
        $fulladdr .= " ตำบล/แขวง " . $this->get->subdistrict(array('SUBSTR(code,1,4)' => substr($txttumbol,0,4)))->row()->name_th;
        $fulladdr .= " อำเภอ/เขต " . $this->get->district(array('SUBSTR(code,1,2)' => substr($txtaumpure,0,2)))->row()->name_th;
        $fulladdr .= " จังหวัด " . $this->get->province(array('SUBSTR(code,1,2)' => substr($txtprovince,0,2)))->row()->name_th;
        $fulladdr .= " รหัสไปรษณีย์ " . $txtzipcode;
        return $fulladdr;
    }

}
