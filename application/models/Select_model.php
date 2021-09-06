<?php

class Select_model extends CI_Model
{

    function customerdetail($cond)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }



    function customerlogin($email, $password)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->or_where('password_revoke', $password);
        $query = $this->db->get();
        return $query;
    }

    function customerbyid($id)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query;
    }


    function billnotificationusers($cond)
    {
        $this->db->select('*');
        $this->db->from('billnotificationusers');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function shippingrate($merchatid, $unit)
    {
        $this->db->select('*');
        $this->db->from('shippingrate');
        $this->db->where('merchantid', $merchatid);
        $this->db->where('unit<=', $unit);
        $this->db->limit(1);
        $this->db->order_by("unit", "desc");
        $query = $this->db->get();
        return $query;
    }

    function shippingrateconfig($cond)
    {
        $this->db->select('*');
        $this->db->from('shippingrate');
        $this->db->order_by("unit", "asc");
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function lineuid($cond)
    {
        $this->db->select('lineuid');
        $this->db->from('merchantlineuid');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function billtoken($cond, $limit = "")
    {
        if ($limit != "") {
            $this->db->limit($limit);
        }
        $this->db->select('*');
        $this->db->from('billtoken');
        $this->db->order_by("createdate", "desc");
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function v_merchantlineuid($cond)
    {
        $this->db->select('lineuid');
        $this->db->from('v_merchantlineuid');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function v_adminsummary($cond)
    {
        $this->db->select('*');
        $this->db->from('v_adminsummary');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function v_notificationtousers($cond)
    {
        $this->db->select('*');
        $this->db->from('v_notificationtousers');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }



    function v_order($cond, $notin = null, $in = null, $limit = 0, $offset = 0, $searchtxt, $dfrom = null, $dto = null)
    {
        if ($notin != null) {
            $this->db->where_not_in('status', $notin);
        }
        if ($in != null) {
            $this->db->where_in('status', $in);
        }

        if ($dfrom != null && $dto != null) {
            $this->db->where('createdate >=', $dfrom);
            $this->db->where('createdate <=', $dto);
        }

        $this->db->select('*');
        $this->db->from('v_order');
        $this->db->where($cond);
        if ($searchtxt != '') {
            $this->db->like('orderno', $searchtxt);
        }
        $this->db->order_by('id', 'desc');
        $this->db->group_by('id');
        if ($limit != 0) {
            $this->db->limit($limit, $offset);
        }
        $query = $this->db->get();
        return $query;
    }

    function orderexcel($cond, $notin = null, $in = null)
    {
        if ($notin != null) {
            $this->db->where_not_in('status', $notin);
        }
        if ($in != null) {
            $this->db->where_in('status', $in);
        }
        $this->db->select('DATE_FORMAT(submitdate,\'%d/%m/%Y\')   as `วันที่ส่งข้อมูล`,DATE_FORMAT(submitdate,\'%H:%i:%s\')   as `เวลาที่ส่งข้อมูล`,fullname as ชื่อ-สกุล,billingaddress ที่อยู่สำหรับจัดส่ง,CONCAT("_",tel) เบอร์โทร,total ยอดสั่งรวม ,paymentamount จำนวนเงินโอน, paymentinfo การชำระเงิน,    	total ยอดสั่งรวม');
        $this->db->from('v_order');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }




    function bankaccount($cond)
    {
        $this->db->select('*');
        $this->db->from('bankaccount');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }



    function category($cond)
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function v_cate($cond)
    {
        $this->db->select('*');
        $this->db->from('v_cate');
        $this->db->where($cond);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query;
    }


    function paymentmethod($cond)
    {
        $this->db->select('*');
        $this->db->from('paymentmethod');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function bank($cond)
    {
        $this->db->select('*');
        $this->db->from('bank');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function province($cond)
    {
        $this->db->select('*');
        $this->db->from('province');
        $this->db->order_by('name_th', 'asc');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function district($cond)
    {
        $this->db->select('*');
        $this->db->from('district');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function subdistrict($cond)
    {
        $this->db->select('*');
        $this->db->from('subdistrict');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }




    function customer($cond)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function v_itemswithstock($cond, $billtokenid)
    {
        $this->db->select('*');
        $this->db->from('v_itemswithstock');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }


    function googleanalytic($cond)
    {
        $this->db->select('*');
        $this->db->from('googleanalytic');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }


    function article($cond, $limit = null)
    {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where($cond);
        $this->db->order_by("id", "desc");
        if ($limit != null) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        return $query;
    }

    function nextarticle($id)
    {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where('id >', $id);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query;
    }

    function previousarticle($id)
    {
        $this->db->select('*');
        $this->db->from('article');
        $this->db->where('id <', $id);
        $this->db->where('status', 1);

        $query = $this->db->get();
        return $query;
    }
    function imagescover($cond)
    {
        $this->db->select('*');
        $this->db->from('imagescover');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function v_banner($cond)
    {
        $this->db->select('*');
        $this->db->from('v_banner');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function itemswithstock($cond, $billtokenid)
    {
        $this->db->select('a.*,sum(b.amount) as itemstock');
        $this->db->from('items a');
        $this->db->join("billtokenstock b", " a.id = b.itemid and  b.billtokenid = $billtokenid", "left");
        $this->db->where($cond);
        $this->db->group_by("a.id");
        $query = $this->db->get();
        return $query;
    }

    function items($cond, $pricelength = 0, $pricesort = "", $ids = array())
    {

        $plength = '';
        switch ($pricelength) {
            case '0':
                break;
            case '1':
                // if ($plength != '') {
                $this->db->where('discount <=', 100);
                $this->db->where('discount >=', 0);
                // }
                break;
            case '2':
                $this->db->where('discount <=', 1000);
                $this->db->where('discount >=', 101);
                break;
            case '3':
                $this->db->where('discount <=', 5000);
                $this->db->where('discount >=', 1001);
                break;
            case '4':
                $this->db->where('discount <=', 10000);
                $this->db->where('discount >=', 5001);
                break;
            case '5':
                $this->db->where('discount >=', 10000);
                break;
        }

        if (count($ids) > 0) {
            $this->db->where_in('status', $ids);
        }
        if ($pricesort != "") {
            $this->db->order_by('discount', $pricesort);
        } else {
            $this->db->order_by('updatedate', 'desc');
        }

        $this->db->select('*');
        $this->db->from('items');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }



    function itemsbycateid($cond, $pricelength, $pricesort)
    {
        $plength = '';
        switch ($pricelength) {
            case '0':
                break;
            case '1':
                // if ($plength != '') {
                $this->db->where('discount <=', 100);
                $this->db->where('discount >=', 0);
                // }
                break;
            case '2':
                $this->db->where('discount <=', 1000);
                $this->db->where('discount >=', 101);
                break;
            case '3':
                $this->db->where('discount <=', 5000);
                $this->db->where('discount >=', 1001);
                break;
            case '4':
                $this->db->where('discount <=', 10000);
                $this->db->where('discount >=', 5001);
                break;
            case '5':
                $this->db->where('discount >=', 10000);
                break;
        }
        if ($pricesort != "") {
            $this->db->order_by('discount', $pricesort);
        } else {
            $this->db->order_by('updatedate', 'desc');
        }

        $this->db->select('*');
        $this->db->from('items');
        $this->db->where($cond);
        $this->db->or_where('cateid1 = ', $cond['cateid']);
        $this->db->or_where('cateid2 = ', $cond['cateid']);
        $query = $this->db->get();
        return $query;
    }

    function v_product($cond, $limit = "", $pricelength = "", $pricesort = "", $searchtxt = "")
    {
        $plength = '';
        switch ($pricelength) {
            case '0':
                break;
            case '1':
                // if ($plength != '') {
                $this->db->where('discount <=', 100);
                $this->db->where('discount >=', 0);
                // }
                break;
            case '2':
                $this->db->where('discount <=', 1000);
                $this->db->where('discount >=', 101);
                break;
            case '3':
                $this->db->where('discount <=', 5000);
                $this->db->where('discount >=', 1001);
                break;
            case '4':
                $this->db->where('discount <=', 10000);
                $this->db->where('discount >=', 5001);
                break;
            case '5':
                $this->db->where('discount >=', 10000);
                break;
        }

        if ($limit != "") {
            $this->db->limit($limit, 0);
        }
        if ($pricesort != "") {
            $this->db->order_by('discount', $pricesort);
        } else {
            $this->db->order_by('updatedate', 'desc');
        }
        if ($searchtxt != "") {
            $this->db->like('id', $searchtxt);
            $this->db->or_like('name', $searchtxt);
            // $this->db->or_like('merchantname', $searchtxt);
        }

        $this->db->select('*');
        $this->db->from('v_product');



        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function v_review($cond)
    {
        $this->db->select('*');
        $this->db->from('v_review');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }


    function v_review_itemid($cond)
    {
        $this->db->select('itemid');
        $this->db->from('v_review');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function auctionlist($cond)
    {
        $this->db->select('*');
        $this->db->from('auctionlist');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function auctiontransaction($cond)
    {
        $this->db->select('*');
        $this->db->from('auctiontransaction');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }


    function auctiontransactionUniqCustid($cond)
    {
        $this->db->select('DISTINCT(custid) as custid');
        $this->db->from('auctiontransaction');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }



    function v_auctionhistoryformerchant($cond)
    {
        $this->db->select('*');
        $this->db->from('v_auctionhistoryformerchant');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function v_auction($cond)
    {
        $this->db->select('*');
        $this->db->from('v_auction');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function v_auctionhistory($cond)
    {
        $this->db->select('*');
        $this->db->from('v_auctionhistory');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }




    function package_mapping($cond)
    {
        $this->db->select('* ,   datediff(curdate(),updatedate) as diffday');
        $this->db->from('package_mapping');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function package_mapping_noneactive()
    {
        $query = $this->db->query("SELECT  *   from package_mapping p  where p.duration - datediff(curdate(),updatedate) < 0 and duration > 0 and status = 1");
        return $query;
    }



    function v_auctionend($cond)
    {
        $this->db->select('*');
        $this->db->from('v_auctionend');
        $this->db->where($cond);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    function v_merchantwithpackage($cond, $searchtxt = "")
    {
        $this->db->select('*');
        $this->db->from('v_merchantwithpackage');
        $this->db->where($cond);
        if ($searchtxt != "") {
            $this->db->like('firstname', $searchtxt);
            $this->db->or_like('lastname', $searchtxt);
            $this->db->or_like('email', $searchtxt);
            $this->db->or_like('tel', $searchtxt);
        }

        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    function v_shopslot($cond)
    {
        $this->db->select('*');
        $this->db->from('v_shopslot');
        $this->db->where($cond);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query;
    }


    function language($cond)
    {
        $this->db->select('*');
        $this->db->from('language');
        $this->db->where($cond);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query;
    }
    function merchantsearch($cond, $searchtxt = "")
    {
        $this->db->select('*');
        $this->db->from('merchant');
        $this->db->where($cond);
        if ($searchtxt != "") {
            $this->db->like('title', $searchtxt);
        }
        $this->db->order_by('status , id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    function merchant($cond)
    {
        $this->db->select('*');
        $this->db->from('merchant');
        $this->db->where($cond);
        $this->db->order_by('status , id', 'desc');
        $query = $this->db->get();
        return $query;
    }

    function shopslot($cond)
    {
        $this->db->select('*');
        $this->db->from('shopslot');
        $this->db->where($cond);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query;
    }
    function v_merchantwithshopslot($cond, $searchtxt = "")
    {
        $this->db->select('*');
        $this->db->from('v_merchantwithshopslot');
        $this->db->where($cond);
        if ($searchtxt != "") {
            $this->db->like('webname', $searchtxt);
            $this->db->or_like('name', $searchtxt);
        }
        $this->db->order_by('status , id', 'desc');
        $query = $this->db->get();
        return $query;
    }


    function aboutus($cond)
    {
        $this->db->select('*');
        $this->db->from('aboutus');
        $this->db->where($cond);
        $this->db->order_by('  id', 'desc');
        $query = $this->db->get();
        return $query;
    }
    function contractus($cond)
    {
        $this->db->select('*');
        $this->db->from('contractus');
        $this->db->where($cond);
        $this->db->order_by('  id', 'desc');
        $query = $this->db->get();
        return $query;
    }




    function package($cond)
    {
        $this->db->select('*');
        $this->db->from('package');
        $this->db->where($cond);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get();
        return $query;
    }
    function searchmerchant($cond, $searchtxt)
    {
        $this->db->select('*');
        $this->db->from('v_merchantwithpackage');
        $this->db->where($cond);
        if ($searchtxt != "") {
            $this->db->like('firstname', $searchtxt);
            $this->db->or_like('lastname', $searchtxt);
            $this->db->or_like('email', $searchtxt);
            $this->db->or_like('tel', $searchtxt);
        }
        $this->db->order_by('status , id', 'desc');
        $query = $this->db->get();
        return $query;
    }


    function v_serchorderbytelandmerchantuid($tel, $lineuid)
    {
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

    function v_salehistory($limit = 0, $offset = 10)
    {
        $this->db->select('*');
        $this->db->from('v_salehistory');
        $this->db->limit(100);
        $query = $this->db->get();
        return $query;
    }


    function merchantin($tokens)
    {
        $this->db->select('*');
        $this->db->where_in('token', $tokens);
        $this->db->from('merchant');
        $query = $this->db->get();
        return $query;
    }

    function v_merchantuid($cond)
    {
        $this->db->select('*');
        $this->db->from('v_merchantuid');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function merchantlineuid($cond)
    {
        $this->db->select('*');
        $this->db->from('merchantlineuid');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function ordertoken($cond)
    {
        $this->db->select('*');
        $this->db->from('ordertoken');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function order($cond)
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }

    function packageorder($cond)
    {
        $this->db->select('a.*,p.packagename,p.price');
        $this->db->from('packageorder a');
        $this->db->join('package p', 'a.packageid = p.id');
        $this->db->where($cond);
        $this->db->limit(1);
        $this->db->order_by('id', "DESC");
        $query = $this->db->get();
        return $query;
    }


    function allpackageorder($cond)
    {
        $this->db->select('a.*,p.packagename,p.price,m.firstname,m.lastname,m.name');
        $this->db->from('packageorder a');
        $this->db->join('package p', 'a.packageid = p.id');
        $this->db->join('merchant m', 'm.id = a.merchantid');
        $this->db->where($cond);
        $this->db->order_by('a.createdate', "DESC");
        $query = $this->db->get();
        return $query;
    }



    function orderdisplaylist($status, $custid, $delivery_iscomplete = 0)
    {
        $query = $this->db->query("SELECT o.id
         ,o.orderno
        ,o.status
        ,o.isconfirm
        ,o.shippingfee
        ,o.shippingaddress
        ,o.payamount
        ,o.imgslip
        ,o.paymentinfo
        ,o.paymentmethodid
        ,o.custid
        ,o.total
        ,o.merchantid
        ,o.delivery_trackid
        ,o.delivery_company
        ,o.delivery_other
        ,m.title
        ,m.image
        ,m.name
        ,m.webname
        FROM `orders` o join merchant m on o.merchantid = m.id
        where o.status  in ($status) AND
        o.closestatus  != 1 AND
        o.delivery_iscomplete  = $delivery_iscomplete AND
        o.custid = '$custid'
        ");

        return $query;
    }


    function orderdisplaylistall($status,  $delivery_iscomplete = 0)
    {
        $query = $this->db->query("SELECT o.id
         ,o.orderno
        ,o.status
        ,o.isconfirm
        ,o.shippingfee
        ,o.shippingaddress
        ,o.payamount
        ,o.imgslip
        ,o.paymentinfo
        ,o.paymentmethodid
        ,o.custid
        ,o.total
        ,o.merchantid
        ,o.delivery_trackid
        ,o.delivery_company
        ,o.delivery_other
        ,m.title
        ,m.image
        ,m.name
        ,m.webname
        FROM `orders` o join merchant m on o.merchantid = m.id
        where o.status  in ($status) AND
        o.closestatus  != 1 AND
        o.delivery_iscomplete  = $delivery_iscomplete 
        ");

        return $query;
    }


    function orderreviewlist($status, $custid, $delivery_iscomplete = 0)
    {
        $query = $this->db->query("select tb.* from (
            SELECT o.id
                     ,o.orderno
                    ,o.status
                    ,o.isconfirm
                    ,o.shippingfee
                    ,o.shippingaddress
                    ,o.payamount
                    ,o.imgslip
                    ,o.paymentinfo
                    ,o.paymentmethodid
                    ,o.custid
                    ,o.total
                    ,o.merchantid
                    ,o.delivery_trackid
                    ,o.delivery_company
                    ,o.delivery_other
                    ,m.title
                    ,m.image
                    ,m.name
                    ,m.webname
                    ,(SELECT count(r.id) FROM review r where r.orderid = o.id) as cntreview
                    ,(SELECT count(od.id) FROM orderdetail od where od.orderid = o.id) as cntorderdetail
                    FROM `orders` o join merchant m on o.merchantid = m.id
                 where o.status  in ($status) AND
                    o.closestatus  != 1 AND
                    o.delivery_iscomplete  =  $delivery_iscomplete  AND
                    o.isauction != 1 AND
                 o.custid = '$custid'
            ) as tb
            where tb.cntorderdetail > tb.cntreview");

        return $query;
    }

    function orderhistory($custid)
    {
        $query = $this->db->query("select tb.* from (
            SELECT o.id
                     ,o.orderno
                     ,o.createdate
                    ,o.status
                    ,o.isconfirm
                    ,o.shippingfee
                    ,o.shippingaddress
                    ,o.payamount
                    ,o.imgslip
                    ,o.paymentinfo
                    ,o.paymentmethodid
                    ,o.custid
                    ,o.total
                    ,o.merchantid
                    ,o.delivery_trackid
                    ,o.delivery_company
                    ,o.delivery_other
                    ,m.title
                    ,m.image
                    ,m.name
                    ,m.webname
                    ,(SELECT count(r.id) FROM review r where r.orderid = o.id) as cntreview
                    ,(SELECT count(od.id) FROM orderdetail od where od.orderid = o.id) as cntorderdetail
                    FROM `orders` o join merchant m on o.merchantid = m.id
                 where o.closestatus  != 1 AND
                    o.delivery_iscomplete  =  1   
                    AND  o.custid = '$custid'
            ) as tb");

        return $query;
    }


    function getoverdueorder($min)
    {
        $query = $this->db->query("SELECT * FROM `orders` WHERE 1=1
        and isauction = 0
        and closestatus = 0
        and status = 1
        and date_add(createdate,interval $min minute) < now()");

        return $query;
    }



    function orderids($uid)
    {
        $this->db->select('orderid');
        $this->db->from('ordertoken');
        $this->db->where_in("uid", $uid);
        $query = $this->db->get();
        return $query;
    }

    function orderin_statusopen($orderids)
    {
        $this->db->select('*');
        $this->db->from('order');
        $this->db->where("status", 1);
        $this->db->where_in("id", $orderids);
        $query = $this->db->get();
        return $query;
    }

    function orderdetail($cond, $notin = null)
    {
        $this->db->select('*');
        $this->db->from('orderdetail');
        $this->db->where($cond);
        if ($notin != null) {
            $this->db->where_not_in('itemid', $notin);
        }
        $query = $this->db->get();
        return $query;
    }

    function getcustomerlist($merchantid)
    {
        $query = $this->db->query("SELECT tb .*,(SELECT tk . token from customer c
inner join `orders` o  
on c . id = o . custid
inner join ordertoken tk 
on tk . orderid = o . id
WHERE c . tel = tb . customertel order by o . id desc limit 1) as lastestordertoken 
from (SELECT a .* FROM `v_serchorderbytelandmerchantuid` a     group by a . customertel)  tb
where tb . merchantid = $merchantid");

        return $query->result();
    }

    function getorderitems($orderid)
    {
        $query = $this->db->query("select  
ii.name,
sum(oo.amount) as sum
from orderdetail  oo
JOIN
items ii
on oo.itemid = ii.id
where orderid  in ($orderid)
 group by ii.id");

        return $query->result();
    }


    function getordersumbybilltoken($billtoken)
    {
        $query = $this->db->query("select   unix_timestamp(b . createdate) as row1,COUNT(a . id) as row2,SUM(b . total) as row3
from ordertoken a
join `orders` b
on a . orderid = b . id
where a . billtoken = '$billtoken'
    and b . closestatus = 0
    and b.createdate BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW()
GROUP BY DATE(b . createdate)
limit 0,30");

        return $query;
    }

    function getdashboarddataforadmin()
    {
        $query = $this->db->query("SELECT
    (select count(id)  from  `orders`  where status not in(3) ) as bills
    ,(select count(id)  from  `orders` where  status not in(3) and  MONTH(createdate) = MONTH(CURRENT_DATE())) as ordermonth
    ,(select count(id)  from  `orders` where  status not in(3) and DATE(createdate) = CURDATE()) as ordertoday 
, (select count(id)  from  `orders` where status in(2)  and closestatus = 0) as paid
, (select count(id)  from  `orders` where status in(1)   and closestatus = 0) as unpaid
, (select count(id)  from  `customer`  ) as usercount
, (select sum(total)  from  `orders` where status in(2) and MONTH(updatedate) = MONTH(CURRENT_DATE())  and closestatus = 0) as monthlytotal
FROM dual");

        return $query;
    }

    function getdashboarddata($merchantid)
    {
        $query = $this->db->query("SELECT
    (select count(id)  from  `orders` where status not in(3) and merchantid = $merchantid and closestatus = 0) as bills
, (select count(id)  from  `orders` where status in(2) and merchantid = $merchantid and closestatus = 0) as paid
, (select count(id)  from  `orders` where status in(1) and merchantid = $merchantid and closestatus = 0) as unpaid
, (select sum(total)  from  `orders` where status in(3) and MONTH(updatedate) = MONTH(CURRENT_DATE()) and merchantid = $merchantid and closestatus = 0) as monthlytotal
FROM dual");

        return $query;
    }
}
