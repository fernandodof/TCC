<?php
require_once './smartyHeader.php';
$title = 'SaborVirtual - Pedidos pela internet';
$siteName = 'SaborVirtual';

$smarty->assign('title', $title);
$smarty->assign('siteName', $siteName);

require_once '../src/app/model/persistence/Dao.class.php';
require_once '../src/app/model/entities/Categoria.class.php';
require_once '../src/app/model/entities/Pedido.class.php';
require_once '../src/app/model/entities/ItemPedido.class.php';
require_once '../src/app/model/entities/Tamanho.class.php';
require_once '../src/app/model/entities/Produto.class.php';

session_start();

$smarty->display('../templates/header.tpl');
