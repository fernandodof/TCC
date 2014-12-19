<?php

require_once 'UserTypes.php';

/**
 * Description of CheckLoggedIn
 *
 * @author Fernando
 */
class CheckLoggedIn {

    public static function checkPermission($type) {
        session_start();
        $valid = true;
        if (!isset($_SESSION['id']) || ($_SESSION['tipo'] != $type)) {
            $valid = false;
        }
        return $valid;
    }

}
