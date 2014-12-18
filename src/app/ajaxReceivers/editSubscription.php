<?php

require_once '../model/entities/Cliente.class.php';
require_once '../util/Queries.php';
require_once '../util/EncryptPassword.php';
require_once '../model/persistence/Dao.class.php';

session_start();

$dao = new Dao();

$idCliente = $_SESSION['id'];

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
$login = filter_input(INPUT_POST, 'login');
$senha = EncryptPassword::encrypt(filter_input(INPUT_POST, 'senha'));

$numeroTelefone = filter_input(INPUT_POST, 'telefone');

$descricaoEndereco = filter_input(INPUT_POST, 'descricaoEndereco');
$logadouro = filter_input(INPUT_POST, 'logradouro');
$bairro = filter_input(INPUT_POST, 'bairro');
$numero = filter_input(INPUT_POST, 'numero');
$cep = filter_input(INPUT_POST, 'cep');
$cidade = filter_input(INPUT_POST, 'cidade');
$estado = filter_input(INPUT_POST, 'estado');
$complemento = filter_input(INPUT_POST, 'complemento');

$cliente = $dao->findByKey('Cliente', $idCliente);

$cliente->setNome($nome);
$cliente->setEmail($email);
$cliente->setLogin($login);
$cliente->setSenha($senha);

//$t = new Doctrine\Common\Collections\ArrayCollection();
//
//$telefone = $cliente->getTelefones()->get(0)->setNumero($numeroTelefone);

$cliente->getTelefones()->get(0)->setNumero($numeroTelefone);

$endereco = $cliente->getEnderecos()->get(0);

$endereco->setDescricao($descricaoEndereco);
$endereco->setLogradouro($logadouro);
$endereco->setBairro($bairro);
$endereco->setNumero($numero);
$endereco->setCep($cep);
$endereco->setCidade($cidade);
$endereco->setEstado($estado);
$endereco->setComplemento($complemento);

$enderecos[] = $endereco;
$cliente->setEnderecos($enderecos);

$dao->save($cliente);

$_SESSION['nome'] = $nome;
$_SESSION['email'] = $email;
$_SESSION['login'] = $login;