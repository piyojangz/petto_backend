<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bill extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Insert_model', 'put');
        $this->load->model('Select_model', 'get');
        $this->load->model('Update_model', 'set');
        $this->load->library('upload');
        $this->load->library('common');
        $this->load->library('lineapi');
    }

    public function index($token = "") {
        $data["ordertoken"] = $token;
        $ordertoken = $this->get->ordertoken(array('token' => $token))->row();

        $uid = $ordertoken->uid;
        $merchantid = $ordertoken->merchantid;
        $orderid = $ordertoken->orderid;

        $data["obj"] = $this;
        $data["merchant"] = $this->get->merchant(array('id' => $merchantid))->row();
        $data["items"] = $this->get->items(array('merchantid' => $merchantid))->result();
        $data["order"] = $this->get->order(array('id' => $orderid))->row();
        $data["orderdetail"] = $this->get->orderdetail(array('orderid' => $orderid))->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $merchantid))->result();

        if ($data["order"]->status >= 1) {
            redirect(base_url("/track/$token"));
        }

        $this->load->view('template/bill', $data);
    }

    public function getamount($orderdetail, $itemid) {
        foreach ($orderdetail as $item) {
            if ($item->itemid == $itemid) {
                return $item->amount;
            }
        }

        return "";
    }

    public function verify() {

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

    public function replymsgtest() {





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

        print_r(json_encode($messages));

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

    public function replymsg() {

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
//

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

    public function splitparmtest() {
        $msg = "ลงทะเบียน:AbrH2JG210";
        $uid = "U7fbb7c7d7ba6f2642c0eb7026f8da615";

        $replymsg = "";

        $tokens = array();
        $merchantlineuid = $this->get->merchantlineuid(array('lineuid' => $uid))->result();
        print_r($merchantlineuid);
        foreach ($merchantlineuid as $item) {
            array_push($tokens, $item->token);
        }
        print_r($tokens);
        $data["sqlmerchant"] = $this->get->merchantin($tokens);




        print_r($data["sqlmerchant"]->result());

        //$this->output->set_header('Content-Type: application/json; charset=utf-8');
        //echo json_encode($messages);
    }

    public function splitparm($event) {
        $msg = $event['message']['text'];
        $customtemplate = false;
        $billtoken = false;
        $messages = array();
        //ลงทะเบียน:shoptoken
        $msgqarr = preg_split("/,|:|\s/", $msg);
        $command = $msgqarr[0];
        if (isset($event['source']['userId'])) {
            $uid = $event['source']['userId'];
            $data["sqlmerchant"] = null;
            if (count($msgqarr) >= 2) {
                switch ($command) {
                    case "ลงทะเบียน":
                        if ($this->registermerchant($msgqarr[1], $uid)) {
                            $replymsg = "คุณได้ลงทะเบียนร้านค้าเพื่อรับการแจ้งเตือนเรียบร้อยแล้ว";
                        } else {
                            $replymsg = "เราไม่พบร้านค้าของคุณ";
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

                    default:
                        $replymsg = "ขออภัย เราไม่ทราบคำขอของคุณ";
                        break;
                }
            } else {
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
                            //$billtoken = $this->generatebilltoken($data["sqlmerchant"]->row());
                            $customtemplate = true;
                        } else {
                            $replymsg = "คุณยังไม่เคยลงทะเบียนกับเรา";
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
                if (count($merchants) > 0) {
                    if (count($merchants) == 1) {
                        foreach ($merchants as $item) {
                            $messages = array(
                                'type' => 'template',
                                "altText" => "ร้านค้า $item->name ได้ส่งข้อมูลการสั่งซื้อสินค้าให้คุณ",
                                "template" => array(
                                    "type" => "buttons",
                                    "thumbnailImageUrl" => "$item->image",
                                    "title" => "ร้านค้า : $item->name",
                                    "text" => "$item->description",
                                    'actions' => array(
                                        array(
                                            "type" => "postback",
                                            "label" => "รับลิงค์สำหรับลูกค้า",
                                            "data" => "getbilltoken|$item->id"
                                        )
                                    )
                                )
                            );
                        }
                    } else {
                        foreach ($merchants as $item) {
                            array_push($colums, array(
                                "thumbnailImageUrl" => "$item->image",
                                "title" => "ร้านค้า : $item->name",
                                "text" => "$item->description",
                                'actions' => array(array(
                                        "type" => "postback",
                                        "label" => "รับลิงค์สำหรับลูกค้า",
                                        "data" => "getbilltoken|$item->id"
                                    )
                                )
                            ));
                        }
                        $messages = array(
                            'type' => 'template',
                            "altText" => "ร้านค้า $merchant->name ได้ส่งข้อมูลการสั่งซื้อสินค้าให้คุณ",
                            "template" => array(
                                "type" => "carousel",
                                "columns" => $colums
                            )
                        );
                    }
                } else {
                    $replymsg = "คุณยังไม่เคยลงทะเบียนกับเรา";
                }
            } else {
                $messages = [
                    'type' => 'text',
                    'text' => $replymsg
                ];
            }





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

    public function getmessagepostback($postbackdata) {
        $msg = explode("|", $postbackdata);
        if ($msg[0] == "getbilltoken") {
            $data["sqlmerchant"] = $this->get->merchant(array('id' => $msg[1]));
            if ($data["sqlmerchant"]->num_rows() > 0) {
                $billtoken = $this->generatebilltoken($data["sqlmerchant"]->row());
                return $messages = [
                    'type' => 'text',
                    'text' => "https://perdbill.co/$billtoken"
                ];
            }
        }
    }

    public function generatebilltoken($merchant) {
        $uniqid = $this->common->getToken(6);
        $input = array(
            'deliverycharge' => $merchant->deliverycharge,
        );
        $orderid = $this->put->order($input);
        $input = array(
            'orderid' => $orderid,
            'merchantid' => $merchant->id,
            'token' => $uniqid,
        );

        if ($this->put->ordertoken($input)) {
            return $uniqid;
        }
        return false;
    }

    public function registermerchant($token, $uid) {
        $cond = array('token' => $token);
        $input = array(
            'token' => $token,
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
