<?php
require_once 'Base.php';

class vendors extends Base 
{
    
    //スタディサプリ専用curl格納メソッド
    public function insertMainabiUrl($res,$url)
    {
		preg_match_all('/(<[^>]+>[^<]+<\/[^>]+>|[^<]+)/', $res, $res);
       	$param['university_json'] = json_encode($res[0]);
       	
		$res = preg_replace("/<title[^>]*>|<\/title>|[\r\n]/","",$res[0][3]);
       	$res = explode('／',$res);
		$param['university_name'] = $res[0];
		
		$res = explode('】',$res[1]);
		$res = explode('【',$res[0]);
		$param['publisher_name'] = $res[1];
		
		$param['university_url'] = $url;
    	$sql =<<<SQL
INSERT INTO university_json(university_name,publisher_name,university_url,university_json)  VALUES(
  :university_name
, :publisher_name
, :university_url
, :university_json
	)
SQL;
	 $res = $this->execute($sql, $param);
        if ($res) {
            return $res;
        } else {
            echo'<pre>';var_dump($sql, $param);echo'</pre>';
        }
    }
    
    //旺文社用curl格納メソッド
    public function insertOubunnurl($res,$url)
    {
    	preg_match_all('/(<[^>]+>[^<]+<\/[^>]+>|[^<]+)/', $res, $res);
       	var_dump($res[0][7]);
       	$param['university_json'] = json_encode($res[0]);
       	 
       	
		$res = preg_replace("/<title[^>]*>|<\/title>|[\r\n]/","",$res[0][7]);
		$res = explode('/',$res);
		$param['university_name'] = $res[0];
		
       	$res = explode('|',$res[1]);
       	$res = $res[0];
       	$res = explode(' ｜',$res);
		$param['publisher_name'] = $res[1];
				
		$param['university_url'] = $url;
    	$sql =<<<SQL
INSERT INTO university_json(university_name,publisher_name,university_url,university_json) VALUES(
  :university_name
, :publisher_name
, :university_url
, :university_json
	)
SQL;
	 $res = $this->execute($sql, $param);
        if ($res) {
            return $res;
        } else {
            echo'<pre>';var_dump($sql, $param);
        }
    }
       
   	//webbackmachine専用1curl格納メソッド
    public function insertWebBackOubunnurl($res,$url)
    {
    	preg_match_all('/(<[^>]+>[^<]+<\/[^>]+>|[^<]+)/', $res, $res);
       	$param['university_json'] = json_encode($res[0]);
       	
       	       	
		$res = preg_replace("/<title[^>]*>|<\/title>|[\r\n]/","",$res[0][19]);
		$res = explode('/',$res);
		$param['university_name'] = $res[0];
		
       	$res = explode('|',$res[1]);
       	$res = $res[0];
       	$res = explode(' ｜',$res);
		$param['publisher_name'] = $res[1];
				
		$param['university_url'] = $url;
    	$sql =<<<SQL
INSERT INTO university_json(university_name,publisher_name,university_url,university_json) VALUES(
  :university_name
, :publisher_name
, :university_url
, :university_json
	)
SQL;
	 $res = $this->execute($sql, $param);
        if ($res) {
            return $res;
        } else {
            echo'<pre>';var_dump($sql, $param);
        }
    }
  public function getUniversity_json($university_name)
  {
  	$param['university_name'] = $university_name;
  	$sql = <<<SQL
SELECT * FROM university_json WHERE university_name = :university_name
SQL;
	
	$res=$this->getOne($sql,$param);
	if($res) {
		return $res;
	} else {
		echo'<pre>';var_dump($sql, $param);
	}
  }
  public function insertFumaUrl($res,$url)
  {
    	preg_match_all('/(<[^>]+>[^<]+<\/[^>]+>|[^<]+)/', $res, $res);
       	$param['companyUrl_json'] = json_encode($res[0]);
       	
  		$res = preg_replace("/<title[^>]*>|<\/title>|[\r\n]/","",$res[0][19]);

  		if(empty($res)){
  			return 'No data';exit;
  		}

		$res = explode('|',$res);
		$res1 = explode('の',$res[0]);
		$param['company_name'] = $res1[0];
				
		$res = explode('|',$res[1]);
       	$res = $res[0];
       	$res = explode(' ｜',$res);
		$param['publisher_name'] = $res[0];
				
		$param['company_url'] = $url;
    	$sql =<<<SQL
INSERT INTO conpanyUrl_json(company_name,publisher_name,company_url,companyUrl_json) VALUES(
  :company_name
, :publisher_name
, :company_url
, :companyUrl_json
	)
SQL;
	 $res = $this->execute($sql, $param);
        if ($res) {
            return $res;
        } else {
            echo'<pre>';var_dump($sql, $param);
        }
    }
  
}
