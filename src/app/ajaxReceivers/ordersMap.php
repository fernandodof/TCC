<?php

require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';
require_once '../model/entities/Pedido.class.php';

$params['id'] = filter_input(INPUT_POST, 'idRestaurante');

$startArray = explode('/', filter_input(INPUT_POST, 'start'));
$endArray = explode('/', filter_input(INPUT_POST, 'end'));

$params['start'] = date('Y-m-d H:i:s', mktime('00', '00', '00', $startArray[1], $startArray[0], $startArray[2]));
$params['end'] = date('Y-m-d H:i:s', mktime('23', '59', '59', $endArray[1], $endArray[0], $endArray[2]));

$dao = new Dao();

$pedidos = $dao->getListAssocResultOfNativeQueryWithParameters(Queries::GET_PEDIDOS_FINALIZADOS_POR_RESTAURANTE_DATA, $params);

echo json_encode($pedidos);