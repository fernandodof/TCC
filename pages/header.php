<?php
$templateRoot = 'http://'.$_SERVER['HTTP_HOST'].'/Restaurantes/';
$path = str_replace("\\", '/',  dirname(__DIR__).'/');

//var_dump($path);
//var_dump($domain);

require_once $path.'pages/smartyHeader.php';
require_once $path.'src/app/model/VO/PedidoVO.class.php';

$title = 'SaborVirtual - Pedidos pela internet';
$siteName = 'SaborVirtual';

$smarty->assign('title', $title);
$smarty->assign('siteName', $siteName);

session_start();

$smarty->assign('path',$path);
$smarty->assign('templateRoot',$templateRoot);
$smarty->display($path.'templates/header.tpl');
