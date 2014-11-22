<?php

include_once '../pages/header.php';
require_once $path . 'pages/smartyHeader.php';



$smarty->display($path . 'templates/error.tpl');