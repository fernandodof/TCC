<?php

require_once '../smartyHeader.php';
$title= 'Restaureates - Pedidos pela internet';
$siteName = 'Restaurantes';

$smarty->assign('title',$title);
$smarty->assign('siteName', $siteName);
$smarty->display('../templates/header.tpl');