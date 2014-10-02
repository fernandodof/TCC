<?php
require_once './smartyHeader.php';
require_once '../src/app/model/entities/Restaurante.class.php';
require_once '../src/app/util/Queries.php';
require_once '../src/app/model/persistence/Dao.class.php';

include_once '../pages/header.php';

$dao = new Dao();

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

$params['nome'] = '%'.filter_input(INPUT_POST, 'search').'%';

$restaurants = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST, $params);
//$restaurants['Nome restaurante 1'] = true;
//$restaurants['Nome restaurante 2'] = false;
//$restaurants['Nome restaurante maior 3'] = true;
//$restaurants['Nome restaurante 4'] = true;
//$restaurants['Nome restaurante bem maior 5'] = true;
//$restaurants['Nome restaurante 6'] = false;
//$restaurants['Nome menor 7'] = false;
//$restaurants['Nome restaurante 8'] = false;
//$restaurants['Nome menor 9'] = true;
//$restaurants['Nome restaurante 10 bem maior'] = true;

$smarty->assign('restaurants',$restaurants);
$smarty->assign('kindsOfFood',$kindsOfFood);
$smarty->display('../templates/search.tpl');

include_once '../pages/footer.php';