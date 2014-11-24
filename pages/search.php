<?php

include_once '../pages/header.php';

require_once $path.'pages/smartyHeader.php';
require_once $path.'/src/app/model/entities/Restaurante.class.php';
require_once $path.'src/app/util/Queries.php';
require_once $path.'src/app/model/persistence/Dao.class.php';

$dao = new Dao();

$params['nome'] = trim(filter_input(INPUT_GET, 'search'));
$tipo = trim(filter_input(INPUT_GET, 'kindOfFood'));

if (is_numeric($params['nome'])) {
    $params['nome'] = '%' . $params['nome'] . '%';
    if ($tipo == "") {
        $restaurants = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST_CEP, $params); //Correct
    } else {
        $params['tipo'] = $tipo;
        $restaurants = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST_CEP_TIPO, $params);
        
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

$kindsOfFood = $dao->getListResultOfNamedQuery(Queries::TIPOS_RESTAURANTE_DISTINCT);

$smarty->assign('restaurants', $restaurants);
$smarty->assign('kindsOfFood', $kindsOfFood);
$smarty->display($path.'templates/search.tpl');

include_once $path.'pages/footer.php';