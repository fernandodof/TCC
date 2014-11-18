<?php
require_once 'pathVars.php';
//var_dump($path);

require_once $path.'pages/smartyHeader.php';
require_once $path.'src/app/model/VO/PedidoVO.class.php';
require_once $path.'src/app/model/VO/PedidoVO.class.php';
require_once $path.'src/app/model/VO/ItemPedidoVO.class.php';
require_once $path.'src/app/model/VO/ProdutoVO.class.php';
require_once $path.'src/app/model/VO/TamanhoVO.class.php';
session_start();

$title = 'SaborVirtual - Pedidos pela internet';
$siteName = 'SaborVirtual';

$smarty->assign('title', $title);
$smarty->assign('siteName', $siteName);
$smarty->assign('path',$path);
$smarty->assign('templateRoot',$templateRoot);
$smarty->display($path.'templates/header.tpl');
