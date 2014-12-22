<?php

require_once '../pages/pathVars.php';
require_once $path . 'src/app/util/CheckLoggedIn.php';
require_once $path . 'src/app/util/UserTypes.php';
require_once '../src/app/model/VO/PedidoVO.class.php';

if (!CheckLoggedIn::checkPermission(UserTypes::CLIENTE)) {
    header('Location: ../pages/index');
}

include_once $path . 'pages/header.php';

require_once $path . 'pages/smartyHeader.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';
require_once $path . 'src/app/util/Queries.php';

$dao = new Dao();
$kindsOfFood = $dao->getListResultOfNamedQuery(Queries::TIPOS_RESTAURANTE_DISTINCT);

if (isset($_SESSION['id'])) {
    $cliente = $dao->findByKey('Cliente', $_SESSION['id']);
    $smarty->assign('cliente', $cliente);
    foreach ($cliente->getPedidos() as $pedido) {
        $pedido->setDataHora($pedido->getDataHora()->format('d/m/Y - H:i:s'));
    }
    $smarty->assign('pedidos', $cliente->getPedidos());
    $smarty->assign('ultimosPedidos', array_slice($cliente->getPedidos()->toArray(), 0, 3));
}


$smarty->assign('kindsOfFood', $kindsOfFood);
$smarty->display($path . 'templates/clientePage.tpl');

include_once $path . 'pages/footer.php';
