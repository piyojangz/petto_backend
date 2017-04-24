<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Insert_model', 'put');
        $this->load->model('Select_model', 'get');
        $this->load->model('Update_model', 'set');
        $this->load->library('upload');
        $this->load->library('lineapi');
    }

    public function lookupcustomer() {
        $txttel = $this->input->post('txttel');
        $txtidcard = $this->input->post('txtidcard');
        $cond = array('tel' => $txttel, 'idcard' => $txtidcard);
        $data['result'] = $this->get->customerdetail($cond);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getaumphure() {
        $provinceid = $this->input->post('provinceid');
        $cond = array('PROVINCE_ID' => $provinceid);
        $data['result'] = $this->get->amphur($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getitem() {
        $id = $this->input->post('id');
        $cond = array('id' => $id);
        $data['result'] = $this->get->items($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }
    
    public function getshippingrate() {
        $merchantid = $this->input->post('merchantid');
        $unit = $this->input->post('unit');

        $data['result'] = $this->get->shippingrate($merchantid, $unit)->row();


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function gettumbol() {
        $aumpureid = $this->input->post('aumpureid');
        $cond = array('AMPHUR_ID' => $aumpureid);
        $data['result'] = $this->get->district($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function submitorder() {
        $itemselected = $this->input->post('itemselected');
        $total = $this->input->post('total');
        $paymenttype = $this->input->post('paymenttype');
        $orderid = $this->input->post('orderid');
        $shipingrate = $this->input->post('shipingrate');
        $ordertoken = $this->input->post('ordertoken');
        $shippingdiscount = $this->input->post('shippingdiscount');
        $pricediscount = $this->input->post('pricediscount');
        $mnbillstatus  = $this->input->post('mnbillstatus');

        //update order
        $input = array(
            'id' => $orderid,
            'total' => $total,
            'shipingrate' => $shipingrate,
            'paymentmethodid' => $paymenttype,
            'shippingdiscount' => $shippingdiscount,
            'pricediscount' => $pricediscount,
            'mnbillstatus' => $mnbillstatus,
            'updatedate' => date('Y-m-d H:i:s'),
        );
        $this->set->order($input);
        $orderitem = explode(";", $itemselected);
        foreach ($orderitem as $value) {
            $item = explode(",", $value);
            $input = array(
                'orderid' => $orderid,
                'itemid' => $item[0],
                'amount' => $item[1],
                'price' => $item[2],
            );
            $cond = array('orderid' => $input['orderid'], 'itemid' => $input['itemid']);
            if ($this->get->orderdetail($cond)->num_rows() == 0) {
                $this->put->orderdetail($input);
            } else {
                $this->set->orderdetail($input);
            }
        }
        $data['result'] = true;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function confirmpayment() {
        $orderid = $this->input->post('orderid');
        $ordertoken = $this->get->ordertoken(array('orderid' => $orderid))->row();
        $input = array(
            'id' => $orderid,
            'status' => 2,
            'updatedate' => date('Y-m-d H:i:s'),
        );
        $data['result'] = false;
        if ($this->set->order($input)) {
            $data['result'] = true;
        }
        $this->lineapi->pushmsg($ordertoken->uid, "สถานะของคุณถูกเปลี่ยนแล้ว https://perdbill.co/track/$ordertoken->token");
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

}
