<?php

require_once '../util/SendEmail.class.php';

$name = filter_input(INPUT_POST, 'name');
$email = filter_input(INPUT_POST, 'email');
$message = filter_input(INPUT_POST, 'message');

$sendEmail = new SendEmail();
$sendEmail->sendContactEmail($name, $email, $message);