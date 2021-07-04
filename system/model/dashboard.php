<?php
require_once 'Base.php';

class dashboard extends Base 
{
    public function getList()
    {
        $sql = <<<SQL
SELECT * FROM users
SQL;
        $param = array();
        return $this->getAll($sql, $param);
    }
    
    public function getListByMail($mail)
    {
        $param["mail"] = $mail;
        $sql = <<<SQL
SELECT * FROM users WHERE mail = :mail
SQL;
        $res =  $this->getOne($sql, $param);
        if (isset($res["mail"])){
            return $res;
        } else {
            return array();
        }
    }
    
    public function addUser($mail, $password)
    {
        $param["mail"]     = $mail;
        $param["password"] = $password;
        
        $sql = <<<SQL
INSERT INTO  users VALUES(
  :mail
, :password
, now()
)
SQL;
        return $this->execute($sql, $param);
    }
	public function getData($prefecture_id)
	{
		$param['prefecture_id'] = $prefecture_id;
		$sql = <<<SQL
SELECT * FROM prefectures WHERE prefecture_id = :prefecture_id LIMIT 20
SQL;
		$res=$this->getAll($sql,$param);
		if($res) {
			return $res;
		}else {
			return array();
		}
		
	}
}
