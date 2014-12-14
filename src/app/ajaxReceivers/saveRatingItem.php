<?php

require '../../../pages/pathVars.php';
require_once $path . 'src/app/model/entities/Restaurante.class.php';
require_once $path . 'src/app/model/entities/Cliente.class.php';
require_once $path . 'src/app/model/entities/Avaliacao.class.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';
require_once $path . 'src/app/util/Queries.php';

session_start();

$dao = new Dao();

$idCliente = $_SESSION['id'];
$idProduto = filter_input(INPUT_POST, 'idProduto');
$novaNota = filter_input(INPUT_POST, 'nota');

$cliente = $dao->findByKey('Cliente', $idCliente);
$produto = $dao->findByKey('Produto', $idProduto);

$params['id_cliente'] = $idCliente;
$params['id_produto'] = $idProduto;
$nota = $dao->getArrayResultOfNativeQueryWithParameters(Queries::GET_NOTA_CLINTE_PRODUTO, $params);

if ($nota != false) {
    $avaliacao = $dao->findByKey('Avaliacao', $nota['id']);
    $avaliacao->setNota($novaNota);
    $dao->update($avaliacao);
} else {
    $avaliacao = new Avaliacao();
    $avaliacao->setCliente($cliente);
    $avaliacao->setProduto($produto);
    $avaliacao->setNota($novaNota);
    $dao->save($avaliacao);
    
    $cliente->addAvaliacao($avaliacao);
    $produto->addAvaliacao($avaliacao);
    $dao->update($cliente);
    $dao->update($produto);
}