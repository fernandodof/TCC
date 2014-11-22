<?php
include_once './header.php';
require_once $path . 'pages/smartyHeader.php';

$smarty->assign('templateRoot', $templateRoot);
$smarty->display($path . 'templates/error.tpl');

