<?php

require_once '../../../pages/pathVars.php';
require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';
require_once '../util/EncryptPassword.php';

$dao = new Dao();

switch (filter_input(INPUT_POST, 'type')) {
    case 'cliente':
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

        if ($cliente == null) {
            $isValid = false;
        } else {
            session_start();
            session_destroy();
            session_start();
            $_SESSION['nome'] = $cliente->getNome();
            $_SESSION['login'] = $cliente->getLogin();
            $_SESSION['email'] = $cliente->getEmail();
            $_SESSION['id'] = $cliente->getId();
            $_SESSION['raio'] = $cliente->getRaioPref();
            $_SESSION['tipo'] = 'cliente';
            $_SESSION['logged_in'] = true;
            $_SESSION['last_activity'] = time();
            $_SESSION['expire_time'] = 30 * 60;
        }
        echo $isValid;
        break;
    case 'funcionario':
        $isValid = true;

        $params['login'] = filter_input(INPUT_POST, 'funcLogin');
        $params['senha'] = EncryptPassword::encrypt(filter_input(INPUT_POST, 'funcSenha'));
        $funcionario = $dao->getSingleResultOfNamedQueryWithParameters(Queries::LOGIN_FUNCIONARIO, $params);

        if ($funcionario == null) {
            $isValid = false;
        } else {
            session_start();
            session_destroy();

            session_start();
            $_SESSION['nome'] = $funcionario->getNome();
            $_SESSION['id'] = $funcionario->getId();
            $_SESSION['funcRestaurante'] = $funcionario->getRestaurante()->getNome();
            $_SESSION['idRestaurante'] = $funcionario->getRestaurante()->getId();
            $_SESSION['tipo'] = 'funcionario';
            $_SESSION['logged_in'] = true;
            $_SESSION['last_activity'] = time();
            $_SESSION['expire_time'] = 30 * 60;
        }
        echo $isValid;
        break;
}

function isEmail($str) {
    if (filter_var($str, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
