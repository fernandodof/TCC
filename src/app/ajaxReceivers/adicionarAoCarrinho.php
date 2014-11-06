<?php

require_once '../model/persistence/Dao.class.php';
require_once '../model/entities/Pedido.class.php';
require_once '../model/entities/ItemPedido.class.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

if (!isset($_SESSION['id'])) {
    echo 'Por favor faça o login para poder reslizar o pedido';
} else {

    $idProuto = filter_input(INPUT_GET, 'idProduto');
    $idTamanho = filter_input(INPUT_GET, 'idTamanho');
    $quantidade = filter_input(INPUT_GET, 'quantidade');

    $dao = new Dao();
    $produto = $dao->findByKey('Produto', $idProuto);
    $tamanho = $dao->findByKey('Tamanho', $idTamanho);

    $itemPedido = new ItemPedido();
    $itemPedido->setProduto($produto);
    $itemPedido->setTamanho($tamanho);
    $itemPedido->setQuantidade($quantidade);
    $itemPedido->setSubtotal($tamanho->getPreco() * $quantidade);

    if (!isset($_SESSION['pedido'])) {
        $pedido = new Pedido();
        $pedido->addItemPedido($itemPedido);
        $valor = 0;
        foreach ($pedido->getItensPedido() as $i) {
            $valor += $i->getSubtotal();
        }
        $pedido->setValorTotal($valor);

        $_SESSION['pedido'] = $pedido;
    } else {
        $pedido = $_SESSION['pedido'];
        $pedido->addItemPedido($itemPedido);
        foreach ($pedido->getItensPedido() as $i) {
            $valor += $i->getSubtotal();
        }
        $pedido->setValorTotal($valor);
        $_SESSION['pedido'] = $pedido;
    }

    echo '[' . $quantidade . '] ' . $produto->getNome() . ' Tamanho ' . $tamanho->getDescricao() . ' Adicionado com Succeso';
}