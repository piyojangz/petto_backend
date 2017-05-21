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
        $data["islogin"] = $this->user->is_login();
        $merchantname = explode(".", $_SERVER['HTTP_HOST'])[0];
        $data['http'] = "http://";
        //echo $merchantname;

        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();
        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        $data["article"] = $this->get->article(array("merchantid" => $data["merchant"]->id,"status"=>"1"))->result();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view('templatemerchant/index', $data);

    }

    public function test($merchantname)
    {
        $data["islogin"] = $this->user->is_login();
        $data['http'] = "http://";
        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();
        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        $data["article"] = $this->get->article(array("merchantid" => $data["merchant"]->id,"status"=>"1"))->result();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view('templatemerchant/index', $data);
    }

    public function subpage($page)
    {
        $data["islogin"] = $this->user->is_login();
        $merchantname = explode(".", $_SERVER['HTTP_HOST'])[0];
        $data['http'] = "http://";
        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();
        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        $data["article"] = $this->get->article(array("merchantid" => $data["merchant"]->id,"status"=>"1"))->result();
        $data["article"] = $this->get->article(array("merchantid" => $data["merchant"]->id,"status"=>"1"))->result();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view("templatemerchant/$page", $data);
    }


    public function mapdomain()
    {
        $data['http'] = "http://";
        $data["islogin"] = $this->user->is_login();
        if (preg_match('/.+\.zoaish\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
        }
        if (preg_match('/.+\.rochubeauty\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
            $data['http'] = "https://";
        }

        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();
        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        $data["article"] = $this->get->article(array("merchantid" => $data["merchant"]->id,"status"=>"1"))->result();
        $data["article"] = $this->get->article(array("merchantid" => $data["merchant"]->id,"status"=>"1"))->result();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view('templatemerchant/index', $data);

    }

    public function webpage($page)
    {
        $data['http'] = "http://";
        $data["islogin"] = $this->user->is_login();
        if (preg_match('/.+\.zoaish\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
        }
        if (preg_match('/.+\.rochubeauty\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
            $data['http'] = "https://";
        }

        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();
        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view("templatemerchant/$page", $data);
    }


    public function page($merchantname, $page)
    {
        $data["islogin"] = $this->user->is_login();
        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();
        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view("templatemerchant/$page", $data);
    }

    public function post($merchantname, $id,$title="")
    {
        $data['http'] = "http://";
        $data["islogin"] = $this->user->is_login();
        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();
        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        $data["article"] = $this->get->article(array("id" => $id))->row();

        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view("templatemerchant/post", $data);
    }

    public function items($merchantname)
    {
        $data['http'] = "http://";
        $data["islogin"] = $this->user->is_login();
        if (preg_match('/.+\.zoaish\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
        }
        if (preg_match('/.+\.rochubeauty\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
            $data['http'] = "https://";
        }

        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();
        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view("templatemerchant/items", $data);
    }


    public function item($merchantname, $itemid, $title = "")
    {
        $data['http'] = "http://";
        $data["islogin"] = $this->user->is_login();
        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();

        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        $data["item"] = $this->get->items(array("id" => $itemid))->row();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view("templatemerchant/item", $data);
    }


    public function subitems()
    {
        $data["islogin"] = $this->user->is_login();
        if (preg_match('/.+\.zoaish\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
        }
        if (preg_match('/.+\.rochubeauty\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
            $data['http'] = "https://";
        }
        $data['http'] = "http://";
        $data["islogin"] = $this->user->is_login();
        $merchantname = explode(".", $_SERVER['HTTP_HOST'])[0];
        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();
        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view("templatemerchant/items", $data);
    }

    public function subitem($itemid, $title = "")
    {
        $data['http'] = "http://";
        $data["islogin"] = $this->user->is_login();
        $merchantname = explode(".", $_SERVER['HTTP_HOST'])[0];
        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();

        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        $data["item"] = $this->get->items(array("id" => $itemid))->row();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view("templatemerchant/item", $data);
    }


    public function mapitems()
    {
        $data["islogin"] = $this->user->is_login();
        if (preg_match('/.+\.zoaish\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
        }
        if (preg_match('/.+\.rochubeauty\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
            $data['http'] = "https://";
        }
        $data['http'] = "http://";
        $data["islogin"] = $this->user->is_login();
        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();
        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view("templatemerchant/items", $data);
    }

    public function mapitem($itemid, $title = "")
    {
        $data['http'] = "http://";
        $data["islogin"] = $this->user->is_login();
        if (preg_match('/.+\.zoaish\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
        }
        if (preg_match('/.+\.rochubeauty\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
            $data['http'] = "https://";
        }
        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();

        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        $data["item"] = $this->get->items(array("id" => $itemid))->row();
        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view("templatemerchant/item", $data);
    }


    public function subpost( $id,$title="")
    {
        $data['http'] = "http://";
        $data["islogin"] = $this->user->is_login();
        $merchantname = explode(".", $_SERVER['HTTP_HOST'])[0];
        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();
        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        $data["article"] = $this->get->article(array("id" => $id))->row();

        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view("templatemerchant/post", $data);
    }

    public function mappost( $id,$title="")
    {
        $data['http'] = "http://";
        $data["islogin"] = $this->user->is_login();
        if (preg_match('/.+\.zoaish\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
        }
        if (preg_match('/.+\.rochubeauty\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
            $merchantname = "rochubeauty";
            $data['http'] = "https://";
        }
        $data["islogin"] = $this->user->is_login();
        $data["merchant"] = $this->get->merchant(array("name" => $merchantname))->row();
        $data["province"] = $this->get->province(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array('merchantid' => $data["merchant"]->id, 'status' => '1'))->result();
        $data["ordertoken"] = substr($data["merchant"]->billtoken, -5);
        $data["imagescover"] = $this->get->imagescover(array("merchantid" => $data["merchant"]->id, "status" => "1"))->result();
        $data["ggscript"] = $this->get->googleanalytic(array("merchantid" => $data["merchant"]->id))->row();
        $data["article"] = $this->get->article(array("id" => $id))->row();

        if (count($data["merchant"]) == 0) {
            redirect(base_url());
        }

        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => 1))->result();

        $this->load->view("templatemerchant/post", $data);
    }
}
