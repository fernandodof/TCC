<?php
require '../../../pages/pathVars.php';

require_once '../model/persistence/Dao.class.php';
require_once '../model/entities/Pedido.class.php';
require_once '../model/entities/ItemPedido.class.php';
require_once '../model/entities/Produto.class.php';
require_once '../model/entities/Categoria.class.php';
require_once '../model/entities/Tamanho.class.php';
require_once '../model/VO/PedidoVO.class.php';
require_once '../model/VO/ItemPedidoVO.class.php';
require_once '../model/VO/ProdutoVO.class.php';
require_once '../model/VO/CategoriaVO.class.php';
require_once '../model/VO/TamanhoVO.class.php';
require_once '../util/CheckLoggedIn.php';
require_once '../util/UserTypes.php';

require_once '../util/Queries.php';

session_start();

$orderAction = filter_input(INPUT_POST, 'orderAction');

if ($orderAction == true) {
    unset($_SESSION['pedido']);
    unset($_SESSION['idRestauranteDoPedidoAtual']);
}

if (!CheckLoggedIn::checkPermission(UserTypes::CLIENTE)) {
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

    $tamanhoVO = new TamanhoVO();
    $tamanhoVO->setId($tamanho->getId());
    $tamanhoVO->setDescricao($tamanho->getDescricao());
    $tamanhoVO->setPreco($tamanho->getPreco());

    $categoriaVO = new CategoriaVO();
    $categoriaVO->setId($produto->getCategoria()->getId());
    $categoriaVO->setId($produto->getCategoria()->getId());
    $categoriaVO->setNome($produto->getCategoria()->getNome());

    $produtoVO = new ProdutoVO();
    $produtoVO->setId($produto->getId());
    $produtoVO->setNome($produto->getNome());
    $produtoVO->setIngredientes($produto->getIngredientes());
    $produtoVO->setImagem($produto->getImagem());
    $produtoVO->setCategoria($categoriaVO);

    $itemPedidoVO = new ItemPedidoVO();
    $itemPedidoVO->setProduto($produtoVO);
    $itemPedidoVO->setTamanho($tamanhoVO);
    $itemPedidoVO->setQuantidade($quantidade);
    $itemPedidoVO->setSubtotal($tamanhoVO->getPreco() * $quantidade);

    $_SESSION['idRestauranteDoPedidoAtual'] = $idRestaurantePedido;

    if (!isset($_SESSION['pedido'])) {
        $pedidoVO = new PedidoVO();
        $pedidoVO->addItemPedido($itemPedidoVO);
        $valor = 0;
        foreach ($pedidoVO->getItensPedido() as $i) {
            $valor += $i->getSubtotal();
        }
        $pedidoVO->setValorTotal($valor);

        $_SESSION['pedido'] = $pedidoVO;
    } else {
        $pedidoVO = $_SESSION['pedido'];
        $pedidoVO->addItemPedido($itemPedidoVO);
        $valor = 0;
        foreach ($pedidoVO->getItensPedido() as $i) {
            $valor += $i->getSubtotal();
        }
        $pedidoVO->setValorTotal($valor);
        $_SESSION['pedido'] = $pedidoVO;
    }

    $pedidoVO = $_SESSION['pedido'];
    $_SESSION['itemCount'] = count($pedidoVO->getItensPedido()); 
            
    echo "<a href='#' class='dropdown-toggle btn btn-primary pull-left' id='togglePedido' data-toggle='dropdown'>Resumo do Pedido" .
    "<span class='badge' id='badgePedido'>" . count($pedidoVO->getItensPedido()) . "</span> <b class='caret'></b></a>";
    echo "<form action='".$templateRoot."pages/confirmOrder.php' method='POST' id='formProseguir' class='pull-left'>";
        echo "<button type='submit' class='dropdown-toggle btn btn-success' id='proseguirPedido'>Proseguir Pedido" .
        "<img class='img' src='".$templateRoot."images/icons/hotPot.png'/> <span class='glyphicon glyphicon-arrow-right'></span></button>";
        echo "<input type='hidden' name='idRestaurantePedido' id='idRestaurantePedido' value='" . $idRestaurantePedido . "'>";
    echo "</form>";
    echo "<ul class='dropdown-menu col-xs-12 col-sm-6'>";
        $counter = 0;
        echo "<div id='divNomeRestaurante'>";
            echo "<h5 id='nomeRestaurnatePedido'>" . $nomeRestaurante['nome'] . "</h5>";
        echo "</div>";
        echo "<li class='divider firstDivider'></li>";
        foreach ($pedidoVO->getItensPedido() as $it) {
            $counter++;
            echo "<li>";
                echo "<div class ='row produtoDropdown'>";
                    echo "<p class ='pull-left noreProdutoDropdown'>" . $it->getProduto()->getNome() . "</p>";
                    echo "<p class = 'pull-right'>R$ " . $it->getTamanho()->getPreco() . "</p>";
                echo "</div>";
                echo "<div class = 'row qutidadeDropdown'>";
                    echo "<p class = 'pull-left'>Quantidade:</p>";
                    echo "<p class = 'pull-right'>" . $it->getQuantidade() . "</p>";
                echo "</div>";
                echo "<div class = 'row tamanhoDropdown'>";
                    echo "<p class = 'pull-left'>Tamanho:</p>";
                    echo "<p class = 'pull-right'>" . $it->getTamanho()->getDescricao() . "</p>";
                echo "</div>";
                echo "<div class = 'row subtotalDropdown'>";
                    echo "<p class = 'pull-left subtotal'>Subtotal</p>";
                    echo "<p class = 'pull-right'>R$ " . $it->getSubtotal() . "</p>";
                echo "</div>";
            echo "</li>";
            if ($counter < count($pedidoVO->getItensPedido())) {
                echo "<li class='divider'></li>";
            }
        }
        echo "<li class='totalLi'>";
        echo "<div class='row totalDropdown'>";
            echo "<p class='pull-left total'>TOTAL</p>";
            echo "<p class='pull-right'>R$ " . $pedidoVO->getValorTotal() . "</p>";
        echo "</div>";
        echo "</li>";
    echo "</ul>";
}