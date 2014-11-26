<?php
require_once './pathVars.php';

require_once $path.'pages/smartyHeader.php';
require_once $path.'/src/app/model/entities/Restaurante.class.php';
require_once $path.'src/app/util/Queries.php';
require_once $path.'src/app/model/persistence/Dao.class.php';
session_start();
$dao = new Dao();

list(,,,, $res) = explode('/', filter_input(INPUT_SERVER, 'REQUEST_URI'));

$restaurante = $dao->findByKey('Restaurante', $res);

$idsRestaurantesComprados = null;

if(isset($_SESSION['id'])){
    $params['id_cliente'] = $_SESSION['id'];
    $idsRestaurantesComprados = $dao->getListResultOfNativeQueryWithParameters(Queries::GET_IDS_RESTAURANTES_CLIENTE_COMPROU, $params);
    $smarty->assign('idsRestaurantesComprados', $idsRestaurantesComprados);
}


if (!isset($_SESSION['id']) || $restaurante == null || $idsRestaurantesComprados == null || !in_array($res, $idsRestaurantesComprados)) {
    header("Location: ../error");
}

$params1['id_cliente'] = $_SESSION['id'];
$params1['id_restaurante'] = $res;
$nota = $dao->getArrayResultOfNativeQueryWithParameters(Queries::GET_NOTA_CLINTE_RESTAURANTE, $params1);
$smarty->assign('nota', $nota['nota']);


include_once '../pages/header.php';

$smarty->assign('restaurante', $restaurante);
$smarty->display($path.'templates/rate.tpl');

include_once $path.'pages/footer.php';