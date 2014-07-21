<?php
require_once './smartyHeader.php';
include_once '../pages/header.php';
$kindsOfFood = array();
$kindsOfFood[] = 'Churrascaria';
$kindsOfFood[] = 'Lanchonete';
$kindsOfFood[] = 'Pizzaria';
$kindsOfFood[] = 'Cozinha Japonesa';
$kindsOfFood[] = 'Cozinha Chinesa';
$kindsOfFood[] = 'Saladas';
$kindsOfFood[] = 'Cozlinha Italiana';
$kindsOfFood[] = 'Variada';
sort($kindsOfFood); 

$restaurants = array();
$restaurants['Nome restaurante 1'] = true;
$restaurants['Nome restaurante 2'] = false;
$restaurants['Nome restaurante maior 3'] = true;
$restaurants['Nome restaurante 4'] = true;
$restaurants['Nome restaurante bem maior 5'] = true;
$restaurants['Nome restaurante 6'] = false;
$restaurants['Nome menor 7'] = false;
$restaurants['Nome restaurante 8'] = false;
$restaurants['Nome menor 9'] = true;
$restaurants['Nome restaurante 10 bem maior'] = true;

$smarty->assign('restaurants',$restaurants);
$smarty->assign('kindsOfFood',$kindsOfFood);
$smarty->display('../templates/search.tpl');

include_once '../pages/footer.php';