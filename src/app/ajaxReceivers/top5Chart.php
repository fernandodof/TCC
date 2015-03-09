<?php

require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';

$params['id_restaurante'] = filter_input(INPUT_POST, 'idRestaurante');

$dao = new Dao();

$resutlt = $dao->getListAssocResultOfNativeQueryWithParameters(Queries::GET_TOP_5_PRODUTOS_VENDIDOS_PEDIDO_FINALIZADO_POR_RESTAURANTE, $params);

$top5 = '';

foreach ($resutlt as $r){
    $auxArray[] = $r['nome'];
    $auxArray[] = intval($r['vendas']);
    $top5[] = $auxArray;
    $auxArray = null;
}

echo json_encode($top5);