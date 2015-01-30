<?php

require_once '../model/persistence/Dao.class.php';

$dao = new Dao();
session_start();

$cliente = $dao->findByKey('Cliente', $_SESSION['id']);
$cliente->setRaioPref(trim(filter_input(INPUT_POST, 'km')));

$_SESSION['raio'] = trim(filter_input(INPUT_POST, 'km'));
$dao->update($cliente);

echo true;
