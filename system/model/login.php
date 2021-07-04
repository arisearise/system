<?php
require_once 'Base.php';

class login extends Base 
{
    public function getList()
    {
        $sql = <<<SQL
SELECT * FROM users
SQL;
        $param = array();
        return $this->getAll($sql, $param);
    }
    
    public function getListByMail($list)
    {
        $param['email']      = $list['email'];
        $sql = <<<SQL
SELECT * FROM users WHERE email = :email
SQL;
        $res =  $this->getOne($sql, $param);
        if (isset($res['email'])){
            return $res;
        } else {
            return array();
        }
    }
    
    public function addUser($list)
    {
        $param['user_name']     = $list['user_name'];
        $param['email']         = $list['email'];
        $param['password']      = $list['pass1'];
        $param['delete_flg']    = '0';
        $param['register_user'] = 1;
        $param['register_date'] = date('Y-m-d H:i:s');
        $param['updated_user']  = 1;
        $param['updated_date']  = date('Y-m-d H:i:s');
        $sql = <<<SQL
INSERT INTO  users VALUES(
  null
, :user_name
, :email
, :password
, :delete_flg
, :register_user
, :register_date
, :updated_user
, :updated_date
)
SQL;
        return $this->execute($sql, $param);
    }
}
