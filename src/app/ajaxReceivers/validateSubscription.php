<?php

require '../model/persistence/Dao.class.php';
require '../util/Queries.php';
require '../util/EncryptPassword.php';

$dao = new Dao();

$isValid = true;

switch (filter_input(INPUT_GET, 'type')) {
    case 'email':
        $params['email'] = filter_input(INPUT_GET, 'email');
        $emailCount = $dao->getArrayResultOfNativeQueryWithParameters(Queries::CHECK_EMAIL_EXISTS, $params);

        if ($emailCount['count']) {
            $isValid = false;
        }
        break;
    case 'login': {
            $params['login'] = filter_input(INPUT_GET, 'login');
            $longinCount = $dao->getArrayResultOfNativeQueryWithParameters(Queries::CHECK_LOGIN_EXISTS, $params);
            if ($longinCount['count']) {
                $isValid = false;
            }
            break;
        }
}

echo json_encode(array(
    'valid' => $isValid,
));
