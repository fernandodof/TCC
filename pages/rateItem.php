<?php
require_once './pathVars.php';

require_once $path.'pages/smartyHeader.php';
require_once $path.'/src/app/model/entities/Restaurante.class.php';
require_once $path.'src/app/util/Queries.php';
require_once $path.'src/app/model/persistence/Dao.class.php';
session_start();
$dao = new Dao();

list(,,,, $idProuto) = explode('/', filter_input(INPUT_SERVER, 'REQUEST_URI'));

$produto = $dao->findByKey('Produto', $idProuto);

$idsProdutosComprados = null;

if(isset($_SESSION['id'])){
    $params['id_cliente'] = $_SESSION['id'];
    $idsProdutosComprados = $dao->getListResultOfNativeQueryWithParameters(Queries::GET_IDS_PRODUTOS_CLIENTE_COMPROOU, $params);
    $smarty->assign('idsProdutosComprados', $idsProdutosComprados);
}


if (!isset($_SESSION['id']) || $produto == null || $idsProdutosComprados == null || !in_array($idProuto, $idsProdutosComprados)) {
    header("Location: ../error");
} 

$params1['id_cliente'] = $_SESSION['id'];
$params1['id_produto'] = $idProuto;
$nota = $dao->getArrayResultOfNativeQueryWithParameters(Queries::GET_NOTA_CLINTE_PRODUTO, $params1);
$smarty->assign('nota', $nota['nota']);

$avgRating;
$sum = 0;
$counter = 0;
foreach ($produto->getAvaliacoes() as $av) {
    $sum += $av->getNota();
    $counter++;
}

if ($counter > 0) {
    $avg = $sum / $counter;
} else {
    $avg = 0;
}

$avgRating = $avg;

$smarty->assign('avgRating', $avgRating);

include_once '../pages/header.php';

$smarty->assign('produto', $produto); 
$smarty->display($path.'templates/rateItem.tpl');

include_once $path.'pages/footer.php';