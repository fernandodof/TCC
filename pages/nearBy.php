<?php
include_once '../pages/header.php';

require_once $path . 'pages/smartyHeader.php';
require_once $path . '/src/app/model/entities/Restaurante.class.php';
require_once $path . 'src/app/util/Queries.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';

$dao = new Dao();

$kindsOfFood = $dao->getListResultOfNamedQuery(Queries::TIPOS_RESTAURANTE_DISTINCT);

$latLong = explode(',', $_SESSION['latLong']);

$params['latitude'] = $latLong[0];
$params['longitude'] = $latLong[1];
$params['raio'] = 1;
$nearByrestaurants = $dao->getListAssocResultOfNativeQueryWithParameters(Queries::GET_RESTAURANTE_RAIO, $params);

//foreach ($restaurants as $r){
//    echo 'res: '. $r['id'].' dis: '.$r['distance'].'<br>';
//}

$restaurants = new \Doctrine\Common\Collections\ArrayCollection();
foreach ($nearByrestaurants as $r){
    $restaurants->add($dao->findByKey('Restaurante', $r['id']));
}

if (isset($_SESSION['id'])) {
    $params1['id_cliente'] = $_SESSION['id'];
    $idsRestaurantesComprados = $dao->getListResultOfNativeQueryWithParameters(Queries::GET_IDS_RESTAURANTES_CLIENTE_COMPROU, $params1);
    $smarty->assign('idsRestaurantesComprados', $idsRestaurantesComprados);
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
$smarty->display($path . 'templates/nearBy.tpl');

include_once $path . 'pages/footer.php';
