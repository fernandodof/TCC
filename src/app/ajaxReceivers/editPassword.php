<?php
require_once '../model/entities/Cliente.class.php';
require_once '../util/EncryptPassword.php';
require_once '../model/persistence/Dao.class.php';

session_start();

$dao = new Dao();

$idCliente = $_SESSION['id'];

$cliente = $dao->findByKey('Cliente', $idCliente);

$cliente->setSenha(EncryptPassword::encrypt(filter_input(INPUT_POST, 'senha')));

$dao->save($cliente);

