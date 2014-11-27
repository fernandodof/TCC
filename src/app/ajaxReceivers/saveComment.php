<?php

require '../../../pages/pathVars.php';
require_once $path . 'src/app/model/entities/Restaurante.class.php';
require_once $path . 'src/app/model/entities/Cliente.class.php';
require_once $path . 'src/app/model/entities/Comentario.class.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';
require_once $path . 'src/app/util/Queries.php';

session_start();

$dao = new Dao();

$idCliente = $_SESSION['id'];
$idRestaurante = filter_input(INPUT_POST, 'idRestaurante');
$comment = filter_input(INPUT_POST, 'comment');


$cliente = $dao->findByKey('Cliente', $idCliente);
$restaurante = $dao->findByKey('Restaurante', $idRestaurante);

$comentario = new Comentario();
$comentario->setCliente($cliente);
$comentario->setRestaurante($restaurante);
$comentario->setDataHora(new \DateTime());
$comentario->setDisponivel(true);
$comentario->setTexto($comment);

$dao->save($comentario);

$cliente->addComentario($comentario);
$dao->update($cliente);

$restaurante->addComentario($comentario);
$dao->update($restaurante);