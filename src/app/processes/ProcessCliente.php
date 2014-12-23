<?php

require_once '../model/persistence/Dao.class.php';
require_once '../model/entities/Cliente.class.php';
require_once '../model/entities/Endereco.class.php';
require_once '../model/entities/Telefone.class.php';
require_once '../util/EncryptPassword.php';
require_once '../util/Queries.php';
require_once '../util/SendEmail.class.php';

function recieveForm($param) {
    return strip_tags(addslashes($param));
}

//var_dump($_POST);
switch (recieveForm(filter_input(INPUT_POST, 'formSubmit'))) {
    case "CadastrarCliente": {
            cadastrarCLiente();
            break;
        }
    case "Login": {
            login();
            break;
        }
    case "Logout": {
            logout();
            break;
        }
}

function cadastrarCLiente() {
    //Cliente
    $cliente = new Cliente();
    $cliente->setNome(filter_input(INPUT_POST, 'nome'));
    $cliente->setEmail(filter_input(INPUT_POST, 'email'));
    $cliente->setLogin(filter_input(INPUT_POST, 'login'));
    $cliente->setSenha(EncryptPassword::encrypt(filter_input(INPUT_POST, 'senha1')));

    //Telefone
    $telefone = new Telefone();
    $telefone->setNumero(filter_input(INPUT_POST, 'telefone'));

    //Clience <<- Telefone
    $telefones[] = $telefone;
    $cliente->setTelefones($telefones);

    //Endereco
    $endereco = new Endereco();
    $endereco->setDescricao(filter_input(INPUT_POST, 'descricaoEndereco'));
    $endereco->setLogradouro(filter_input(INPUT_POST, 'logradouro'));
    $endereco->setBairro(filter_input(INPUT_POST, 'bairro'));
    $endereco->setNumero(filter_input(INPUT_POST, 'numero'));
    $endereco->setCep(filter_input(INPUT_POST, 'cep'));
    $endereco->setCidade(filter_input(INPUT_POST, 'cidade'));
    $endereco->setEstado(filter_input(INPUT_POST, 'estado'));
    $endereco->setComplemento(filter_input(INPUT_POST, 'complemento'));

    //Cliente <<- Endereco
    $enderecos[] = $endereco;
    $cliente->setEnderecos($enderecos);
    $dao = new Dao();
    $dao->save($cliente);
    
    $sendEmail = new SendEmail();
    
    $sendEmail->sendSubscribeConfirmation($cliente->getNome(), $cliente->getEmail());
    
    header("Location: ../../../pages/subscriptionConfirmation");
    exit();
}

function login() {
    $dao = new Dao();
    $params['senha'] = EncryptPassword::encrypt(filter_input(INPUT_POST, 'senhaLogin'));
    $emailLogin = filter_input(INPUT_POST, 'emailLogin');
    if (isEmail($emailLogin)) {
        $params['email'] = $emailLogin;
        $cliente = $dao->getSingleResultOfNamedQueryWithParameters(Queries::LOGIN_COM_EMAIl, $params);
    } else {
        $params['login'] = $emailLogin;
        $cliente = $dao->getSingleResultOfNamedQueryWithParameters(Queries::LOGIN_COM_LOGIN, $params);
    }

    session_start();
    $_SESSION['nome'] = $cliente->getNome();
    $_SESSION['login'] = $cliente->getLogin();
    $_SESSION['email'] = $cliente->getEmail();
    $_SESSION['id'] = $cliente->getId();
    $_SESSION['tipo'] = 'cliente';
    $_SESSION['logged_in'] = true;
    $_SESSION['last_activity'] = time();
    $_SESSION['expire_time'] = 30 * 60;
    header("Location: ../../../pages/clientePage");
    exit();
}

function logout() {
    session_destroy();
    unset($_SESSION);
    setcookie("PHPSESSID", "", time() - 61200, "/");
    header("Location: ../../../pages/index");
}

function isEmail($str) {
    if (filter_var($str, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
