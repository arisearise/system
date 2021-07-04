<?php
/* 文字 UTF-8 */
require_once '../startup.php';
$c  = new startUp();
$page = $c->getPageName($_SERVER["REQUEST_URI"]);
$title = '企業・業界・業種検索';
$style     = $c->setCss($page);
$bootstrap = $c->setCss('bootstrap.min');
$jsImg = $c->setJs($page);
$homeImg = IMG .'dashboard' .'.png';

require_once MDL .$page . '.php';
$m = new company();
$cmpList ='';
$company = $m->setCompany();
foreach($company as $key=>$cmp) {
	$cmp_name = trim($cmp['company_name']);
	$cmp_location= trim($cmp['company_id']);
	$cmpList .= "<form  id = 'id-{$key}' action = '/system/controller/company/index.php' method='post'>\n";
	$cmpList .= "	<div class='companyList' onClick='onSubmit($key)'>$cmp_name</div>\n";
	$cmpList .= "	<input type='hidden' name='company_name' id='company_name-{$key}' value= {$cmp_location}>\n";
	$cmpList .= "</form>\n";
}
require_once '../function.php';
$f = new funta();
$i = 1001;
/*for($i = 10001; $i <= 16000; $i++) {
//$getYahooApi = $c->jdec(file_get_contents(WRKYHO .KWDYHO .'&start='.$i.'&results=1'));
$getYahooApi = $c->jdec(file_get_contents(CMPYHO .KWDYHO .'&start='.$i .'&results=1'));
//var_dump($getYahooApi['results'][0]['corporationId']);
//$recruitResult = $m->insertYahooRecruitApi($getYahooApi['results'][0]);
$recruitResult = $m->insertYahooCompanyApi($getYahooApi['results'][0]);
}*/

include  TPL . $page . DS .'index.tpl';
echo $html;
