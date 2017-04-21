<?php

/**
 * Extends the BaseFacebook class with the intent of using
 * PHP sessions to store user ids and access tokens.
 */
class Lineapi {

    //put your code here
    // constructor
    function __construct() {
        
    }

    function pushmsg($userid, $msg) {
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
        curl_close($ch);
    }

}
