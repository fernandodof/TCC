<?php

require '../../../pages/pathVars.php';
require_once $path . 'src/app/model/entities/Produto.class.php';
require_once $path . 'src/app/model/entities/Cliente.class.php';
require_once $path . 'src/app/model/entities/Comentario.class.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';
require_once $path . 'src/app/util/Queries.php';

session_start();

$dao = new Dao();

$idCliente = $_SESSION['id'];
$idProduto = filter_input(INPUT_POST, 'idProduto');
$comment = filter_input(INPUT_POST, 'comment');

$cliente = $dao->findByKey('Cliente', $idCliente);
$produto = $dao->findByKey('Produto', $idProduto);

$comentario = new Comentario();
$comentario->setCliente($cliente);
$comentario->setProduto($produto);
$comentario->setDataHora(new \DateTime());
$comentario->setDisponivel(true);
$comentario->setTexto($comment);

$dao->save($comentario);

$cliente->addComentario($comentario);
$dao->update($cliente);

$produto->addComentario($comentario);
$dao->update($produto);