<?php

require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';
require_once '../model/entities/Pedido.class.php';
session_start();
$dao = new Dao();

$idPedido = intval(filter_input(INPUT_POST, 'idPedido'));
$status = intval(filter_input(INPUT_POST, 'status'));

$currentStatus = $status - 1;

switch ($currentStatus) {
    case Pedido::PEDIDO_RECEBIDO:
        $pedidosCaregados = $_SESSION['pedidosNovosCarregados'];
        if (($key = array_search($idPedido, $pedidosCaregados)) !== false) {
            unset($_SESSION['pedidosNovosCarregados'][$key]);
        }
        break;
    case Pedido::PEDIDO_COZINHA:
        $pedidosCaregados = $_SESSION['pedidosCozinhaCarregados'];
        if (($key = array_search($idPedido, $pedidosCaregados)) !== false) {
            unset($_SESSION['pedidosCozinhaCarregados'][$key]);
        }
        break;
    case Pedido::PEDIDO_ENTREGA:
        $pedidosCaregados = $_SESSION['pedidosEntregaCarregados'];
        if (($key = array_search($idPedido, $pedidosCaregados)) !== false) {
            unset($_SESSION['pedidosEntregaCarregados'][$key]);
        }
        break;
}

$params['id'] = $idPedido;
$dao->executeQueryWithParameters(Queries::UPDATE_STATUS_PEDIDO, $params);
