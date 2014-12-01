<?php
require_once './src/app/model/persistence/Dao.class.php';
require_once './src/app/model/entities/Categoria.class.php';
require_once './src/app/util/Queries.php';
$dao = new Dao();

//$categoria = new Categoria();
//$categoria->setNome('Comida');
//$dao->save($categoria);
//
//
//$categoria1 = new Categoria();
//$categoria1->setNome('Bebida');
//$dao->save($categoria1);

//$params['id'] = '2';
//$params['dataHora'] = new \DateTime();
//$pedidos =  $dao->getListResultOfNamedQueryWithParameters(Queries::GET_PEDIDOS_RESTAURANTE_EM_ABERTO_DATA, $params);
//
////print_r($pedidos->getDataHora());
//
//foreach ($pedidos as $p){
//    echo $p->getDataHora()->format('d/m/Y - H:i:s').'<br>';
//}

//$params['id'] = '37';
//$dao->executeQueryWithParameters(Queries::SET_PEDIDO_ENCAMINHADO, $params);

//$params['id_cliente'] = '2';
//$idRestauratesComprados = $dao->getListResultOfNativeQueryWithParameters(Queries::GET_IDS_RESTAURANTES_CLIENTE_COMPROU, $params);
//var_dump($idRestauratesComprados);
//
//
//$params['id_cliente'] = 1;
//$params['id_restaurante'] = 1;
//$nota = $dao->getArrayResultOfNativeQueryWithParameters(Queries::GET_NOTA_CLINTE_RESTAURANTE, $params);
//
//
//var_dump($nota);

$params['id'] = '2';
$params['dataHora'] = new \DateTime();
$params['status'] = Pedido::PEDIDO_COZINHA;

$r = $dao->getListResultOfNamedQueryWithParameters(Queries::GET_PEDIDOS_POR_STATUS_RESTAURANTE_DATA, $params);
var_dump($r);