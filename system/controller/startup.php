<?php

class startUp
{
    public function __construct() 
    { 
         $this->_setting(); 
    }
    
    public function getPageName()
    { 
      	$serverUri = $_SERVER['REQUEST_URI'];
        if ( strstr($serverUri, '?')) {
 			 $path = explode("?", $serverUri);
             $serverUri = $path[0];
        }
        $pageNames = explode( DS, $serverUri );
        $keys = array_keys( $pageNames );
        $end  = end( $keys );
        $pos  = $end - 1;
        return $pageNames[$pos];
    }
    
    public function jenc($array)
    { 
        return json_encode($array); 
    }
    
    public function jdec($str)
    { 
        return json_decode( $str, true ); 
    }
    public function getInputTag($set, $key_name, $width)
    { 
        $out = "                <span class = 'abs cel-01 blk'>\n";
        $para          = array();
        $para['type']  = 'text';
        $para['name']  = $key_name;
        $para['value'] = $set[$key_name];
        $para['id']    = 'select-cel2';
        $para['width'] = $width;
        $para['heigh'] = 27;
        $out .= $this->getTagParts( $para );
        $out .= "                </span>\n";
    }
    
    
    public function getAnchorTag($url, $str, $space=null, $target=null)
    { 
        $out  = "<span";
        if ( ! is_null($space)) { 
            $out .= " style='padding-left:{$space}px;'"; 
        }
        $out .= ">";
        $out .= "<a href='{$url}'";
        if ($target) { 
            $out .= " target='_blank' "; 
        }
        $out .= ">{$str}</a>";
        $out .= "<span>";
        return $out;
    }
    
    public function setFavicon()
    {
        return "<link rel='shortcut icon' href='" . IMG . DS ."favicon.ico'>\n";
    }
    
    public function setCsv($name)
    {
    	$out ="";
    	if( $name === "" || is_null($name)) {
    	return $out;
    	}
    	$out .= CSV .$name . ".csv" ;
    	return $out;
    }
    
    public function setCss($name)
    {
        $out = "";
        if ($name === "" || is_null($name)) {
            return $out;
        }
        $out .=  "<link rel='stylesheet' type='text/css' href='" . CSS . $name . ".css" . CSSV . "'>\n";
        return $out;
    }
    
    public function setJs($name)
    {
        $out = "";
        if ($name === "" || is_null($name)) {
            return $out;
        }
        $out .= "<script type='text/javascript' src='". JS . DS . "{$name}.js'" . CSSV . " charset='utf-8'></script>\n";
        return $out;
    }
    
    public function setErrorMsg( $message="", $color="" )
    {
        $out = "";
        if ($message === "" || is_null($message)) {
            return $out;
        }
        if ($color === "" || is_null($color)) {
            $color = "red";
        }
        $out .= "<span style='color:{$color};'>{$message}</span>\n";
        return $out;
    }
    
    public function setSubmitBtn($btnName, $class="", $id="", $name="", $jsCommand="")
    {
        $out = "";
        if ($btnName === "" || is_null($btnName)) {
            return $out;
        }
        if ($class === "") {
            $class = "btn btn-primary";
        }
        if ($id === "") {
            $id = "submit";
        }
        if ($name === "") {
            $name = "submit";
        }
        if ($jsCommand === "") {
            $jsCommand = "onClick='return confirms()'";
        }
        $out .= "<button id='{$id}' name={$name} class='{$class}' value='1'>{$btnName}</button>\n";
        return $out;
    }
    
    public function setDelIco()
    {
        return "<span data-feather='trash'></span>";
    }
    
    public function setPullDown($list, $name, $width, $data )
    {
        $out = "                <span class = 'abs cel-01 blk'>\n";
        $para          = array();
        $para['type']  = 'select';
        $para['name']  = $name;
        $para['value'] = $list[$name];
        $para['id']    = 'select-cel';
        $para['chan']  = 'return document.form1.submit()';
        $para['width'] = $width;
        $para['list']  = $data;
        $out .= $this->getTagParts( $para );
        $out .= "                </span>\n";
        return $out;
    }
    public function setHidden($name, $value)
    { 
        $out = "";
        $para          = array();
        $para['type']  = 'hidden';
        $para['name']  = $name;
        $para['id']    = $name;
        $para['value'] = $value;
        $out .= $this->getTagParts( $para );
        return $out;
    }
    
// PRIVATE

    private $sysdate;
    private $section;
    private $data;
    
