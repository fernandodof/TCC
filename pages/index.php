<?php
require_once './smartyHeader.php';
include_once '../pages/header.php';

$highlights = array();
$highlights['Pizza de Frango com Catupiry'] = '../images/dishes/francoComCatupiry.jpg';
$highlights['Lasanha à Bolhonesa'] = '../images/dishes/lasanhabolonhesa.jpg';
$highlights['Penne ao Pepperoni'] = '../images/dishes/penne-ao-molho-de-linguica.jpg';
$highlights['Vaca Atolada'] = '../images/dishes/vacaAtolada.jpg';

$restaurants = array();
$restaurants[] = 'Pizza Place';
$restaurants[] = 'Sapore D\'Itália';
$restaurants[] = 'Sabores da Toscana';
$restaurants[] = 'Sabores do Brasil';

$links[] = './restaurant.php';
$links[] = '#';
$links[] = '#';
$links[] = '#';

$kindsOfFood = array();
$kindsOfFood[] = 'Churrascaria';
$kindsOfFood[] = 'Lanchonete';
$kindsOfFood[] = 'Pizzaria';
$kindsOfFood[] = 'Cozinha Japonesa';
$kindsOfFood[] = 'Cozinha Chinesa';
$kindsOfFood[] = 'Saladas';
$kindsOfFood[] = 'Cozlinha Italiana';
$kindsOfFood[] = 'Variada';
sort($kindsOfFood);
array_unshift($kindsOfFood,"Tipo de Cozinha (todas)");

$smarty->assign('kindsOfFood',$kindsOfFood);
$smarty->assign('highlights', $highlights);
$smarty->assign('restaurants', $restaurants);
$smarty->assign('links', $links);

$smarty->display('../templates/index.tpl');

include_once '../pages/footer.php';