<?php

class User_model extends CI_Model {

    function __construct() {
        parent::__construct();

        $this->load->library(array('encrypt'));
        $this->load->helper(array('cookie', 'url'));
    }

    function user_login($user_id = '', $password = '', $remember_me = '') {
        $query = $this->db->query("SELECT * FROM merchant where email = '" . $user_id . "'  and password = '" . $password . "'  LIMIT 1");
        if ($query->num_rows() > 0) {
            $row = $query->row();

            if ($remember_me == 'on') {
                $expires = ( 60 * 60 * 24 * 365) / 12;
            } else {
                $expires = ( 60 * 60 * 24);
            }

            $set_cm_account['id'] = $row->id;
            $set_cm_account['name'] = $row->name;
            $set_cm_account['email'] = $row->email;
            $set_cm_account['description'] = $row->description;
            $set_cm_account['lineid'] = $row->lineid;
            $set_cm_account['image'] = $row->image;
            $set_cm_account['token'] = $row->token;
            $set_cm_account = $this->encrypt->encode(serialize($set_cm_account));
            set_cookie('useraccount', $set_cm_account, $expires);


            return true;
        } else {
            return false;
        }
    }

    function get_account_cookie() {
        $this->load->library(array('encrypt'));
        // get cookie
        $c_account = get_cookie('useraccount', true);
        if ($c_account != null) {
            $c_account = $this->encrypt->decode($c_account);
            $c_account = @unserialize($c_account);
            return $c_account;
        }
        return null;
    }

    function logout() {
        $this->load->helper(array('cookie'));
        delete_cookie('useraccount');
    }

    function is_login() {
        $cm_account = $this->get_account_cookie();
        if (!isset($cm_account['email']) || !isset($cm_account['id'])) {
            return false;
        } else
        if ($this->get_by_id($cm_account['id']) != false)
            return true;
        else
            return false;
    }

    function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('merchant');
    }

}
