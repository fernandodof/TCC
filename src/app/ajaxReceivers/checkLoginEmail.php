<?php

require '../model/persistence/Dao.class.php';
require '../util/Queries.php';
$dao = new Dao();

$isAvailable = true;

switch (filter_input(INPUT_GET, 'type')) {
    case 'email':
        $params['email'] = filter_input(INPUT_GET, 'email');
        $emailCount = $dao->getArrayResultOfNativeQueryWithParameters(Queries::CHECK_EMAIL_EXISTS_N, $params);

        if ($emailCount['count']) {
            $isAvailable = false;
        }
        break;
    case 'login': {
            $params['login'] = filter_input(INPUT_GET, 'login');
            $longinCount = $dao->getArrayResultOfNativeQueryWithParameters(Queries::CHECK_LOGIN_EXISTS_N, $params);
            if ($longinCount['count']) {
                $isAvailable = false;
            }
            break;
        }
}

echo json_encode(array(
    'valid' => $isAvailable,
));
