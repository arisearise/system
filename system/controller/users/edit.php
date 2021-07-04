<?php

/* 文字 UTF-8 */
require_once '../startup.php';
$c  = new startUp();
$page = $c->getPageName($_SERVER["REQUEST_URI"]);
$title = '取引先管理';
$style     = $c->setCss($page);
$bootstrap = $c->setCss('bootstrap.min');

require_once MDL .$page . '.php';
$m = new orders();
$zip2addr  = JS  . 'jquery.zip2addr.js'. CSSV;
require_once MDL .$page . '.php';

$m = new vendors();

isset($_REQUEST['init']          ) ? $para['init']             =        $_REQUEST['init']             : $para['init']            = '';
isset($_REQUEST['status']         ) ? $para['status']          =        $_REQUEST['status']           : $para['status']          = '';
isset($_REQUEST['vendor_id']    ) ? $para['vendor_id']     = intval($_REQUEST['vendor_id']    ) : $para['vendor_id']     = null;
isset($_REQUEST['vendor_name']  ) ? $para['vendor_name']   =        $_REQUEST['vendor_name']    : $para['vendor_name']   = '';
isset($_REQUEST['department_name']) ? $para['department_name'] =        $_REQUEST['department_name']  : $para['department_name'] = '';
isset($_REQUEST['zip_code']       ) ? $para['zip_code']        =        $_REQUEST['zip_code']         : $para['zip_code']        = '';
isset($_REQUEST['address_1']      ) ? $para['address_1']       =        $_REQUEST['address_1']        : $para['address_1']       = '';
isset($_REQUEST['address_2']      ) ? $para['address_2']       =        $_REQUEST['address_2']        : $para['address_2']       = '';
isset($_REQUEST['address_3']      ) ? $para['address_3']       =        $_REQUEST['address_3']        : $para['address_3']       = '';
isset($_REQUEST['tel_no']         ) ? $para['tel_no']          =        $_REQUEST['tel_no']           : $para['tel_no']          = '';
isset($_REQUEST['fax_no']         ) ? $para['fax_no']          =        $_REQUEST['fax_no']           : $para['fax_no']          = '';
isset($_REQUEST['email_address']  ) ? $para['email_address']   =        $_REQUEST['email_address']    : $para['email_address']   = '';
isset($_REQUEST['note']           ) ? $para['note']            =        $_REQUEST['note']             : $para['note']            = '';
isset($_REQUEST['delete_flg']     ) ? $para['delete_flg']      =        $_REQUEST['delete_flg']       : $para['delete_flg']      = '0';

switch ($para['status']) {
	case 'update':
    	$subTitle = '変更';
		break;
	case 'delete':
    	$subTitle = '削除';
		break;
	default:
    	$subTitle = '登録';
}
if ($para['init'] === '') {
    $customerList = $m->getVendorListById($para['vendor_id']);
	isset($customerList['vendor_name']  )   ? $para['vendor_name']     = $customerList['vendor_name']     : $para['vendor_name']   = '';
	isset($customerList['department_name']) ? $para['department_name'] = $customerList['department_name'] : $para['department_name'] = '';
	isset($customerList['zip_code'])        ? $para['zip_code']        = $customerList['zip_code']        : $para['zip_code']        = '';
	isset($customerList['address_1'])       ? $para['address_1']       = $customerList['address_1']       : $para['address_1']       = '';
	isset($customerList['address_2'])       ? $para['address_2']       = $customerList['address_2']       : $para['address_2']       = '';
	isset($customerList['address_3'])       ? $para['address_3']       = $customerList['address_3']       : $para['address_3']       = '';
	isset($customerList['tel_no'])          ? $para['tel_no']          = $customerList['tel_no']          : $para['tel_no']          = '';
	isset($customerList['fax_no'])          ? $para['fax_no']          = $customerList['fax_no']          : $para['fax_no']          = '';
	isset($customerList['email_address'])   ? $para['email_address']   = $customerList['email_address']   : $para['email_address']   = '';
	isset($customerList['note'])            ? $para['note']            = $customerList['note']            : $para['note']            = '';
	isset($customerList['delete_flg'])      ? $para['delete_flg']      = $customerList['delete_flg']      : $para['delete_flg']      = '0';
	$para['init'] = '1';
}

$message = '';
if (isset($_REQUEST['submit'])){
    // ToDo Varidation
    
    if ($message === '') {
         switch ($para['status']){
			case 'update':
				$res = $m->updVendors($para);
				break;
			case 'delete':
				$para['delete_flg'] = '1';
				$res = $m->updVendors($para);
				break;
			default:
				$res = $m->insVendors($para);
         }
         if ($res) {
             header('Location: index.php');exit;
         }
    }
}
include TPL . $page . DS . 'edit.tpl';
echo $html;
