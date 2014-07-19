<?php

require_once './smartyHeader.php';
$title= 'Restaurates - Pedidos pela internet';
$siteName = 'Restaurantes';

$smarty->assign('title',$title);
$smarty->assign('siteName', $siteName);
$smarty->display('../templates/header.tpl');