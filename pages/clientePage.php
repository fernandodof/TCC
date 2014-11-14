<?php

require_once './smartyHeader.php';
require_once '../src/app/model/persistence/Dao.class.php';
require_once '../src/app/util/Queries.php';

include_once '../pages/header.php';

$dao = new Dao();
$kindsOfFood = $dao->getListResultOfNamedQuery(Queries::TIPOS_RESTAURANTE_DISTINCT);

if (isset($_SESSION['id'])) {
    $cliente = $dao->findByKey('Cliente', $_SESSION['id']);

    foreach ($cliente->getPedidos() as $pedido){
        $pedido->setDataHora($pedido->getDataHora()->format('d/m/Y - H:i:s'));
    }
    $smarty->assign('pedidos', $cliente->getPedidos());
}

$smarty->assign('kindsOfFood', $kindsOfFood);
$smarty->display('../templates/clientePage.tpl');

include_once '../pages/footer.php';
