<?php

require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';
require_once '../util/EncryptPassword.php';

$dao = new Dao();

$emailLogin = filter_input(INPUT_POST, 'emailLogin');
$senhaLogin = filter_input(INPUT_POST, 'senhaLogin');
$params['senha'] = EncryptPassword::encrypt($senhaLogin);

$cliente = null;
$isValid = true;
if (isEmail($emailLogin)) {
    $params['email'] = $emailLogin;
    $cliente = $dao->getSingleResultOfNamedQueryWithParameters(Queries::LOGIN_COM_EMAIl, $params);
} else {
    $params['login'] = $emailLogin;
    $cliente = $dao->getSingleResultOfNamedQueryWithParameters(Queries::LOGIN_COM_LOGIN, $params);
}

if($cliente==null){
    $isValid = false;
}

echo $isValid;

//echo json_encode(array(
//    'valid' => $isValid,
//));


function isEmail($str) {
    if (filter_var($str, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
