<?php
require_once '../../../pages/pathVars.php';
require_once '../../app/model/persistence/Dao.class.php';
require_once '../util/Queries.php';
require_once '../util/SendEmail.class.php';

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

$dao->save($recuperarSenha);

$sendEmail = new SendEmail();

$sendEmail->sendPasswordRecoverEmail($cliente->getNome(), $templateRoot.'pages/resetPassword/'.$recuperarSenha->getCodigo(), $cliente->getEmail());