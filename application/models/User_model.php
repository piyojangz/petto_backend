<?php

class User_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();

        $this->load->library(array('encryption'));
        $this->load->helper(array('cookie', 'url'));
    }

    function user_login($user_id = '', $password = '', $remember_me = '')
    {
        $query = $this->db->query("SELECT * FROM merchant where email = '" . $user_id . "'  and password = '" . $password . "'  LIMIT 1");
        if ($query->num_rows() > 0) {
            $row = $query->row();

            if ($remember_me == 'on') {
                $expires = (60 * 60 * 24 * 365) / 12;
            } else {
                $expires = (60 * 60 * 24);
            }

            if ($row->status == 1) {
                $set_cm_account['id'] = $row->id;
                $set_cm_account['name'] = $row->name;
                $set_cm_account['webname'] = $row->webname;
                $set_cm_account['email'] = $row->email;
                $set_cm_account['description'] = $row->description;
                $set_cm_account['lineid'] = $row->lineid;
                $set_cm_account['image'] = $row->image;
                $set_cm_account['token'] = $row->token;
                $set_cm_account['isadmin'] = $row->isadmin;

                $queryx = $this->db->query("SELECT * FROM v_merchantwithpackage where email = '" . $user_id . "'  and password = '" . $password . "'  LIMIT 1");
                if ($queryx->num_rows() > 0) {
                    $rowx = $queryx->row();
                    $set_cm_account['packageid'] = $rowx->packageid;
                }
                else{
                    $set_cm_account['packageid'] = 0;
                }

              
                $set_cm_account = $this->encryption->encrypt(serialize($set_cm_account));
                set_cookie('useraccount', $set_cm_account, $expires);
                return array('login' => 'success', 'data' => $row);
            } else {
                return array('login' => 'failed', 'data' => $row);
            }
        } else {
            return array('login' => 'failed', 'data' => null);
        }
    }

    function get_account_cookie()
    {
        $this->load->library(array('encryption'));
        // get cookie
        $c_account = get_cookie('useraccount', true);
        if ($c_account != null) {
            $c_account = $this->encryption->decrypt($c_account);
            $c_account = @unserialize($c_account);
            return $c_account;
        }
        return null;
    }

    function logout()
    {
        $this->load->helper(array('cookie'));
        delete_cookie('useraccount');
    }

    function is_login()
    {
        $cm_account = $this->get_account_cookie();
        if (!isset($cm_account['email']) || !isset($cm_account['id'])) {
            return false;
        } else
        if ($this->get_by_id($cm_account['id']) != false)
            return true;
        else
            return false;
    }

    function get_by_id($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('merchant');
    }


    function weblogin($user_id = '', $password = '')
    {
        $query = $this->db->query("SELECT * FROM merchant where email = '" . $user_id . "'  and password = '" . $password . "'  LIMIT 1");
        if ($query->num_rows() > 0) {
            $row = $query->row(); 
            if ($row->status == 1) {
                $set_cm_account['id'] = $row->id;
                $set_cm_account['name'] = $row->name;
                $set_cm_account['webname'] = $row->webname;
                $set_cm_account['email'] = $row->email;
                $set_cm_account['description'] = $row->description;
                $set_cm_account['lineid'] = $row->lineid;
                $set_cm_account['image'] = $row->image;
                $set_cm_account['token'] = $row->token;
                $set_cm_account['isadmin'] = $row->isadmin;

                $queryx = $this->db->query("SELECT * FROM v_merchantwithpackage where email = '" . $user_id . "'  and password = '" . $password . "'  LIMIT 1");
                if ($queryx->num_rows() > 0) {
                    $rowx = $queryx->row();
                    $set_cm_account['packageid'] = $rowx->packageid;
                }
                else{
                    $set_cm_account['packageid'] = 0;
                } 
                return array('login' => 'success', 'data' => $row);
            } else {
                return array('login' => 'failed', 'data' => $row);
            }
        } else {
            return array('login' => 'failed', 'data' => null);
        }
    }
}
