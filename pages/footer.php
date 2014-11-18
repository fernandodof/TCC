<?php
require_once $path.'pages/smartyHeader.php';
$footerBarMsg = 'SaborVirtual - Pedidos pela internet';

$smarty->assign('footerBarMsg', $footerBarMsg);
$smarty->display($path.'templates/footer.tpl');