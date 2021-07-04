<?php

/* 文字 UTF-8 11/1 */
require_once '../startup.php';
$c  = new startUp();
$page = 'login';
$title = "ログイン";
$style     = $c->setCss($page);
$bootstrap = $c->setCss('bootstrap.min');
$img       = IMG .$page .'.png';

require_once MDL .$page . '.php';

$m = new login();

isset($_REQUEST['email']   ) ? $para['email']    = $_REQUEST['email']    : $para['email']    = '';
isset($_REQUEST['password']) ? $para['password'] = $_REQUEST['password'] : $para['password'] = '';
$message = '';

$res = true;
if (isset($_REQUEST['submit'])){
    if (strlen($para['password']) < 8 ) {
        $message = '正しいパスワードを入れてください！';
        $res = false;
    }
    if ($res) {
        $list = $m->getListByMail($para);
        if (empty($list)){
            $message = 'メールアドレス・パスワードが違います！';
            $res = false;
        }else {
            if ($list['password'] !== $para['password']) {
                $message = 'メールアドレス・パスワードが違います！';
                $res = false;
            }
        }
    }
    if ($res) {
        header('Location: ../dashboard/');exit;
    }
}
include TPL. $page. DS . 'index.tpl';
echo $html;
