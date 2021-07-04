<?php
class Base
{
    private $pdo;
    private $host = "localhost";
    private $db   = "rikudb";
    private $user = "root";
    private $pass = "";
    private $ini;
    
       
    public function __constract(){}
    
    public function conPdo() { return $this->connect(); }
    
    public function connect()
    {
       // $this->setDbIni('prod');
        try{
            $this->pdo = new PDO("mysql:dbname={$this->db};host={$this->host};charset=utf8","{$this->user}","{$this->pass}",array(PDO::ATTR_EMULATE_PREPARES => true));
            return $this->pdo;
        } catch (PDOException $e) {
            print('Error:'.$e->getMessage());
            exit;
        }
    }
    
    /**************************************************************************
     * public getOne ＤＢデータ取得（１レコード）
     * @param ( $sql=null, $params=array() )
     * @return  $statement->fetch(PDO::FETCH_ASSOC)  array()
     **************************************************************************/
    public function getOne( $sql=null, $params=array() )
    {
        try {
            if ( get_magic_quotes_gpc() && count($params) > 0 ){
                $params = $this->cutSlash( $params );
            }
            
            $statement = $this->getPrepare( $sql );
            $result = $statement->execute( $params );
            if( $result ){
                return $statement->fetch(PDO::FETCH_ASSOC);
            }
        }catch (PgException $e) {
            echo 'Error:'. $e->getMessage();
            return array();
        }
    }
    
    /**************************************************************************
     * public getAll ＤＢデータ取得（全レコード）
     * @param ( $sql=null, $params=array() )
     * @return  $data  array()
     **************************************************************************/
    public function getAll( $sql=null, $param=array() )
    {
        try {
            if ( get_magic_quotes_gpc() && count($param) > 0 ) {
                $param = $this->cutSlash( $param );
            }
            $statement = $this->getPrepare( $sql );
            $result = $statement->execute( $param );
            if (! $result ){ return false;}
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            if (! $data ){ $return = array(); }else{ return $data; }
        }catch (PgException $e) {
               echo 'Error:'. $e->getMessage();
               return array();
        }
    }
    
    /**************************************************************************
     * public execute ＳＱＬ実行
     * @param ( $sql=null, $params=array() )
     * @return  true  false
     **************************************************************************/
    public function execute($sql=null, $param=array())
    {
        try {
            if ( get_magic_quotes_gpc() && count($param) > 0 ){ 
                $param = $this->cutSlash( $param );
            }
            $statement = $this->getPrepare( $sql );
            $result = $statement->execute( $param );
            if (! $result ){ return false;}else{return true;}
        }catch (PgException $e) {
            echo 'Error:'. $e->getMessage();
            return false;
        }
    }
    
