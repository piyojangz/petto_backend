<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Service extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Insert_model', 'put');
        $this->load->model('Select_model', 'get');
        $this->load->model('Update_model', 'set');
        $this->load->library('upload');
        $this->load->library('lineapi');
        $this->load->library('excel');
        $this->load->library('common');
    }

    public function lookupcustomer()
    {
        $txttel = $this->input->post('txttel');
        $txtidcard = $this->input->post('txtidcard');
        $cond = array('tel' => $txttel, 'idcard' => $txtidcard);
        $data['result'] = $this->get->customerdetail($cond);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getbilltoken()
    {
        $token = $this->input->post('token');
        $cond = array('token' => $token);
        $data['result'] = $this->get->billtoken($cond)->row();
        $data['result2'] = $this->get->billnotificationusers(array('billtokenid' => $data['result']->id))->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getpromobilltokenformerchant($merchantid, $merchantuid)
    {
        $uniqid = $this->common->getToken(6);
        $input = array(
            'shipingrate' => 0,
        );
        $orderid = $this->put->order($input);
        $input = array(
            'orderid' => $orderid,
            'merchantid' => $merchantid,
            'token' => $uniqid,
            'uid' => $merchantuid,
            'genstatus' => 1
        );

        if ($this->put->ordertoken($input)) {
            return array($orderid, $uniqid);
        }
        return false;
    }

    public function getpromobill()
    {
        $merchantid = $this->input->post('merchantid');
        $merchanttoken = $this->input->post('merchanttoken');
        $merchantuid = $this->input->post('merchantuid');
        $itemselected = $this->input->post('itemselected');
        $total = $this->input->post('total');
        $paymenttype = $this->input->post('paymenttype');

        $shipingrate = $this->input->post('shipingrate');
        $shippingdiscount = $this->input->post('shippingdiscount');
        $pricediscount = $this->input->post('pricediscount');

        //genorder
        $order = $this->getpromobilltokenformerchant($merchantid, $merchantuid);


        //update order
        $input = array(
            'id' => $order[0],
            'total' => $total,
            'shipingrate' => $shipingrate,
            'paymentmethodid' => $paymenttype,
            'shippingdiscount' => $shippingdiscount,
            'pricediscount' => $pricediscount,
            'mnbillstatus' => 1,
            'updatedate' => date('Y-m-d H:i:s'),
        );
        $this->set->order($input);
        $orderitem = explode(";", $itemselected);
        foreach ($orderitem as $value) {
            $item = explode(",", $value);
            $input = array(
                'orderid' => $order[0],
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

        $this->lineapi->pushmsg($merchantuid, "บิลสำหรับลูกค้าของคุณ https://perdbill.co/$order[1]");

        $data['result'] = $order[1];
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }


    public function deletemerchantlineuid()
    {
        $id = $this->input->post('id');

        $input = array(
            'id' => $id,
            'status' => 0,
            'updatedate' => date('Y-m-d H:i:s'),
        );

        $data = $this->set->merchantlineuidbyid($input);


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function deletebilltoken()
    {
        $id = $this->input->post('id');

        $input = array(
            'id' => $id,
            'status' => 0,
            'updatedate' => date('Y-m-d H:i:s'),
        );

        $data = $this->set->billtoken($input);


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getaumphure()
    {
        $provinceid = $this->input->post('provinceid');
        $cond = array('PROVINCE_ID' => $provinceid);
        $data['result'] = $this->get->amphur($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getmerchantbilldata()
    {
        $token = $this->input->post('token');
        $cond = array('token' => $token, 'status' => '1');
        $billtoken = $this->get->billtoken($cond)->row();
        $data["result"] = $billtoken;
        $data["result2"] = $this->getordersumbibilltoken($billtoken->token);
        $data["result3"] = $this->get->billnotificationusers(array("billtokenid" => $billtoken->id))->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getallbilltokenhtml()
    {
        $merchantid = $this->input->post('merchantid');
        $cond = array('merchantid' => $merchantid, 'status' => '1');
        $result = $this->get->billtoken($cond)->result();
        $html = "";

        foreach ($result as $key => $value) {

            $url = "perdbill.co/";
            $html .= "<tr   id=\"$value->token\">";
//            $html .= "<td>";
//            $html .= "<div class=\"checkbox m-t-0 m-b-0\">";
//            $html .= "<input type=\"checkbox\" name=\"billtokenid\" id =\"billtokenid\">";
//            $html .= "<label for=\"checkbox0\"></label>";
//            $html .= "</div>";
//            $html .= "</td>";
            $html .= "<td colspan=\"2\">";
            $html .= "<small>$value->createdate</small><br/>$value->name</br>";
            $html .= "<small style=\"color:#ee6123;\">$url<b>$value->token</b></small>";
            $html .= "</td>";
            $html .= "</tr>";
        }

        echo $html;
    }

    public function saveadminuid()
    {
        $token = $this->input->post('token');
        $merchantid = $this->input->post('merchantid');
        $adminname = $this->input->post('adminname');
        $adminemail = $this->input->post('adminemail');
        $admintel = $this->input->post('admintel');
        $invitetoken = "Regis" . $this->common->getToken(8);

        $input = array(
            'token' => $token,
            'name' => $adminname,
            'email' => $adminemail,
            'tel' => $admintel,
            'status' => 1,
            'invitetoken' => $invitetoken,
            'updatedate' => date('Y-m-d H:i:s'),
        );


        $data['result'] = $this->put->merchantlineuid($input);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function savebilltoken()
    {
        $token = $this->input->post('token');
        $editnotiusers = $this->input->post('editnotiusers');
        $merchantid = $this->input->post('merchantid');
        $daterange = $this->input->post('daterange');
        $merchantuid = $this->input->post('merchantuid');
        $usernoti = $this->input->post('usernoti');
        $name = $this->input->post('name');
        $daterange = preg_split("/,|:|\s/", $daterange);
        $uniqid = $this->common->getToken(5);

        $from = str_replace('/', '-', $daterange[0]);
        $to = str_replace('/', '-', $daterange[2]);

        $from = strtotime($from);
        $to = strtotime($to);


        if ($editnotiusers == "") {
            $input = array(
                'merchantid' => $merchantid,
                'name' => $name,
                'merchanttoken' => $token,
                'token' => $uniqid,
                'uid' => $merchantuid,
                'datefrom' => date('Y-m-d H:i:s', $from),
                'dateto' => date('Y-m-d H:i:s', $to),
                'status' => 1,
                'updatedate' => date('Y-m-d H:i:s'),
            );

            $billtokenid = $this->put->billtoken($input);

            if ($usernoti != "") {
                foreach ($usernoti as $item) {
                    $input = array(
                        'billtokenid' => $billtokenid,
                        'lineuid' => explode("|", $item)[0],
                        'merchantlinename' => explode("|", $item)[1]
                    );
                    $this->put->billnotificationusers($input);
                }
            }
        } else {
            $input = array(
                'id' => $editnotiusers,
                'merchantid' => $merchantid,
                'name' => $name,
                'datefrom' => date('Y-m-d H:i:s', $from),
                'dateto' => date('Y-m-d H:i:s', $to),
                'status' => 1,
            );

            $this->set->billtoken($input);

            if ($this->set->deletebillnotificationusers($editnotiusers)) {
                if ($usernoti != "") {
                    foreach ($usernoti as $item) {
                        $input = array(
                            'billtokenid' => $editnotiusers,
                            'lineuid' => explode("|", $item)[0],
                            'merchantlinename' => explode("|", $item)[1]
                        );
                        $this->put->billnotificationusers($input);
                    }
                }
            }
        }


        $data['result'] = true;
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getitem()
    {
        $id = $this->input->post('id');
        $cond = array('id' => $id);
        $data['result'] = $this->get->items($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getordersumbibilltoken($billtoken)
    {
        return $this->get->getordersumbybilltoken($billtoken)->result();
    }

    public function updateorderstatus()
    {
        $items = $this->input->post('items');
        $status = $this->input->post('status');
        $itemarr = array();
        foreach (explode("|", $items) as $value) {
            array_push($itemarr, $value);
        }
        if ($status == "4") {
            $input = array('closestatus' => "1");
        } else {
            $input = array('status' => $status);
        }

        $data['result'] = $this->set->order($input, $itemarr);
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function exportorderexcel()
    {
        $merchantid = $this->input->post('merchantid');
        $status = $this->input->post('exportorderstatus');
        if ($status != "0") {
            if ($status == "4") {
                $result = $this->get->orderexcel(array("merchantid" => $merchantid, "closestatus" => "1"), null, null);
            } else {
                $result = $this->get->orderexcel(array("merchantid" => $merchantid), null, array($status));
            }
        } else {
            $result = $this->get->orderexcel(array("merchantid" => $merchantid), array("0", "3"), null);
        }
        $date = date('YmdHis');
        $this->excel->to_excel($result, 'order-excel' . $date);
    }

    public function getorderstatus()
    {
        $merchantid = $this->input->post('merchantid');
        $status = $this->input->post('status');
        if ($status != "0") {
            if ($status == "4") {
                $data['result'] = $this->get->v_order(array("merchantid" => $merchantid, "closestatus" => "1"), null, null)->result();
            } else {
                $data['result'] = $this->get->v_order(array("merchantid" => $merchantid, "closestatus" => "0"), null, array($status))->result();
            }
        } else {
            $data['result'] = $this->get->v_order(array("merchantid" => $merchantid, "closestatus" => "0"), array("0", "3"), null)->result();
        }

        $html = "";
        foreach ($data['result'] as $item) {
            $statuslabel = $this->getorderstatuslabel($item->status, $item->closestatus);
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

    public function getorderstatuslabel($status, $closestatus)
    {
        if ($closestatus == "1") {
            return " <div class=\"label label-table label-warning\">Canceled</div>";
        } else {
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
                default:
                    break;
            }
        }

        return "-";

        // <div class="label label-table label-success">Paid</div>
    }

    public function getshippingrateconfig()
    {
        $id = $this->input->post('id');
        $cond = array('id' => $id);
        $data['result'] = $this->get->shippingrateconfig($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getpementmethod()
    {
        $id = $this->input->post('id');
        $cond = array('id' => $id);
        $data['result'] = $this->get->paymentmethod($cond)->row();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function getshippingrate()
    {
        $merchantid = $this->input->post('merchantid');
        $unit = $this->input->post('unit');

        $data['result'] = $this->get->shippingrate($merchantid, $unit)->row();


        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function gettumbol()
    {
        $aumpureid = $this->input->post('aumpureid');
        $cond = array('AMPHUR_ID' => $aumpureid);
        $data['result'] = $this->get->district($cond)->result();
        $this->output->set_header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function submitorder()
    {
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
            'submitdate' => date('Y-m-d H:i:s'),
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

    public function confirmpayment()
    {
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
