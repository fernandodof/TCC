<?php

require_once '../model/persistence/Dao.class.php';
require_once '../model/entities/Pedido.class.php';
require_once '../model/entities/Produto.class.php';
require_once '../model/entities/ItemPedido.class.php';
require_once '../model/entities/Categoria.class.php';
require_once '../model/entities/Cliente.class.php';
require_once '../model/entities/Restaurante.class.php';
require_once '../model/VO/PedidoVO.class.php';
require_once '../model/VO/ItemPedidoVO.class.php';
require_once '../model/VO/ProdutoVO.class.php';
require_once '../model/VO/CategoriaVO.class.php';
require_once '../model/VO/TamanhoVO.class.php';
require_once '../util/SendEmail.class.php';

session_start();
if(!isset($_SESSION['idRestauranteDoPedidoAtual'])){
    header('Location: ../../../pages/clientePage.php');
}else{

    $dao = new Dao();

    $clienteId = $_SESSION['id'];
    $cliente = $dao->findByKey('Cliente', $clienteId);

    $restauranteId = $_SESSION['idRestauranteDoPedidoAtual'];
    $restaurante = $dao->findByKey('Restaurante', $restauranteId);

    $obs = filter_input(INPUT_POST, 'obs');

    $pedidoVO = $_SESSION['pedido'];

    $pedido = new Pedido();

    foreach ($pedidoVO->getItensPedido() as $it) {
        $idProuto = $it->getProduto()->getId();
        $produto = $dao->findByKey('Produto', $idProuto);

        $tamanho = $dao->findByKey('Tamanho', $it->getTamanho()->getId());

        $itemPedido = new ItemPedido();
        $itemPedido->setProduto($produto);
        $itemPedido->setQuantidade($it->getQuantidade());
        $itemPedido->setSubtotal($it->getSubtotal());
        $itemPedido->setTamanho($tamanho);

        $pedido->addItemPedido($itemPedido);
    }

    if ($obs == '') {
        $pedido->setObservacoes(null);
    } else {
        $pedido->setObservacoes($obs);
    }

    $pedido->setValorTotal($pedidoVO->getValorTotal());
    $pedido->setDataHora(new \DateTime());
    $pedido->setCliente($cliente);
    $pedido->setRestaurante($restaurante);
    $pedido->setStatus(Pedido::PEDIDO_RECEBIDO);

    if($_SESSION['latLong']){
       $latLong = explode(',', $_SESSION['latLong']);
       $pedido->setLatitude($latLong[0]);
       $pedido->setLongitude($latLong[1]);
    }
    
    $cliente->addPedido($pedido);
    $restaurante->addPedido($pedido);
    $dao->update($cliente);
    $dao->update($restaurante);
    
    $sendEmail = new SendEmail();
    
    $sendEmail->sendOrderConfirmation($cliente->getNome(), $pedidoVO, $restaurante->getNome(), $pedido->getDataHora()->format('d/m/Y - H:i:s'), $cliente->getEmail());
    
    unset($_SESSION['pedido']);
    unset($_SESSION['idRestauranteDoPedidoAtual']);
}