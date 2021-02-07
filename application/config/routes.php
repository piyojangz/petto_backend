<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */


if (preg_match('/.+\.perdbill\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
    $route['default_controller'] = 'Web';
    $route['(:any)'] = "web/subpage/$1";
    $route['items'] = "web/subitems"; ;
    $route['item/(:any)/(:any)'] = "web/subitem/$1/$2";
    $route['post/(:any)/(:any)'] = "web/subpost/$1/$2";

}
elseif (preg_match('/.+\.(zoaish|rochubeauty)\.(com|co)$/', $_SERVER['HTTP_HOST'])) {
    $route['default_controller'] = 'Web/mapdomain';
    $route['(:any)'] = "web/webpage/$1";
    $route['items'] = "web/mapitems"; ;
    $route['item/(:any)/(:any)'] = "web/mapitem/$1/$2";
    $route['post/(:any)/(:any)'] = "web/mappost/$1/$2";
    $route['item/detail/1012/(:any)'] = "web/mapitem/3/$1";
}
else {
    $route['default_controller'] = 'home';
    $route['404_override'] = '';
    $route['translate_uri_dashes'] = FALSE;

    
    $route['webhook'] = "webhook/index/"; 
    
    
    $route['logout'] = "logout/index/";
    $route['register'] = "register/index/";
    $route['login'] = "login/index/";
    $route['(:any)'] = "bill/index/$1";
    $route['shipinginfo/(:any)'] = "order/payment/$1";
    $route['track/(:any)'] = "order/trackorder/$1";
    $route['track/(:any)/(:any)'] = "order/trackorder/$1/$2";
    $route['paymentsuccess/(:any)'] = "order/paymentsuccess/$1";
    $route['pro/(:any)/(:any)'] = "bill/pro/$1/$2";

    $route['account'] = "account/index/";
    $route['account/(:any)'] = "account/index/$1";
    $route['account/(:any)/userlist'] = "account/userlist";
    $route['account/(:any)/banlist'] = "account/banlist";
    $route['account/(:any)/package'] = "account/package/$1"; 
    $route['account/(:any)/changeuserstatus'] = "account/changeuserstatus/$1";
    $route['account/(:any)/setting_lang'] = "account/setting_lang/$1"; 
    $route['account/(:any)/changeuserpackage'] = "account/changeuserpackage/$1";
    $route['account/(:any)/dashboard'] = "account/dashboard/$1";
    $route['account/(:any)/products'] = "account/products/$1";
    $route['account/(:any)/auction'] = "account/auction/$1";
    $route['account/(:any)/productcate'] = "account/productcate/$1";
    $route['account/(:any)/setting'] = "account/setting/$1";
    $route['account/(:any)/setting_home'] = "account/setting_home/$1";
    $route['account/(:any)/setting_ads_banner'] = "account/setting_ads_banner/$1";
    $route['account/(:any)/setting_about'] = "account/setting_about/$1";
    $route['account/(:any)/setting_contact'] = "account/setting_contact/$1";
    $route['account/(:any)/setting_gganalytic'] = "account/setting_gganalytic/$1";
    $route['account/(:any)/setting_post'] = "account/setting_post/$1";
    $route['account/(:any)/customer'] = "account/customer/$1";
    $route['account/(:any)/order/all'] = "account/orderall/$1";
    $route['account/(:any)/paymentmethod'] = "account/paymentmethod/$1";
    $route['account/(:any)/shippingrate'] = "account/shippingrate/$1";
    $route['account/(:any)/base64_to_jpeg'] = "account/base64_to_jpeg";
    $route['account/(:any)/addnewproduct'] = "account/addnewproduct/$1";
    $route['account/(:any)/addnewcate'] = "account/addnewcate/$1";
    $route['account/(:any)/addnewpaymentmethod'] = "account/addnewpaymentmethod/$1";
    $route['account/(:any)/addnewshippingrate'] = "account/addnewshippingrate/$1";
    $route['account/(:any)/updatesetting'] = "account/updatesetting/$1";
    $route['account/(:any)/updatehomesetting'] = "account/updatehomesetting/$1";
    $route['account/(:any)/updateaboutsetting'] = "account/updateaboutsetting/$1";
    $route['account/(:any)/updatecontactsetting'] = "account/updatecontactsetting/$1";
    $route['account/(:any)/updategganalyticsetting'] = "account/updategganalyticsetting/$1";
    $route['account/(:any)/addcover'] = "account/addcover/$1";
    $route['account/(:any)/shopslot'] = "account/shopslot/$1";
    $route['account/(:any)/addarticle'] = "account/addarticle/$1";



    $route['account/(:any)/info'] = "account/info/$1";
    $route['promoinfo/(:any)'] = "order/promoinfo/$1";
    $route['sendinfotouser/(:any)/(:any)/(:any)/(:any)'] = "order/sendinfotouser/$1/$2/$3/$4";

    /* test */

    $route['web/(:any)'] = "web/test/$1";
    $route['web/(:any)/items'] = "web/items/$1";
    $route['web/(:any)/(:any)'] = "web/page/$1/$2";
    $route['web/(:any)/item/(:any)/(:any)'] = "web/item/$1/$2/$3";
    $route['web/(:any)/post/(:any)/(:any)'] = "web/post/$1/$2/$3";
}

