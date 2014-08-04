<?php
require_once './smartyHeader.php';
$footerBarMsg = 'SaborVirtual - Pedidos pela internet';

$smarty->assign('footerBarMsg', $footerBarMsg);
$smarty->display('../templates/footer.tpl');