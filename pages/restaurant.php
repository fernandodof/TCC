<?php
include_once '../pages/header.php';

require_once $path.'pages/smartyHeader.php';
require_once $path.'src/app/model/persistence/Dao.class.php';
//require_once $path.'src/app/model/VO/PedidoVO.class.php';
//require_once $path.'src/app/model/VO/ItemPedidoVO.class.php';
//require_once $path.'src/app/model/VO/ProdutoVO.class.php';
//require_once $path.'src/app/model/VO/TamanhoVO.class.php';
//
//require_once '../src/app/model/VO/PedidoVO.class.php';
//require_once '../src/app/model/VO/ItemPedidoVO.class.php';
//require_once '../src/app/model/VO/ProdutoVO.class.php';
//require_once '../src/app/model/VO/TamanhoVO.class.php';


list(,,,,$res) = explode('/',$_SERVER['REQUEST_URI']);

$dao = new Dao();
if (isset($_SESSION['idRestauranteDoPedidoAtual'])) {
    $restaurantePedido = $dao->findByKey('Restaurante', $_SESSION['idRestauranteDoPedidoAtual']);
    $smarty->assign('restaurantePedido', $restaurantePedido);
}

$restaurante = $dao->findByKey('Restaurante', $res);
$produtos = $restaurante->getProdutos();

$produtosComida;
$produtosBebida;

foreach ($produtos as $p) {
    if ($p->getCategoria()->getNome() == 'Comida') {
        $produtosComida[] = $p;
    } else if ($p->getCategoria()->getNome() == 'Bebida') {
        $produtosBebida[] = $p;
    }
}


$smarty->assign('produtosComida', $produtosComida);
$smarty->assign('produtosBebida', $produtosBebida);
$smarty->assign('restaurante', $restaurante);

$smarty->display($path.'templates/restaurant.tpl');

include_once $path.'pages/footer.php';
