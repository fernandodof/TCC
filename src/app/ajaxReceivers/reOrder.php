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

require_once '../util/Queries.php';

session_start();

unset($_SESSION['pedido']);
unset($_SESSION['idRestauranteDoPedidoAtual']);

if (!isset($_SESSION['id'])) {
    echo 'Erro';
} else {
    $dao = new Dao();

    $idPedido = filter_input(INPUT_POST, 'idPedido');
    $pedido = $dao->findByKey('Pedido', $idPedido);

    $idRestaurantePedido = filter_input(INPUT_POST, 'idRestaurante');

    $params['id'] = $idRestaurantePedido;
    $nomeRestaurante = $dao->getSingleResultOfNamedQueryWithParameters(Queries::GET_NOME_RESTAURANTE_BY_ID, $params);
    $_SESSION['idRestauranteDoPedidoAtual'] = $idRestaurantePedido;

    $pedidoVO = new PedidoVO();
    foreach ($pedido->getItensPedido() as $it) {

        $idProuto = $it->getProduto()->getId();
        $idTamanho = $it->getTamanho()->getId();
        $quantidade = $it->getQuantidade();

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

        $pedidoVO->addItemPedido($itemPedidoVO);
        $pedidoVO->setValorTotal($pedidoVO->getValorTotal() + $itemPedidoVO->getSubtotal());
    }

    $_SESSION['pedido'] = $pedidoVO;
    $_SESSION['itemCount'] = count($pedidoVO->getItensPedido());
//    header("Location: ../../../pages/confirmOrder");
}