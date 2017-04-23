<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Insert_model', 'put');
        $this->load->model('Select_model', 'get');
        $this->load->model('Update_model', 'set');
        $this->load->model('User_model', 'user');

        $this->load->library('upload');
        $this->load->library('common');
        $this->load->library('lineapi');
    }

    public function index($acctoken = "") {
        if (!$this->user->is_login()) {
            redirect('/');
        } else {
            redirect(base_url("account/$acctoken/dashboard"));
        }
    }

    public function dashboard($acctoken = "") {
        $data["user"] = $this->user->get_account_cookie();
        $data["token"] = $data["user"] ['token'];
        if (!$this->user->is_login()) {
            redirect('/');
        }

        $this->load->view('account/index', $data);
    }
    
    
      public function products($acctoken = "") {
        $data["user"] = $this->user->get_account_cookie();
        $data["token"] = $data["user"] ['token'];
        if (!$this->user->is_login()) {
            redirect('/');
        }

        $this->load->view('account/products', $data);
    }

}
