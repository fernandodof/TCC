<?php
require_once './smartyHeader.php';
require_once '../src/app/model/persistence/Dao.class.php';
require_once '../src/app/util/Queries.php';
require_once '../src/app/model/VO/PedidoVO.class.php';
require_once '../src/app/model/VO/ItemPedidoVO.class.php';
require_once '../src/app/model/VO/ProdutoVO.class.php';
require_once '../src/app/model/VO/TamanhoVO.class.php';

include_once '../pages/header.php';

$dao = new Dao();

$params['id'] = $_SESSION['id'];
$cliente = $dao->findByKey('Cliente', $params);
$idRestaurantePedido = filter_input(INPUT_POST, 'idRestaurantePedido');

$restaurante = $dao->findByKey('Restaurante', $idRestaurantePedido);

$smarty->assign('cliente', $cliente);
$smarty->assign('restaurante', $restaurante);
$smarty->display('../templates/confirmOrder.tpl');

include_once '../pages/footer.php';