<?php

include_once '../pages/header.php';

require_once $path . 'pages/smartyHeader.php';
require_once $path . '/src/app/model/entities/Restaurante.class.php';
require_once $path . 'src/app/util/Queries.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';

$dao = new Dao();

$params['nome'] = '%'.trim(filter_input(INPUT_GET, 'productName')).'%';

$products = $dao->getListResultOfNamedQueryWithParameters(Queries::GET_PRODUTOS_BY_NOME, $params);
$restaurants = new \Doctrine\Common\Collections\ArrayCollection();
$avgRating = array();

foreach ($products as $p){
    $params1['id_produto'] = $p->getId();
    $restaurants->add($dao->getSingleResultOfNamedQueryWithParameters(Queries::GET_RESTAURANTE_BY_ID_PRODUTO, $params1));
    $avgRating[] = $dao->getArrayResultOfNativeQueryWithParameters(Queries::GET_NOTA_PRODUTO_BY_ID, $params1)['nota'];
}

$smarty->assign('products', $products);
$smarty->assign('restaurants', $restaurants);
$smarty->assign('avgRating', $avgRating);

$smarty->display($path . 'templates/searchProduct.tpl');

include_once $path . 'pages/footer.php';


