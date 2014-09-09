<?php
require_once './bootstrap.php';
require_once './src/app/model/entities/Pessoa.class.php';
require_once './src/app/model/entities/Cliente.class.php';
require_once './src/app/model/entities/Administrador.class.php';

//$cliente = new Cliente();
//$cliente->setEmail("fernnadodof@gmail.com");
//$cliente->setNome("Fernando");
//$cliente->setSenha("123456");
//$cliente->setStatus(1);

$adminidtrador = new Administrador();
$adminidtrador->setLogin("fernandodof");
$adminidtrador->setNome("Fernando");
$adminidtrador->setSenha("123456");
$adminidtrador->setStatus(1);
$adminidtrador->setUltimoAcesso(new \DateTime);

$entityManager->persist($adminidtrador);
$entityManager->flush();

echo $adminidtrador->getId();