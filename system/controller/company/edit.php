<?php

/* 文字 UTF-8 */
require_once '../startup.php';
$c  = new startUp();
$page = $c->getPageName($_SERVER["REQUEST_URI"]);
$title = '加工品目管理';
$style     = $c->setCss($page);
$bootstrap = $c->setCss('bootstrap.min');

require_once MDL .$page . '.php';
$m = new products();

isset($_REQUEST['init']         ) ? $para['init']         =        $_REQUEST['init']         : $para['init']         = '';
isset($_REQUEST['status']       ) ? $para['status']       =        $_REQUEST['status']       : $para['status']       = '';
isset($_REQUEST['product_id']   ) ? $para['product_id']   = intval($_REQUEST['product_id'] ) : $para['product_id']   = null;
isset($_REQUEST['product_name'] ) ? $para['product_name'] =        $_REQUEST['product_name'] : $para['product_name'] = '';
isset($_REQUEST['product_type'] ) ? $para['product_type'] =        $_REQUEST['product_type'] : $para['product_type'] = '';
isset($_REQUEST['note']         ) ? $para['note']         =        $_REQUEST['note']         : $para['note']         = '';
isset($_REQUEST['delete_flg']   ) ? $para['delete_flg']   =        $_REQUEST['delete_flg']   : $para['delete_flg']   = '0';

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
    $productList = $m->getProductListById($para['product_id']);
	isset($productList['product_name']   ) ? $para['product_name'] = $productList['product_name'] : $para['product_name'] = '';
	isset($productList['department_name']) ? $para['product_type'] = $productList['product_type'] : $para['product_type'] = '';
	isset($productList['note']           ) ? $para['note']         = $productList['note']         : $para['note']         = '';
	isset($productList['delete_flg']     ) ? $para['delete_flg']   = $productList['delete_flg']   : $para['delete_flg']   = '0';
	$para['init'] = '1';
}

$message = '';
if (isset($_REQUEST['submit'])){
    // ToDo Varidation
    
    if ($message === '') {
         switch ($para['status']){
			case 'update':
				$res = $m->updProducts($para);
				break;
			case 'delete':
				$para['delete_flg'] = '1';
				$res = $m->updProducts($para);
				break;
			default:
				$res = $m->insProducts($para);
         }
         if ($res) {
             header('Location: index.php');exit;
         }
    }
}
include TPL . $page . DS . 'edit.tpl';
echo $html;
