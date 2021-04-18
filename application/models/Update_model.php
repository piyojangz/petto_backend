<?php

class Update_model extends CI_Model
{

    function merchant($input)
    {
        $this->db->where('token', $input['token']);
        if ($this->db->update('merchant', $input)) :
            return $this->db->affected_rows();;
        else :
            return false;
        endif;
    }

    function aboutus($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('aboutus', $input)) :
            return true;
        else :
            return false;
        endif;
    }


    function contractus($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('contractus', $input)) :
            return true;
        else :
            return false;
        endif;
    }

    function shopslot($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('shopslot', $input)) :
            return true;
        else :
            return false;
        endif;
    }





    public function delete_shippingrate($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete('shippingrate')) :
            return true;
        else :
            return false;
        endif;
    }

    public function category($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('category', $input)) :
            return true;
        else :
            return false;
        endif;
    }

    public function article($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('article', $input)) :
            return true;
        else :
            return false;
        endif;
    }


    public function billtoken($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('billtoken', $input)) :
            return true;
        else :
            return false;
        endif;
    }

    public function deletebillnotificationusers($id)
    {
        $this->db->where('billtokenid', $id);
        if ($this->db->delete('billnotificationusers')) :
            return true;
        else :
            return false;
        endif;
    }

    public function removeimagescover($id)
    {
        $this->db->where('id', $id);
        if ($this->db->delete(' imagescover')) :
            return true;
        else :
            return false;
        endif;
    }



    public function googleanalytic($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('googleanalytic', $input)) :
            return true;
        else :
            return false;
        endif;
    }



    public function merchantbyid($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('merchant', $input)) :
            return true;
        else :
            return false;
        endif;
    }


    public function language($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('language', $input)) :
            return true;
        else :
            return false;
        endif;
    }




    public function packagemappingbymerchantid($input)
    {
        $this->db->where('merchantid', $input['merchantid']);
        if ($this->db->update('package_mapping', $input)) :
            return true;
        else :
            return false;
        endif;
    }


    public function imagescover($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('imagescover', $input)) :
            return true;
        else :
            return false;
        endif;
    }



    function shippingrate($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('shippingrate', $input)) :
            return true;
        else :
            return false;
        endif;
    }
    

    function customer($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('customer', $input)) :
            return true;
        else :
            return false;
        endif;
    }

    function paymentmethod($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('paymentmethod', $input)) :
            return true;
        else :
            return false;
        endif;
    }

    function merchantlineuid($input)
    {
        $this->db->where('id', $input['merchantid']);
        $this->db->where('token', $input['token']);
        if ($this->db->update('merchantlineuid', $input)) :
            return true;
        else :
            return false;
        endif;
    }

    function merchantlineuidbyid($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('merchantlineuid', $input)) :
            return true;
        else :
            return false;
        endif;
    }

    function merchantlineuidbyinvitetoken($input)
    {
        $this->db->where('invitetoken', $input['invitetoken']);
        if ($this->db->update('merchantlineuid', $input)) :
            return true;
        else :
            return false;
        endif;
    }

    function orderdetail($input)
    {
        $this->db->where('orderid', $input['orderid']);
        $this->db->where('itemid', $input['itemid']);
        if ($this->db->update('orderdetail', $input)) :
            return true;
        else :
            return false;
        endif;
    }

    function items($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('items', $input)) :
            return true;
        else :
            return false;
        endif;
    }
    

    
    function auctionlist($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('auctionlist', $input)) :
            return true;
        else :
            return false;
        endif;
    }


    function package($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('package', $input)) :
            return true;
        else :
            return false;
        endif;
    }

    function package_mapping($input)
    {
        $this->db->where('id', $input['id']);
        if ($this->db->update('package_mapping', $input)) :
            return true;
        else :
            return false;
        endif;
    }


    function order($input, $wherein = null)
    {

        if ($wherein != null) {
            $this->db->where_in('id', $wherein);
        } else {
            $this->db->where('id', $input['id']);
        }

        if ($this->db->update('orders', $input)) :
            return true;
        else :
            return false;
        endif;
    }
}
