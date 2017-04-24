<?php

class Select_model extends CI_Model {

    function customerdetail($cond) {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query->row();
    }

    function shippingrate($merchatid, $unit) {
        $this->db->select('*');
        $this->db->from('shippingrate');
        $this->db->where('merchantid', $merchatid);
        $this->db->where('unit<=', $unit);
        $this->db->limit(1);
        $this->db->order_by("unit", "desc");
        $query = $this->db->get();
        return $query;
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

    function bank($cond) {
        $this->db->select('*');
        $this->db->from('bank');
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

    function v_serchorderbytelandmerchantuid($tel, $lineuid) {
        $this->db->select('*');
        $this->db->where('tel', $tel);
        $this->db->where('lineuid', $lineuid);
        $this->db->where('status >=', 1);
        $this->db->from('v_serchorderbytelandmerchantuid');
        $this->db->order_by("paiddate", "desc");
        $this->db->limit(10);
        $query = $this->db->get();
        return $query;
    }

    function merchantin($tokens) {
        $this->db->select('*');
        $this->db->where_in('token', $tokens);
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

    function getcustomerlist($merchantid) {
        $query = $this->db->query("SELECT tb.*,(SELECT tk.token from customer c 
inner join `order` o  
on c.id = o.custid
inner join ordertoken tk 
on tk.orderid = o.id
WHERE c.tel = tb.customertel order by o.id desc limit 1) as lastestordertoken from (SELECT a.* FROM `v_serchorderbytelandmerchantuid` a     group by a.customertel)  tb
where tb.merchantid = $merchantid");

        return $query->result();
    }

}

?>