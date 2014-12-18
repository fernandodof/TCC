<?php

require '../model/persistence/Dao.class.php';
require '../util/Queries.php';
require '../util/EncryptPassword.php';

$dao = new Dao();
session_start();

$isValid = true;

switch (filter_input(INPUT_GET, 'type')) {
    case 'email':
        $params['email'] = filter_input(INPUT_GET, 'email');
        $emailCount = $dao->getArrayResultOfNativeQueryWithParameters(Queries::CHECK_EMAIL_EXISTS, $params);

        if ($emailCount['count']) {
            $isValid = false;
        }
        
        if($params['email'] == $_SESSION['email']){
            $isValid = true;
        }
        
        break;
    case 'login': {
            $params['login'] = filter_input(INPUT_GET, 'login');
            $longinCount = $dao->getArrayResultOfNativeQueryWithParameters(Queries::CHECK_LOGIN_EXISTS, $params);
            if ($longinCount['count']) {
                $isValid = false;
            }
            
            if($params['login'] == $_SESSION['login']){
               $isValid = true; 
            }
            break;
        }
    case 'senhaAtual': {
            $params['id'] = $_SESSION['id'];
            $senha = EncryptPassword::encrypt(filter_input(INPUT_GET, 'senhaAtual'));
            $senhaDB = $dao->getArrayResultOfNativeQueryWithParameters(Queries::GET_SENHA_ATUAL, $params);

            if ($senha === $senhaDB['senha']) {
                $isValid = true;
            }else{
                $isValid = false;
            }
        }
        
}

echo json_encode(array(
    'valid' => $isValid,
));
