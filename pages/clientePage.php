<?php

require_once './smartyHeader.php';
require_once '../src/app/model/persistence/Dao.class.php';
require_once '../src/app/util/Queries.php';

include_once '../pages/header.php';

$dao = new Dao();
$kindsOfFood = $dao->getListResultOfNamedQuery(Queries::TIPOS_RESTAURANTE_DISTINCT);

$smarty->assign('kindsOfFood',$kindsOfFood);
$smarty->display('../templates/clientePage.tpl');

include_once '../pages/footer.php';