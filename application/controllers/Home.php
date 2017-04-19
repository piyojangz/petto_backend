<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Insert_model', 'put');
        $this->load->model('Select_model', 'get');
        $this->load->model('Update_model', 'set');
        $this->load->library('upload');
        $this->load->library('common');
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
                    $text = $this->splitparm($event);
                    // Get replyToken
                    $replyToken = $event['replyToken'];

                    // Build message to reply back
                    $messages = [
                        'type' => 'text',
                        'text' => $text
                    ];

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
            }
        }
        //echo "OK";
    }

    public function splitparmtest() {
        $msg = "ลงทะเบียน:AbrH2JG210";
        $uid = "U7fbb7c7d7ba6f2642c0eb7026f8da615";


//        $msgqarr = explode(":", $msg);
//        $command = $msgqarr[0];
//        switch ($command) {
//            case "ลงทะเบียน":
//                break;
//            case "สั่งซื้อ":
//                break;
//
//            default:
//                break;
//        }
//        print_r(count($msgqarr));
//        print_r($command);

        $sql = $this->get->merchant(array('name' => "Rochubeauty"));
        if ($sql->num_rows() > 0) {
            $billtoken = $this->generatebilltoken($sql->row(), $uid);
            if ($billtoken) {
                $replymsg = "ลูกค้าสามารถซื้อสินค้าได้ที่ลิงค์นี้ https://www.servewellsolution.com/socialbill/$billtoken";
            } else {
                $replymsg = "เราไม่พบร้านค้าที่คุณสั่งซื้อ";
            }
        }

        print_r($replymsg);
    }

    public function splitparm($event) {
        $msg = $event['message']['text'];
        $uid = $event['source']['userId'];
        //ลงทะเบียน:shoptoken
        $msgqarr = preg_split("/,|:|\s/", $msg);
        $command = $msgqarr[0];

        if (count($msgqarr) >= 2) {
            switch ($command) {
                case "ลงทะเบียน":
                    if ($this->registermerchant($msgqarr[1], $uid)) {
                        $replymsg = "คุณได้ลงทะเบียนร้านค้าเพื่อรับการแจ้งเตือนเรียบร้อยแล้ว";
                    } else {
                        $replymsg = "เราไม่พบร้านค้าของคุณ";
                    }

                    break;
                case "สั่งซื้อ":
                    $sql = $this->get->merchant(array('name' => $msgqarr[1]));
                    if ($sql->num_rows() > 0) {
                        $billtoken = $this->generatebilltoken($sql->row(), $uid);
                        if ($billtoken) {
                            $replymsg = "ลูกค้าสามารถซื้อสินค้าได้ที่ลิงค์นี้ https://www.servewellsolution.com/socialbill/$billtoken";
                        } else {
                            $replymsg = "เราไม่พบร้านค้าที่คุณสั่งซื้อ";
                        }
                    } else {
                        $replymsg = "เราไม่พบร้านค้าที่คุณสั่งซื้อ";
                    }
                    break;

                default:
                    $replymsg = "ขออภัย เราไม่ทราบคำขอของคุณ";
                    break;
            }
        } else {
            $replymsg = "";
        }


        //$this->pushmsg($uid, $replymsg);
        return $replymsg;
    }

    public function generatebilltoken($merchant, $uid) {
        $uniqid = $this->common->getToken(6);
        $input = array(
            'deliverycharge' => $merchant->deliverycharge,
        );
        $orderid = $this->put->order($input);
        $input = array(
            'orderid' => $orderid,
            'merchantid' => $merchant->id,
            'uid' => $uid,
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
        }
        else{
             return true;
        }

        return false;
    }

    public function pushmsg($userid, $msg) {
        $strAccessToken = LINETOKEN;
        $strUrl = "https://api.line.me/v2/bot/message/push";

        $arrHeader = array();
        $arrHeader[] = "Content-Type: application/json";
        $arrHeader[] = "Authorization: Bearer {$strAccessToken}";

        $arrPostData = array();
        $arrPostData['to'] = $userid;
        $arrPostData['messages'][0]['type'] = "text";
        $arrPostData['messages'][0]['text'] = $msg;


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrHeader);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        print_r($result);
        curl_close($ch);
    }

}
