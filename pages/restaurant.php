<?php

require_once './smartyHeader.php';
require_once '../src/app/model/persistence/Dao.class.php';
include_once '../pages/header.php';

$size = 14;

$itens = array();
$itens[] = 'Brasileira';
$itens[] = 'Supreme';
$itens[] = 'Calabresa';
$itens[] = 'Country';
$itens[] = 'Portuguesa';
$itens[] = 'Hawaiana';
$itens[] = 'Corn & Bacon';
$itens[] = 'Vegetariana';
$itens[] = 'Pepperoni';
$itens[] = 'Mussarela';
$itens[] = 'Frango Supreme';
$itens[] = 'Peito de Peru e Alho Poró';
$itens[] = 'Pepperoni & Cheddar';
$itens[] = 'Super Brasileira';
$itens[] = 'Frango com Catupiry';

$ingedients = array();
$ingedients[] = 'Mussarela, presuto, requeijão cremoso e azeitonas';
$ingedients[] = 'Carnes bovina e suína, pepperoni, mussarela, champignon, pimentão e cebola';
$ingedients[] = 'Mussarela, calabresa, cebola e azeitonas';
$ingedients[] = 'Grande quantidade de frango, milho selecionado, requeijão cremoso e mussarela';
$ingedients[] = 'Mussarela, presunto, cebola e azeitonas, ovo e ervilha';
$ingedients[] = 'Mussarela, presunto e abacaxi';
$ingedients[] = 'Mussarela, milho e bacon';
$ingedients[] = 'Mussarela, champignon, pimentão, cebola, tomate e azeitonas';
$ingedients[] = 'Mussarela e fatias de pepperoni (salame especial condimentado com páprica)';
$ingedients[] = 'A mais pura e saborosa das mussarelas';
$ingedients[] = 'Mussarela, pepperoni, frango, champingnon, pimentão e cebola';
$ingedients[] = 'Mussarela, peito de peru, alho poró, tomate cereja, e tiras de queijo Philadelphia';
$ingedients[] = 'Mussarela, cebola, pepperoni, tiras de cheddar Sadia e azeitonas';
$ingedients[] = 'Queijo, presunto, calabresa, tomate em cubos, tiras de queijo Philadelphia e azeitonas';
$ingedients[] = 'Frango desfiado, catupiry, milho verde, tomate e azeitona';

$precoP = array();
$precoP[] = 34.00;
$precoP[] = 34.00;
$precoP[] = 34.00;
$precoP[] = 34.00;
$precoP[] = 34.00;
$precoP[] = 32.00;
$precoP[] = 32.00;
$precoP[] = 32.00;
$precoP[] = 32.00;
$precoP[] = 32.00;
$precoP[] = 36.00;
$precoP[] = 36.00;
$precoP[] = 36.00;
$precoP[] = 36.00;
$precoP[] = 36.00;

$precoM = array();
$precoM[] = 38.00;
$precoM[] = 38.00;
$precoM[] = 38.00;
$precoM[] = 38.00;
$precoM[] = 38.00;
$precoM[] = 35.00;
$precoM[] = 35.00;
$precoM[] = 35.00;
$precoM[] = 35.00;
$precoM[] = 35.00;
$precoM[] = 40.00;
$precoM[] = 40.00;
$precoM[] = 40.00;
$precoM[] = 40.00;
$precoM[] = 40.00;

$precoG = array();
$precoG[] = 42.00;
$precoG[] = 42.00;
$precoG[] = 42.00;
$precoG[] = 42.00;
$precoG[] = 42.00;
$precoG[] = 40.00;
$precoG[] = 40.00;
$precoG[] = 40.00;
$precoG[] = 40.00;
$precoG[] = 40.00;
$precoG[] = 44.00;
$precoG[] = 44.00;
$precoG[] = 44.00;
$precoG[] = 44.00;
$precoG[] = 44.00;

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
$smarty->assign('size', $size);
$smarty->assign('itens', $itens);
$smarty->assign('ingredients', $ingedients);
$smarty->assign('precoP', $precoP);
$smarty->assign('precoM', $precoM);
$smarty->assign('precoG', $precoG);

$smarty->display('../templates/restaurant.tpl');

include_once '../pages/footer.php';
