<?php

/* 文字 UTF-8 */
require_once '../startup.php';
$c  = new startUp();
$page = $c->getPageName($_SERVER["REQUEST_URI"]);
$title = '大学一覧';
$style     = $c->setCss($page);
$bootstrap = $c->setCss('bootstrap.min');
$homeImg = IMG ."dashboard" .".png";
$university_js = $c->setJs($page);

require_once '../function.php';
$f = new funta();
//$json = $c->jdec(file_get_contents(SCLRCR .KWDRCR ."&keyword=旭川医科大学&format=json"));
//var_dump($json['results']['school'][0]);

require_once MDL .$page . '.php';
$m = new university();
$data = $m->getUniversity();
$university='';
//$decodeUniversity = $c->jdec(file_get_contents(SCLRCR .KWDRCR ."&keyword=".$d ."&format=json"));
foreach($data as $d=>$key){
	$val = trim($key['university_name']);
	$university .= "<form name='university-{$d}' id='id-{$d}'  action='/system/controller/university/index.php' method='post'>\n";
	$university .= "<div class='university' onClick='onSubmit($d)'>\n";
	$university .= "	<span name='university-span'>".$val."</sapn>\n";
	$university .= "	<input type='hidden' name='university_name' id='university_name-{$d}' value= {$key['university_name']}>\n";
	$university .= "</div>\n";
	$university .= "</form>\n";
}

$key1 = $_POST['university_name'];
var_dump($key1);
$shuushoku = $m->getShuushoku($key1);
$shuushoku = $c->jdec($shuushoku);
//echo '<pre>';var_dump(preg_grep('/就職者総数/',$shuushoku));exit;
echo '<pre>';var_dump($shuushoku);exit;



/*$code1 = '';
$code1 .= "<div>{$shuushoku['1146']}</div>\n";
$code1 .= "   <div style='padding-left:25px'>{$shuushoku['1151']}  <span style='text-align:right'>{$shuushoku['1153']} </span> </div>\n";
$code1 .= "   <div style='padding-left:25px'>{$shuushoku['1161']}  <span style='text-align:right'>{$shuushoku['1163']} </span> </div>\n";
$code1 .= "   <div style='padding-left:25px'>{$shuushoku['1171']}  <span style='text-align:right'>{$shuushoku['1173']} </span> </div>\n" ;
$code1 .= "   <div style='padding-left:25px'> その他 {$shuushoku['1184']} </div>\n";
$code1 .= */


		
include  TPL . $page . DS .'index.tpl';
echo $html;
