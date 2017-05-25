<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
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
        $data["emaildoesexit"] = false;
        $data["webnamedoesexit"] = false;
        $data["register"] = false;
        if ($_POST) {
            $email = $this->input->post('email');
            $lineid = $this->input->post('lineid');
            $name = $this->input->post('name');
            $webname = $this->input->post('webname');
            $cond = array('email' => $email);
            if ($this->get->merchant($cond)->num_rows() > 0) {
                $data["emaildoesexit"] = true;
            } elseif ($this->get->merchant(array('webname' => $webname))->num_rows() > 0) {
                $data["webnamedoesexit"] = true;
            } else {
                $password = $this->input->post('password');
                $token = $this->common->getToken(10);
                $input = array(
                    'email' => $email,
                    'webname' => $webname,
                    'name' => $name,
                    'lineid' => $lineid,
                    'image' => base_url("public/avatar.png"),
                    'password' => md5($password),
                    'token' => $token,
                );
                $this->put->merchant($input);
                $data["register"] = true;
            }
        }

        $cm_account = $this->user->get_account_cookie();
        if ($this->user->is_login()) {
            redirect('account', 'index');
        }


        $this->load->view('register/index', $data);
    }

}
