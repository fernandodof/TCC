<?php

require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';
require_once '../model/entities/Pedido.class.php';
session_start();

$params['id'] = filter_input(INPUT_POST, 'idRestaurante');
$params['status'] = Pedido::PEDIDO_FINALIZADO;

$dao = new Dao();
$pedidos = $dao->getListResultOfNamedQueryWithParameters(Queries::GET_PEDIDOS_POR_STATUS_RESTAURANTE, $params);
//$pedidosHistorico = new Doctrine\Common\Collections\ArrayCollection();

if(count($pedidos)>0){

//if (isset($_SESSION['pedidosHistorioCarregados'])) {
//
//        $pedidosCaregados = $_SESSION['pedidosHistorioCarregados'];
//
//        foreach ($pedidos as $pedido) {
//            if (!in_array($pedido->getId(), $pedidosCaregados)) {
//                $pedidosHistorico->add($pedido);
//                $pedidosCaregados[] = $pedido->getId();
//            }
//        }
//        $_SESSION['pedidosHistorioCarregados'] = $pedidosCaregados;
//    }else {
//
//        $pedidosHistorico = $pedidos;
//        $pedidosCaregados;
//        foreach ($pedidos as $pedido) {
//            $pedidosCaregados[] = $pedido->getId();
//        }
//
//        $_SESSION['pedidosHistorioCarregados'] = $pedidosCaregados;
//    }
//
//    if (isset($pedidosHistorico)) {
//        $i = count($pedidosCaregados) - 1;
//        if (count($pedidosHistorico) > 0) {
           
            echo "<table id='historicoPedidos' class='display table-striped'>";
                echo "<thead>";
                    echo "<tr>";
                        echo "<th>#</th>";
                        echo "<th>Data</th>";
                        echo "<th>Valor</th>";
                        echo "<th>Detalhes</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody id='bodyHistorico'>";
            $i=0;
            foreach ($pedidos as $pedido){
                echo "<tr>";
                    echo "<td>".$pedido->getId()."</td>";
                        echo "<td>". $pedido->getDataHora()->format('d/m/Y - H:i:s') . "</td>";
                        echo "<td>" .$pedido->getValorTotal() . "</td>";
                        echo "<td <label data-toggle='collapse' data-target='#item". $i ."' class='elementToggle verItem'>Detalhes <span class='fa fa-eye'></span></label>";
                            echo "<div class='modal' id='item". $i ."' role='dialog'>";
                                echo "<div class='modal-dialog'>";
                                    echo "<div class='modal-content'>";
                                        echo "<div class='modal-header'>";
                                            echo "<h5>". $pedido->getDataHora()->format('d/m/Y - H:i:s') . "</h5>";
                                            echo "<h4>Itens</h4>";
                                        echo "</div>";
                                        echo "<div class='modal-body'>";
                                            echo "<div class='table-responsive tableOrders'>";
                                                echo "<table class='table table-hover table-condensed'>";
                                                    echo "<thead>";
                                                        echo "<tr>";
                                                            echo "<th>Nome</th>";
                                                            echo "<th>Tamanho</th>";
                                                            echo "<th>Quantidade</th>";
                                                            echo "<th>Subtotal</th>";
                                                        echo "<tr>";
                                                    echo "</thead>";
                                                        foreach ($pedido->getItensPedido() as $it){
                                                            echo "<tbody>";
                                                                echo "<tr>";
                                                                    echo "<td>". $it->getProduto()->getNome() . "</td>";
                                                                    echo "<td>". $it->getTamanho()->getDescricao() ."</td>";
                                                                    echo "<td>". $it->getQuantidade() . "</td>";
                                                                    echo "<td>". $it->getSubtotal() . "</td>";
                                                                echo "</tr>";
                                                            echo "<tbody>";
                                                        }
                                                echo "</table>";
                                            echo "</div>";
                                        echo "</div>";
                                        echo "<div class='modal-footer'>";
                                            echo "<label class='pull-right'>Valor Total: R$ ".$pedido->getValorTotal() . "</label>";
                                            echo "<div class='col-xs-12'>";
                                                echo "<h4>Cliente: " . $pedido->getCliente()->getNome() . "</h4>";
                                                foreach ($pedido->getCliente()->getEnderecos() as $endereco){ 
                                                    echo "<p>". $endereco->getLogradouro() . ", " . $endereco->getNumero() . "</p>";
                                                    echo "<p>". $endereco->getBairro() . ", "  . $endereco->getCidade() . "</p>";
                                                    echo "<p>". $endereco->getEstado() . ", ". $endereco->getCep() . "</p>";
                                                }
                                        echo "</div>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    echo "</td>";
                echo "</tr>";
            $i++;
            }
            echo "</tbody>";
        echo "</table>";

}