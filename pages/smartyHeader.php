<?php
require '../pages/pathVars.php';
require_once $path.'libs/Smarty/Smarty.class.php';

$smarty = new Smarty;
$smarty->caching = false;
$smarty->template_dir = '../templates';
$smarty->compile_dir = '../template_c';
$smarty->config_dir = '../configs';
$smarty->cache_dir = '../cache';
