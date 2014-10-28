<?php

require_once './smartyHeader.php';
$title = 'SaborVirtual - Pedidos pela internet';
$siteName = 'SaborVirtual';

$smarty->assign('title', $title);
$smarty->assign('siteName', $siteName);
session_start();

$smarty->display('../templates/header.tpl');
