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
        $token = $this->common->getToken(10);
        $input = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password,
            'token' => $token,
            'createdate' => date('Y-m-d H:i:s')
        );

        $customer = $this->get->customer(array('email' => $email))->row();
    
        if(isset($customer)){ 
            $data['result'] = false;
        } 
        else{
            $data['result'] = $this->put->customer($input);
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

    function sendregisteremail($token, $firstname, $email)
    {
        $msg =  "สวัสดีคุณ $firstname<br/>
        คุณได้ทำการสมัครสมาชิก Pettogo.co เรียบร้อยแล้ว<br/>
        โปรดทำตามขั้นตอนเพื่อยืนยันตนของท่านดังนี้<br/>
        1.ทำการ Add Line : @232ruaun หรือ แสกน QR code<br/>
        2.จากนั้น copy ข้อความ 'ลงทะเบียน $token' ในช่องแชท<br/>
        3.เสร็จสิ้นขั้นตอนจะมีข้อความยืนยัน และรอระบบอนุมัติ<br/>
        ขอบคุณค่ะ";
        $this->Semail->sendinfo($msg, $email, 'ยืนยันการสมัครสมาชิก Pettogo.co');
    }

    public function customerlogin()
    {
        $post = json_decode(file_get_contents('php://input'), true); 
        $email = $post['email'];
        $password = $post['password'];
        $cond = array('email' => $email, 'password' => $password);
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
        $cond = array('id' => $id);
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
        // $packageid = $post['packageid'];
        $packageid = 3;
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
            <td style='vertical-align: middle;'>$row->manageuser</td>
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
        if ($packageid == 0) {
            $html .= "";
        } else {
            $html .= "<tr><td  colspan='9' style='vertical-align: middle;'><code>แพคเกจคุณเหลืออายุอีก $totaldays วัน</code></td></tr>";
        }

        echo  $html;
    }


    public function getauctionlist()
    {
        $cond = array('status' => 1);
        $data['result'] = $this->get->auctionlist($cond)->result();
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
        $cond = array('status' => 1);
        $data['result'] = $this->get->v_product($cond, $limit)->result();
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

        $data['result'] = $this->set->order($input, $itemarr);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function exportorderexcel()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $merchantid = $post['merchantid'];
        $status = $post['exportorderstatus'];
        if ($status != "0") {
            if ($status == "4") {
                $result = $this->get->orderexcel(array("merchantid" => $merchantid, "closestatus" => "1"), null, null);
            } else {
                $result = $this->get->orderexcel(array("merchantid" => $merchantid, "closestatus" => 0), null, array($status));
            }
        } else {
            $result = $this->get->orderexcel(array("merchantid" => $merchantid, "closestatus" => 0), null, null);
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
            $submitdate = date("d/M/Y H:i:s", strtotime($item->submitdate));
            $html .= "<tr>";
            $html .= "<td>";
            $html .= "<div class=\"checkbox checkbox-success checkbox-order \">";
            $html .= "<input id=\"orderid$item->id\" name=\"orderid\"  type=\"checkbox\" value=\"$item->id\">";
            $html .= "<label for=\"orderid$item->id\"> </label>";
            $html .= "</div>";
            $html .= "</td>";
            $html .= "<td><a class=\"badge badge-info \" target=\"_blank\" href=\"" . base_url($item->token) . "\">$item->token</a></td>";
            $html .= "<td> $submitdate</td>";
            // $html .= "<td>" . number_format($item->total) . "</td>";
            $html .= "<td>$item->paymentinfo</td>";
            $html .= "<td>$item->fullname</td>";
            $html .= "<td>$item->billingaddress</td>";
            $html .= "<td>$item->orderitems</td>";
            // $html .= "<td>$item->sumamount</td>";
            $html .= "<td>" . number_format($item->total) . "</td>";
            $html .= "<td>" . number_format($item->shipingrate) . "</td>";
            $html .= "<td>$statuslabel</td> ";
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
                    return " <div class=\"label label-table label-warning\">Waiting for confirm payment</div>";

                    break;
                case "2":
                    return " <div class=\"label label-table label-success\">Paid</div>";
                    break;
                case "3":
                    return " <div class=\"label label-table label-danger\">Shipped</div>";
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

    public function confirmpayment()
    {
        $post = json_decode(file_get_contents('php://input'), true);
        $orderid = $post['orderid'];
        $ordertoken = $this->get->ordertoken(array('orderid' => $orderid))->row();
        $input = array(
            'id' => $orderid,
            'status' => 2,
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
