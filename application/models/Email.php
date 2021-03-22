<?php
class Email extends CI_Model {
    public function sendinfo($msg, $email, $subject) {

          //config
        $config['protocol'] = 'smtp';
        $config['charset'] = 'utf8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $config['smtp_host'] = 'localhost';
        $config['smtp_user'] = 'info@pettogo.co';
        $config['smtp_pass'] = '0ew,jwfh';
        $this->email->initialize($config);
        //config
        $this->email->from('info@pettogo.co', 'Pettogo.co');
        $this->email->to($email); //ส่งถึงใคร
        $this->email->subject("$subject"); //หัวข้อของอีเมล
        $this->email->message("$msg"); //เนื้อหาของอีเมล
        $this->email->send(); 
    }



}
