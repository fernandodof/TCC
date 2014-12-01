<?php
require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';
$dao = new Dao();

$idPedido = filter_input(INPUT_POST,'idPedido');
$status = filter_input(INPUT_POST, 'status');

$params['id'] = $idPedido;
$params['status'] = $status;
$dao->executeQueryWithParameters(Queries::SET_PEDIDO_STATUS, $params);