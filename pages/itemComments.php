<?php

require_once './pathVars.php';

require_once $path . 'pages/smartyHeader.php';
require_once $path . '/src/app/model/entities/Restaurante.class.php';
require_once $path . 'src/app/util/Queries.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';
require_once $path . 'src/app/model/VO/PedidoVO.class.php';

session_start();
$dao = new Dao();

list(,,,, $idProduto) = explode('/', filter_input(INPUT_SERVER, 'REQUEST_URI'));

$produto = $dao->findByKey('Produto', $idProduto);

$params['id_produto'] = $produto;
$restaurante = $dao->getSingleResultOfNamedQueryWithParameters(Queries::GET_RESTAURANTE_BY_ID_PRODUTO, $params);

if (count($produto->getComentarios()) == 0) {
    header("Location: ../error");
}

include_once '../pages/header.php';

$smarty->assign('restaurante', $restaurante);
$smarty->assign('produto', $produto);

$smarty->display($path . 'templates/itemComments.tpl');

include_once $path . 'pages/footer.php';
