<?php
require_once '../../app/model/persistence/Dao.class.php';
require_once '../util/Queries.php';

$email =  filter_input(INPUT_POST, 'email');

$dao = new Dao();
$params['email'] = $email;
$cliente = $dao->getSingleResultOfNamedQueryWithParameters(Queries::GET_CLIENTE_BY_EMAIL, $params);

$recuperarSenha = new RecuperarSenha();
$recuperarSenha->setPessoa($cliente);
$recuperarSenha->setCodigo(uniqid(rand()));

$expiryDate = new \DateTime();
$expiryDate->modify('+5 Hours');

$recuperarSenha->setExpira($expiryDate);