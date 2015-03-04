<?php
require_once './smartyHeader.php';

if (!session_id()) {
    session_start();
}

if(isset($_SESSION['id'])){
    header('Location: ../pages/index');
}

include_once '../pages/header.php';
$smarty->display('../templates/subscribe.tpl');
include_once '../pages/footer.php';