<?php
require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';
session_start();

$params['id'] = filter_input(INPUT_POST, 'idRestaurante');
$params['dataHora'] = $_SESSION['paginaFuncionarioCarregada'];

$dao = new Dao();

$pedidos = $dao->getListResultOfNamedQueryWithParameters(Queries::GET_PEDIDOS_RESTAURANTE_EM_ABERTO_DATA, $params);

$pedidosCaregados = $_SESSION['pedidosCarregados'];

$pedidosNovos = new Doctrine\Common\Collections\ArrayCollection();

foreach ($pedidos as $pedido){
    if(!in_array($pedido->getId(), $pedidosCaregados)){
        $pedidosNovos->add($pedido);
        $pedidosCaregados[] = $pedido->getId();
        $_SESSION['pedidosCarregados'] = $pedidosCaregados; 
        echo 'TESTE';
    }
//    echo 'TESTE';
}

$i=0;
if(count($pedidosNovos)>0){
    foreach ($pedidosNovos as $pedido){
        echo "<div class='well well-sm pedidoDiv'>";
            echo "<div class='pull-right checkboxPedidoDiv'>";
                echo "<input type='checkBox' name='pedidos[]' id='pedido".$i."'>";
                echo "<label for='pedido".$i."'>Encaminhado para entrega</label>";
            echo "</div>";
            echo "<table class='table table-condensed table-responsive table-striped'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>Item</th>";
                        echo "<th>Quantidade</th>";
                        echo "<th>Tamanho</th>";
                        echo "<th>Subtotal</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                    foreach ($pedido->getItensPedido() as $it){
                        echo "<tr>";
                            echo "<td>".$it->getProduto()->getNome()."</td>";
                            echo "<td>".$it->getQuantidade()."</td>";
                            echo "<td>".$it->getTamanho()->getDescricao()."</td>";
                            echo "<td>R$ ".$it->getSubtotal()."</td>";
                        echo "</tr>";
                    }
                echo "</tbody>";
            echo "</table>";
        echo "<label class='pull-right valorTotal'>TOTAL: R$ ". $pedido->getValorTotal() ."</label>";
        echo "</div>";
    $i++;
    }
}