    /**************************************************************************
     * public enc サニタイズ
     * @param ( $str )
     * @return  $str
     **************************************************************************/
    public function enc( $str )
    {
        return htmlentities( $str, ENT_QUOTES, 'UTF-8', false );
    }
    
    
    /**************************************************************************
     * public setDevice デバイス判定
     * @param ( $ua )
     * @return $dev
     **************************************************************************/
    public function setDevice( $ua )
    {
        $dev = 'PC';
        switch( $ua ){
            case strpos( $ua, 'iPhone' ) > 0:
                $dev = 'Sphone';
                break;
            
            case strpos( $ua, 'iPod ' ) > 0:
                $dev = 'Sphone';
                break;
                
            case strpos( $ua, 'BlackBerry' ) > 0:
                $dev = 'Sphone';
                break;
                
            case strpos( $ua, 'iPad' ) > 0:
                $dev = 'Tablet';
                break;
                
            case strpos( $ua, 'Kindle' ) > 0:
                $dev = 'Tablet';
                break;
                
            case strpos( $ua, 'Silk' ) > 0:
                $dev = 'Tablet';
                break;
                
            case strpos( $ua, 'playbook' ) > 0:
                $dev = 'Tablet';
                break;
                
            case strpos( $ua, 'Android' ) > 0:
                if( strpos( $ua, 'Mobile' ) > 0 ){ $dev = 'Sphone'; }else{ $dev = 'Tablet'; }
                break;
                
            case strpos( $ua, 'Firefox' ) > 0:
                if( strpos( $ua, 'Mobile' ) > 0 ){ $dev = 'Sphone'; }
                if( strpos( $ua, 'Tablet' ) > 0 ){ $dev = 'Tablet'; }
                break;
                
            case strpos( $ua, 'Windows' ) > 0:
                if( strpos( $ua, 'Phone' ) > 0 ){ $dev = 'Sphone'; }
                if( strpos( $ua, 'Tablet PC' ) > 0 ){ $dev = 'Tablet'; }
                break;
                
            default:
        }
        return $dev;
    }
    /**************************************************************************
     * public cnvDateTime 日時のフォーマット変換
     * @param $date
     * @return $out
     **************************************************************************/
    public function cnvDateTime( $date )
    {
        $out ='';
        if( !$date ){ return $out; }
        $str  = explode( ' ', $date );
        isset( $str[0] ) ? $hiduke = $str[0] : $hiduke = '';
        isset( $str[1] ) ? $jikann = $str[1] : $jikann = '';
        if( !$hiduke || !$jikann ){ return $out; }
        $week = array( "日", "月", "火", "水", "木", "金", "土" );
        $w  = $week[date( 'w',strtotime( $hiduke ) )];
        $list = explode( '/', $hiduke );
        isset( $list[0] ) ? $nen  = intval( $list[0] ) : $nen  = 0;
        isset( $list[1] ) ? $tuki = intval( $list[1] ) : $tuki = 0;
        isset( $list[2] ) ? $hi   = intval( $list[2] ) : $hi   = 0;
        if( !$nen === 0 || !$tuki === 0 || $hi === 0 ){ return $out; }
        $jikann = str_replace(':','：',$jikann);
        $out = "{$nen}年{$tuki}月{$hi}日（{$w}） {$jikann}";
        return $out;
    }
    /**************************************************************************
     * public parse 設定ファイルのパース
     * @param ( $file )
     * @return$this->data
     **************************************************************************/
    public function parse( $file )
    {
        $this->section = null;
        $this->data = array();
        if ( ! file_exists( $file ) ) { return false; }
        $list = file( $file );
        foreach ( $list as $line ) 
        {
            $line = trim( $line );
            if (empty( $line ) ) { continue; }
            if ( preg_match( '/^;/', $line ) ) { continue; }
            if ( preg_match( '/^\[(.*?)\]/', $line, $item ) ) { $this->section = $item[1]; continue; }
            if ( strpos( $line, '=' ) === false) { continue; }
            list ( $key, $val ) = explode( '=', $line, 2 );
            $key = trim( $key );
            $val = trim( $val );
            $val = preg_replace_callback( '/\{(.*?)\}/', array( $this, '_var' ), $val );
            if ( isset( $this->section ) ) { $this->data[$this->section][$key] = $val;} else { $this->data[$key] = $val; }
        }
        return $this->data;
    }
    
    /**************************************************************************
     * protected cutSlash スラッシュの除去
     * @param ($array=array())
     * @return $array
     **************************************************************************/
    protected function cutSlash( $array=array() )
    {
        foreach ( $array as $key=>$val )
        {
            if ( is_array( $val ) ) { $this->cutSlash($val); }
            if ( is_string( $val ) ){ $array[$key] = stripslashes($val); }
        }
        return $array;
    }
    
    /**************************************************************************
     * protected getPrepare プリペアードクエリー取得
     * @param ($sql=null)
     * @return $result false
     **************************************************************************/
    protected function getPrepare($sql=null)
    {
        try {
            $result = $this->conPdo()->prepare( $sql );
            //var_dump(json_decode(json_encode($result)),true );exit;
            if (! $result ){return false;}else{return $result;}
        } catch (PgException $e) {
            echo 'Error:'. $e->getMessage();
            return false;
        }
    }
    
