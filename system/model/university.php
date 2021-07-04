<?php
require_once 'Base.php';

class university extends Base 
{
 
    public function getUniversity(){
    $sql =<<<SQL
SELECT * FROM university_json  
SQL;
	return $this->getAll($sql);
	}
	
	public function getShuushoku($university_name)
	{
		$param['university_name'] = $university_name;
		$sql = <<<SQL
SELECT * FROM university_json WHERE university_name = :university_name
SQL;
	$res = $this->getOne($sql,$param);
	return $res['university_json'];
	}
	
/*	public function updUniversity_json($university,$i)
	{
		$param['undergraduate'] =$university[$i]; 
		$i = $i + 5;
		$param['graduated'] = $universtiy[$i];
		$param['graduated_number'] = $universtiy[$i];
		$param['job applicants'] = $university[$i];
		$param['']
		$sql=<<<SQL
INSERT INTO university_json VALUES( 
:afterRecord
)
SQL;
 */
}
