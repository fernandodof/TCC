<?php
require_once './smartyHeader.php';
require_once '../src/app/model/persistence/Dao.class.php';
require_once '../src/app/model/entities/Restaurante.class.php';
require_once '../src/app/model/entities/Produto.class.php';
require_once '../src/app/util/Queries.php';
include_once '../pages/header.php';

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
$pedidos = $dao->getListResultOfNamedQueryWithParameters(Queries::GET_PEDIDOS_RESTAURANTE_EM_ABERTO, $params);

foreach ($pedidos as $pedido) {
    $idsPedidos[] = $pedido->getId();
}

if (isset($idsPedidos) && $idsPedidos != null) {
    $_SESSION['pedidosCarregados'] = $idsPedidos;
}

if (substr_count(filter_input(INPUT_SERVER, 'REQUEST_URI'), '/') == 4) {

    list(,,,, $produtoCadastrado) = explode('/', filter_input(INPUT_SERVER, 'REQUEST_URI'));

    if ($produtoCadastrado === 'success') {
        $smarty->assign('success', $produtoCadastrado);
    }
}

$historicoPedidos = $restaurante->getPedidos();
foreach ($historicoPedidos as $p) {
    $p->setDataHora($p->getDataHora()->format('d/m/Y - H:i:s'));
}
$smarty->assign('historicoPedidos', $historicoPedidos);

$smarty->assign('pedidos', $pedidos);
$smarty->assign('produtosComida', $produtosComida);
$smarty->assign('produtosBebida', $produtosBebida);
$smarty->assign('categorias', $categorias);
$smarty->display('../templates/funcionarioPage.tpl');

include_once '../pages/footer.php';
