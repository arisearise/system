<?php
require_once 'Base.php';

class users extends Base 
{
    protected $table = 'users';
    public function getUserList()
    {
        $sql = <<<SQL
SELECT * FROM {$this->table}
SQL;
        $param = array();
        return $this->getAll($sql, $param);
    }
    
    public function getUserListById($UsersId)
    {
        $param['user_id'] = $UsersId;
        $sql = <<<SQL
SELECT * FROM {$this->table} WHERE user_id = :user_id
SQL;
        $res =  $this->getOne($sql, $param);
        if (isset($res['user_id'])){
            return $res;
        } else {
            return array();
        }
    }
    
    public function insUsers($list)
    {
        $param['vendor_id']     = $list['vendor_id'];
        $param['vendor_name']     = $list['vendor_name'];
        $param['department_name'] = $list['department_name'];
        $param['zip_code']        = $list['zip_code'];
        $param['address_1']       = $list['address_1'];
        $param['address_2']       = $list['address_2'];
        $param['address_3']       = $list['address_3'];
        $param['tel_no']          = $list['tel_no'];
        $param['fax_no']          = $list['fax_no'];
        $param['email_address']   = $list['email_address'];
        $param['note']            = $list['note'];
        $param['delete_flg']      = '0';
        $param['register_user']   = 1;
        $param['register_date']   = date('Y-m-d H:i:s');
        $param['update_user']     = 1;
        $param['update_date']     = date('Y-m-d H:i:s');
        $sql = <<<SQL
INSERT INTO  {$this->table} VALUES(
  :vendor_id
, :vendor_name
, :department_name
, :zip_code
, :address_1
, :address_2
, :address_3
, :tel_no
, :fax_no
, :email_address
, :note
, :delete_flg
, :register_user
, :register_date
, :update_user
, :update_date
)
SQL;
        $res = $this->execute($sql, $param);
        if ($res) {
            return $res;
        } else {
            echo'<pre>';var_dump($sql, $param, $list);echo'</pre>';
        }
    }
    
    public function updVendors($list)
    {
        if (is_null($list['vendor_id']) ||$list['vendor_id'] === '') {
            echo'<pre>';var_dump($list);echo'</pre>';
            return false;
        }
        $param['vendor_id']     = $list['vendor_id'];
        $param['vendor_name']   = $list['vendor_name'];
        $param['department_name'] = $list['department_name'];
        $param['zip_code']        = $list['zip_code'];
        $param['address_1']       = $list['address_1'];
        $param['address_2']       = $list['address_2'];
        $param['address_3']       = $list['address_3'];
        $param['tel_no']          = $list['tel_no'];
        $param['fax_no']          = $list['fax_no'];
        $param['email_address']   = $list['email_address'];
        $param['note']            = $list['note'];
        $param['delete_flg']      = $list['delete_flg'];
        $param['update_user']     = 1;
        $param['update_date']     = date('Y-m-d H:i:s');
        $sql = <<<SQL
UPDATE {$this->table} SET
  vendor_name      = :vendor_name
, department_name  = :department_name
, zip_code         = :zip_code
, address_1        = :address_1
, address_2        = :address_2
, address_3        = :address_3
, tel_no           = :tel_no
, fax_no           = :fax_no
, email_address    = :email_address
, note             = :note
, delete_flg       = :delete_flg
, update_user     = :update_user
, update_date     = :update_date
 WHERE vendor_id = :vendor_id
SQL;
        $res = $this->execute($sql, $param);
        if ($res) {
            return $res;
        } else {
            echo'<pre>';var_dump($sql, $param);echo'</pre>';
        }
    }
}