    private function makeDirs( $dir )
    { 
        return exec("mkdir -p {$dir}"); 
    }
    
    private function _setting()
    {
        if( !defined( 'SIGN'   ) ){ define( 'SIGN'  ,'system' ); }
        if( !defined( 'DS'     ) ){ define( 'DS'  ,'/' ); }
        $base_dir = str_replace( "\\","/", dirname(__FILE__));
        $server = $_SERVER["SERVER_NAME"];
        $path = "http:" . DS .DS . $server .DS . SIGN .DS;
        if( !defined( 'ROOT'   ) ){ define( 'ROOT', str_replace( 'controller', '', $base_dir  ) ); }
        if( !defined( 'CTL'    ) ){ define( 'CTL' , ROOT . 'controller'. DS ); }
        if( !defined( 'MDL'    ) ){ define( 'MDL' , ROOT . 'model'. DS ); }
        if( !defined( 'TPL'    ) ){ define( 'TPL' , ROOT . 'view'. DS ); }
        if( !defined( 'DOC'    ) ){ define( 'DOC' , "docs"); }
        if( !defined( 'CSV'	   ) ){ define(	'CSV' , $path .DOC . DS ."csv" .DS);	}
        if( !defined( 'CSS'    ) ){ define( 'CSS' , $path . DOC . DS ."css" . DS); }
        if( !defined( 'JS'     ) ){ define( 'JS' , $path . DOC . DS ."js" ); }
        if( !defined( 'IMG'    ) ){ define( 'IMG' , $path . DOC . DS ."img" . DS); }
        if( !defined( 'SITE'   ) ){ define( 'SITE', 'My System' ); }
        if( !defined( 'CSSV'   ) ){ define( 'CSSV', '?v=' . date("YmdHis") ); }
        $this->sysdate = date("Y/m/d");//$this->dumps(DATA);
    }
    
    public function getTagParts( $param )
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
        isset($param['heigh']) ? $heigh = $param['heigh'] : $heigh = '';
        isset($param['chan'])  ? $chan  = $param['chan']  : $chan  = '';
        isset($param['disab']) ? $disab = $param['disab'] : $disab = '';
        isset($param['dir'])   ? $dir   = $param['dir']   : $dir   = '';
        isset($param['list'])  ? $list  = $param['list']  : $list  = array();
        isset($param['stat'])  ? $stat  = $param['stat']  : $stat  = '';
        isset($param['pos'])   ? $pos   = $param['pos']   : $pos   = '';
        isset($param['check']) ? $check = $param['check'] : $check = '';
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
                if( $width ){ 
                    $out .= " style='width:{$width}px;"; 
                    if( $heigh ){ $out .= "height:{$heigh}px;"; }
                    if( $pos ){ $out .= "text-align:{$pos};'"; }else{$out .= "'";}
                }
                if( $click ){ $out .= " onClick='{$click}'"; }
                if( $only  ){ $out .= " readonly"; }
                $out .=" autocomplete='off' ";
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
                $out = "<{$type} name='{$name}' value='{$value}'";
                if( $id    ){ $out .= " id='{$id}'"; }
                if( $class ){ $out .= " class='{$class}'"; }
                if( $only  ){ $out .= " readonly"; }
                $out .=">{$value}</{$type}>\n";
                break;
                
            case 'select':
                $out  = "<{$type} ";
                $out .= " name='{$name}' ";
                if( $id    ){ $out .= " id='{$id}'"; }
                if( $dir   ){ $out .= " dir='{$dir}'"; }
                if( $width ){
                    $out .= " style='width:{$width}px;padding-bottom:6px;'";
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
            case 'checkbox':
                $out = "<input type='{$type}' name='{$name}' value='{$value}'";
                if( $id    ){ $out .= " id='{$id}'"; }
                if( $chan  ){ $out .= " onChange='{$chan}'"; }
                if( $only  ){ $out .= " disabled"; }
                if( $check ){ $out .= " checked"; }
                $out .=" />";
                break;
            case 'radio':
                $out = "<input type='{$type}' name='{$name}' value='{$value}'";
                if( $id    ){ $out .= " id='{$id}'"; }
                if( $check !== '' ){ $out .= $check; }
                if( $chan  ){ $out .= " onChange='{$chan}'"; }
                if( $only  ){ $out .= " disabled"; }
                $out .="  />";
                break;
            default:
                $out = "";
        }
        return $out;
    }
    
}
