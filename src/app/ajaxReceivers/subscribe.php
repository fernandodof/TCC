<?php

require_once '../model/entities/Cliente.class.php';
require_once '../model/entities/Telefone.class.php';
require_once '../model/entities/Endereco.class.php';
require_once '../model/persistence/Dao.class.php';
require_once '../util/SendEmail.class.php';
require_once '../util/EncryptPassword.php';

//Cliente
$cliente = new Cliente();
$cliente->setNome(filter_input(INPUT_POST, 'nome'));
$cliente->setEmail(filter_input(INPUT_POST, 'email'));
$cliente->setLogin(filter_input(INPUT_POST, 'login'));
$cliente->setSenha(EncryptPassword::encrypt(filter_input(INPUT_POST, 'senha1')));

//Telefone
$telefone = new Telefone();
$telefone->setNumero(filter_input(INPUT_POST, 'telefone'));

//Clience <<- Telefone
$telefones[] = $telefone;
$cliente->setTelefones($telefones);

//Endereco
$endereco = new Endereco();
$endereco->setDescricao(filter_input(INPUT_POST, 'descricaoEndereco'));
$endereco->setLogradouro(filter_input(INPUT_POST, 'logradouro'));
$endereco->setBairro(filter_input(INPUT_POST, 'bairro'));
$endereco->setNumero(filter_input(INPUT_POST, 'numero'));
$endereco->setCep(filter_input(INPUT_POST, 'cep'));
$endereco->setCidade(filter_input(INPUT_POST, 'cidade'));
$endereco->setEstado(filter_input(INPUT_POST, 'estado'));
$endereco->setComplemento(filter_input(INPUT_POST, 'complemento'));

//Cliente <<- Endereco
$enderecos[] = $endereco;
$cliente->setEnderecos($enderecos);
$dao = new Dao();
$dao->save($cliente);

$sendEmail = new SendEmail();

echo true;

$sendEmail->sendSubscribeConfirmation($cliente->getNome(), $cliente->getEmail());
