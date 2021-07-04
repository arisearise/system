<?php

class funta
{
	public function __construct(){
		 $this->setApi();
	}
	
	public function getcsv($csv,$tag1,$tag2)
	{
	$company = '';
	$prefectures = fopen($csv ,'r'); 
		if($prefectures === FALSE) {
		//エラー
		throw new Exception('Error: Failed to open file (' . $csv . ')');
		}
		$list = file($csv);
		foreach ($list as $key=>$val) {
	  		$company .= "$tag1\n";
	  		$university = trim($val); 
	  		$company .= "<form name='university' id='university_id'  action='../university' method='post'>\n";
	  		$company .= "	<div class='university_span' onclick='onSubmit($key)'>\n";
	  		$company .= "		<span>{$university}</span>\n";
	  		//$company .= "		<span id ='university_name-{$key} class='university-span' onClick=Click($key) >" .$val ."</span>";  
	  		$company .= "		<input id='university_name-{$key}' type='hidden' name='university_name' value='https://webservice.recruit.co.jp/shingaku/school/v1/?key=58b34f6a0e2f82e6&keyword={$university}&format=json'>\n";
	  		$company .= "	</div>\n";
	  		$company .= "</form>\n";
	  		$company .= "$tag2\n";
	 	}
	 return $company;
	var_dump($company);
	fclose($prefectures);
	}
	
	public function getResasApi($param){
		$header = array("X-API-KEY:$param");
		$options = array("http" =>
			array(
				"method" => "GET",
				"header" => implode("\r\n",$header),
			)
		);
		$getAdvanceData=$c->jdec(file_get_contents("https://opendata.resas-portal.go.jp/api/v1/regionalEmploy/analysis/portfolio?prefCode=12&year=2016&matter=1&class=2",false,stream_context_create($options)));

	}
	
	public function setCompanyName($post)
	{
		if($_POST['company_name'] === '平郡町') {
			$localcode = $_POST['company_name'];
		} elseif (preg_match('/郡/',$_POST['company_name'])){
			$localcode = explode('郡',$_POST['company_name']);
		} else {
			$localcode = $_POST['company_name'];
		}
	return $localcode;exit;
	}
	
	public function setCurlurl($url,$i) 
	{
	  $i = str_pad($i, 7, 0, STR_PAD_LEFT);
  	  $url = $url.$i;
	  $conn = curl_init(); // cURLセッションの初期化
   	  curl_setopt($conn, CURLOPT_URL, $url); //　取得するURLを指定
  	  curl_setopt($conn, CURLOPT_RETURNTRANSFER, true); // 実行結果を文字列で返す。
  	  $res =  curl_exec($conn);
	  curl_close($conn); //セッションの終了
	  return array($res,$url);
	 }

	private function setApi()
	{
		//リクルートAPI用URL
		if(! defined("SCLRCR"	)	) { define("SCLRCR","https://webservice.recruit.co.jp/shingaku/school/v1/?key=");}
		if(! defined("WRKRCR"	)	) { define("WRKRCR","https://webservice.recruit.co.jp/shingaku/work/v1/?key=");}
		if(! defined("KWDRCR"	)	) { define("KWDRCR","58b34f6a0e2f82e6");}
		
		//yahooAPI専用URI
		if(! defined("CMPYHO"	)	) { define("CMPYHO","https://job.yahooapis.jp/v1/furusato/company/?appid=");}
		if( !defined("WRKYHO"	)	) { define("WRKYHO","https://job.yahooapis.jp/v1/furusato/jobinfo/?appid=");}
		if(! defined("KWDYHO"	)	) { define("KWDYHO","dj00aiZpPVJoNU9YRGZNYmhidSZzPWNvbnN1bWVyc2VjcmV0Jng9NmU-");}
		if(! defined("SCRYHO"	)	) { define("SCRYHO","LoNFZ21vCm0s6Pt7qvDqXukrKfig7vYTQtq2VrVh");}
		
		//しごとナビ専用URI
		if(! defined("SGTRCR"	)	) { define("SGTRCR","http://www.shigotonavi.co.jp/api/search/?key=");}
		if(! defined("KWDSGT"	)	) { define("KWDSGT","eb1c123ffe5be41a3fe06b5653950c20");}
		
		//RESAS専用URI
		if(! defined("KWDRESAS"	)	) { define("KWDRESAS","KwEeKP8TlBITjfahxjmGX77SJSGulMfV5SYUI1XY");}
		if(! defined("RSSEdcApi")	) { define("RSSEdcApi","https://opendata.resas-portal.go.jp/api/v1/employEducation/localjobAcademic/toTransition");}	
	}
	
}
?>