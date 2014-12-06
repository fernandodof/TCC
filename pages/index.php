<?php

include_once '../pages/header.php';

require_once $path . 'pages/smartyHeader.php';
require_once $path . 'src/app/model/persistence/Dao.class.php';
require_once $path . 'src/app/util/Queries.php';

$dao = new Dao();

$highlights = array();
$highlights['Pizza de Frango com Catupiry'] = $templateRoot.'images/dishes/francoComCatupiry.jpg';
$highlights['Lasanha à Bolhonesa'] = $templateRoot.'images/dishes/lasanhabolonhesa.jpg';
$highlights['Vaca Atolada'] = $templateRoot.'images/dishes/vacaAtolada.jpg';
$highlights['Penne ao Pepperoni'] = $templateRoot.'images/dishes/penne-ao-molho-de-linguica.jpg';

$restaurants = array();
$restaurants[] = 'Pizza Place';
$restaurants[] = 'Sapore D\'Itália';
$restaurants[] = 'Sabores do Brasil';
$restaurants[] = 'Sabores da Toscana Sabores da Toscana';

$links[] = '#';
$links[] = '#';
$links[] = '#';
$links[] = '#';

$kindsOfFood = $dao->getListResultOfNamedQuery(Queries::TIPOS_RESTAURANTE_DISTINCT);

$smarty->assign('kindsOfFood', $kindsOfFood);
$smarty->assign('highlights', $highlights);
$smarty->assign('restaurants', $restaurants);
$smarty->assign('links', $links);

$smarty->display($path . 'templates/index.tpl');

include_once $path . 'pages/footer.php';
