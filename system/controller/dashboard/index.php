<?php
/* 文字 UTF-8 */
require_once '../startup.php';
$c  = new startUp();
$page = $c->getPageName($_SERVER["REQUEST_URI"]);
$title = "ダッシュボード";
$style     = $c->setCss($page);
$bootstrap = $c->setCss('bootstrap.min');
$homeImg = IMG .$page .'.png';

$company = '';
isset($_REQUEST['prefecture_id']    ) ? $para['prefecture_id']     = intval($_REQUEST['prefecture_id']    ) : $para['prefecture_id']     = 0;

require_once "../function.php";
$f = new funta();
$json = $c->jdec(file_get_contents(CMPYHO .KWDYHO .'&results=' .'100'));
//$json_work = $c->jdec(file_get_contents(WRKYHO .KWDYHO));
//var_dump($json_work);
$i = 0;
$employee='';
$occupation ='';
$link = '';

require_once MDL .$page . '.php';
$m = new dashboard();
var_dump($_REQUEST);
$data = $m->getData($para['prefecture_id']);
if(! empty($data)) {
	foreach($data as $d) {
	/*	if( isset($link)) {
			$link = $json["results"][$i]["webUrl"] ;
			$employee = $json_work["results"][$i]["employmentTypeNote"];
			$occupation = $json_work["results"][$i]["occupationCode"];

		}*/
		$company .= "<tr>\n";
		$company .= "    <td><a href = 'detail.php'>" .$d['company_name'] ."</a></td>\n";
		$company .="    <td>" .$occupation ."</td>\n";
		$company .="    <td>" .$employee ."</td>\n";
		$company .="    <td><a href = $link>" .$link ."</td>\n";
		$company .= "</tr>\n" ;
		$i++;
		if($i >= 9){
			$link = null;
		}
		//var_dump($occupation);
	}
}
//var_dump($link);
$pref = array(0=>'',1=>'北海道',2=>'青森',3=>'岩手',4=>'宮城',5=>'秋田',6=>'山形',7=>'福島',8=>'茨城',9=>'栃木',10=>'群馬',11=>'埼玉',12=>'千葉',13=>'東京',14=>'神奈川',15=>'新潟',16=>'富山',17=>'石川',18=>'福井',19=>'山梨',20=>'長野',21=>'岐阜',22=>'静岡',23=>'愛知',24=>'三重',25=>'滋賀',26=>'京都',27=>'大阪',28=>'兵庫',29=>'奈良',30=>'和歌山',31=>'鳥取',32=>'島根',33=>'岡山',34=>'広島',35=>'山口',36=>'徳島',37=>'香川',38=>'愛媛',39=>'高知',40=>'福岡',41=>'佐賀',42=>'長崎',43=>'熊本',44=>'大分',45=>'宮崎',46=>'鹿児島',47=>'沖縄');
$select_pref = $c->setPullDown($para,'prefecture_id','60',$pref);
  
include TPL . $page . DS . "index.tpl";
echo $html;
