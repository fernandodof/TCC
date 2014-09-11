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
//
//$telefone = new Telefone();
//$telefone->setNumero("(83) 9304-3663");
//$telefones[] = $telefone;
//
//$cliente->setTelefones($telefones);
//
////$adminidtrador = new Administrador();
////$adminidtrador->setLogin("fernandodof");
////$adminidtrador->setNome("Fernando");
////$adminidtrador->setSenha("123456");
////$adminidtrador->setStatus(1);
////$adminidtrador->setUltimoAcesso(new \DateTime);
//
//$entityManager->persist($cliente);
//$entityManager->flush();

$cliente = $entityManager->find('cliente', 1);
print_r ($cliente->getTelefones()->getValues());
