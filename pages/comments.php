<?php

require_once './pathVars.php';

require_once $path . 'pages/smartyHeader.php';
require_once $path . '/src/app/model/entities/Restaurante.class.php';
require_once $path . 'src/app/util/Queries.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';
require_once $path . 'src/app/model/VO/PedidoVO.class.php';

if (!session_id()) {
    session_start();
}

$dao = new Dao();

list(,,,, $res) = explode('/', filter_input(INPUT_SERVER, 'REQUEST_URI'));

$restaurante = $dao->findByKey('Restaurante', $res);

$idsRestaurantesComprados = null;

if (count($restaurante->getComentarios()) == 0) {
    header("Location: ../error");
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

include_once '../pages/header.php';

$smarty->assign('avgRating', $avgRating);
$smarty->assign('restaurante', $restaurante);

$smarty->display($path . 'templates/comments.tpl');

include_once $path . 'pages/footer.php';
