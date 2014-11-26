<?php
require_once './pathVars.php';

require_once $path.'pages/smartyHeader.php';
require_once $path.'/src/app/model/entities/Restaurante.class.php';
require_once $path.'src/app/util/Queries.php';
require_once $path.'src/app/model/persistence/Dao.class.php';

$dao = new Dao();


list(,,,, $res) = explode('/', filter_input(INPUT_SERVER, 'REQUEST_URI'));

$restaurante = $dao->findByKey('Restaurante', $res);

if ($restaurante == null) {
    header("Location: ../error");
}

include_once '../pages/header.php';

if(isset($_SESSION['id'])){
    $params['id_cliente'] = $_SESSION['id'];
    $idsRestaurantesComprados = $dao->getListResultOfNativeQueryWithParameters(Queries::GET_IDS_RESTAURANTES_CLIENTE_COMPROU, $params);
    $smarty->assign('idsRestaurantesComprados', $idsRestaurantesComprados);
    
}

$smarty->assign('restaurante', $restaurante);
$smarty->display($path.'templates/rate.tpl');

include_once $path.'pages/footer.php';