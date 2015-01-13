<?php

require_once '../pages/pathVars.php';
require_once $path . 'pages/smartyHeader.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';
require_once $path . 'src/app/model/VO/PedidoVO.class.php';
require_once $path . 'src/app/model/VO/ItemPedidoVO.class.php';
require_once $path . 'src/app/model/VO/ProdutoVO.class.php';
require_once $path . 'src/app/model/VO/TamanhoVO.class.php';
require_once $path . 'src/app/util/Queries.php';
require_once $path . 'src/app/util/UserTypes.php';

session_start();

$slashCount = substr_count(filter_input(INPUT_SERVER, 'REQUEST_URI'), '/');

if ($slashCount < 4) {
    header("Location: ../error");
}

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

$produtosComida = array();
$produtosBebida = array();

foreach ($produtos as $p) {
    if ($p->getCategoria()->getNome() == 'Comida') {
        $produtosComida[] = $p;
    } else if ($p->getCategoria()->getNome() == 'Bebida') {
        $produtosBebida[] = $p;
    }
}

$avgRating;
$sum = 0;
$counter = 0;
foreach ($restaurante->getAvaliacoes() as $av) {
    $sum += $av->getNota();
    $counter++;
}

if ($counter > 0) {
    $avg = $sum / $counter;
} else {
    $avg = 0;
}

$avgRating = $avg;


foreach ($produtosComida as $p) {
    $avgRatingP;
    $sumP = 0;
    $counter = 0;

    foreach ($p->getAvaliacoes() as $av) {
        $sumP += $av->getNota();
        $counter++;
    }

    if ($counter > 0) {
        $avgP = $sumP / $counter;
    } else {
        $avgP = 0;
    }

    $avgRatingP[] = $avgP;
}

if (isset($avgRatingP)) {
    $smarty->assign('avgRatingP', $avgRatingP);
}

if (isset($_SESSION['id']) && $_SESSION['tipo'] === UserTypes::CLIENTE) {
    $params1['id_cliente'] = $_SESSION['id'];
    $idsProdutosComprados = $dao->getListResultOfNativeQueryWithParameters(Queries::GET_IDS_PRODUTOS_CLIENTE_COMPROOU, $params1);
    $smarty->assign('idsProdutosComprados', $idsProdutosComprados);
}

$smarty->assign('avgRating', $avgRating);
$smarty->assign('produtosComida', $produtosComida);
$smarty->assign('produtosBebida', $produtosBebida);
$smarty->assign('restaurante', $restaurante);

$smarty->display($path . 'templates/restaurant.tpl');

include_once $path . 'pages/footer.php';
