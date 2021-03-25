<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Webhook extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Insert_model', 'put');
        $this->load->model('Select_model', 'get');
        $this->load->model('Update_model', 'set');
        $this->load->model('User_model', 'user');
        $this->load->library('upload');
        $this->load->library('lineapi');
        $this->load->library('excel');
        $this->load->library('common');
    }

    public function test(){
           // push message block
           $pushmessages = [];
           $pushmessages['to'] = 'U7fbb7c7d7ba6f2642c0eb7026f8da615';
           $pushmessages['messages'][0] = $this->getFormatTextMessage("Pushs Message [U7fbb7c7d7ba6f2642c0eb7026f8da615]");
           $encodeJson2 = json_encode($pushmessages);
           // push message block
   
           $results = $this->lineapi->pushMessage($encodeJson2);
    }

    public function testflex()
    {
        $messages['messages'][0] = $this->getFlex();
        $encodeJson = json_encode($messages);


        echo $encodeJson;
    }

    public function index()
    {
        //file_put_contents('log.txt', file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
        $datas = file_get_contents('php://input');
        $deCode = json_decode($datas, true);


        //
        $replyToken = $deCode['events'][0]['replyToken'];
        $userId  =  $deCode['events'][0]['source']["userId"]; // ใช้สำหรับตอบกลับ
        $text = $deCode['events'][0]['message']['text'];


        $strArr = explode(" ", $text);

        $isreplied = false;

        if (count($strArr) == 2) {
            if ($strArr[0] === 'ลงทะเบียน') {
                $isreplied = true;
                $this->updateUserVerifyLine($strArr[1], $replyToken, $userId);
            }
        } else {
            if ($text == "#ตะกร้าสินค้า") {
                $isreplied = true;
                $messages = [];
                $messages['replyToken'] = $replyToken;
                $messages['messages'][0] = $this->getFormatTextMessage("กำลังพัฒนาครับ");
                $encodeJson = json_encode($messages);
                $this->lineapi->replyMessage($encodeJson);
            }
            if ($text == "#รายการประมูล") { 
                $isreplied = true;
                $messages = [];
                $messages['replyToken'] = $replyToken;
                $messages['messages'][0] = $this->getFlex();
                $encodeJson = json_encode($messages);
                $this->lineapi->replyMessage($encodeJson);
            }
            if ($text == "#ติดต่อเจ้าหน้าที่") {
                $isreplied = true;
                $messages = [];
                $messages['replyToken'] = $replyToken;
                $messages['messages'][0] = $this->getFormatTextMessage("กำลังพัฒนาครับ");
                $encodeJson = json_encode($messages);
                $this->lineapi->replyMessage($encodeJson);
            }
        }

        if ($isreplied == false) {
            $messages = [];
            $messages['replyToken'] = $replyToken;
            $messages['messages'][0] = $this->getFormatTextMessage("Unknow command");
            $encodeJson = json_encode($messages);
            $this->lineapi->replyMessage($encodeJson);
        }



        //$this->unknow($userId, $replyToken, $text);

        http_response_code(200);
    }

    function updateUserVerifyLine($token, $replyToken, $userId)
    {
        $input = array(
            'token' => $token,
            'lineuserid' => $userId,
            'islineverify' => 1,
            'updatedate' => date('Y-m-d H:i:s'),
        );
        $result = false;

        $isverify =   $this->get->merchant(array('token' => $token, 'islineverify' => 1))->num_rows();
        $messages = [];
        $messages['replyToken'] = $replyToken;

        if ($isverify  == 0) {
            if ($this->set->merchant($input) > 0) {
                $result = true;
            }

            if ($result) {
                $messages['messages'][0] = $this->getFormatTextMessage("ยืนยันตนเรียบร้อย กรุณารอเจ้าหน้าที่ตรวจสอบข้อมูลสักครู่ค่ะ");
            } else {
                $messages['messages'][0] = $this->getFormatTextMessage("ไม่สามารถยืนยันข้อมูลได้ กรุณาติดต่อเจ้าหน้าที่");
            }
        } else {
            $messages['messages'][0] = $this->getFormatTextMessage("ท่านได้ยืนยันตนเรียบร้อยแล้ว กรุณารอเจ้าหน้าที่ตรวจสอบข้อมูลสักครู่ค่ะ");
        }




        $encodeJson = json_encode($messages);
        $this->lineapi->replyMessage($encodeJson);
    }


    function  unknow($userId, $replyToken, $text)
    {
        // reply message block
        $messages = [];
        $messages['replyToken'] = $replyToken;
        $messages['messages'][0] = $this->getFormatTextMessage("Reply Message [$text]");
        $encodeJson = json_encode($messages);
        // reply message block


        // push message block
        $pushmessages = [];
        $pushmessages['to'] = $userId;
        $pushmessages['messages'][0] = $this->getFormatTextMessage("Pushs Message [$text]");
        $encodeJson2 = json_encode($pushmessages);
        // push message block

        $results = $this->lineapi->pushMessage($encodeJson2);
        $results = $this->lineapi->replyMessage($encodeJson);
    }



    function getFormatTextMessage($text)
    {
        $datas = [];
        $datas['type'] = 'text';
        $datas['text'] = $text;
        return $datas;
    }

    function getFlex()
    {
        $datas = [];
        $datas['type'] = 'flex';
        $datas['altText'] = 'this is a flex message';
        $datas['contents']["type"] = 'bubble';
        $datas['contents']["body"]["type"] = 'box';
        $datas['contents']["body"]["layout"] = 'vertical';
        $datas['contents']["body"]["contents"][0]["type"] = 'text';
        $datas['contents']["body"]["contents"][0]["text"] = 'ราการ#1'; 
      
        $datas['contents']["body"]["contents"][1]["type"] = 'text';
        $datas['contents']["body"]["contents"][1]["text"] = 'ราการ#2'; 

        $datas['contents']["body"]["contents"][2]["type"] = 'text';
        $datas['contents']["body"]["contents"][2]["text"] = 'ราการ#3'; 

        $datas['contents']["body"]["contents"][3]["type"] = 'text';
        $datas['contents']["body"]["contents"][3]["text"] = 'ราการ#4'; 

        $datas['contents']["body"]["contents"][4]["type"] = 'text';
        $datas['contents']["body"]["contents"][4]["text"] = 'ราการ#5'; 

        $datas['contents']["body"]["contents"][5]["type"] = 'text';
        $datas['contents']["body"]["contents"][5]["text"] = 'ราการ#6'; 
        
        return $datas;
    }
}
