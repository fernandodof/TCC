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
$idRestaurante = filter_input(INPUT_POST, 'idRestaurante');
$novaNota = filter_input(INPUT_POST, 'nota');

$cliente = $dao->findByKey('Cliente', $idCliente);
$restaurante = $dao->findByKey('Restaurante', $idRestaurante);

$params['id_cliente'] = $idCliente;
$params['id_restaurante'] = $idRestaurante;
$nota = $dao->getArrayResultOfNativeQueryWithParameters(Queries::GET_NOTA_CLINTE_RESTAURANTE, $params);

var_dump($nota);

if ($nota != false) {
    $avaliacao = $dao->findByKey('Avaliacao', $nota['id']);
    $avaliacao->setNota($novaNota);
    $dao->update($avaliacao);
} else {
    $avaliacao = new Avaliacao();
    $avaliacao->setCliente($cliente);
    $avaliacao->setRestaurante($restaurante);
    $avaliacao->setNota($novaNota);
    $dao->save($avaliacao);
    $dao->update($cliente);
    $dao->update($restaurante);
}
