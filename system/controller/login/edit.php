<?php

/* 文字 UTF-8 */
require_once '../startup.php';
$c = new startUp();
$page = 'login';
$title = "ログイン";
$style     = $c->setCss($page);
$bootstrap = $c->setCss('bootstrap.min');

require_once MDL .$page . ".php";
$m = new login();


isset($_REQUEST['user_name']) ? $para['user_name'] = $_REQUEST['user_name'] : $para['user_name'] = "";
isset($_REQUEST['email']   )  ? $para['email']     = $_REQUEST['email']     : $para['email']     = "";
isset($_REQUEST['pass1'])     ? $para['pass1']     = $_REQUEST['pass1']     : $para['pass1']     = "";
isset($_REQUEST['pass2'])     ? $para['pass2']     = $_REQUEST['pass2']     : $para['pass2']     = "";
$message = "";
if (isset($_REQUEST["submit"])){
    if (strlen($para['pass1']) < 8 ) {
        $message = "正しいパスワードを入れてください！";
    }
    if ($para['pass1'] !==  $para['pass2']) {
        $message = "パスワードが一致しません！";
    }
    if ($message === "") {
         $res = $m->addUser($para);
         if ($res) {
             header("Location: index.php");exit;
         }
    }

}
include TPL . $page . DS."edit.tpl";
echo $html;
