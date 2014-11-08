<?php

require_once './smartyHeader.php';
require_once '../src/app/model/persistence/Dao.class.php';
require_once '../src/app/model/entities/Categoria.class.php';
require_once '../src/app/model/entities/Pedido.class.php';
require_once '../src/app/model/entities/ItemPedido.class.php';
require_once '../src/app/model/entities/Tamanho.class.php';
require_once '../src/app/model/entities/Produto.class.php';

include_once '../pages/header.php';

$dao = new Dao();
$restaurante = $dao->findByKey('Restaurante', filter_input(INPUT_GET, 'res'));
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

$smarty->display('../templates/restaurant.tpl');

include_once '../pages/footer.php';
