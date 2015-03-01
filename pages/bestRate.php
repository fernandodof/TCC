<?php

include_once '../pages/header.php';

require_once $path . 'pages/smartyHeader.php';
require_once $path . '/src/app/model/entities/Restaurante.class.php';
require_once $path . 'src/app/util/Queries.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';
require_once $path . 'src/app/util/CheckLoggedIn.php';
require_once $path . 'src/app/util/UserTypes.php';

$dao = new Dao();

if (isset($_SESSION['id']) && CheckLoggedIn::checkPermission(UserTypes::CLIENTE)) {
    $params1['id_cliente'] = $_SESSION['id'];
    $idsRestaurantesComprados = $dao->getListResultOfNativeQueryWithParameters(Queries::GET_IDS_RESTAURANTES_CLIENTE_COMPROU, $params1);
    $smarty->assign('idsRestaurantesComprados', $idsRestaurantesComprados);
}

$kindsOfFood = $dao->getListResultOfNamedQuery(Queries::TIPOS_RESTAURANTE_DISTINCT);
$restaurants = new \Doctrine\Common\Collections\ArrayCollection();

if (isset($_SESSION['latLong'])) {

    $latLong = explode(',', $_SESSION['latLong']);

    $params['latitude'] = $latLong[0];
    $params['longitude'] = $latLong[1];

    if (filter_input(INPUT_GET, 'kindOfFood') == null) {
        $nearByrestaurants = $dao->getListAssocResultOfNativeQueryWithParameters(Queries::GET_RESTAURANTE_RAIO_ORDER_BY_AVALIACAO_E_RAIO, $params);
    } else {
        $params['tipo'] = '%' . filter_input(INPUT_GET, 'kindOfFood') . '%';
        $nearByrestaurants = $dao->getListAssocResultOfNativeQueryWithParameters(Queries::GET_RESTAURANTE_RAIO_TIPO_ORDER_BY_AVALIACAO_E_RAIO, $params);
    }

    foreach ($nearByrestaurants as $r) {
        $restaurants->add($dao->findByKey('Restaurante', $r['id']));
    }
    
} else {
    $bestRestaurants = $dao->getListAssocResultOfNativeQuery(Queries::GET_RESTAURANTE_ORDER_BY_AVALIACAO);
    
    foreach ($bestRestaurants as $r) {
        $restaurants->add($dao->findByKey('Restaurante', $r['id']));
    }
}

foreach ($restaurants as $r) {
    $avgRating;
    $sum = 0;
    $counter = 0;
    foreach ($r->getAvaliacoes() as $av) {
        $sum += $av->getNota();
        $counter++;
    }

    if ($counter > 0) {
        $avg = $sum / $counter;
    } else {
        $avg = 0;
    }

    $avgRating[] = $avg;
}

if (isset($avgRating)) {
    $smarty->assign('avgRating', $avgRating);
}

$smarty->assign('restaurants', $restaurants);
$smarty->assign('kindsOfFood', $kindsOfFood);
$smarty->display($path . 'templates/bestRate.tpl');

include_once $path . 'pages/footer.php';
