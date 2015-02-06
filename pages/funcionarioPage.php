<?php

require_once '../pages/pathVars.php';
require_once $path . 'src/app/util/CheckLoggedIn.php';
require_once $path . 'src/app/util/UserTypes.php';

if (!CheckLoggedIn::checkPermission(UserTypes::FUNCIONARIO)) {
    header('Location: ../pages/index');
}

require_once $path . 'pages/smartyHeader.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';
require_once $path . 'src/app/model/entities/Restaurante.class.php';
require_once $path . 'src/app/model/entities/Produto.class.php';
require_once $path . 'src/app/util/Queries.php';
include_once $path . 'pages/header.php';

$dao = new Dao();

$categorias = $dao->findAll('Categoria');
$tamanhos = $dao->findAll('TamanhoCadastrado');

$restaurante = $dao->findByKey('Restaurante', $_SESSION['idRestaurante']);
$produtos = $restaurante->getProdutos();

$produtosComida = [];
$produtosBebida = [];

$_SESSION['paginaFuncionarioCarregada'] = new DateTime();

if (count($produtos) > 0) {
    foreach ($produtos as $p) {
        if ($p->getCategoria()->getNome() == 'Comida') {
            $produtosComida[] = $p;
        } else if ($p->getCategoria()->getNome() == 'Bebida') {
            $produtosBebida[] = $p;
        }
    }
}

$params['id'] = $restaurante->getId();

//unset 
unset($_SESSION['pedidosNovosCarregados']);
unset($_SESSION['pedidosCozinhaCarregados']);
unset($_SESSION['pedidosEntregaCarregados']);
unset($_SESSION['pedidosHistorioCarregados']);


//novos
$params['status'] = Pedido::PEDIDO_RECEBIDO;
$pedidosRecebidos = $dao->getListResultOfNamedQueryWithParameters(Queries::GET_PEDIDOS_POR_STATUS_RESTAURANTE, $params);

foreach ($pedidosRecebidos as $pedido) {
    $idsPedidosRecebidos[] = $pedido->getId();
}

if (isset($idsPedidosRecebidos) && $idsPedidosRecebidos != null) {
    $_SESSION['pedidosNovosCarregados'] = $idsPedidosRecebidos;
}


//cozinha
$params['status'] = Pedido::PEDIDO_COZINHA;
$pedidosCozinha = $dao->getListResultOfNamedQueryWithParameters(Queries::GET_PEDIDOS_POR_STATUS_RESTAURANTE, $params);

foreach ($pedidosCozinha as $pedido) {
    $idsPedidosCozinha[] = $pedido->getId();
}

if (isset($idsPedidosCozinha) && $idsPedidosCozinha != null) {
    $_SESSION['pedidosCozinhaCarregados'] = $idsPedidosCozinha;
}

//entrega
$params['status'] = Pedido::PEDIDO_ENTREGA;
$pedidosEntrega = $dao->getListResultOfNamedQueryWithParameters(Queries::GET_PEDIDOS_POR_STATUS_RESTAURANTE, $params);

foreach ($pedidosEntrega as $pedido) {
    $idsPedidosEntrega[] = $pedido->getId();
}

if (isset($idsPedidosEntrega) && $idsPedidosEntrega != null) {
    $_SESSION['pedidosEntregaCarregados'] = $idsPedidosEntrega;
}

if (substr_count(filter_input(INPUT_SERVER, 'REQUEST_URI'), '/') == 4) {

    list(,,,, $produtoCadastrado) = explode('/', filter_input(INPUT_SERVER, 'REQUEST_URI'));

    if ($produtoCadastrado === 'success') {
        $smarty->assign('success', $produtoCadastrado);
    }
}

//historico
$params['status'] = Pedido::PEDIDO_FINALIZADO;
$historicoPedidos = $dao->getListResultOfNamedQueryWithParameters(Queries::GET_PEDIDOS_POR_STATUS_RESTAURANTE, $params);

foreach ($historicoPedidos as $pedido) {
    $idsPedidosHistorico[] = $pedido->getId();
}

$tamanhosComida = new \Doctrine\Common\Collections\ArrayCollection();
$tamanhosBebida = new \Doctrine\Common\Collections\ArrayCollection();

foreach ($tamanhos as $tamanho) {
    if ($tamanho->getCategoria()->getNome() == 'Comida') {
       $tamanhosComida->add($tamanho);
    } else if ($tamanho->getCategoria()->getNome() == 'Bebida') {
        $tamanhosBebida->add($tamanho);
    }
}

$smarty->assign('historicoPedidos', $historicoPedidos);
$smarty->assign('pedidosRecebidos', $pedidosRecebidos);
$smarty->assign('pedidosCozinha', $pedidosCozinha);
$smarty->assign('pedidosEntrega', $pedidosEntrega);
$smarty->assign('produtosComida', $produtosComida);
$smarty->assign('produtosBebida', $produtosBebida);
$smarty->assign('categorias', $categorias);
$smarty->assign('tamanhosComida', $tamanhosComida);
$smarty->assign('tamanhosBebida',$tamanhosBebida);

$smarty->display('../templates/funcionarioPage.tpl');

include_once '../pages/footer.php';
