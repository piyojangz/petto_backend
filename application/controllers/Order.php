<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function Summary($orderid = "") {
        $this->load->view('template/bill');
    }

    public function payment($orderid = "") {
        $this->load->view('template/payment');
    }

}
