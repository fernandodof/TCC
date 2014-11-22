<?php
require_once './pathVars.php';
require_once $path . 'pages/smartyHeader.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';


list(,,,, $res) = explode('/', filter_input(INPUT_SERVER, 'REQUEST_URI'));

$dao = new Dao();
if (isset($_SESSION['idRestauranteDoPedidoAtual'])) {
    $restaurantePedido = $dao->findByKey('Restaurante', $_SESSION['idRestauranteDoPedidoAtual']);
    $smarty->assign('restaurantePedido', $restaurantePedido);
}

$restaurante = $dao->findByKey('Restaurante', $res);

if ($restaurante == null) {
    header("Location: ../error");
}

include_once '../pages/header.php';

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

$smarty->display($path . 'templates/restaurant.tpl');

include_once $path . 'pages/footer.php';
