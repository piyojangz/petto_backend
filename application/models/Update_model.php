<?php

class Update_model extends CI_Model {

    function merchant($input) {
        $this->db->where('token', $input['token']);
        if ($this->db->update('merchant', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function customer($input) {
        $this->db->where('uid', $input['uid']);
        if ($this->db->update('customer', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function paymentmethod($input) {
        $this->db->where('id', $input['id']);
        if ($this->db->update('paymentmethod', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function merchantlineuid($input) {
        $this->db->where('merchantid', $input['merchantid']);
        $this->db->where('token', $input['token']);
        if ($this->db->update('merchantlineuid', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function orderdetail($input) {
        $this->db->where('orderid', $input['orderid']);
        $this->db->where('itemid', $input['itemid']);
        if ($this->db->update('orderdetail', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function items($input) {
        $this->db->where('id', $input['id']);
        if ($this->db->update('items', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function order($input, $wherein = null) {

        if ($wherein != null) {
            $this->db->where_in('id', $wherein);
        } else {
            $this->db->where('id', $input['id']);
        }
        
        if ($this->db->update('order', $input)):
            return true;
        else:
            return false;
        endif;
    }

}

?>
