<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bill extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Insert_model', 'put');
        $this->load->model('Select_model', 'get');
        $this->load->model('Update_model', 'set');
        $this->load->library('upload');
        $this->load->library('common');
        $this->load->library('lineapi');
    }

    public function index($token = "")
    {
        $data["ordertoken"] = $token;
        $data["billtoken"] = "";
        $billtoken = $this->get->billtoken(array('token' => $token))->row();
        if (count($billtoken) > 0) {
            $merchantid = $billtoken->merchantid;
            $data["sqlmerchant"] = $this->get->merchant(array('id' => $merchantid));
            if ($data["sqlmerchant"]->num_rows() > 0) {
                //$billtoken = $this->generatebilltoken($data["sqlmerchant"]->row(), $billtoken->uid); // ifsubmit
                //redirect(base_url("$token"));


                $data["obj"] = $this;
                $data["merchant"] = $this->get->merchant(array('id' => $merchantid))->row();
                $data["province"] = $this->get->province(array())->result();
                $data["items"] = $this->get->items(array('merchantid' => $merchantid, 'status' => 1))->result();
                $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $merchantid))->result();
                $this->load->view('template/merchantbill', $data);
                return;
            }
        }

        $ordertoken = $this->get->ordertoken(array('token' => $token))->row();
        if ($ordertoken == null) {
            redirect(base_url());
        }
        $data["uid"] = $ordertoken->uid;
        $merchantid = $ordertoken->merchantid;
        $orderid = $ordertoken->orderid;

        $data["obj"] = $this;
        $data["genstatus"] = $ordertoken->genstatus;
        $data["merchant"] = $this->get->merchant(array('id' => $merchantid))->row();
        $data["items"] = $this->get->items(array('merchantid' => $merchantid, 'status' => 1))->result();
        $data["order"] = $this->get->order(array('id' => $orderid))->row();
        $data["orderdetail"] = $this->get->orderdetail(array('orderid' => $orderid))->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $merchantid))->result();

        if ($data["order"]->status >= 1) {
            redirect(base_url("/track/$token"));
        }

        if ($data["order"]->mnbillstatus >= 1) {
            redirect(base_url("/shipinginfo/$token"));
        }

        $this->load->view('template/bill', $data);
    }

    public function pro($merchanttoken = "", $uid = "")
    {

        $data["genstatus"] = 1;
        $data["billtoken"] = "";
        $data["uid"] = $uid;
        $merchant = $this->get->merchant(array('token' => $merchanttoken))->row();


        $data["obj"] = $this;
        $data["merchant"] = $this->get->merchant(array('id' => $merchant->id))->row();
        $data["items"] = $this->get->items(array('merchantid' =>  $merchant->id, 'status' => 1))->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' =>  $merchant->id))->result();


        $this->load->view('template/promobill', $data);
    }

    public function getamount($orderdetail, $itemid)
    {
        foreach ($orderdetail as $item) {
            if ($item->itemid == $itemid) {
                return $item->amount;
            }
        }

        return "";
    }

    public function verify()
    {

        $url = 'https://api.line.me/v1/oauth/verify';

        $headers = array('Authorization: Bearer ' . LINETOKEN);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        echo $result;
    }

    public function replymsgtest()
    {


        $messages = array(
            'type' => 'template',
            "altText" => "this is a confirm template",
            "template" => array(
                "type" => "confirm",
                "text" => "Are you sure?",
                'actions' => array(
                    array(
                        "type" => "message",
                        "label" => "Yes",
                        "text" => "Yes"
                    ),
                    array(
                        "type" => "message",
                        "label" => "No",
                        "text" => "No"
                    )
                )
            )
        );

        //print_r(json_encode($messages));
        // Make a POST Request to Messaging API to reply to sender
        $url = 'https://api.line.me/v2/bot/message/reply';
        $data = [
            'replyToken' => "07b790a5833d4b558dbe9fcc6e3552b8",
            'messages' => [$messages],
        ];
        $post = json_encode($data);
        $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . LINETOKEN);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);

        echo $result . "\r\n";
    }

    public function replymsg()
    {

        // Get POST body content
        $content = file_get_contents('php://input');
// Parse JSON
        $events = json_decode($content, true);
// Validate parsed JSON data
        if (!is_null($events['events'])) {
            // Loop through each event
            foreach ($events['events'] as $event) {
                // Reply only when message sent is in 'text' format
                if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
                    // Get text sent
                    $messages = $this->splitparm($event);
                    // Get replyToken
                    $replyToken = $event['replyToken'];
                }

                if ($messages != false) {
                    // Make a POST Request to Messaging API to reply to sender
                    $url = 'https://api.line.me/v2/bot/message/reply';
                    $data = [
                        'replyToken' => $replyToken,
                        'messages' => [$messages],
                    ];
                    $post = json_encode($data);
                    $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . LINETOKEN);

                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    $result = curl_exec($ch);
                    curl_close($ch);

                    echo $result . "\r\n";
                }

                if (isset($event['postback'])) {
                    $replyToken = $event['replyToken'];
                    $url = 'https://api.line.me/v2/bot/message/reply';
                    $postbackdata = $event['postback']['data'];
                    $messages = $this->getmessagepostback($postbackdata);

//                    $messages = [
//                        'type' => 'text',
//                        'text' => $postbackdata
//                    ];


                    $data = [
                        'replyToken' => $replyToken,
                        'messages' => [$messages],
                    ];
                    $post = json_encode($data);
                    $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . LINETOKEN);

                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    $result = curl_exec($ch);
                    curl_close($ch);

                    echo $result . "\r\n";
                }
            }
        }

        echo "OK";
    }

    public function splitparmtest()
    {
        $msg = "ลงทะเบียน:AbrH2JG210";
        $uid = "U7fbb7c7d7ba6f2642c0eb7026f8da615";


        $tokens = array();
        $merchantlineuid = $this->get->merchantlineuid(array('lineuid' => $uid))->result();
        foreach ($merchantlineuid as $item) {
            array_push($tokens, $item->token);
        }
        $data["sqlmerchant"] = $this->get->merchantin($tokens);
        print_r($data["sqlmerchant"]);
//        $data["sqlmerchant"] = $this->get->v_serchorderbytelandmerchantuid("0863647397", $uid);
//        print_r($data["sqlmerchant"]->result());
//
//        $replymsg = "";
//
//        $tokens = array();
//        $merchantlineuid = $this->get->merchantlineuid(array('lineuid' => $uid))->result();
//        print_r($merchantlineuid);
//        foreach ($merchantlineuid as $item) {
//            array_push($tokens, $item->token);
//        }
//        print_r($tokens);
//        $data["sqlmerchant"] = $this->get->merchantin($tokens);
//
//
//
//
//        print_r($data["sqlmerchant"]->result());
        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($messages);
    }

    public function splitparm($event = "")
    {
        $msg = $event['message']['text'];

//        $msg = "เปิดโปร";
//        $event['source']['userId'] = "U7fbb7c7d7ba6f2642c0eb7026f8da615";

        $customtemplate = false;
        $customtemplatepromo = false;
        $billtoken = false;
        $messages = array();
        $msgqarr = preg_split("/,|:|\s/", $msg);
        $command = $msgqarr[0];


        if (isset($event['source']['userId'])) {
            $uid = $event['source']['userId'];
            $data["sqlmerchant"] = null;
            if (count($msgqarr) >= 2) {
                switch ($command) {
                    case "ลงทะเบียน":
                        if (count($msgqarr) >= 3) {
                            if ($this->registermerchant($msgqarr[1], $msgqarr[2], $uid)) {
                                $replymsg = "คุณได้ลงทะเบียนร้านค้าเพื่อรับการแจ้งเตือนเรียบร้อยแล้ว";
                            } else {
                                $replymsg = "เราไม่พบร้านค้าของคุณ";
                            }
                        } else {
                            $replymsg = "กรุณาระบุชื่อของท่านด้วยเช่น 'ลงทะเบียน perdbill เจ้าของร้าน'";
                        }

                        break;
//                    case "สั่งซื้อ":
//                        $sql = $this->get->merchant(array('name' => $msgqarr[1]));
//                        if ($sql->num_rows() > 0) {
//                            $billtoken = $this->generatebilltoken($sql->row());
//                            if ($billtoken) {
//                                $customtemplate = true;
//                            } else {
//                                $replymsg = "เราไม่พบร้านค้าที่คุณสั่งซื้อ";
//                            }
//                        } else {
//                            $replymsg = "เราไม่พบร้านค้าที่คุณสั่งซื้อ";
//                        }
//                        break;

                    case "สามารถสร้างบิลเพิ่มได้ที่":

                        break;
                    case "ค้นหาได้ด้วยการพิมพ์เบอร์โทรเช่น":

                        break;
                    default:
                        $replymsg = "ขออภัย เราไม่ทราบคำขอของคุณ";
                        break;
                }
            } else {

                $telno = $command;
                $registertoken = "";
                if (preg_match('/^[0-9]{9,10}$/', trim($command))) {
                    $command = "ค้นหา";
                }
                if (substr($command, 0, 5) == "Regis") {
                    $registertoken = $command;
                    $command = "ลงทะเบียน";
                }


                switch ($command) {
                    case "เปิดบิล":
                        // get all merchant $uid
                        $tokens = array();
                        $merchantlineuid = $this->get->merchantlineuid(array('lineuid' => $uid))->result();
                        foreach ($merchantlineuid as $item) {
                            array_push($tokens, $item->token);
                        }
                        $data["sqlmerchant"] = $this->get->merchantin($tokens);
                        if ($data["sqlmerchant"]->num_rows() > 0) {
                            //$billtoken = $this->generatebilltoken($data["sqlmerchant"]->row(), $uid);
                            $customtemplate = true;
                        } else {
                            $replymsg = "คุณยังไม่เคยลงทะเบียนกับเรา" . $tokens;
                        }

                        break;
                    case "เปิดโปร":
                        // get all merchant $uid
                        $tokens = array();
                        $merchantlineuid = $this->get->merchantlineuid(array('lineuid' => $uid))->result();
                        foreach ($merchantlineuid as $item) {
                            array_push($tokens, $item->token);
                        }
                        $data["sqlmerchant"] = $this->get->merchantin($tokens);
                        if ($data["sqlmerchant"]->num_rows() > 0) {
                            // $billtoken = $this->generatebilltoken($data["sqlmerchant"]->row(), $uid);
                            $customtemplatepromo = true;
                        } else {
                            $replymsg = "คุณยังไม่เคยลงทะเบียนกับเรา" . $tokens;
                        }
                        break;
                    case "ค้นหา":
                        $msg = "";
                        $orderhistory = $this->get->v_serchorderbytelandmerchantuid($telno, $uid)->result();
                        $msg = "ไม่พบรายการสั่งซื้อ";
                        if (count($orderhistory) > 0) {
                            $msg = "รายการสั่งซื้อล่าสุด\n";
                            $no = 1;
                            foreach ($orderhistory as $index => $item) {
                                $paidtime = date("d/m/Y ,เวลา H:i:s", strtotime($item->paiddate));
                                $msg .= "$no. https://perdbill.co/$item->token \n    $paidtime\n";
                                $no++;
                            }
                        }

                        return $messages = [
                            'type' => 'text',
                            'text' => $msg
                        ];
                        break;
                    case "ลงทะเบียน":
                        $input = array(
                            'invitetoken' => $registertoken,
                            'lineuid' => $uid,
                            'updatedate' => date('Y-m-d H:i:s'),
                        );
                        if ($this->set->merchantlineuidbyinvitetoken($input)) {
                            $replymsg = "คุณได้ลงทะเบียนร้านค้าเพื่อรับการแจ้งเตือนเรียบร้อยแล้ว";
                        }

                        break;
                    default:
                        $replymsg = "ขออภัย เราไม่ทราบคำขอของคุณ";
                        break;
                }
            }

            if ($customtemplate) {
                $merchants = $data["sqlmerchant"]->result();
                $colums = array();
                $billcolums = array();
                if (count($merchants) > 0) {
                    if (count($merchants) == 1) {
                        foreach ($merchants as $item) {
                            $merchantbills = $this->get->billtoken(array("merchantid" => $item->id, "status" => 1), 3)->result();
                            foreach ($merchantbills as $billitem) {
                                array_push($billcolums, array("type" => "postback",
                                    "label" => "$billitem->name",
                                    "data" => "getbilltokennogen|$billitem->id|$uid"));
                            }

                            $description = $item->description == '' ? '-' : $item->description;
                            $messages = array(
                                'type' => 'template',
                                "altText" => "ร้านค้าได้ส่งข้อมูลการสั่งซื้อสินค้าให้คุณ",
                                "template" => array(
                                    "type" => "buttons",
                                    "thumbnailImageUrl" => "$item->image",
                                    "title" => "ร้านค้า : $item->name",
                                    "text" => "***แสดง 3 บิลล่าสุด เพิ่มเติมดูที่ Admin panel***",
                                    'actions' => $billcolums
                                )
                            );

                            //  print_r($messages);
                        }
                    } else {

//                        foreach ($merchants as $item) {
//                            $description = $item->description == '' ? '-' : $item->description;
//                            array_push($colums, array(
//                                "thumbnailImageUrl" => "$item->image",
//                                "title" => "ร้านค้า : $item->name",
//                                "text" => "$description",
//                                'actions' => array(
//                                    array(
//                                        "type" => "postback",
//                                        "label" => "- รับลิงค์สำหรับร้านค้า -",
//                                        "data" => "getbilltokenformerchant|$item->id|$uid"
//                                    ),
//                                    array(
//                                        "type" => "postback",
//                                        "label" => "- รับลิงค์สำหรับลูกค้า -",
//                                        "data" => "getbilltoken|$item->id|$uid"
//                                    )
//                                )
//                            ));
//                        }
//                        $messages = array(
//                            'type' => 'template',
//                            "altText" => "คุณได้รับข้อมูลการสั่งซื้อสินค้า",
//                            "template" => array(
//                                "type" => "carousel",
//                                "columns" => $colums
//                            )
//                        );

                        foreach ($merchants as $item) {
                            $billcolums = array();

                            $merchantbills = $this->get->billtoken(array("merchantid" => $item->id, "status" => 1), 3)->result();
                            foreach ($merchantbills as $billitem) {
                                array_push($billcolums, array("type" => "postback",
                                    "label" => "$billitem->name",
                                    "data" => "getbilltokennogen|$billitem->id|$uid"));
                            }
                            for ($i = count($billcolums); $i < 3; $i++) {
                                array_push($billcolums, array("type" => "message",
                                    "label" => "-",
                                    "text" => "สามารถสร้างบิลเพิ่มได้ที่ https://perdbill.co/account/$item->token/dashboard"));
                            }


                            $description = $item->description == '' ? '-' : $item->description;
                            array_push($colums, array(
                                "thumbnailImageUrl" => "$item->image",
                                "title" => "ร้านค้า : $item->name",
                                "text" => "***แสดง 3 บิลล่าสุด เพิ่มเติมดูที่ Admin panel***",
                                'actions' => $billcolums
                            ));


                        }
                        //print_r($colums);
                        $messages = array(
                            'type' => 'template',
                            "altText" => "คุณได้รับข้อมูลการสั่งซื้อสินค้า",
                            "template" => array(
                                "type" => "carousel",
                                "columns" => $colums
                            )
                        );

                    }
                } else {
                    $replymsg = "คุณยังไม่เคยลงทะเบียนกับเรา";
                }
            } else if ($customtemplatepromo) {
                $merchants = $data["sqlmerchant"]->result();
                $colums = array();
                if (count($merchants) > 0) {


                    foreach ($merchants as $item) {
                        $billcolums = array();

                        $description = $item->description == '' ? '-' : $item->description;


                        array_push($colums, array(
                            "thumbnailImageUrl" => "$item->image",
                            "title" => "ร้านค้า : $item->name",
                            "text" => $description,
                            'actions' => array(
                                array(
                                    "type" => "uri",
                                    "label" => "กรอกข้อมูลสำรับรับลิงค์",
                                    "uri" => "https://perdbill.co/pro/$item->token/$uid"
                                )
                            )
                        ));
                    }

                    $messages = array(
                        'type' => 'template',
                        "altText" => "คุณได้รับข้อมูลการสั่งซื้อสินค้า",
                        "template" => array(
                            "type" => "carousel",
                            "columns" => $colums
                        )
                    );

                } else {
                    $replymsg = "คุณยังไม่เคยลงทะเบียนกับเรา";
                }
            } else {
                $messages = [
                    'type' => 'text',
                    'text' => $replymsg
                ];
            }

            //  print_r($messages);
            return $messages;
        } else {
            if (count($msgqarr) >= 2) {
                switch ($command) {
                    case "บิล":
                        $merchant = $this->get->merchant(array('name' => $msgqarr[1]))->row();
                        $replymsg = "ลูกค้าสามารถซื้อสินค้าได้ที่ลิงค์นี้ https://perdbill.co/$merchant->token";
                        break;
                    default:
                        return false;
                        break;
                }
                $messages = array(
                    'type' => 'template',
                    "altText" => "this is a buttons template",
                    "template" => array(
                        "type" => "buttons",
                        "thumbnailImageUrl" => "https://www.rochubeauty.com/public/uploads/84859jiu9256359glpuyi23444363.jpg",
                        "title" => "วิธีการสั่งสินค้าของร้าน $merchant->name",
                        "text" => "กรุณาทำตามวิธีด้านล่างครับ/ค่ะ",
                        'actions' => array(
                            array(
                                "type" => "uri",
                                "label" => "1.เพิ่มเพื่อน Perdbill",
                                "uri" => "https://line.me/R/ti/p/%40hkw0659s"
                            ),
                            array(
                                "type" => "message",
                                "label" => "2.คลิกเพื่อทำตามด้านล่าง",
                                "text" => "พิมพ์ข้อความ \"สั่งซื้อ $merchant->name\" \n "
                                    . "- ส่งไปที่ Line Perdbill \n "
                                    . "- จากนั้นทำตามขั้นตอนการสั่งซื้อ \n "
                                    . "- ขอบคุณครับ/ค่ะ"
                            )
                        )
                    )
                );
                return $messages;
            }
        }
        return false;
    }

    public function getmessagepostback($postbackdata)
    {
        $msg = explode("|", $postbackdata);
        if ($msg[0] == "getbilltoken") {
            $data["sqlmerchant"] = $this->get->merchant(array('id' => $msg[1]));
            if ($data["sqlmerchant"]->num_rows() > 0) {
                $billtoken = $this->generatebilltoken($data["sqlmerchant"]->row(), $msg[2]);
                return $messages = [
                    'type' => 'text',
                    'text' => "https://perdbill.co/$billtoken"
                ];
            }
        }
        if ($msg[0] == "getbilltokenformerchant") {
            $data["sqlmerchant"] = $this->get->merchant(array('id' => $msg[1]));
            if ($data["sqlmerchant"]->num_rows() > 0) {
                $billtoken = $this->getbilltokenformerchant($data["sqlmerchant"]->row(), $msg[2]);
                return $messages = [
                    'type' => 'text',
                    'text' => "https://perdbill.co/$billtoken"
                ];
            }
        }
        if ($msg[0] == "getbilltokennogen") {

            $billtoken = $this->get->billtoken(array("id" => $msg[1]))->row();
            return $messages = [
                'type' => 'text',
                'text' => "https://perdbill.co/$billtoken->token"
            ];

        }
    }

    public function generatebilltoken($merchant, $merchantuid)
    {
        $uniqid = $this->common->getToken(6);
        $cond = array('token' => $uniqid);
        if ($this->get->ordertoken($cond)->num_rows() > 0) {
            return $this->generatebilltoken($merchant);
        }
        $input = array(
            'merchantid' => $merchant->id,
            'shipingrate' => 0,
        );
        $orderid = $this->put->order($input);
        $input = array(
            'orderid' => $orderid,
            'merchantid' => $merchant->id,
            'token' => $uniqid,
            'uid' => $merchantuid,
            'genstatus' => 0
        );

        if ($this->put->ordertoken($input)) {
            return $uniqid;
        }
        return $uniqid;
    }

    public function getbilltokenformerchant($merchant, $merchantuid)
    {
        $uniqid = $this->common->getToken(6);
        $input = array(
            'shipingrate' => 0,
        );
        $orderid = $this->put->order($input);
        $input = array(
            'orderid' => $orderid,
            'merchantid' => $merchant->id,
            'token' => $uniqid,
            'uid' => $merchantuid,
            'genstatus' => 1
        );

        if ($this->put->ordertoken($input)) {
            return $uniqid;
        }
        return false;
    }

    public function registermerchant($token, $name, $uid)
    {
        $cond = array('token' => $token);
        $input = array(
            'token' => $token,
            'name' => $name,
            'lineuid' => $uid,
            'updatedate' => date('Y-m-d H:i:s'),
        );
        if ($this->get->merchant($cond)->num_rows() > 0) {
            $cond = array('token' => $token, 'lineuid' => $uid);
            if ($this->get->merchantlineuid($cond)->num_rows() == 0) {
                return $this->put->merchantlineuid($input);
            }
            return true;
        } else {
            return false;
        }

        return false;
    }

}
