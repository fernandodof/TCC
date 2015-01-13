<?php

require_once './bootstrap.php';
require_once './src/app/model/entities/Pessoa.class.php';
require_once './src/app/model/entities/Cliente.class.php';
require_once './src/app/model/entities/Administrador.class.php';
require_once './src/app/model/entities/Endereco.class.php';
require_once './src/app/model/persistence/Dao.class.php';
require_once './src/app/util/EncryptPassword.php';
require_once './src/app/util/Queries.php';

$dao = new Dao();
//
//$cliente = new Cliente();
//$cliente->setEmail("fernnadodof@gmail.com");
//$cliente->setNome("Fernando");
//$cliente->setSenha("123456");
//$cliente->setStatus(1);
//
//$telefone = new Telefone();
//$telefone->setDdd("83");
//$telefone->setNumero("9304-3663");
//
//$telefone1 = new Telefone();
//$telefone1->setDdd("83");
//$telefone1->setNumero("9999-9999");
//
//$telefones[] = $telefone;
//$telefones[] = $telefone1;
//
//$cliente->setTelefones($telefones);
//
//$endereco = new Endereco();
//$endereco->setBairro("Jardim Osis");
//$endereco->setCep("58900-000");
//$endereco->setDescricao("Casa");
//$endereco->setEstado("Paraíba");
//$endereco->setCidade("Cajazeiras");
//$endereco->setLogradouro("Rua Dimas Andriola");
//$endereco->setNumero("25");
//
//$enderecos[] = $endereco;
//
//$cliente->setEnderecos($enderecos);
//
//$dao->save($cliente);
//$params['email'] = 'fernandodof@gmail.com';
//$params['senha'] = EncryptPassword::encrypt("123456");
//
//$cliente1 = $dao->getSingleResultOfNamedQueryWithParameters(Queries::LOGIN, $params);
//echo $cliente1->getNome();

$c = $dao->findByKey('Cliente', 1);

echo $c->getNome();

//echo EncryptPassword::encrypt("123456");
//print_r ($cliente->getTelefones()->getValues());
