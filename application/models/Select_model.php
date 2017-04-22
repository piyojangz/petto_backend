<?php

class Select_model extends CI_Model {

    function customerdetail($cond) {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query->row();
    }

    function v_merchantlineuid($cond) {
        $this->db->select('lineuid');
        $this->db->from('v_merchantlineuid');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function paymentmethod($cond) {
        $this->db->select('*');
        $this->db->from('paymentmethod');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function province($cond) {
        $this->db->select('*');
        $this->db->from('province');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function amphur($cond) {
        $this->db->select('*');
        $this->db->from('amphur');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function district($cond) {
        $this->db->select('*');
        $this->db->from('district');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function customer($cond) {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function items($cond) {
        $this->db->select('*');
        $this->db->from('items');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function merchant($cond) {
        $this->db->select('*');
        $this->db->from('merchant');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function merchantin($tokens) {
        $this->db->select('*');
        $this->db->where_in('token',$tokens);
        $this->db->from('merchant');
        $query = $this->db->get();
        return $query;
    }

    function v_merchantuid($cond) {
        $this->db->select('*');
        $this->db->from('v_merchantuid');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function merchantlineuid($cond) {
        $this->db->select('*');
        $this->db->from('merchantlineuid');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function ordertoken($cond) {
        $this->db->select('*');
        $this->db->from('ordertoken');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function order($cond) {
        $this->db->select('*');
        $this->db->from('order');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function orderdetail($cond) {
        $this->db->select('*');
        $this->db->from('orderdetail');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

}

?>