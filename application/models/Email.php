<?php
class Email extends CI_Model {
    public function sendinfo($msg, $email, $subject) {

          //config
        $config['protocol'] = 'smtp';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = FALSE;
        $config['mailtype'] = 'html';
        $config['smtp_host'] = 'localhost';
        $config['smtp_user'] = 'info@perdbill.co';
        $config['smtp_pass'] = 'p@ssw0rd';
        $this->email->initialize($config);
        //config
        $this->email->from('info@perdbill.co', 'Perdbill');
        $this->email->to($email); //ส่งถึงใคร
        $this->email->subject($subject); //หัวข้อของอีเมล
        $this->email->message($msg); //เนื้อหาของอีเมล
        $this->email->send();
    }



}
