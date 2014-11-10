<?php

require '../model/entities/Pedido.class.php';
require '../model/entities/Produto.class.php';
require '../model/entities/ItemPedido.class.php';
require_once 'C:\wamp\www\Restaurantes\vendor\autoload.php';

session_start();

$pedido = $_SESSION['pedido'];
$command = filter_input(INPUT_POST, 'command');
$indexItem = filter_input(INPUT_POST, 'indexProduto');
$idRestaurante = $_SESSION['idRestauranteDoPedidoAtual'];

if ($command == 'remove') {

    if (count($pedido->getItensPedido()) == 1) {
        unset($_SESSION['pedido']);
    } else {
        $counter = 0;
        $itensDoPedido = new Doctrine\Common\Collections\ArrayCollection();
        foreach ($pedido->getItensPedido() as $it) {
            if ($counter != $indexItem) {
                $itensDoPedido->add($it);
            } else {
                $valorDoItem = $it->getSubtotal();
            }

            $counter++;
        }

        $pedido->setValorTotal($pedido->getValorTotal() - $valorDoItem);
        $pedido->setItensPedido($itensDoPedido);

        $_SESSION['pedido'] = $pedido;
    }
    
} else if ($command == 'update'){
    $quantidade = filter_input(INPUT_POST, 'quantidade');
    $counter = 0;
    $itensDoPedido = new Doctrine\Common\Collections\ArrayCollection();
    $valorTotalPedido = 0;

    foreach ($pedido->getItensPedido() as $it) {
        if ($counter == $indexItem) {
            $it->setQuantidade($quantidade);
            $it->setSubtotal($it->getTamanho()->getPreco() * $quantidade);
            $valorTotalPedido += $it->getTamanho()->getPreco() * $quantidade;
            $itensDoPedido->add($it);
        } else {
            $itensDoPedido->add($it);
            $valorTotalPedido += $it->getSubtotal();
        }
        $counter++;
    }

    $pedido->setItensPedido($itensDoPedido);
    $pedido->setValorTotal($valorTotalPedido);
    $_SESSION['pedido'] = $pedido;
}


if(isset($_SESSION['pedido'])){
    $i = 0;
    echo "<thead>";
        echo "<tr>";
            echo "<th id='ProtutoTh'>Produto</th>";
            echo "<th id='ValorTh'>Valor</th>";
            echo "<th id='QuantidadeTh'>Quantidade</th>";
            echo "<th id='SubtotalTh' class='text-center'>Subtotal</th>";
            echo "<th id='ButtonsTh'></th>";
        echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($pedido->getItensPedido() as $it){
        echo "<tr>";
            echo "<td data-th='Item'>";
                echo "<div class='row'>";
                    if ($it->getProduto()->getIngredientes() ==null){
                        echo "<div class='col-sm-2 hidden-xs'><img src='../images/icons/drink.png' alt='Comida' class='img-responsive'/></div>";
                    }else{
                        echo "<div class='col-sm-2 hidden-xs'><img src='../images/icons/food.png' alt='Bebida' class='img-responsive'/></div>";
                    }         
                    echo "<div class='col-sm-10'>";
                        echo "<h4 class='nomargin nomeProduto'>". $it->getProduto()->getNome() . "<span class='tamanho'> - " . $it->getTamanho()->getDescricao() . "</span></h4>";
                        echo "<p>". $it->getProduto()->getIngredientes() . "</p>";
                    echo "</div>";
                echo "</div>";
            echo "</td>";
            echo "<td data-th='Price'>R$ ". $it->getTamanho()->getPreco() . "</td>";
            echo "<td data-th='Quantity'>";
                echo "<input type='number' class='form-control text-center' min='1' max='99' id='quantidade". $i. "' value='". $it->getQuantidade()."'>";
            echo "</td>";
            echo "<td data-th='Subtotal' class='text-center'>R$ ". $it->getSubtotal(). "</td>";
            echo "<td class='actions' data-th=''>";
                echo "<button style='margin-right: 4px' class='btn btn-info btn-sm' onclick='updateQuantity(". $i. ");'><i class='glyphicon glyphicon-refresh'></i></button>";
                echo "<button class='btn btn-danger btn-sm' onclick='removeProduct(". $i .");'><i class='fa fa-trash-o'></i></button>";								
            echo "</td>";
        echo "</tr>"; 
        $i++; 
    }
    echo "</tbody>";
    echo "<tfoot>";
        echo "<tr class='visible-xs'>";
            echo "<td class='text-center'><strong>Total</strong></td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td><a href='../pages/restaurant.php?res=" . $idRestaurante . "' class='btn btn-warning'><i class='fa fa-angle-left'></i> Voltar ao cardápio</a></td>";
            echo "<td colspan='2' class='hidden-xs'></td>";
            echo "<td class='hidden-xs text-center'><strong>Total R$ ". $pedido->getValorTotal() . "</strong></td>";
            echo "<td><a href='#' class='btn btn-success btn-block'>Comfirmar <i class='fa fa-angle-right'></i></a></td>";
        echo "</tr>";
    echo "</tfoot>";
}                
