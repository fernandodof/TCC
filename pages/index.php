<?php
require_once './smartyHeader.php';
include_once '../pages/header.php';

$highlights = array();
$highlights['Pizza de Frango com Catupiry'] = '../images/dishes/francoComCatupiry.jpg';
$highlights['Lasanha Bolhonesa'] = '../images/dishes/lasanhabolonhesa.jpg';
$highlights['Pene ao molho de linguiça'] = '../images/dishes/penne-ao-molho-de-linguica.jpg';
$highlights['Vaca Atolada'] = '../images/dishes/vacaAtolada.jpg';
$smarty->assign('highlights', $highlights);

$smarty->display('../templates/index.tpl');
include_once '../pages/footer.php';