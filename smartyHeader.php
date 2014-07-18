<?php
//define('SMARTY_DIR', '../libs/Smarty/');
//require_once (SMARTY_DIR . 'Smarty.class.php');
require_once '../libs/Smarty/Smarty.class.php';
$smarty = new Smarty;
$smarty->caching = true;
$smarty->template_dir = '../templates';
$smarty->compile_dir = '../template_c';
$smarty->config_dir = '../configs';
$smarty->cache_dir = '../cache';