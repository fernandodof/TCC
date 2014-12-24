<?php
require '../model/persistence/Dao.class.php';
require '../util/Queries.php';

$dao = new Dao();

$isValid = false;

switch (filter_input(INPUT_GET, 'type')) {
    case 'email':
        $params['email'] = filter_input(INPUT_GET, 'email');
        $emailCount = $dao->getArrayResultOfNativeQueryWithParameters(Queries::CHECK_EMAIL_EXISTS, $params);

        if ($emailCount['count']) {
            $isValid = true;
        }
        break;
}

echo json_encode(array(
    'valid' => $isValid,
));
