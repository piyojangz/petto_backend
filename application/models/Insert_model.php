<?php

class Insert_model extends CI_Model
{

    function merchant($input)
    {
        if ($this->db->insert('merchant', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function article($input)
    {
        if ($this->db->insert('article', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }

    function auctiontransaction($input)
    {
        if ($this->db->insert('auctiontransaction', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }
    

    function category($input)
    {
        if ($this->db->insert('category', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }


    function review($input)
    {
        if ($this->db->insert('review', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }



    function customer($input)
    {
        if ($this->db->insert('customer', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }

    function imagescover($input)
    {
        if ($this->db->insert('imagescover', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }

    function googleanalytic($input)
    {
        if ($this->db->insert('googleanalytic', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }


    function billtokenstock($input)
    {
        if ($this->db->insert('billtokenstock', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }


    function billnotificationusers($input)
    {
        if ($this->db->insert('billnotificationusers', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }

    function billtoken($input)
    {
        if ($this->db->insert('billtoken', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }

    function shippingrate($input)
    {
        if ($this->db->insert('shippingrate', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }

    function paymentmethod($input)
    {
        if ($this->db->insert('paymentmethod', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }

    function items($input)
    {
        if ($this->db->insert('items', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }


    
    function shopslot($input)
    {
        if ($this->db->insert('shopslot', $input)):
            return true;
        else:
            return false;
        endif;
    }


    
    function auctionlist($input)
    {
        if ($this->db->insert('auctionlist', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function merchantlineuid($input)
    {
        if ($this->db->insert('merchantlineuid', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function orderdetail($input)
    {
        if ($this->db->insert('orderdetail', $input)):
            return true;
        else:
            return false;
        endif;
    }

    function order($input)
    {
        if ($this->db->insert('orders', $input)):
            $insert_id = $this->db->insert_id();
            return $insert_id;
        else:
            return false;
        endif;
    }


 

    function ordertoken($input)
    {
        if ($this->db->insert('ordertoken', $input)):
            return true;
        else:
            return false;
        endif;
    }

    public function packagemapping($input) { 
        if ($this->db->insert('package_mapping', $input)):
            return true;
        else:
            return false;
        endif;
    }

}
