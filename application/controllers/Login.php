<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Insert_model', 'put');
        $this->load->model('Select_model', 'get');
        $this->load->model('Update_model', 'set');
        $this->load->model('User_model', 'user');

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

            $result = $this->user->user_login($email, md5($password), $remember_me);
            $user = $this->user->get_account_cookie();
            $token = $user['token'];
            if ($result) {
                redirect(base_url("account/$token/dashboard"));
            }
            $data["login"] = false;
        }

        $user = $this->user->get_account_cookie();
        if ($this->user->is_login()) {
            $token = $user['token'];
            redirect(base_url("account/$token/dashboard"));
        }


        $this->load->view('login/index', $data);
    }

}