    /**************************************************************************
     * public hyp -ハイフン区切
     * @param ( $str )
     * @return $str
     **************************************************************************/
    public function hyp( $str )
    {
        
        $str = $this->removeHyphen( $str );
        $len = strlen( $str );
        switch ( $len ){
            case 1: return $str; break;
            case 2: return $str; break;
            case 3: return $str; break;
            case 4: return $str; break;
            case 5: 
                $no1 = substr( $str, 0, 4 );
                $no2 = substr( $str, 4, 1 );
                return $no1 . '-' . $no2; 
                break;
            case 6: 
                $no1 = substr( $str, 0, 4 );
                $no2 = substr( $str, 4, 2 );
                return $no1 . '-' . $no2; 
                break;
            case 7: 
                $no1 = substr( $str, 0, 4 );
                $no2 = substr( $str, 4, 3 );
                return $no1 . '-' . $no2; 
                break;
            case 8: 
                $no1 = substr( $str, 0, 4 );
                $no2 = substr( $str, 4, 4 );
                return $no1 . '-' . $no2; 
                break;
            case 9: 
                $no1 = substr( $str, 0, 4 );
                $no2 = substr( $str, 4, 4 );
                $no3 = substr( $str, 8, 1 );
                return $no1 . '-' . $no2 . '-' . $no3; 
                break;
            case 10: 
                $no1 = substr( $str, 0, 4 );
                $no2 = substr( $str, 4, 4 );
                $no3 = substr( $str, 8, 2 );
                return $no1 . '-' . $no2 . '-' . $no3; 
                break;
            case 11: 
                $no1 = substr( $str, 0, 4 );
                $no2 = substr( $str, 4, 4 );
                $no3 = substr( $str, 8, 3 );
                return $no1 . '-' . $no2 . '-' . $no3; 
                break;
            case 12: 
                $no1 = substr( $str, 0, 4 );
                $no2 = substr( $str, 4, 4 );
                $no3 = substr( $str, 8, 4 );
                return $no1 . '-' . $no2 . '-' . $no3; 
                break;
            default:
                return $str;
        }
    }
    
    /**************************************************************************
     * public removeHyphen- ハイフンを取り除く
     * @param ( $str )
     * @return $return
     **************************************************************************/
    public function removeHyphen( $str )
    { 
        // 全角⇒半角変換
        $str = mb_convert_kana( $str, "achnrs", "utf-8" );
        $return = '';
        // 数値以外の除去
        for( $i = 0; $i < strlen( $str ); $i++ ){
            $letter = substr( $str, $i, 1 );
            if( preg_match( '/^[0-9]+$/', $letter ) ) { $return .= $letter; }
        }
        return $return;
    }

    /**************************************************************************
     * protected _var 設定ファイル変換用
     * @param ( $array )
     * @return constant( $name ) false
     **************************************************************************/
    protected function _var( $array )
    {
        $name = $array[1];
        if ( isset( $this->section ) && isset( $this->data[$this->section][$name] ) ) { return $this->data[$this->section][$name]; }
        if ( isset( $this->data[$name] ) ) { return $this->data[$name]; }
        if ( defined( $name )) { return constant( $name ); }
        return ''; 
    }
    /**************************************************************************
     * public makeDirs く
     * @param ( $str )
     * @return $return
     **************************************************************************/
    public function makeDirs( $dir )
    {
    	return exec("mkdir -p {$dir}");
    }
    /**************************************************************************
     * protected geCorpListAll 
     * @param 
     * @return ALLLIST corp_id,corp_name
     **************************************************************************/
    protected function geCorpListAll()
    {
        $params = array();
        $sql = <<<SQL
SELECT corp_id,corp_name FROM m_qas_compaany
SQL;
        return $this->getAll( $sql, $params );
    }
    
    /**************************************************************************
     * protected geCorpDepListAll 
     * @param 
     * @return ALLLIST
     **************************************************************************/   
    protected function geCorpDepListAll()
    {
        $params = array();
        $sql = <<<SQL
SELECT * FROM m_qas_corp_dep
SQL;
        return $this->getAll( $sql, $params );
    }
     
    protected function getYearList() 
    {
        $now = intval( date( "Y" ) );
        $str = $now - 5;
        $end = $now + 5;
        $out = array('');
        for( $i = $str; $i < $end; $i++ ){ $out[$i] = $i; }
        return $out;
    }
    
    protected function getMonthList() 
    {
        $out = array('');
        for( $i = 1; $i <= 12; $i++ ){ $out[$i] = $i; }
        return $out;
    }
    
