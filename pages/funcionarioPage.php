<?php

require_once './smartyHeader.php';
require_once '../src/app/model/persistence/Dao.class.php';
require_once '../src/app/model/entities/Restaurante.class.php';
require_once '../src/app/model/entities/Produto.class.php';
include_once '../pages/header.php';


$dao = new Dao();

$categorias = $dao->findAll('Categoria');
$tamanhos = $dao->findAll('TamanhoCadastrado');

$restaurante = $dao->findByKey('Restaurante', $_SESSION['idRestaurante']);
$produtos = $restaurante->getProdutos();

$produtosComida;
$produtosBebida;

foreach ($produtos as $p){
    if($p->getCategoria()->getNome() == 'Comida'){
        $produtosComida[] = $p;
    }else if($p->getCategoria()->getNome() == 'Bebida'){
        $produtosBebida[] = $p;
    }
}

$smarty->assign('produtosComida', $produtosComida);
$smarty->assign('produtosBebida', $produtosBebida);
$smarty->assign('categorias', $categorias);
$smarty->display('../templates/funcionarioPage.tpl');

include_once '../pages/footer.php';
