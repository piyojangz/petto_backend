<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller
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
        $merchantname = explode(".", $_SERVER['HTTP_HOST'])[0];
        //echo $merchantname;

        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view('templatemerchant/index', $data);

    }

    public function test($merchantname)
    {
        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view('templatemerchant/index', $data);
    }


    public function mapdomain()
    {
        if (preg_match('/.+\.zoaish\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
        }
        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view('templatemerchant/index', $data);

    }

}