    protected function getTagParts( $param ) 
    {
        isset($param['type'])  ? $type  = $param['type']  : $type  = '';
        isset($param['id'])    ? $id    = $param['id']    : $id    = '';
        isset($param['name'])  ? $name  = $param['name']  : $name  = '';
        isset($param['value']) ? $value = $param['value'] : $value = '';
        isset($param['class']) ? $class = $param['class'] : $class = '';
        isset($param['max'])   ? $max   = $param['max']   : $max   = '';
        isset($param['click']) ? $click = $param['click'] : $click = '';
        isset($param['only'])  ? $only  = $param['only']  : $only  = '';
        isset($param['width']) ? $width = $param['width'] : $width = '';
        isset($param['chan'])  ? $chan  = $param['chan']  : $chan  = '';
        isset($param['disab']) ? $disab = $param['disab'] : $disab = '';
        isset($param['dir'])   ? $dir   = $param['dir']   : $dir   = '';
        isset($param['list'])  ? $list  = $param['list']  : $list  = array();
        isset($param['stat'])  ? $stat  = $param['stat']  : $stat  = '';
        switch( $type )
        {
            case 'hidden':
                $out = "<input type='{$type}'id='{$id}' name='{$name}' value='{$value}' />\n";
                break;
                
            case 'text':
                $out = "<input type='{$type}' name='{$name}' value='{$value}'";
                if( $id    ){ $out .= " id='{$id}'"; }
                if( $class ){ $out .= " class='{$class}'"; }
                if( $max   ){ $out .= " maxlength='{$max}'"; }
                if( $width ){ $out .= " style='width:{$width}px;'"; }
                if( $click ){ $out .= " onClick='{$click}'"; }
                if( $only  ){ $out .= " readonly"; }
                $out .=" />\n";
                break;
            
            case 'number':
                $out = "<input type='{$type}' name='{$name}' value='{$value}'";
                if( $id    ){ $out .=" id='{$id}'"; }
                if( $class ){ $out .=" class='{$class}'"; }
                if( $max   ){ $out .=" maxlength='{$max}'"; }
                if( $width ){ $out .=" style='width:{$width}px;'"; }
                if( $click ){ $out .=" onClick='{$click}'"; }
                if( $only  ){ $out .=" readonly"; }
                $out .=" />\n";
                break;
            
            case 'submit':
                $out = "<input type='{$type}' name='{$name}' value='{$value}'";
                if( $id    ){ $out .= " id='{$id}'"; }
                if( $class ){ $out .= " class='{$class}'"; }
                if( $click ){ $out .= " onClick='{$click}'"; }
                if( $only  ){ $out .= " disabled"; }
                $out .=" />\n";
                break;
            
            case 'textarea':
                $out = "<{$type} name='{$name}'";
                if( $id    ){ $out .= " id='{$id}'"; }
                if( $class ){ $out .= " class='{$class}'"; }
                if( $only  ){ $out .= " readonly"; }
                $out .=">{$value}</{$type}>\n";
                break;
                
            case 'select':
                $out  = "<{$type} '";
                $out .= " name='{$name}' ";
                if( $id    ){ $out .= " id='{$id}'"; }
                if( $dir   ){ $out .= " dir='{$dir}'"; }
                if( $width ){
                    $out .= " style='width:{$width}px;' ";
                }
                if( $chan  ){ $out .= " onChange='{$chan}'"; }
                if( $disab ){ $out .= " disabled"; }
                $out .= ">\n";
                foreach ($list as $key => $val) {
                    if ( $key === $value ) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                        if( strval( $key ) === $value ){ $selected = 'selected'; }
                    }
                    if( $stat === '' ){
                        $out .= "<option value='{$key}' {$selected} >{$val}</option>\n";
                    }else{
                        if( $key === 0 || $key === '0' || $key === '' ){
                            $out .= "<option value='{$key}' {$selected} >{$val}</option>\n";
                        }else{
                            $out .= "<option value='{$key}' {$selected} >{$key}：{$val}</option>\n";
                        }
                    }
                }
                $out .= "</{$type}>\n";
                break;

            default:
                $out = "";
        }
        return $out;
    }
    
    private function setDbIni( $name ) // 'db_prod.ini'
    {
     	$this->ini  = $this->parse(INI.$name.'.ini' );
     	$this->host = $this->ini['DB']['host'];
     	$this->db   = $this->ini['DB']['db'];
     	$this->user = $this->ini['DB']['user'];
     	$this->pass = $this->ini['DB']['pass'];
    }

}

