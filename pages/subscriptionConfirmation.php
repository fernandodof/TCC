<?php
if(!isset($email)){
    header('Location: index');
}

require_once './smartyHeader.php';
include_once '../pages/header.php';

$email = filter_input(INPUT_GET, 'email');        

$smarty->assign('email', $email);
$smarty->display('../templates/subscriptionConfirmation.tpl');

include_once '../pages/footer.php';