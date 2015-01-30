<?php
include_once '../pages/header.php';

require_once $path . 'pages/smartyHeader.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';
require_once $path . 'src/app/util/Queries.php';

$dao = new Dao();

$products = new \Doctrine\Common\Collections\ArrayCollection();
$restaurants = new \Doctrine\Common\Collections\ArrayCollection();

if (isset($_SESSION['latLong'])) {

    $latLong = explode(',', $_SESSION['latLong']);

    $params['latitude'] = $latLong[0];
    $params['longitude'] = $latLong[1];

    $nearByProducts = $dao->getListAssocResultOfNativeQueryWithParameters(Queries::GET_PRODUTO_ORDER_BY_AVALIACAO_RAIO, $params);
    $indexes = array_rand($nearByProducts, 4);

   
    foreach ($indexes as $i) {
        $products->add($dao->findByKey('Produto', $nearByProducts[$i]['id_produto']));
        $restaurants->add($dao->findByKey('Restaurante', $nearByProducts[$i]['id_restaurante']));
    }
} else {
    $bestProducts = $dao->getListAssocResultOfNativeQuery(Queries::GET_PRODUTO_ORDER_BY_AVALIACAO);
    $indexes = array_rand($bestProducts, 4);

   
    foreach ($indexes as $i) {
        $products->add($dao->findByKey('Produto', $bestProducts[$i]['id_produto']));
        $restaurants->add($dao->findByKey('Restaurante', $bestProducts[$i]['id_restaurante']));
    }
}

$kindsOfFood = $dao->getListResultOfNamedQuery(Queries::TIPOS_RESTAURANTE_DISTINCT);

$smarty->assign('kindsOfFood', $kindsOfFood);
$smarty->assign('products', $products);
$smarty->assign('restaurants', $restaurants);

$smarty->display($path . 'templates/index.tpl');

include_once $path . 'pages/footer.php';
