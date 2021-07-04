<?php
/* 文字 UTF-8 */
require_once '../startup.php';
$c  = new startUp();
$page = 'users';
$title = 'ユーザー管理';
$style     = $c->setCss($page);
$bootstrap = $c->setCss('bootstrap.min');

require_once MDL .$page . '.php';
$m = new users();

$userList = $m->getUserList();

include  TPL . $page . DS .'index.tpl';
echo $html;
