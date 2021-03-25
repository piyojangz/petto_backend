<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Insert_model', 'put');
        $this->load->model('Select_model', 'get');
        $this->load->model('Update_model', 'set');
        $this->load->model('User_model', 'user');
        $this->load->model('Email','Semail');
        $this->load->library('upload');
        $this->load->library('common');
        $this->load->library('lineapi');
    }

    public function index()
    {
        $data["emaildoesexit"] = false;
        $data["webnamedoesexit"] = false;
        $data["register"] = false;
        if ($_POST) {
            $email = $this->input->post('email');
            $lineid = $this->input->post('lineid');
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $tel = $this->input->post('tel');
            $name = $this->input->post('nameth');
            $webname = $this->input->post('webname');
            $cond = array('email' => $email);
            if ($this->get->merchant($cond)->num_rows() > 0) {
                $data["emaildoesexit"] = true;
            } elseif ($this->get->merchant(array('name' => $name))->num_rows() > 0) {
                $data["webnamedoesexit"] = true;
            } else {
                $password = $this->input->post('password');
                $token = $this->common->getToken(10);
                $input = array(
                    'email' => $email,
                    // 'webname' => $webname,
                    'firstname' => $firstname,
                    'lastname' => $lastname,
                    'tel' => $tel,
                    'name' => $name,
                    // 'lineid' => $lineid,
                    'image' => base_url("public/avatar.png"),
                    'password' => md5($password),
                    'token' => $token,
                );
                $this->put->merchant($input);

                $this->sendemail($token, $firstname,$email);

                $data["register"] = true;
                redirect(base_url("login?register=success"));
            }
        }

        $cm_account = $this->user->get_account_cookie();
        if ($this->user->is_login()) {
            redirect(base_url("account"));
        }

        $this->load->view('register/index', $data);
    }

    function sendemail($token, $firstname,$email)
    {
        $msg =  "สวัสดีคุณ $firstname<br/>
        คุณได้ทำการสมัครสมาชิก Pettogo.co เรียบร้อยแล้ว<br/>
        โปรดทำตามขั้นตอนเพื่อยืนยันตนของท่านดังนี้<br/>
        1.ทำการ Add Line : @232ruaun หรือ แสกน QR code<br/>
        2.จากนั้น copy ข้อความ 'ลงทะเบียน $token' ในช่องแชท<br/>
        3.เสร็จสิ้นขั้นตอนจะมีข้อความยืนยัน และรอระบบอนุมัติ<br/>
        ขอบคุณค่ะ";
        $this->Semail->sendinfo($msg,$email,'ยืนยันการสมัครสมาชิก Pettogo.co'); 
    }
}
