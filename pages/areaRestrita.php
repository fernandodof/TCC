<?php
require_once '../pages/pathVars.php';
require_once $path.'pages/smartyHeader.php';

$smarty->assign('templateRoot', $templateRoot);
$smarty->display($path.'templates/areaRestrita.tpl');

