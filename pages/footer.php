<?php
require_once './smartyHeader.php';
$footerBarMsg = 'FomeOnline - Pedidos pela internet';

$smarty->assign('footerBarMsg', $footerBarMsg);
$smarty->display('../templates/footer.tpl');