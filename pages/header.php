<?php

require_once './smartyHeader.php';
$title= 'FomeOnline - Pedidos pela internet';
$siteName = 'FomeOnline';

$smarty->assign('title',$title);
$smarty->assign('siteName', $siteName);
$smarty->display('../templates/header.tpl');