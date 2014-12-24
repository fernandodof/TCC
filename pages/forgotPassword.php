<?php
require_once '../pages/pathVars.php';

require_once $path . 'pages/smartyHeader.php';
include_once $path . 'pages/header.php';

$smarty->display('../templates/forgotPassword.tpl');

include_once '../pages/footer.php';