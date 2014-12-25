<?php

require_once '../../app/model/persistence/Dao.class.php';
require_once '../util/Queries.php';
require_once '../util/EncryptPassword.php';


$codigo = filter_input(INPUT_POST, 'codigo');

$dao = new Dao();

$params['codigo'] = $codigo;
$recuperar = $dao->getArrayResultOfNativeQueryWithParameters(Queries::GET_ID_PESSOA_CODIGO_BY_PASSWORD_CODE, $params);

if (!$recuperar) {
    echo 0;
} else {

    $password = EncryptPassword::encrypt(filter_input(INPUT_POST, 'password'));

    $cliente = $dao->findByKey('Cliente', $recuperar['pessoa_id']);
    $cliente->setSenha($password);
    $dao->save($cliente);

    $params1['id'] = $recuperar['id'];
    $dao->executeQueryWithParameters(Queries::UPDATE_SENHA_REDEFINIDA, $params1);
}