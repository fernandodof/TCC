<?php

require_once '../model/persistence/Dao.class.php';
require_once '../model/entities/Pedido.class.php';
require_once '../model/entities/ItemPedido.class.php';
require_once '../model/entities/Produto.class.php';
require_once '../model/entities/Categoria.class.php';
require_once '../model/entities/Tamanho.class.php';
require_once '../util/Queries.php';

session_start();

if (!isset($_SESSION['id'])) {
    echo 'Erro';
} else {
    $dao = new Dao();
    $idRestaurantePedido = filter_input(INPUT_POST, 'idRestaurantePedido');
    $params['id'] = $idRestaurantePedido;
    $nomeRestaurante = $dao->getSingleResultOfNamedQueryWithParameters(Queries::GET_NOME_RESTAURANTE_BY_ID, $params);
    
    $idProuto = filter_input(INPUT_POST, 'idProduto');
    $idTamanho = filter_input(INPUT_POST, 'idTamanho');
    $quantidade = filter_input(INPUT_POST, 'quantidade');

    
    $produto = $dao->findByKey('Produto', $idProuto);
    $tamanho = $dao->findByKey('Tamanho', $idTamanho);

    $itemPedido = new ItemPedido();
    $itemPedido->setProduto($produto);
    $itemPedido->setTamanho($tamanho);
    $itemPedido->setQuantidade($quantidade);
    $itemPedido->setSubtotal($tamanho->getPreco() * $quantidade);
    $_SESSION['idRestauranteDoPedidoAtual'] =  $idRestaurantePedido;
    
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
        $valor = 0;
        foreach ($pedido->getItensPedido() as $i) {
            $valor += $i->getSubtotal();
        }
        $pedido->setValorTotal($valor);
        $_SESSION['pedido'] = $pedido;
    }
    
    $pedido = $_SESSION['pedido'];
    
        echo "<a href='#' class='dropdown-toggle btn btn-primary pull-left' id='togglePedido' data-toggle='dropdown'>Resumo do Pedido" . 
                            "<span class='badge' id='badgePedido'>".count($pedido->getItensPedido()) . "</span> <b class='caret'></b></a>";
        echo "<form action='../pages/confirmOrder.php' method='POST' id='formProseguir' class='pull-left'>";
            echo "<button type='submit' class='dropdown-toggle btn btn-success' id='proseguirPedido'>Proseguir Pedido" . 
                "<img class='img' src='../images/icons/hotPot.png'/> <span class='glyphicon glyphicon-arrow-right'></span></button>";
            echo "<input type='hidden' name='idRestaurantePedido' id='idRestaurantePedido' value='".$idRestaurantePedido."'>";
        echo "</form>";    
        echo "<ul class='dropdown-menu col-xs-12 col-sm-6'>";
        $counter = 0;
        echo "<div id='divNomeRestaurante'>";
            echo "<h5 id='nomeRestaurnatePedido'>".$nomeRestaurante['nome']."</h5>";
        echo "</div>";    
        echo "<li class='divider firstDivider'></li>";
        foreach ($pedido->getItensPedido() as $it) {
            $counter++;
            echo "<li>";
                echo "<div class ='row produtoDropdown'>";
                    echo "<p class ='pull-left noreProdutoDropdown'>".$it->getProduto()->getNome()."</p>";
                    echo "<p class = 'pull-right'>R$ " . $it->getTamanho()->getPreco() . "</p>";
                echo "</div>";
                echo "<div class = 'row qutidadeDropdown'>";
                    echo "<p class = 'pull-left'>Quantidade:</p>";
                    echo "<p class = 'pull-right'>".$it->getQuantidade() . "</p>";
                echo "</div>";
                echo "<div class = 'row tamanhoDropdown'>";
                    echo "<p class = 'pull-left'>Tamanho:</p>";
                    echo "<p class = 'pull-right'>".$it->getTamanho()->getDescricao() . "</p>";
                echo "</div>";
                echo "<div class = 'row subtotalDropdown'>";
                    echo "<p class = 'pull-left subtotal'>Subtotal</p>";
                    echo "<p class = 'pull-right'>R$ ".$it->getSubtotal() . "</p>";
                echo "</div>";
            echo "</li>";
            if($counter < count($pedido->getItensPedido())){
                echo "<li class='divider'></li>";
            }
        }
            echo "<li class='totalLi'>";
                echo "<div class='row totalDropdown'>";
                    echo "<p class='pull-left total'>TOTAL</p>";
                    echo "<p class='pull-right'>R$ " . $pedido->getValorTotal() . "</p>"; 
                echo "</div>";
            echo "</li>";
    echo "</ul>";

}