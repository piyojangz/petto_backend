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
        $this->load->library('excel');
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

    public function updateorderstatus() {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        $itemarr = array();
        foreach (explode("|", $items) as $value) {
            array_push($itemarr, $value);
        }
        $input = array('status' => $status);
        $data['result'] = $this->set->order($input, $itemarr);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function exportorderexcel() {
        $merchantid = $this->input->post('merchantid');
        $status = $this->input->post('exportorderstatus');
        if ($status != "0") {
            $result = $this->get->orderexcel(array("merchantid" => $merchantid), null, array($status));
        } else {
            $result = $this->get->orderexcel(array("merchantid" => $merchantid), array("0", "3"), null);
        }
        $date = date('YmdHis');
        $this->excel->to_excel($result, 'order-excel' . $date);
    }

    public function getorderstatus() {
        $merchantid = $this->input->post('merchantid');
        $status = $this->input->post('status');
        if ($status != "0") {
            $data['result'] = $this->get->v_order(array("merchantid" => $merchantid), null, array($status))->result();
        } else {
            $data['result'] = $this->get->v_order(array("merchantid" => $merchantid), array("0", "3", "4"), null)->result();
        }

        $html = "";
        foreach ($data['result'] as $item) {
            $statuslabel = $this->getorderstatuslabel($item->status);
            $html .= "<tr>";
            $html .= "<td>";
            $html .= "<div class=\"checkbox checkbox-success checkbox-order \">";
            $html .= "<input id=\"orderid$item->id\" name=\"orderid\"  type=\"checkbox\" value=\"$item->id\">";
            $html .= "<label for=\"orderid$item->id\"> </label>";
            $html .= "</div>";
            $html .= "</td>";
            $html .= "<td><a class=\"badge badge-info \" target=\"_blank\" href=\"" . base_url($item->token) . "\">$item->token</a></td>";
            $html .= "<td>" . number_format($item->total) . "</td>";
            $html .= "<td>$item->paymentinfo</td>";
            $html .= "<td>$item->fullname</td>";
            $html .= "<td>$item->billingaddress</td>";
            $html .= "<td>$statuslabel</td> ";
            $html .= "</tr>";
        }

        echo $html;
    }

    public function getorderstatuslabel($status) {
        switch ($status) {
            case "1":
                return " <div class=\"label label-table label-warning\">Waiting for confirm payment</div>";

                break;
            case "2":
                return " <div class=\"label label-table label-success\">Paid</div>";
                break;
            case "3":
                return " <div class=\"label label-table label-danger\">Shipped</div>";
                break;
            case "4":
                return " <div class=\"label label-table label-warning\">Canceled</div>";
                break;
            default:
                break;
        }
        return "-";

        // <div class="label label-table label-success">Paid</div>
    }

    public function getshippingrateconfig() {
        $id = $this->input->post('id');
        $cond = array('id' => $id);
        $data['result'] = $this->get->shippingrateconfig($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

        public function getpementmethod() {
        $id = $this->input->post('id');
        $cond = array('id' => $id);
        $data['result'] = $this->get->paymentmethod($cond)->row();
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
        $mnbillstatus = $this->input->post('mnbillstatus');

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
        //$this->lineapi->pushmsg($ordertoken->uid, "สถานะของคุณถูกเปลี่ยนแล้ว https://perdbill.co/track/$ordertoken->token");
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

}
