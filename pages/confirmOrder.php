<?php

require_once '../pages/pathVars.php';
require_once $path . 'src/app/util/CheckLoggedIn.php';
require_once $path . 'src/app/util/UserTypes.php';
require_once $path . 'pages/smartyHeader.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';
require_once $path . 'src/app/util/Queries.php';
require_once $path . 'src/app/model/VO/PedidoVO.class.php';
require_once $path . 'src/app/model/VO/ItemPedidoVO.class.php';
require_once $path . 'src/app/model/VO/ProdutoVO.class.php';
require_once $path . 'src/app/model/VO/TamanhoVO.class.php';

if (!CheckLoggedIn::checkPermission(UserTypes::CLIENTE) || !($_SESSION['pedido'])) {
    header('Location: ../pages/index');
}

include_once '../pages/header.php';

$dao = new Dao();
$params['id'] = $_SESSION['id'];
$cliente = $dao->findByKey('Cliente', $params);
$idRestaurantePedido = $_SESSION['idRestauranteDoPedidoAtual'];

$restaurante = $dao->findByKey('Restaurante', $idRestaurantePedido);

$smarty->assign('cliente', $cliente);
$smarty->assign('restaurante', $restaurante);
$smarty->display($path . 'templates/confirmOrder.tpl');

include_once $path . 'pages/footer.php';
