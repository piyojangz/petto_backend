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
        $this->load->library('excel');
    }

    public function index($acctoken = "") {
        if (!$this->user->is_login()) {
            redirect('/');
        } else {
            redirect(base_url("account/$acctoken/dashboard"));
        }
    }

    public function setting($acctoken = "") {
        $data["user"] = $this->user->get_account_cookie();
        $data["token"] = $data["user"] ['token'];
        $data["merchant"] = $this->get->merchant(array("token" => $data["token"]))->row();
        if (!$this->user->is_login()) {
            redirect('/');
        }
        $this->load->view('account/setting', $data);
    }

    public function info($acctoken = "") {
        $data["user"] = $this->user->get_account_cookie();
        $data["token"] = $data["user"] ['token'];
        $data["merchant"] = $this->get->merchant(array("token" => $data["token"]))->row();
        if (!$this->user->is_login()) {
            redirect('/');
        }
        $this->load->view('account/info', $data);
    }

    public function updatesetting($acctoken = "") {
        if ($_POST) {
            $image = "";
            $data["user"] = $this->user->get_account_cookie();
            $imageData = $this->input->post("imageData");
            $name = $this->input->post("name");
            $tel = $this->input->post("tel");
            $detail = $this->input->post("detail");
            $lineid = $this->input->post("lineid");

            if (!empty($imageData)) {
                $image = $this->base64_to_jpeg_acc($imageData, $data["user"]["token"]);
                $image = base_url("public/upload/acc/$acctoken/") . $image["upload_data"]["file_name"];
            }


            $input = array(
                'token' => $data["user"]["token"],
                'tel' => $tel,
                'name' => $name,
                'description    ' => $detail,
                'lineid' => $lineid,
                'updatedate' => date('Y-m-d H:i:s'),
            );
            if ($image != "") {
                $input["image"] = $image;
            }
            if ($this->set->merchant($input)) {
                redirect(base_url("account/$acctoken/setting"));
            }
        }
    }

    public function dashboard($acctoken = "") {
        $data["user"] = $this->user->get_account_cookie();
        $data["token"] = $data["user"] ['token'];
        $data["merchant"] = $this->get->merchant(array("token" => $data["token"]))->row();
        $data["lineadmin"] = $this->get->v_adminsummary(array("token" => $data["token"]))->result();

        if (!$this->user->is_login()) {
            redirect('/');
        }

        $this->load->view('account/index', $data);
    }

    public function customer($acctoken = "") {
        $data["user"] = $this->user->get_account_cookie();
        $data["token"] = $data["user"] ['token'];
        $data["merchant"] = $this->get->merchant(array("token" => $data["token"]))->row();
        if (!$this->user->is_login()) {
            redirect('/');
        }

        $data["customer"] = $this->get->getcustomerlist($data["merchant"]->id);

        $this->load->view('account/customer', $data);
    }

    public function orderall($acctoken = "") {
        $data["user"] = $this->user->get_account_cookie();
        $data["obj"] = $this;
        $data["token"] = $data["user"] ['token'];
        $data["merchant"] = $this->get->merchant(array("token" => $data["token"]))->row();
        $data["order"] = $this->get->v_order(array("merchantid" => $data["merchant"]->id), array("0", "3", "4"))->result();

        if (!$this->user->is_login()) {
            redirect('/');
        }

        $data["customer"] = $this->get->getcustomerlist($data["merchant"]->id);

        $this->load->view('account/allorder', $data);
    }

    public function getorderstatus($status) {
        switch ($status) {
            case "1":
                return " <div class=\"label label-table label-warning\">Waiting for payment</div>";

                break;
            case "2":
                return " <div class=\"label label-table label-success\">Paid</div>";
                break;
            case "3":
                return " <div class=\"label label-table label-danger\">Shipped</div>";
                break;
            case "4":
                return " <div class=\"label label-table label-warning\">Closed</div>";
                break;
            default:
                break;
        }
        return "-";

        // <div class="label label-table label-success">Paid</div>
    }

    public function products($acctoken = "") {
        $data["user"] = $this->user->get_account_cookie();
        $data["token"] = $data["user"] ['token'];
        $data["merchant"] = $this->get->merchant(array("token" => $data["token"]))->row();
        if (!$this->user->is_login()) {
            redirect('/');
        }
        $data["items"] = $this->get->items(array("merchantid" => $data["merchant"]->id, "status" => '1'))->result();

        $this->load->view('account/products', $data);
    }

    public function updateproduct($id, $acctoken = "", $isdelete = "false") {
        if ($isdelete == "true") {
            $input = array(
                'id' => $id,
                'status' => 0,
                'updatedate' => date('Y-m-d H:i:s'),
            );
            if ($this->set->items($input)) {
                redirect("account/$acctoken/products");
            }
        }
    }

    public function addnewpaymentmethod($acctoken = "") {
        if ($_POST) {
            if (!$this->user->is_login()) {
                redirect('/');
            }
            $id = $this->input->post("id");
            $data["user"] = $this->user->get_account_cookie();
            $bankaccount = $this->input->post("bankaccount");
            $accounttype = $this->input->post("accounttype");
            $accountbranch = $this->input->post("accountbranch");
            $accountno = $this->input->post("accountno");
            $accountname = $this->input->post("accountname");
            $bank = $this->get->bank(array("name" => $bankaccount))->row();

            if (empty($id)) {
                $input = array(
                    'merchantid' => $data["user"]["id"],
                    'bankname' => $bankaccount,
                    'accbranch' => $accountbranch,
                    'accno' => $accountno,
                    'status' => 1,
                    'accname' => $accountname,
                    'acctype' => $accounttype,
                    'banklogo' => $bank->image,
                    'updatedate' => date('Y-m-d H:i:s'),
                );
                if ($this->put->paymentmethod($input)) {
                    redirect("account/$acctoken/paymentmethod");
                }
            } else {
                $input = array(
                    'id' => $id,
                    'merchantid' => $data["user"]["id"],
                    'bankname' => $bankaccount,
                    'accbranch' => $accountbranch,
                    'accno' => $accountno,
                    'status' => 1,
                    'accname' => $accountname,
                    'acctype' => $accounttype,
                    'banklogo' => $bank->image,
                    'updatedate' => date('Y-m-d H:i:s'),
                );
                if ($image != "") {
                    $input["image"] = $image;
                }
                if ($this->set->paymentmethod($input)) {
                    redirect("account/$acctoken/paymentmethod");
                }
            }
        }
    }

    public function updatepaymentmethod($id, $acctoken = "", $isdelete = "false") {
        if ($isdelete == "true") {
            $input = array(
                'id' => $id,
                'status' => 0,
                'updatedate' => date('Y-m-d H:i:s'),
            );
            if ($this->set->paymentmethod($input)) {
                redirect("account/$acctoken/paymentmethod");
            }
        }
    }

    public function addnewproduct($acctoken = "") {
        if ($_POST) {
            $id = $this->input->post("id");
            $imageData = $this->input->post("imageData");
            $data["user"] = $this->user->get_account_cookie();
            $name = $this->input->post("name");
            $price = $this->input->post("price");
            $image = "";
            if (!empty($imageData)) {
                $image = $this->base64_to_jpeg($imageData, $acctoken);
                $image = base_url("public/upload/item/$acctoken/") . $image["upload_data"]["file_name"];
            }

            if (empty($id)) {
                $input = array(
                    'name' => $name,
                    'price' => $price,
                    'image' => $image,
                    'status' => "1",
                    'merchantid' => $data["user"]["id"],
                    'updatedate' => date('Y-m-d H:i:s'),
                );
                if ($this->put->items($input)) {
                    redirect("account/$acctoken/products");
                }
            } else {
                $input = array(
                    'id' => $id,
                    'name' => $name,
                    'price' => $price,
                    'updatedate' => date('Y-m-d H:i:s'),
                );
                if ($image != "") {
                    $input["image"] = $image;
                }
                if ($this->set->items($input)) {
                    redirect("account/$acctoken/products");
                }
            }
        }
    }

    function base64_to_jpeg_acc($data, $acctoken) {
        $temp_file_path = tempnam(sys_get_temp_dir(), 'tempimage'); // might not work on some systems, specify your temp path if system temp dir is not writeable
        file_put_contents($temp_file_path, base64_decode($data));
        $image_info = getimagesize($temp_file_path);
        $_FILES['userfile'] = array(
            'name' => uniqid() . '.' . preg_replace('!\w+/!', '', $image_info['mime']),
            'tmp_name' => $temp_file_path,
            'size' => filesize($temp_file_path),
            'error' => UPLOAD_ERR_OK,
            'type' => $image_info['mime'],
        );

        $config['upload_path'] = 'public/upload/acc/' . $acctoken . "/";
        if (!is_dir($config['upload_path'])) {
            mkdir("public/upload/acc/$acctoken", 0777);
        }

        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['max_width'] = '1024';
        $config['max_height'] = '1024';
        $config['overwrite'] = FALSE;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;

        $this->upload->initialize($config);


        if (!$this->upload->do_upload('userfile', true)) {
            print_r($this->upload->display_errors());
        } else {
            return array('upload_data' => $this->upload->data());
        }
    }

    function base64_to_jpeg($data, $acctoken) {
        $temp_file_path = tempnam(sys_get_temp_dir(), 'tempimage'); // might not work on some systems, specify your temp path if system temp dir is not writeable
        file_put_contents($temp_file_path, base64_decode($data));
        $image_info = getimagesize($temp_file_path);
        $_FILES['userfile'] = array(
            'name' => uniqid() . '.' . preg_replace('!\w+/!', '', $image_info['mime']),
            'tmp_name' => $temp_file_path,
            'size' => filesize($temp_file_path),
            'error' => UPLOAD_ERR_OK,
            'type' => $image_info['mime'],
        );

        $config['upload_path'] = 'public/upload/item/' . $acctoken . "/";
        if (!is_dir($config['upload_path'])) {
            mkdir("public/upload/item/$acctoken", 0777);
        }

        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '0';
        $config['max_width'] = '1024';
        $config['max_height'] = '1024';
        $config['overwrite'] = FALSE;
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;

        $this->upload->initialize($config);


        if (!$this->upload->do_upload('userfile', true)) {
            print_r($this->upload->display_errors());
        } else {
            return array('upload_data' => $this->upload->data());
        }
    }

    public function paymentmethod($acctoken = "") {
        $data["user"] = $this->user->get_account_cookie();
        $data["token"] = $data["user"] ['token'];
        $data["merchant"] = $this->get->merchant(array("token" => $data["token"]))->row();
        if (!$this->user->is_login()) {
            redirect('/');
        }
        $data["bank"] = $this->get->bank(array())->result();
        $data["paymentmethod"] = $this->get->paymentmethod(array("merchantid" => $data["user"]["id"], "status" => 1))->result();

        $this->load->view('account/moneyaccount', $data);
    }

}
