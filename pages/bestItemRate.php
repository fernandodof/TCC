<?php

include_once '../pages/header.php';

require_once $path . 'pages/smartyHeader.php';
require_once $path . 'src/app/model/entities/Restaurante.class.php';
require_once $path . 'src/app/util/Queries.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';
require_once $path . 'src/app/util/CheckLoggedIn.php';
require_once $path . 'src/app/util/UserTypes.php';

$dao = new Dao();

if (isset($_SESSION['id']) && CheckLoggedIn::checkPermission(UserTypes::CLIENTE)) {
    $params1['id_cliente'] = $_SESSION['id'];
    $idsProdutosComprados = $dao->getListResultOfNativeQueryWithParameters(Queries::GET_IDS_PRODUTOS_CLIENTE_COMPROOU, $params1);
    $smarty->assign('idsProdutosComprados', $idsProdutosComprados);
}

$products = new \Doctrine\Common\Collections\ArrayCollection();
$restaurants = new \Doctrine\Common\Collections\ArrayCollection();
$avgRating;

if (isset($_SESSION['latLong'])) {

    $latLong = explode(',', $_SESSION['latLong']);

    $params['latitude'] = $latLong[0];
    $params['longitude'] = $latLong[1];

    $nearByProducts = $dao->getListAssocResultOfNativeQueryWithParameters(Queries::GET_PRODUTO_ORDER_BY_AVALIACAO_RAIO, $params);

    foreach ($nearByProducts as $p) {
        $products->add($dao->findByKey('Produto', $p['id_produto']));
        $restaurants->add($dao->findByKey('Restaurante', $p['id_restaurante']));
        $avgRating[] = $p['nota'];
    }
} else {
    $bestProducts = $dao->getListAssocResultOfNativeQuery(Queries::GET_PRODUTO_ORDER_BY_AVALIACAO);

    foreach ($bestProducts as $p) {
        $products->add($dao->findByKey('Produto', $p['id_produto']));
        $restaurants->add($dao->findByKey('Restaurante', $p['id_restaurante']));
        $avgRating[] = $p['nota'];
    }
}

$smarty->assign('products', $products);
$smarty->assign('restaurants', $restaurants);
$smarty->assign('avgRating', $avgRating);

$smarty->display($path . 'templates/bestItemRate.tpl');

include_once $path . 'pages/footer.php';
