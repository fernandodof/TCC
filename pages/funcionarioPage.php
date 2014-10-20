<?php

require_once './smartyHeader.php';
require_once '../src/app/model/persistence/Dao.class.php';
include_once '../pages/header.php';

$dao = new Dao();

$categorias = $dao->findAll('Categoria');
$tamanhos = $dao->findAll('Tamanho');

$smarty->assign('categorias', $categorias);
$smarty->display('../templates/funcionarioPage.tpl');

include_once '../pages/footer.php';
