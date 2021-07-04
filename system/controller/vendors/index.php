<?php
/* 文字 UTF-8 */
require_once '../startup.php';
$c  = new startUp();
$page = 'vendors';
$title = '取引先管理';
$style     = $c->setCss($page);
$bootstrap = $c->setCss('bootstrap.min');

require_once MDL .$page . '.php';
$m = new vendors();

require_once '../function.php';
$f = new funta();

for($i =1135448; $i <=1140000; $i++){
$university = $f->setCurlurl('https://fumadata.com/search/detail/',$i);
//echo '<pre>';var_dump($university);exit;

//マイナビ　進学専用格納機	  
//$result = $m->insertMainabiUrl($university[0],$university[1]);

//旺文社｜パスナビ専用格納機
//$insert = $m->insertOubunnUrl($university[0],$university[1]);
//$insert = $m->insertWebBackOubunnurl($university[0],$university[1]);

//fuma専用格納機
$company = $m->insertFumaUrl($university[0],$university[1]);
sleep(1);
continue;
//$i = $i + 5;
}
//$university = $m->getUniversity_json('北海商科大学');
//$university = $c->jdec($university['university_json']);


include  TPL . $page . DS .'index.tpl';
echo $html;
