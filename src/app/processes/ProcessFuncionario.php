<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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
    $params['senha'] = EncryptPassword::encrypt(filter_input(INPUT_POST, 'senhaLogin'));

    $cliente = $dao->getSingleResultOfNamedQueryWithParameters(Queries::LOGIN_FUNCIONARIO, $params);

    session_start();
    
    $_SESSION['nome'] = $cliente->getNome();
    $_SESSION['id'] = $cliente->getId();
    $_SESSION['tipo'] = 'funcionario';
    
    echo "YES";
//    header("Location: ../../../pages/clientePage.php");
    exit();
}