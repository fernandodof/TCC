<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';
require_once '../model/entities/Funcionario.class.php';
require_once '../model/entities/Restaurante.class.php';
require_once '../model/entities/Tamanho.class.php';
require_once '../model/entities/TamanhoCadastrado.class.php';
require_once '../../../pages/pathVars.php';
include_once '../util/ChromePHP.php';

function recieveForm($param) {
    return strip_tags(addslashes($param));
}

switch (recieveForm(filter_input(INPUT_POST, 'formSubmit'))) {
    case "cadastrarProduto": {
            cadastrarProduto();
            break;
        }
}

function cadastrarProduto() {
    $dao = new Dao();
    $restaurante = $dao->findByKey('Restaurante', filter_input(INPUT_POST, 'idRestaurante'));
    $categoria = $dao->findByKey('Categoria', filter_input(INPUT_POST, 'categoria'));

    $tamanhos = filter_input(INPUT_POST, 'tamanhos', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    $precos = filter_input(INPUT_POST, 'price', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

    for ($i = 0; $i < count($precos); $i++) {
        $precos[$i] = str_replace("R$ ", "", $precos[$i]);
    }

    $produto = new Produto();
    $produto->setCategoria($categoria);
    $produto->setDisponivel(1);
    $produto->setIngredientes(filter_input(INPUT_POST, 'ingredientes'));
    $produto->setNome(filter_input(INPUT_POST, 'nomeProduto'));

    for ($i = 0; $i < count($tamanhos); $i++) {
        $tamanhosCadastrado = $dao->findByKey('TamanhoCadastrado', $tamanhos[$i]);
        $tamanho = new Tamanho();
        $tamanho->setCategoria($categoria);
        $tamanho->setDescricao($tamanhosCadastrado->getDescricao());
        $tamanho->setPreco($precos[$i]);
        $produto->addTamanho($tamanho);
    }

    if (strtolower($categoria->getNome()) === 'comida') {
        $imgFile = $_FILES['image'];

        $errorName = null;
        if ($imgFile['error'] != 0) {
            echo 'Erro no Envio do Arquivo ';
            switch ($imgFile['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    $errorName = 'O Arquivo excede o tamanho máximo permitido';
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $errorName = 'O Arquivo excede o tamanho máximo permitido';
                    break;
                case UPLOAD_ERR_PARTIAL:
                    $errorName = 'O Envio não foi completado';
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $errorName = 'Nenhum arquivo foi enviado';
                    break;
                default:
                    $errorName = "Nenhum foi escolhido";
            }
            header("Location: ../../../pages/funcionarioPage?error=" . $errorName);
            exit;
        }

//        $fileTypes = array('image/jpeg', 'image/png');
//        //explode('/', $imgFile['type'])[1]
//        if (!array_search($imgFile['type'], $fileTypes)) {
//            $errorName = "O Arquivo enviado é do tipo " . $imgFile['type'] . " e não é aceito para envio";
//            header("Location: ../../../pages/funcionarioPage?error=" . $errorName);
//            exit;
//        }

        //getting folder for restaurants image upload
        $restauranteFolder = str_replace(' ', '', $restaurante->getNome());

        //images directorty
        $imgRoot = '../../../' . 'images/';

        //checking if folder already exists, if not create it 
        if (!file_exists($imgRoot . $restauranteFolder)) {
            mkdir($imgRoot . $restauranteFolder, 0700);
        }

        //file destination
        $destination = $imgRoot . $restauranteFolder . '/' . $imgFile['name'];

        //moving the file uploaded
        move_uploaded_file($imgFile['tmp_name'], $destination);

        //setting image path on product
        $produto->setImagem('images/' . $restauranteFolder . '/' . $imgFile['name']);
    }

    $dao->save($produto);
    $restaurante->addProduto($produto);
    $dao->save($restaurante);
    header("Location: ../../../pages/funcionarioPage?produtoCadastrado=sucesso");
    exit();
}