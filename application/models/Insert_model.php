<?php

class Insert_model extends CI_Model {

    function merchant($input) {
        if ($this->db->insert('merchant', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function customer($input) {
        if ($this->db->insert('customer', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }

    function billtoken($input) {
        if ($this->db->insert('billtoken', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }

    function shippingrate($input) {
        if ($this->db->insert('shippingrate', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }

    function paymentmethod($input) {
        if ($this->db->insert('paymentmethod', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }

    function items($input) {
        if ($this->db->insert('items', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }

    function merchantlineuid($input) {
        if ($this->db->insert('merchantlineuid', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function orderdetail($input) {
        if ($this->db->insert('orderdetail', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function order($input) {
        if ($this->db->insert('order', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }

    function ordertoken($input) {
        if ($this->db->insert('ordertoken', $input)):
            return true;
        else:
            return false;
        endif;
    }

}

?>