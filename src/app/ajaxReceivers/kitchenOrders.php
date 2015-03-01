<?php

require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';
require_once '../model/entities/Pedido.class.php';
session_start();

$params['id'] = filter_input(INPUT_POST, 'idRestaurante');
$params['status'] = Pedido::PEDIDO_COZINHA;

$dao = new Dao();
$pedidos = $dao->getListResultOfNamedQueryWithParameters(Queries::GET_PEDIDOS_POR_STATUS_RESTAURANTE, $params);
$pedidosCozinha = new Doctrine\Common\Collections\ArrayCollection();

if(count($pedidos)>0){

    if (isset($_SESSION['pedidosCozinhaCarregados'])) {

        $pedidosCaregados = $_SESSION['pedidosCozinhaCarregados'];

        foreach ($pedidos as $pedido) {
            if (!in_array($pedido->getId(), $pedidosCaregados)) {
                $pedidosCozinha->add($pedido);
                $pedidosCaregados[] = $pedido->getId();
            }
        }
        $_SESSION['pedidosCozinhaCarregados'] = $pedidosCaregados;
    } else {

        $pedidosCozinha = $pedidos;
        $pedidosCaregados;
        foreach ($pedidos as $pedido) {
            $pedidosCaregados[] = $pedido->getId();
        }

        $_SESSION['pedidosCozinhaCarregados'] = $pedidosCaregados;
    }

    if (isset($pedidosCozinha)) {
        $i = count($pedidosCaregados) - 1;
        if (count($pedidosCozinha) > 0) {
            foreach ($pedidosCozinha as $pedido) {
                echo "<div class='pedidoDiv'id='pedidoCozinhaDiv" . $i . "'>";
                    echo "<label class='idPedido'>#" . $pedido->getId() . "</label>";
                    echo "<div class='pull-right checkboxPedidoDiv'>";
                        echo "<input type='hidden' value='" . $pedido->getId() . "' id='idPedidoCozinha". $i . "'>";
                        echo "<input type='checkBox' class='fwdCheckBox' name='pedidos[]' value='" . $i . "' id='pedido" . $i . "' onchange='enviarPedidoEntrega(this)';>";
                        echo "<label for='pedido" . $i . "'><span class='lbEncaminharEntrega'>Encaminhar para entrega</span></label>";
                    echo "</div>";
                    echo "<div class='table-responsive tableOrders'>";
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
                    echo "</div>";
                    echo "<label class='pull-right valorTotal'>TOTAL: R$ " . $pedido->getValorTotal() . "</label>";
                    echo "<div class='infoCliente'>";
                        echo "<h4 class='nomeCliente'><span>Cliente: </span>" . $pedido->getCliente()->getNome() . "</h4>";
                        echo "<h4 data-toggle='collapse' data-target='#endereco" . $i . "' class='elementToggle verEndereco'>Detalhes do cliente <i class='fa fa-chevron-circle-down'></i></h4>";
                        echo "<div class='collapse' id='endereco" . $i . "'>";
                        foreach ($pedido->getCliente()->getTelefones() as $telefone){
                            echo "<h5>Telefone: " . $telefone->getNumero() . "</h5>";
                        }
                        echo "<h4>Endereço <span class='fa fa-map-marker enderecoMarker'></span></h4>";
                        foreach ($pedido->getCliente()->getEnderecos() as $endereco) {
                            echo "<p>" . $endereco->getLogradouro() . ", " . $endereco->getNumero() . "</p>";
                            echo "<p>" . $endereco->getBairro() . ", " . $endereco->getCidade() . "</p>";
                            echo "<p>" . $endereco->getEstado() . ", " . $endereco->getCep() . "</p>";
                        }
                        if ($pedido->getLatitude() != null){
                            echo "<a href='#myMapModal' data-toggle='modal' onclick='initialize(" . $pedido->getLatitude() . ",". $pedido->getLongitude() . ");' class='btn btn-info btn-xs'>Mapa</a>";
                        }
                    echo "</div>";
                    echo "</div>";
                    if ($pedido->getObservacoes() != null) {
                        echo "<h3 class='obs'>Observações: <small>" . $pedido->getObservacoes() . "</small></h3>";
                    }
                echo "</div>";
                $i++;
            }
        }
    }
}