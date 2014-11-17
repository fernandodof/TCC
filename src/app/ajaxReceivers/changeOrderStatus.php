<?php
require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';
$dao = new Dao();

$idPedido = filter_input(INPUT_POST,'idPedido');

$params['id'] = $idPedido;
$dao->executeQueryWithParameters(Queries::SET_PEDIDO_ENCAMINHADO, $params);