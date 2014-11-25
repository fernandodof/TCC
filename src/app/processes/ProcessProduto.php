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

   
    var_dump($precos);
    
    for ($i = 0; $i < count($precos); $i++) {
        $precos[$i] = str_replace("R$ ", "", $precos[$i]);
    }
    
    var_dump($precos);

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

    $dao->save($produto);
    $restaurante->addProduto($produto);
    $dao->save($restaurante);

    header("Location: ../../../pages/funcionarioPage?produtoCadastrado=sucesso");
    exit();
}
