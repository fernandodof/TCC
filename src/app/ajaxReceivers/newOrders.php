<?php

require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';
session_start();

$params['id'] = filter_input(INPUT_POST, 'idRestaurante');
$params['dataHora'] = $_SESSION['paginaFuncionarioCarregada'];

$dao = new Dao();

$pedidos = $dao->getListResultOfNamedQueryWithParameters(Queries::GET_PEDIDOS_RESTAURANTE_EM_ABERTO_DATA, $params);

if (isset($_SESSION['pedidosCarregados'])) {

    $pedidosCaregados = $_SESSION['pedidosCarregados'];

    $pedidosNovos = new Doctrine\Common\Collections\ArrayCollection();

    foreach ($pedidos as $pedido) {
        if (!in_array($pedido->getId(), $pedidosCaregados)) {
            $pedidosNovos->add($pedido);
            $pedidosCaregados[] = $pedido->getId();
            $_SESSION['pedidosCarregados'] = $pedidosCaregados;
//        echo 'TESTE';
        }
//    echo 'TESTE';
    }
}

if (isset($pedidosNovos)) {
    $i = count($pedidosCaregados) - 1;
    if (count($pedidosNovos) > 0) {
        foreach ($pedidosNovos as $pedido) {
            echo "<div class='pedidoDiv'id='pedidoDiv" . $i . "'>";
                echo "<label class='idPedido'>#" . $pedido->getId() . "</label>";
                    echo "<div class='pull-right checkboxPedidoDiv'>";
                        echo "<input type='checkBox' name='pedidos[]' value='" . $i . "' id='pedido" . $i . "' onchange='removerPedido(this)';>";
                        echo "<label for='pedido" . $i . "'>Encaminhado para entrega</label>";
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
                            foreach ($pedido->getItensPedido() as $it) {
                                echo "<tr>";
                                    echo "<td>" . $it->getProduto()->getNome() . "</td>";
                                    echo "<td>" . $it->getQuantidade() . "</td>";
                                    echo "<td>" . $it->getTamanho()->getDescricao() . "</td>";
                                    echo "<td>R$ " . $it->getSubtotal() . "</td>";
                                echo "</tr>";
                            }
                        echo "</tbody>";
                    echo "</table>";
                    echo "<label class='pull-right valorTotal'>TOTAL: R$ " . $pedido->getValorTotal() . "</label>";
                    echo "<div class='infoCliente'>";
                        echo "<h4 class='nomeCliente'><span>Cliente: </span>" . $pedido->getCliente()->getNome() . "</h4>";
                        echo "<h4 data-toggle='collapse' data-target='#endereco" . $i . "' class='elementToggle verEndereco'>Clique Aqui Para Ver o Endereço <i class='fa fa-chevron-circle-down'></i></h4>";
                    echo "<div class='collapse' id='endereco" . $i . "'>";
                    foreach ($pedido->getCliente()->getEnderecos() as $endereco) {
                        echo "<p>" . $endereco->getLogradouro() . "," . $endereco->getNumero() . "</p>";
                        echo "<p>" . $endereco->getBairro() . ", " . $endereco->getCidade() . "</p>";
                        echo "<p>" . $endereco->getEstado() . ", " . $endereco->getCep() . "</p>";
                    }
                    echo "</div>";
                echo "</div>";
            echo "</div>";
            $i++;
        }
    }
}