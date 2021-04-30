<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Insert_model', 'put');
        $this->load->model('Select_model', 'get');
        $this->load->model('Update_model', 'set');
        $this->load->model('User_model', 'user');
        $this->load->model('Email', 'Semail');
        $this->load->library('upload');
        $this->load->library('common');
        $this->load->library('lineapi');
    }

    public function index()
    {
        $data["login"] = true;
        $data["register"] = false;
        if ($this->input->get("register") == "success") {
            $data["register"] = true;
        }
        if ($_POST) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $remember_me = 'on'; 
            //เช็ค password revoke
            $ispassword_revoke = $this->get->merchant(array("password_revoke" => md5($password)))->row();
            if (isset($ispassword_revoke)) {
                $input = array(
                    'email' => $email,
                    'password' => $ispassword_revoke->password_revoke
                );
                $this->set->merchantbyemail($input);
            }

            $result = $this->user->user_login($email, md5($password), $remember_me);
            if ($result['login'] == 'success') {
                $user = $this->user->get_account_cookie();
                $token = $user['token'];
                redirect(base_url("account/$token/dashboard"));
            } else {
                $data["login"] = $result['data'];
            }
        } else {
            $user = $this->user->get_account_cookie();
            if ($this->user->is_login()) {
                $token = $user['token'];
                redirect(base_url("account/$token/dashboard"));
            }
        }




        $this->load->view('login/index', $data);
    }

    public function forgotpassword()
    {
        $email = $this->input->post('email');
        $pass = $this->randomPassword();
        $input = array(
            'email' => $email,
            'password_revoke' => md5($pass)
        );
        if (!$this->isLocalhost()) {
            $this->Semail->sendinfo("รหัสผ่านชั่วคราวสำหรับเข้าใช้งานระบบคือ $pass ", $email, 'Pettogo.co รีเซ็ตรหัสผ่าน');
        }
        $this->set->merchantbyemail($input);

        redirect(base_url("login?resetpassword=true"));
    }

    function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }


    function isLocalhost($whitelist = ['127.0.0.1', '::1'])
    {
        return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
    }
}
