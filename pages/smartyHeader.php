<?php

//list(,,,$resquestPage) = explode('/', filter_input(INPUT_SERVER, 'REQUEST_URI'));
//if(strtolower($resquestPage) == strtolower(basename(__FILE__, '.php'))){
//    header("Location: index");
//}

require '../pages/pathVars.php';
require_once $path.'libs/Smarty/Smarty.class.php';

$smarty = new Smarty;
$smarty->caching = false;
$smarty->template_dir = '../templates';
$smarty->compile_dir = '../template_c';
$smarty->config_dir = '../configs';
$smarty->cache_dir = '../cache';
