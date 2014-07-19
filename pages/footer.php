<?php

require_once './smartyHeader.php';
$footerBarMsg = 'Restaurates - Pedidos pela internet';

$smarty->assign('footerBarMsg', $footerBarMsg);

$smarty->display('../templates/footer.tpl');