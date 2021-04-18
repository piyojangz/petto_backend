<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        Header("Access-Control-Allow-Credentials: true");
        Header('Access-Control-Allow-Origin: *'); //for allow any domain, insecure
        Header('Access-Control-Allow-Headers:  X-Auth-Token,AccountKey,x-requested-with, Content-Type, origin, authorization, accept, client-security-token, host, date, cookie, cookie2'); //for allow any headers, insecure
        Header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE'); //method allowed

        $this->load->model('Insert_model', 'put');
        $this->load->model('Select_model', 'get');
        $this->load->model('Update_model', 'set');
        $this->load->model('User_model', 'user');
        $this->load->model('Email', 'Semail');
        $this->load->library('upload');
        $this->load->library('lineapi');
        $this->load->library('excel');
        $this->load->library('common');
    }

    public function test()
    {
        echo "test";
    }


    public function getbanner()
    {
        $data['result'] = $this->get->imagescover(array('status' => 1))->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function registercust()
    {

        $post = json_decode(file_get_contents('php://input'), true);
        $firstname = $post['firstname'];
        $lastname = $post['lastname'];
        $email = $post['email'];
        $password = $post['password'];
        $userLineID = $post['userLineID'];
        $pictureUrl = $post['pictureUrl'];
        $name = $post['name'];

        $token = $this->common->getToken(10);
        $input = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password,
            'token' => $token,
            'lineid' => $userLineID,
            'pictureUrl' => $pictureUrl,
            'name' => $name,
            'createdate' => date('Y-m-d H:i:s')
        );

        $customer = $this->get->customer(array('email' => $email))->row();

        if (isset($customer)) {
            $data['result'] = false;
        } else {
            $data['result'] = $this->put->customer($input);
            $this->sendtoLine($userLineID, "ยินดีตอนรับสู่ Pettogo.co ท่านสามารถเข้าใช้งานระบบได้เลยที่ https://cd259cde582f.ngrok.io/");
            $whitelist = array(
                '127.0.0.1',
                '::1'
            );
            if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
                $this->sendregisteremail($token, $firstname, $email);
            }
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data['result']);
    }


    public function sendtoLine($userLineID, $msg)
    {
        // push message block
        $pushmessages = [];
        $pushmessages['to'] = $userLineID;
        $pushmessages['messages'][0] = $this->getFormatTextMessage($msg);
        $encodeJson2 = json_encode($pushmessages);
        // push message block

        $results = $this->lineapi->pushMessage($encodeJson2);
    }

    function getFormatTextMessage($text)
    {
        $datas = [];
        $datas['type'] = 'text';
        $datas['text'] = $text;
        return $datas;
    }

    function sendregisteremail($token, $firstname, $email)
    {
        $msg =  "สวัสดีคุณ $firstname คุณได้ทำการสมัครสมาชิก Pettogo.co เรียบร้อยแล้ว ขอบคุณค่ะ";
        $this->Semail->sendinfo($msg, $email, 'ยืนยันการสมัครสมาชิก Pettogo.co');
    }

    public function customerlogin()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $email = $post['email'];
        $password = $post['password'];
        $cond = array('email' => trim($email), 'password' => trim($password));
        $data['result'] = $this->get->customerdetail($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }



    public function login()
    {
        $post = json_decode(file_get_contents('php://input'), true);

        $username = $post['username'];
        $password = $post['password'];
        $data['result'] = $this->user->weblogin($username, md5($password));
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function lookupcustomer()
    {
        $post = json_decode(file_get_contents('php://input'), true);

        $txttel = $post['txttel'];
        $txtidcard = $post['txtidcard'];
        $cond = array('tel' => $txttel, 'idcard' => $txtidcard);
        $data['result'] = $this->get->customerdetail($cond);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getbilltoken()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $token = $post['token'];
        $cond = array('token' => $token);
        $data['result'] = $this->get->billtoken($cond)->row();
        $data['result2'] = $this->get->billnotificationusers(array('billtokenid' => $data['result']->id))->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getpromobilltokenformerchant($merchantid, $merchantuid)
    {
        $uniqid = $this->common->getToken(6);
        $input = array(
            'shipingrate' => 0,
        );
        $orderid = $this->put->order($input);
        $input = array(
            'orderid' => $orderid,
            'merchantid' => $merchantid,
            'token' => $uniqid,
            'uid' => $merchantuid,
            'genstatus' => 1
        );

        if ($this->put->ordertoken($input)) {
            return array($orderid, $uniqid);
        }
        return false;
    }

    public function getpromobill()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $merchantid = $post['merchantid'];
        $merchanttoken = $post['merchanttoken'];
        $merchantuid = $post['merchantuid'];
        $itemselected = $post['itemselected'];
        $total = $post['total'];
        $paymenttype = $post['paymenttype'];

        $shipingrate = $post['shipingrate'];
        $shippingdiscount = $post['shippingdiscount'];
        $pricediscount = $post['pricediscount'];

        //genorder
        $order = $this->getpromobilltokenformerchant($merchantid, $merchantuid);


        //update order
        $input = array(
            'id' => $order[0],
            'total' => $total,
            'shipingrate' => $shipingrate,
            'paymentmethodid' => $paymenttype,
            'shippingdiscount' => $shippingdiscount,
            'pricediscount' => $pricediscount,
            'mnbillstatus' => 1,
            'updatedate' => date('Y-m-d H:i:s'),
        );
        $this->set->order($input);
        $orderitem = explode(";", $itemselected);
        foreach ($orderitem as $value) {
            $item = explode(",", $value);
            $input = array(
                'orderid' => $order[0],
                'itemid' => $item[0],
                'amount' => $item[1],
                'price' => $item[2],
            );
            $cond = array('orderid' => $input['orderid'], 'itemid' => $input['itemid']);
            if ($this->get->orderdetail($cond)->num_rows() == 0) {
                $this->put->orderdetail($input);
            } else {
                $this->set->orderdetail($input);
            }
        }

        $this->lineapi->pushmsg($merchantuid, "บิลสำหรับลูกค้าของคุณ https://perdbill.co/$order[1]");

        $data['result'] = $order[1];
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function deletemerchantlineuid()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];

        $input = array(
            'id' => $id,
            'status' => 0,
            'updatedate' => date('Y-m-d H:i:s'),
        );

        $data = $this->set->merchantlineuidbyid($input);


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function deletebilltoken()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];

        $input = array(
            'id' => $id,
            'status' => 0,
            'updatedate' => date('Y-m-d H:i:s'),
        );

        $data = $this->set->billtoken($input);


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getaumphure()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $provinceid = $post['provinceid'];
        $cond = array('SUBSTR(code,1,2)' => substr($provinceid, 0, 2));
        $data['result'] = $this->get->district($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getmerchantbilldata()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $token = $post['token'];
        $cond = array('token' => $token, 'status' => '1');
        $billtoken = $this->get->billtoken($cond)->row();
        $data["result"] = $billtoken;
        $data["result2"] = $this->getordersumbibilltoken($billtoken->token);
        $data["result3"] = $this->get->billnotificationusers(array("billtokenid" => $billtoken->id))->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getallbilltokenhtml()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $merchantid = $post['merchantid'];
        $cond = array('merchantid' => $merchantid, 'status' => '1');
        $result = $this->get->billtoken($cond)->result();
        $html = "";

        foreach ($result as $key => $value) {

            $url = "perdbill.co/";
            $html .= "<tr   id=\"$value->token\">";
            //            $html .= "<td>";
            //            $html .= "<div class=\"checkbox m-t-0 m-b-0\">";
            //            $html .= "<input type=\"checkbox\" name=\"billtokenid\" id =\"billtokenid\">";
            //            $html .= "<label for=\"checkbox0\"></label>";
            //            $html .= "</div>";
            //            $html .= "</td>";
            $html .= "<td colspan=\"2\">";
            $html .= "<small>$value->createdate</small><br/>$value->name</br>";
            $html .= "<small style=\"color:#ee6123;\">$url<b>$value->token</b></small>";
            $html .= "</td>";
            $html .= "</tr>";
        }

        echo $html;
    }


    public function getsalehistory()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $merchantid = $post['merchantid'];
        $lineuid = $post['lineuid'];
        $limit = $post['limit'];
        $offset = $post['offset'];
        $result = $this->get->v_salehistory($lineuid, $merchantid, $offset, $limit)->result();

        $html = "";
        foreach ($result as $key => $value) {
            $list = $this->get_orderitemslist($value->orderitems);
            $i = $key + 1 + $offset;
            $total = number_format($value->total);
            $html .= "<tr>";
            $html .= "<td>$i</td>";
            $html .= "<td>$value->date</td>";
            $html .= "<td>$list</td>";
            $html .= "<td>$total</td>";
            $html .= "</tr>";
        }
        echo $html;
    }

    public function get_orderitemslist($items)
    {
        $html = "";
        $orderitems = $this->get->getorderitems($items);
        foreach ($orderitems as $item) {
            $html .= "$item->name  ($item->sum) <br/>,";
        }
        return rtrim($html, ",");
    }


    public function saveshopslot()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $token = $post['token'];
        $merchantid = $post['merchantid'];

        $input = array(
            'merchantid' => $merchantid,
            'shoprange' => 0,
            'isactive' => 1,
            'updatedate' => date('Y-m-d H:i:s'),
        );


        $data['result'] = $this->put->shopslot($input);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function saveadminuid()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $token = $post['token'];
        $merchantid = $post['merchantid'];
        $adminname = $post['adminname'];
        $adminemail = $post['adminemail'];
        $admintel = $post['admintel'];
        $invitetoken = "Regis" . $this->common->getToken(8);

        $input = array(
            'token' => $token,
            'name' => $adminname,
            'email' => $adminemail,
            'tel' => $admintel,
            'status' => 1,
            'invitetoken' => $invitetoken,
            'updatedate' => date('Y-m-d H:i:s'),
        );


        $data['result'] = $this->put->merchantlineuid($input);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function updateitemtobill()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $itemid = $post['itemid'];
        $data['result'] = $itemid;

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getbillitiemswithstock()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $token = $post['token'];
        $billtoken = $this->get->billtoken(array("token" => $token))->row();
        $items = $this->get->itemswithstock(array("a.merchantid" => $billtoken->merchantid, "a.status" => '1'), $billtoken->id)->result();
        $html = "";
        foreach ($items as $index => $item) {
            $i = $index + 1;
            $stock = $item->itemstock == null ? 0 : $item->itemstock;
            $stock = $stock <= 0 ? "<span class=\"badge badge-danger\" style=\"padding-left: 10px;padding-right: 10px;\">$stock</span>" : $stock;
            $html .= "<tr>
                                                    <td class=\"text-center\">$i</td>
                                                    <td><span class=\"font-medium\">$item->name</td>
                                                    <td>$stock</td>

                                                    <td>
                                                        <a href=\"#\" id=\"stockamount$item->id\" name=\"stockamount\"
                                                           data-type=\"text\" data-pk=\"1\" data-title=\"Enter amount\"
                                                           data-itemid=\"$item->id\"
                                                           style=\"display: block; text-align: center;\"></a>
                                                    </td>
                                                </tr>";
        }

        echo $html;
    }


    public function updatestock()
    {

        $post = json_decode(file_get_contents('php://input'), true);

        $data["user"] = $this->user->get_account_cookie();
        $data["token"] = $data["user"]['token'];
        $data["merchant"] = $this->get->merchant(array("token" => $data["token"]))->row();
        $isstockenable = $post["isstockenable"] == 'on' ? 1 : 0;
        $updateitemamount = $post["updateitemamount"];
        $billtokenid = $post["billtokenid"];

        $input = array(
            "id" => $billtokenid,
            "isstockenable" => $isstockenable,
            "updatedate" => date('Y-m-d H:i:s'),
        );
        $this->set->billtoken($input);


        $items = explode("|", $updateitemamount);
        foreach ($items as $item) {
            $var = explode(";", $item);
            $id = $var[0];
            $amount = $var[1];

            $input = array(
                "billtokenid" => $billtokenid,
                "amount" => $amount,
                "itemid" => $id,
                "merchantid" => $data["merchant"]->id,
            );

            if ($amount != 0) {
                $this->put->billtokenstock($input);
            }
        }

        $this->checkinglowstock($data["merchant"]->id, $billtokenid);
        $data['result'] = true;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function checkinglowstock($merchantid, $billtokenid)
    {

        $billtoken = $this->get->billtoken(array("id" => $billtokenid))->row();
        $items = $this->get->itemswithstock(array("a.merchantid" => $merchantid, "a.status" => '1'), $billtokenid)->result();
        $billnotificationusers = $this->get->billnotificationusers(array('billtokenid' => $billtokenid))->result();

        if ($billtoken->isstockenable == "1") {
            foreach ($items as $item) {
                if ($item->itemstock <= 0) {
                    $stock = $item->itemstock == null ? 0 : $item->itemstock;
                    foreach ($billnotificationusers as $user) {
                        $this->lineapi->pushmsg($user->lineuid, "STOCK($billtoken->name) : $item->name มีจำนวนเหลือ $stock");
                    }
                }
            }
        }
    }

    public function savebilltoken()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $token = $post['token'];
        $editnotiusers = $post['editnotiusers'];
        $merchantid = $post['merchantid'];
        $daterange = $post['daterange'];
        $merchantuid = $post['merchantuid'];
        $usernoti = $post['usernoti'];
        $name = $post['name'];
        $daterange = preg_split("/,|:|\s/", $daterange);
        $uniqid = $this->common->getToken(5);

        $from = str_replace('/', '-', $daterange[0]);
        $to = str_replace('/', '-', $daterange[2]);

        $from = strtotime($from);
        $to = strtotime($to);


        if ($editnotiusers == "") {
            $input = array(
                'merchantid' => $merchantid,
                'name' => $name,
                'merchanttoken' => $token,
                'token' => $uniqid,
                'uid' => $merchantuid,
                'datefrom' => date('Y-m-d H:i:s', $from),
                'dateto' => date('Y-m-d H:i:s', $to),
                'status' => 1,
                'updatedate' => date('Y-m-d H:i:s'),
            );

            $billtokenid = $this->put->billtoken($input);

            if ($usernoti != "") {
                foreach ($usernoti as $item) {
                    $input = array(
                        'billtokenid' => $billtokenid,
                        'lineuid' => explode("|", $item)[0],
                        'merchantlinename' => explode("|", $item)[1]
                    );
                    $this->put->billnotificationusers($input);
                }
            }
        } else {
            $input = array(
                'id' => $editnotiusers,
                'merchantid' => $merchantid,
                'name' => $name,
                'datefrom' => date('Y-m-d H:i:s', $from),
                'dateto' => date('Y-m-d H:i:s', $to),
                'status' => 1,
            );

            $this->set->billtoken($input);

            if ($this->set->deletebillnotificationusers($editnotiusers)) {
                if ($usernoti != "") {
                    foreach ($usernoti as $item) {
                        $input = array(
                            'billtokenid' => $editnotiusers,
                            'lineuid' => explode("|", $item)[0],
                            'merchantlinename' => explode("|", $item)[1]
                        );
                        $this->put->billnotificationusers($input);
                    }
                }
            }
        }


        $data['result'] = true;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getreview()
    {
        // $id = $post['id'];
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('merchantid' => $id);
        $data['result'] = $this->get->v_review($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function getreviewbyproductid()
    {
        // $id = $post['id'];
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('itemid' => $id);
        $data['result'] = $this->get->v_review($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function getitem()
    {
        // $id = $post['id'];
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('id' => $id, 'status' => 1);
        $data['result'] = $this->get->items($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function getitembyseller()
    {
        // $id = $post['id'];
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('merchantid' => $id, 'status' => 1);
        $data['result'] = $this->get->items($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function getpackagelist()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $packageid = $post['packageid'];
        $cond = array('id' => $packageid);
        $packagelist = $this->get->package($cond)->result();
        $html = "";
        foreach ($packagelist as $index => $row) {
            $PACKICON = '';
            switch ($row->packagename) {
                case 'STARTUP':
                    $PACKICON = '<span class="badge" style="background:blue"><i class="fa fa-star"></i> Free StartUP</span>';
                    break;
                case 'SILVER':
                    $PACKICON = '<span class="badge" style="background:silver"><i class="fa fa-star"></i> Silver</span>';
                    break;
                case 'GOLD':
                    $PACKICON = '<span class="badge" style="background:gold"><i class="fa fa-star"></i> Gold</span>';
                    break;
                case 'PLATINUM':
                    $PACKICON = '<span class="badge" style="background:platinum"><i class="fa fa-star"></i> Platinum</span>';
                    break;

                default:
                    # code...
                    break;
            }
            $rownum = $index + 1;
            $isbestseller =   $row->isbestseller == 0 ? 'ไม่มีสิทธิ์' : 'มีสิทธิ์';
            $isrecommend = $row->isrecommend == 0 ? 'ไม่มีสิทธิ์' : 'มีสิทธิ์';
            $isbiding = $row->isbiding == 0 ? 'FALSE' : 'TRUE';


            $duration = "";
            switch ($row->duration) {
                case '0':
                    $duration = "Life time";
                    break;
                case '15':
                    $duration = "15 วัน";
                    break;

                case '30':
                    $duration = "30 วัน";
                    break;

                case '45':
                    $duration = "45 วัน";
                    break;

                case '60':
                    $duration = "60 วัน";
                    break;
                case '120':
                    $duration = "120 วัน";
                    break;


                default:
                    $duration = "Life time";
                    break;
            }
            $html .= "<tr>
            <td class='text-center' style='vertical-align: middle;'>$rownum</td>
            <td style='vertical-align: middle;'>$PACKICON </td>
            <td style='vertical-align: middle;'>
            $row->saleslot
            </td>
            <td style='vertical-align: middle;'>
            $isbiding
            </td>
            <td style='vertical-align: middle;'>
            $duration
            </td>
            <td style='vertical-align: middle;'>$row->price</td>
      
            <td style='vertical-align: middle;'>$isbestseller</td>
         <td style='vertical-align: middle;'>$isrecommend</td>
        </tr>";
        }


        $data["user"] = $this->user->get_account_cookie();
        $data["token"] = $data["user"]['token'];
        $merchant = $this->get->merchant(array("token" => $data["token"]))->row();
        $merchantid = $merchant->id;
        $package_mapping = $this->get->package_mapping(array("packageid" => $packageid, 'merchantid' =>   $merchantid, 'status' => 1))->row();

        $totaldays = $package_mapping->duration  - $package_mapping->diffday;


        if ($packageid == 1) {
            $html .= "";
        } else {
            $html .= "<tr><td  colspan='9' style='vertical-align: middle;'><code>แพคเกจคุณเหลืออายุอีก $totaldays วัน</code></td></tr>";
        }

        echo  $html;
    }

    public function job_updatemerchantpackage()
    {

        $packageoverduedate = $this->get->package_mapping_noneactive()->result();
        foreach ($packageoverduedate as $key => $value) {
            $input = array(
                'id' => $value->id,
                'status' => 0,
            );
            $this->set->package_mapping($input);
            $package =   $this->get->package(array('packagename'  => 'STARTUP'))->row();
            $input2 = array(
                'merchantid' => $value->merchantid,
                'packageid' => $package->id,
                'status' => 1,
                'duration' => $package->duration,
            );
            $this->put->packagemapping($input2);
        }
    }
    public function job_updateauctionwinners()
    {
        // $cond = array('status' => 1, 'dto <' => date('Y-m-d H:i:s'), 'currentprice > ' => 0);
        $cond = array('status' => 1, 'dto <' => date('Y-m-d H:i:s'));
        $auctionlist = $this->get->v_auction($cond)->result();
        print_r($auctionlist);

        foreach ($auctionlist as $key => $value) {
            // เพื่ม order + orderdetail 
            $orderno = date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);

            $gtotal = 0;
            $price =  $value->currentprice;
            $unit = 1;
            $gtotal  =   $value->currentprice;


            $shippingfee = $this->get->shippingrate($value->merchantid, $unit)->row();
            $gtotal   =  $gtotal + (isset($shippingfee) ? $shippingfee->price : 0);
            $customer = $this->get->customer(array('id' => $value->custid))->row();
            $total = 0;

            if ($customer) {


                $input = array(
                    'orderno' => $orderno,
                    'merchantid' => $value->merchantid,
                    'shippingfee' => isset($shippingfee) ? $shippingfee->price : 0,
                    'status' => 1,
                    'custid' => $value->custid,
                    'total' => $gtotal,
                    'isauction' => 1,
                    'shippingaddress' => $customer->fulladdress,
                    'createdate' => date('Y-m-d H:i:s'),
                    'updatedate' => date('Y-m-d H:i:s'),
                );
                $orderid  = $this->put->order($input);
                $s_image = "";
                $image = $this->base64_to_jpeg($value->image);
                $s_image .= base_url("public/upload/review/") . $image["upload_data"]["file_name"];

                $input2 = array(
                    'orderid' => $orderid,
                    'itemid' => 0,
                    'image' => $s_image,
                    'name' =>  $value->name,
                    'amount' => $unit,
                    'price' =>  $price,
                    'createdate' => date('Y-m-d H:i:s'),
                    'updatedate' => date('Y-m-d H:i:s'),
                );
                $this->put->orderdetail($input2); 

                

                //email and line
                $subject = "ผู้ชนะการประมูล";
                $msg = "ยินดีด้วยคุณชนะการประมูลสินค้า $value->name กรุณาดูที่หน้าข้อมูลลส่วนตัว";
                $this->msgnotifyCustomer($customer, $subject, $msg);
            }

            //update สถานะเป็นจบแล้ว
            $input = array(
                'id' => $value->id,
                'status' => 2,
                'updatedate' => date('Y-m-d H:i:s')
            );
            $this->set->auctionlist($input);
        }
    }

    function msgnotifyCustomer($customer, $subject, $msg)
    {
        $this->sendtoLine($customer->lineid, $msg);
        $this->Semail->sendinfo($msg, $customer->email, $subject);
    }
    public function getauctionhistorybycustid()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $custid = $post['custid'];
        $cond = array('custid' => $custid);
        $data['result'] = $this->get->v_auctionhistory($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getauctionlist()
    {
        $cond = array('status' => 1);
        $data['result'] = $this->get->v_auction($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getcontentlist()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $limit = $post['limit'];
        $cond = array('status' => 1);
        $data['result'] = $this->get->article($cond, $limit)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getcontentbyid()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('status' => 1, 'id' => $id);
        $data['result'] = $this->get->article($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function getauction()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('id' => $id);
        $data['result'] = $this->get->auctionlist($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getimagecover()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('id' => $id);
        $data['result'] = $this->get->imagescover($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getarticle()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('id' => $id);
        $data['result'] = $this->get->article($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getproducts()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $limit = $post['limit'];
        $pricelength = $post['pricelength'];
        $pricesort = $post['pricesort'];
        $cond = array('status' => 1, 'stock > ' => 0);
        $data['result'] = $this->get->v_product($cond, $limit, $pricelength, $pricesort)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getproductbyid()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('status' => 1, 'id' => $id);
        $data['result'] = $this->get->v_product($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }



    public function getauctionbyid()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('id' => 1, 'id' => $id);
        $data['result'] = $this->get->v_auction($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getproductoffer()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $limit = $post['limit'];
        $cond = array('status' => 1, 'isoffer' => 1);
        $data['result'] = $this->get->v_product($cond, $limit)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getproductbycateid()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        if ($id == '0') {
            $cond = array('status' => 1);
            $data['result'] = $this->get->items($cond)->result();
        } else {
            $cond = array('status' => 1, 'cateid' => $id);
            $data['result'] = $this->get->itemsbycateid($cond)->result();
        }

        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function removeimagecover()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $input = array(
            'id' => $id,
            'status' => 0,
            'updatedate' => date('Y-m-d H:i:s'),
        );

        $data['result'] = $this->set->imagescover($input);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function removearticle()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $input = array(
            'id' => $id,
            'status' => 0,
            'updatedate' => date('Y-m-d H:i:s'),
        );

        $data['result'] = $this->set->article($input);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function getordersumbibilltoken($billtoken)
    {
        return $this->get->getordersumbybilltoken($billtoken)->result();
    }

    public function confirmOrderPayment()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $items = $post['items'];
        $itemarr = array();
        foreach (explode("|", $items) as $value) {
            if ($value != "") {
                array_push($itemarr, $value);
            }
        }
        $input = array('isconfirm' => 1);

        $data['result'] = $this->set->order($input, $itemarr);


        foreach (explode("|", $items) as $value) {
            if ($value) {
                $order = $this->get->order(array('id' => intval($value)))->row();

                $custid = $order->custid;
                $customer = $this->get->customer(array('id' => $custid))->row();
                $subject = "ยืนยันการชำระเงิน";
                $msg = "รายการชำระ {$order->orderno} ของคุณถูกยืนยันแล้ว";

                $this->msgnotifyCustomer($customer, $subject, $msg);
            }
        }


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function updateorderstatus()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $items = $post['items'];
        $status = $post['status'];
        $itemarr = array();
        foreach (explode("|", $items) as $value) {
            array_push($itemarr, $value);
        }
        if ($status == "4") {
            $input = array('closestatus' => "1");
        } else {
            $input = array('status' => $status);
        }

        foreach ($itemarr as $orderid) {
            $orderdetails = $this->get->orderdetail(array('orderid' => $orderid))->result();
            foreach ($orderdetails as   $odetails) {
                $itemdetail = $this->get->items(array('id' => $odetails->itemid))->row();
                $inputstock = array(
                    'id' => $odetails->itemid,
                    'stock' => intval($itemdetail->stock) + intval($odetails->amount),
                    'updatedate' => date('Y-m-d H:i:s'),
                );
                $this->set->items($inputstock);
            }
        }

        $data['result'] = $this->set->order($input, $itemarr);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function exportorderexcel()
    {
        $merchantid = $this->input->post('merchantid');
        $status = $this->input->post('exportorderstatus');
        if ($status != "0") {
            if ($status == "4") {
                $result = $this->get->orderexcel(array("merchantid" => $merchantid), null, null);
            } else {
                $result = $this->get->orderexcel(array("merchantid" => $merchantid), null, array($status));
            }
        } else {
            $result = $this->get->orderexcel(array("merchantid" => $merchantid), null, null);
            // $result = $this->get->orderexcel(array("merchantid" => $merchantid, "closestatus" => 0), array("0", "3"), null);
        }
        $date = date('YmdHis');
        $this->excel->to_excel($result, 'order-excel' . $date);
    }

    public function getorderstatus()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $merchantid = $post['merchantid'];
        $status = $post['status'];
        if ($status != "0") {
            if ($status == "4") {
                $data['result'] = $this->get->v_order(array("merchantid" => $merchantid, "closestatus" => "1"), null, null)->result();
            } else {
                $data['result'] = $this->get->v_order(array("merchantid" => $merchantid, "closestatus" => "0"), null, array($status))->result();
            }
        } else {
            $data['result'] = $this->get->v_order(array("merchantid" => $merchantid, "closestatus" => "0"), null, null)->result();
            // $data['result'] = $this->get->v_order(array("merchantid" => $merchantid, "closestatus" => "0"), array("0", "3"), null)->result();
        }



        $html = "";
        foreach ($data['result'] as $item) {
            $statuslabel = $this->getorderstatuslabel($item->status, $item->closestatus);
            $notideliver = $item->isconfirm == 1 ? $item->delivery_trackid != "" ? "" : "<button onclick=\"setdelivery($item->id)\" class=\"btn btn-rounded btn-danger\">แจ้งจัดส่ง</button>" : "";
            $ischeckdisabled = $item->isconfirm == 1 ? "disabled" : "";
            $isdelivery_complete = $item->delivery_iscomplete == 1 ? "<div class=\"label label-table label-success\">ได้รับสินค้าแล้ว</div>" : "";
            $submitdate = date("d/M/Y H:i:s", strtotime($item->submitdate));
            $html .= "<tr>";
            $html .= "<td>";
            $html .= "<div class=\"checkbox checkbox-success checkbox-order \">";
            $html .= "<input  $ischeckdisabled id=\"orderid$item->id\" name=\"orderid\"  type=\"checkbox\" value=\"$item->id\">";
            $html .= "<label for=\"orderid$item->id\"> </label>";
            $html .= "</div>";
            $html .= "</td>";
            $html .= "<td><a class=\"badge badge-info \" target=\"_blank\" href=\"" . base_url("orderdetail/$item->id") . "\">$item->orderno</a></td>";
            $html .= "<td>$notideliver</td> ";
            $html .= "<td> $submitdate</td>";
            $html .= "<td>$item->paydatetime</td>";
            $html .= "<td>$item->fullname</td>";
            $html .= "<td>$item->shippingaddress</td>";
            // $html .= "<td>-</td>";
            // $html .= "<td>$item->sumamount</td>";
            $html .= "<td>" . number_format($item->total) . "</td>";
            $html .= "<td><b style='color:red'>" . number_format($item->total) . "</b>(รวมค่าจัดส่ง " . $item->shippingfee . ")</td>";
            // $html .= "<td>" . number_format($item->shipingrate) . "</td>";
            $html .= "<td>$statuslabel $isdelivery_complete</td> ";
            $html .= "</tr>";
        }

        echo $html;
    }

    public function getorderstatuslabel($status, $closestatus)
    {
        if ($closestatus == "1") {
            return " <div class=\"label label-table label-warning\">Canceled</div>";
        } else {
            switch ($status) {
                case "1":
                    return " <div class=\"label label-table label-warning\">รอชำระเงิน</div>";

                    break;
                case "2":
                    return " <div class=\"label label-table label-success\">ชำระเงินแล้ว</div>";
                    break;
                case "3":
                    return " <div class=\"label label-table label-danger\">จัดส่งแล้ว</div>";
                    break;
                default:
                    break;
            }
        }

        return "-";

        // <div class="label label-table label-success">Paid</div>
    }

    public function getshippingrateconfig()
    {
        // $id = $post['id'];
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('id' => $id);
        $data['result'] = $this->get->shippingrateconfig($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getpementmethod()
    {
        // $id = $post['id'];
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('id' => $id);
        $data['result'] = $this->get->paymentmethod($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function getshoprecommend()
    {
        $cond = array('status' => 1, 'isrecommend' => 1);
        $data['result'] = $this->get->v_merchantwithpackage($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getshop()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('status' => 1, 'id' => $id);
        $data['result'] = $this->get->v_merchantwithpackage($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getcate()
    {
        // $id = $post['id'];
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('id' => $id);
        $data['result'] = $this->get->category($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }



    public function getpaymentmethod()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $merchantid = $post['merchantid'];
        $cond = array('merchantid' => $merchantid);
        $data['result'] = $this->get->paymentmethod($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }



    public function getallcate()
    {
        // $merchantid = $post['merchantid'];
        $cond = array('status	' => '1');
        $data['result'] = $this->get->category($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getcateparent()
    {
        // $merchantid = $post['merchantid'];
        $cond = array('status	' => '1', 'parentid' => 0);
        $data['result'] = $this->get->category($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }



    public function getorderpendingpaid()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $custid = $post['custid'];
        // $custid = 8;
        $orderlist  = $this->get->orderdisplaylist(1, $custid, 0)->result();
        foreach ($orderlist as   $value) {
            $gtotal = 0;
            $odetails = $this->get->orderdetail(array('orderid' => $value->id))->result();
            $value->orderdetails =  $odetails;

            foreach ($odetails as $od) {
                $gtotal  =   $gtotal + ($od->price * $od->amount);
            }
            $value->grandtotal   =  $gtotal + $value->shippingfee;
        }


        $data['result'] = $orderlist;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getorderpaid()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $custid = $post['custid'];
        // $custid = 8;
        $orderlist  = $this->get->orderdisplaylist('2,3', $custid, 0)->result();
        foreach ($orderlist as   $value) {
            $gtotal = 0;
            $odetails = $this->get->orderdetail(array('orderid' => $value->id))->result();
            $value->orderdetails =  $odetails;

            foreach ($odetails as $od) {
                $gtotal  =   $gtotal + ($od->price * $od->amount);
            }
            $value->grandtotal   =  $gtotal + $value->shippingfee;
        }


        $data['result'] = $orderlist;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }



    public function gethistory()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $custid = $post['custid'];
        // $custid = 8;
        $orderlist  = $this->get->orderhistory($custid)->result();
        foreach ($orderlist as   $value) {
            $gtotal = 0;
            $odetails = $this->get->orderdetail(array('orderid' => $value->id))->result();
            $value->orderdetails =  $odetails;

            foreach ($odetails as $od) {
                $gtotal  =   $gtotal + ($od->price * $od->amount);
            }
            $value->grandtotal   =  $gtotal + $value->shippingfee;
        }


        $data['result'] = $orderlist;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }



    public function getorderreview()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $custid = $post['custid'];
        // $custid = 8;
        $orderlist  = $this->get->orderreviewlist('2,3', $custid, 1)->result();
        foreach ($orderlist as   $value) {
            $gtotal = 0;
            $review = $this->get->v_review(array('orderid' => $value->id))->result();
            $notin = array();
            foreach ($review as  $row) {
                array_push($notin, $row->itemid);
            }
            $odetails = $this->get->orderdetail(array('orderid' => $value->id), $notin)->result();

            $value->orderdetails =  $odetails;
            $value->review =  $notin;

            foreach ($odetails as $od) {
                $gtotal  =   $gtotal + ($od->price * $od->amount);
            }
            $value->grandtotal   =  $gtotal + $value->shippingfee;
        }


        $data['result'] = $orderlist;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function getcatebyParentId()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        $cond = array('status	' => '1', 'parentid' => $id);
        $data['result'] = $this->get->category($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getshippingrate()
    {
        header("Content-Type: application/json");
        // $merchantid = $post['merchantid'];
        $post = json_decode(file_get_contents('php://input'), true);
        $merchantid = $post['merchantid'];
        $unit = $post['unit'];

        $data['result'] = $this->get->shippingrate($merchantid, $unit)->row();


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function gettumbol()
    {
        // $aumpureid = $post['aumpureid'];
        $post = json_decode(file_get_contents('php://input'), true);
        $aumpureid = $post['aumpureid'];
        $cond = array('SUBSTR(code,1,4)' => substr($aumpureid, 0, 4));

        $data['result'] = $this->get->subdistrict($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function submitorder()
    {
        $post = json_decode(file_get_contents('php://input'), true);

        $itemselected = $post['itemselected'];
        $total = $post['total'];
        $paymenttype = $post['paymenttype'];
        $orderid = $post['orderid'];
        $shipingrate = $post['shipingrate'];
        $ordertoken = $post['ordertoken'];
        $shippingdiscount = $post['shippingdiscount'];
        $pricediscount = $post['pricediscount'];
        $mnbillstatus = $post['mnbillstatus'];

        //update order
        $input = array(
            'id' => $orderid,
            'total' => $total,
            'shipingrate' => $shipingrate,
            'paymentmethodid' => $paymenttype,
            'shippingdiscount' => $shippingdiscount,
            'pricediscount' => $pricediscount,
            'mnbillstatus' => $mnbillstatus,
            'submitdate' => date('Y-m-d H:i:s'),
            'updatedate' => date('Y-m-d H:i:s'),
        );
        $this->set->order($input);
        $orderitem = explode(";", $itemselected);
        foreach ($orderitem as $value) {
            $item = explode(",", $value);
            $input = array(
                'orderid' => $orderid,
                'itemid' => $item[0],
                'amount' => $item[1],
                'price' => $item[2],
            );
            $cond = array('orderid' => $input['orderid'], 'itemid' => $input['itemid']);
            if ($this->get->orderdetail($cond)->num_rows() == 0) {
                $this->put->orderdetail($input);
            } else {
                $this->set->orderdetail($input);
            }
        }
        $data['result'] = true;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function createorder()
    {

        $post = json_decode(file_get_contents('php://input'), true);

        $cartItems =  $post['cartItems'];
        $merchantlist =  $post['merchantlist'];
        $userid =  $post['userid'];

        foreach ($merchantlist as $merchant) {

            $orderno = date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);

            $unit = 0;
            $gtotal = 0;
            foreach ($cartItems as $item) {
                $price =  $item['discount'] != "" ? $item['discount']  :  $item['price'];
                $unit = $unit + intval($item['qty']);
                $gtotal  =   $gtotal + ($price * $item["qty"]);
            }

            $shippingfee = $this->get->shippingrate($merchant['id'], $unit)->row();
            $gtotal   =  $gtotal + (isset($shippingfee) ? $shippingfee->price : 0);
            $customer = $this->get->customer(array('id' => $userid))->row();
            $total = 0;

            $input = array(
                'orderno' => $orderno,
                'merchantid' => $merchant['id'],
                'shippingfee' => isset($shippingfee) ? $shippingfee->price : 0,
                'status' => 1,
                'custid' => $userid,
                'total' => $gtotal,
                'shippingaddress' => $customer->fulladdress,
                'shippingtel' => $customer->tel,
                'createdate' => date('Y-m-d H:i:s'),
                'updatedate' => date('Y-m-d H:i:s'),
            );
            $orderid  = $this->put->order($input);

            foreach ($cartItems as $item) {
                if ($merchant['id'] == $item['merchantid']) {
                    $input = array(
                        'orderid' => $orderid,
                        'itemid' => $item['id'],
                        'image' => $item['image'],
                        'name' => $item['name'],
                        'amount' => $item['qty'],
                        'price' =>  $item['discount'] != "" ? $item['discount']  :  $item['price'],
                        'createdate' => date('Y-m-d H:i:s'),
                        'updatedate' => date('Y-m-d H:i:s'),
                    );
                    $cond = array('orderid' => $input['orderid'], 'itemid' => $input['itemid']);
                    if ($this->get->orderdetail($cond)->num_rows() == 0) {

                        $itemdetail = $this->get->items(array('id' => $item['id']))->row();
                        $inputstock = array(
                            'id' => $item['id'],
                            'stock' => intval($itemdetail->stock) - intval($item['qty']),
                            'updatedate' => date('Y-m-d H:i:s'),
                        );
                        $this->set->items($inputstock);
                        $this->put->orderdetail($input);
                    } else {
                        $this->set->orderdetail($input);
                    }
                }
            }
        }

        $this->Semail->sendinfo('คุณได้รับออเดอร์ กรุณาตรวจสอบที่ https://seller.pettogo.co/', $merchant['email'], "Pettogo.co - ยินดีด้วยคุณได้รับออเดอร์ กรุณาตรวจสอบ");
        // foreach ($cartItems as $value) {
        //     $item = explode(",", $value);
        //     $input = array(
        //         'orderid' => $orderid,
        //         'itemid' => $item[0],
        //         'amount' => $item[1],
        //         'price' => $item[2],
        //     );
        //     $cond = array('orderid' => $input['orderid'], 'itemid' => $input['itemid']);
        //     if ($this->get->orderdetail($cond)->num_rows() == 0) {
        //         $this->put->orderdetail($input);
        //     } else {
        //         $this->set->orderdetail($input);
        //     }
        // }

        //update order
        // $input = array(
        //     'id' => $orderid,
        //     'total' => $total,
        //     'shipingrate' => $shipingrate,
        //     'paymentmethodid' => $paymenttype,
        //     'shippingdiscount' => $shippingdiscount,
        //     'pricediscount' => $pricediscount,
        //     'mnbillstatus' => $mnbillstatus,
        //     'submitdate' => date('Y-m-d H:i:s'),
        //     'updatedate' => date('Y-m-d H:i:s'),
        // );
        // $this->set->order($input);
        // $orderitem = explode(";", $itemselected);
        // foreach ($orderitem as $value) {
        //     $item = explode(",", $value);
        //     $input = array(
        //         'orderid' => $orderid,
        //         'itemid' => $item[0],
        //         'amount' => $item[1],
        //         'price' => $item[2],
        //     );
        //     $cond = array('orderid' => $input['orderid'], 'itemid' => $input['itemid']);
        //     if ($this->get->orderdetail($cond)->num_rows() == 0) {
        //         $this->put->orderdetail($input);
        //     } else {
        //         $this->set->orderdetail($input);
        //     }
        // }
        $data['result'] =  true;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function submitauction()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $auctionprice = $post['auctionprice'];
        $auctionid = $post['auctionid'];
        $custid = $post['custid'];
        if ($auctionid != 0) {
            $input = array(
                'price' => intval($auctionprice),
                'custid' => intval($custid),
                'auctionid' => intval($auctionid),
            );
            $data['result'] = false;
            if ($this->put->auctiontransaction($input)) {
                $data['result'] = true;
            }
            $this->output->set_header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        }
    }


    public function setcustomeraddress()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $fulladdress = $post['fulladdress'];
        $tel = $post['tel'];
        $custid = $post['custid'];
        $input = array(
            'id' => $custid,
            'fulladdress' => $fulladdress,
            'tel' => $tel,
            'updatedate' => date('Y-m-d H:i:s'),
        );
        $data['result'] = false;
        if ($this->set->customer($input)) {
            $data['result'] = true;
        }
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function addreview()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $custid = $post['custid'];
        $itemid = $post['itemid'];
        $orderid = $post['orderid'];
        $itemname = $post['itemname'];
        $rating = $post['rating'];
        $message = $post['message'];
        $pictures = $post['pictures'];


        $s_image = "";
        foreach ($pictures as $key => $pic) {
            // $image = $this->base64_to_jpeg(str_replace("data:image/jpeg;base64,", "", $pic));
            // $image = $this->base64_to_jpeg(str_replace("data:image/png;base64,", "", $pic)); 
            $image = $this->base64_to_jpeg($pic);
            $s_image .= base_url("public/upload/review/") . $image["upload_data"]["file_name"] . ",";
        }


        if ($itemid != 0) {
            $input = array(
                'itemid' =>  "$itemid",
                'orderid' => "$orderid",
                'message' => "$message",
                'pictures' => rtrim($s_image, ","),
                'star' => intval($rating),
                'reviewby' => "$custid",
                'createdate' => date('Y-m-d H:i:s'),
            );
            $data['result'] = false;
            if ($this->put->review($input)) {
                $data['result'] = true;
            }
            $this->output->set_header('Content-Type: application/json; charset=utf-8');
            echo json_encode($data);
        }
    }

    function base64_to_jpeg($data)
    {
        $temp_file_path = tempnam(sys_get_temp_dir(), 'tempimage'); // might not work on some systems, specify your temp path if system temp dir is not writeable
        file_put_contents($temp_file_path, file_get_contents($data));
        $image_info = getimagesize($temp_file_path);
        $_FILES['userfile'] = array(
            'name' => uniqid() . '.' . preg_replace('!\w+/!', '', $image_info['mime']),
            'tmp_name' => $temp_file_path,
            'size' => filesize($temp_file_path),
            'error' => UPLOAD_ERR_OK,
            'type' => 'jpg',
        );

        $config['upload_path'] = 'public/upload/review/';
        if (!is_dir($config['upload_path'])) {
            mkdir("public/upload/review", 0777);
        }

        $config['allowed_types'] = '*';
        $config['max_size'] = '0';
        $config['max_width'] = '0';
        $config['max_height'] = '0';
        $config['overwrite'] = FALSE;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;

        $this->upload->initialize($config);


        if (!$this->upload->do_upload('userfile', true)) {
            print_r($this->upload->display_errors());
        } else {
            return array('upload_data' => $this->upload->data());
        }
    }

    public function confirmdeliver()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $id = $post['id'];
        // $grandtotal = $post['grandtotal']; 
        $input = array(
            'id' => $id,
            'delivery_iscomplete' => 1,
            'updatedate' => date('Y-m-d H:i:s'),
        );
        $data['result'] = false;
        if ($this->set->order($input)) {
            $data['result'] = true;
        }
        //$this->lineapi->pushmsg($ordertoken->uid, "สถานะของคุณถูกเปลี่ยนแล้ว https://perdbill.co/track/$ordertoken->token");
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function confirmpayment()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $orderid = $post['orderid'];
        $custid = $post['custid'];
        $slipimg = $post['slipimg'];
        $paydate = $post['paydate'];
        $paytime = $post['paytime'];
        $payamount = $post['payamount'];
        $payacc = $post['payacc'];
        // $grandtotal = $post['grandtotal']; 
        $input = array(
            'id' => $orderid,
            'status' => 2,
            'paymentinfo' => $payacc,
            'payamount' => $payamount,
            'imgslip' => $slipimg,
            // 'custid' => $custid,
            'paydatetime' => date(($paydate . " " . $paytime)),
            'updatedate' => date('Y-m-d H:i:s'),
        );
        $data['result'] = false;
        if ($this->set->order($input)) {
            $data['result'] = true;
        }
        //$this->lineapi->pushmsg($ordertoken->uid, "สถานะของคุณถูกเปลี่ยนแล้ว https://perdbill.co/track/$ordertoken->token");
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function cancelpayment()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $orderid = $post['orderid'];
        $ordertoken = $this->get->ordertoken(array('orderid' => $orderid))->row();
        $input = array(
            'id' => $orderid,
            'closestatus' => 1,
            'updatedate' => date('Y-m-d H:i:s'),
        );
        $data['result'] = false;
        if ($this->set->order($input)) {
            $data['result'] = true;
        }
        //$this->lineapi->pushmsg($ordertoken->uid, "สถานะของคุณถูกเปลี่ยนแล้ว https://perdbill.co/track/$ordertoken->token");
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
}
