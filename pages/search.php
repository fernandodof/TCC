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

$params['nome'] = trim(filter_input(INPUT_POST, 'search'));
$tipo = trim(filter_input(INPUT_POST, 'kindOfFood'));

if (is_numeric($params['nome'])) {
    $params['nome'] = '%' . $params['nome'] . '%';
    if ($tipo == "") {
        $restaurants = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST_CEP, $params); //Correct
    } else {
        $params['tipo'] = $tipo;
        $restaurants = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST_CEP_TIPO, $params);
        print_r($params);
        
    }
} else {
    $params['nome'] = '%' . $params['nome'] . '%';
    if ($tipo == "") {
        $restaurants = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST_NOME, $params); //Correct
    } else {
        $params['tipo'] = $tipo;
        $restaurants = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST_NOME_TIPO, $params);
    }
}

//$kindOfFood = filter_input(INPUT_POST, 'kindOfFood');
//
//if ($kindOfFood !== "") {
//    foreach ($restaurants as $key => $value) {
//        if ($value->getTipo()->getNome() != $kindOfFood) {
//            unset($restaurants[$key]);
//        }
//    }
//}

$smarty->assign('restaurants', $restaurants);
$smarty->assign('kindsOfFood', $kindsOfFood);
$smarty->display('../templates/search.tpl');

include_once '../pages/footer.php';
