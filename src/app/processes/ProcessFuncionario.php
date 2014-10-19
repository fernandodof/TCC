<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../model/persistence/Dao.class.php';
require_once '../util/EncryptPassword.php';;
require_once '../util/Queries.php';

function recieveForm($param) {
    return strip_tags(addslashes($param));
}

switch (recieveForm(filter_input(INPUT_POST, 'formSubmit'))) {
    case "Login": {
            login();
            break;
        }
}

function login() {
    $dao = new Dao();

    $params['login'] = filter_input(INPUT_POST, 'funcLogin');
    $params['senha'] = EncryptPassword::encrypt(filter_input(INPUT_POST, 'funcSenha'));

    $funcionario = $dao->getSingleResultOfNamedQueryWithParameters(Queries::LOGIN_FUNCIONARIO, $params);

    session_start();
    
    $_SESSION['nome'] = $funcionario->getNome();
    $_SESSION['id'] = $funcionario->getId();
    $_SESSION['funcRestaurante'] = $funcionario->getRestaurante()[0]->getNome();
    $_SESSION['tipo'] = 'funcionario';
    

    header("Location: ../../../pages/funcionarioPage.php");
    exit();
}