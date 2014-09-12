<?php
require_once './bootstrap.php';
require_once './src/app/model/entities/Pessoa.class.php';
require_once './src/app/model/entities/Cliente.class.php';
require_once './src/app/model/entities/Administrador.class.php';
require_once './src/app/model/entities/Endereco.class.php';

$cliente = new Cliente();
$cliente->setEmail("fernnadodof@gmail.com");
$cliente->setNome("Fernando");
$cliente->setSenha("123456");
$cliente->setStatus(1);

$telefone = new Telefone();
$telefone->setNumero("(83) 9304-3663");

$telefone1 = new Telefone();
$telefone1->setNumero("(83)9999-9999");

$telefones[] = $telefone;
$telefones[] = $telefone1;

$cliente->setTelefones($telefones);

$endereco = new Endereco();
$endereco->setBairro("Jardim Osis");
$endereco->setCep("58900-000");
$endereco->setDescricao("Casa");
$endereco->setEstado("Paraíba");
$endereco->setLogradouro("Rua Dimas Andriola");
$endereco->setNumero("25");

$enderecos[] = $endereco;

$cliente->setEnderecos($enderecos);

$entityManager->persist($cliente);
$entityManager->flush();

//print_r ($cliente->getTelefones()->getValues());
