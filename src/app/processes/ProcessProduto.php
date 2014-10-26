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
    echo filter_input(INPUT_POST, 'categoria');
    $categoria = $dao->findByKey('Categoria', filter_input(INPUT_POST, 'categoria'));

    $tamanhos = $_POST['tamanhos'];

    $produto = new Produto();
    $produto->setCategoria($categoria);
    $produto->setDisponivel(1);
    $produto->setIngredientes(filter_input(INPUT_POST, 'ingredientes'));
    $produto->setNome(filter_input(INPUT_POST, 'nomeProduto'));

    foreach ($tamanhos as $t) {
        $produto->addTamanho($dao->findByKey('Tamanho', $t));
    }
    
    $dao->save($produto);
    $restaurante->addProduto($produto);
    $dao->save($restaurante);
    
    header("Location: ../../../pages/funcionarioPage.php?produtoCadastrado=sucesso");
    
    exit();
}
