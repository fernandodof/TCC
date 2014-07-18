<?php

require_once '../smartyHeader.php';
$title= 'Restaurentes - Pedidos pela internet';
$msg = 'Hello World';

$smarty->assign('title',$title);
$smarty->assign('msg', $msg);
$smarty->display('../templates/header.tpl');