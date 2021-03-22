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

    function v_order($cond, $notin = null, $in = null)
    {
        if ($notin != null) {
            $this->db->where_not_in('status', $notin);
        }
        if ($in != null) {
            $this->db->where_in('status', $in);
        }
        $this->db->select('*');
        $this->db->from('v_order');
        $this->db->where($cond);
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
        $this->db->select('DATE_FORMAT(submitdate,\'%d/%m/%Y\')   as `วันที่ส่งข้อมูล`,DATE_FORMAT(submitdate,\'%H:%i:%s\')   as `เวลาที่ส่งข้อมูล`,fullname as ชื่อ-สกุล,billingaddress ที่อยู่สำหรับจัดส่ง,CONCAT("_",tel) เบอร์โทร,total จำนวนเงินโอน, paymentinfo เวลาโอน, accno เลขบัญชี, bankname ธนาคาร , orderitems รายการสินค้า , 	sumamount ยอดสั่งรวม/ชิ้น');
        $this->db->from('v_order');
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

    function imagescover($cond)
    {
        $this->db->select('*');
        $this->db->from('imagescover');
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

    function items($cond)
    {
        $this->db->select('*');
        $this->db->from('items');
        $this->db->where($cond);
        $query = $this->db->get();
        return $query;
    }



    function itemsbycateid($cond)
    {
        $this->db->select('*');
        $this->db->from('items');
        $this->db->where($cond);
        $this->db->or_where('cateid1 = ', $cond['cateid']);
        $this->db->or_where('cateid2 = ', $cond['cateid']);
        $query = $this->db->get();
        return $query;
    }

    function v_product($cond, $limit = "")
    {
        if ($limit != "") {
            $this->db->limit($limit, 0);
        }
        $this->db->select('*');
        $this->db->from('v_product');
        $this->db->where($cond);
        $this->db->order_by('updatedate','desc');
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

    function auctionlist($cond)
    {
        $this->db->select('*');
        $this->db->from('auctionlist');
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




    function v_merchantwithpackage($cond)
    {
        $this->db->select('*');
        $this->db->from('v_merchantwithpackage');
        $this->db->where($cond);
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
    function v_merchantwithshopslot($cond)
    {
        $this->db->select('*');
        $this->db->from('v_merchantwithshopslot');
        $this->db->where($cond);
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
        $this->db->like('firstname', $searchtxt);
        $this->db->or_like('lastname', $searchtxt);
        $this->db->or_like('email', $searchtxt);
        $this->db->or_like('tel', $searchtxt);
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

    function v_salehistory($lineuid, $merchantid, $limit = 0, $offset = 10)
    {
        $query = $this->db->query("select sum(`a`.`total`) AS `total`,cast(`a`.`submitdate` as date) AS `date`,`b`.`uid` AS `uid`,(select group_concat(concat(`a`.`id`) separator ', ')) AS `orderitems`,`b`.`merchantid` AS `merchantid` from (`order` `a` join `ordertoken` `b` on((`a`.`id` = `b`.`orderid`))) where ((`a`.`status` in (2,3)) and (`a`.`closestatus` = 0) and (b.uid = '$lineuid') and (`b`.`merchantid` = $merchantid)) group by cast(`a`.`submitdate` as date)  order by a.submitdate desc limit $limit , $offset");
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

    function orderdetail($cond)
    {
        $this->db->select('*');
        $this->db->from('orderdetail');
        $this->db->where($cond);
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
on oo.itemsid = ii.id
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

    function getdashboarddata($merchantid)
    {
        $query = $this->db->query("SELECT
    (select count(id)  from  `orders` where merchantid = $merchantid and closestatus = 0) as bills
, (select count(id)  from  `orders` where status in(2, 3) and merchantid = $merchantid and closestatus = 0) as paid
, (select count(id)  from  `orders` where status in(1) and merchantid = $merchantid and closestatus = 0) as unpaid
, (select sum(total)  from  `orders` where status in(2, 3) and MONTH(updatedate) = MONTH(CURRENT_DATE()) and merchantid = $merchantid and closestatus = 0) as monthlytotal
FROM dual");

        return $query;
    }
}
