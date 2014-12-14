<?php

session_start();

unset($_SESSION['latLong']);
unset($_SESSION['locationError']);

if (filter_input(INPUT_POST, 'latLong') !== null) {
    $_SESSION['latLong'] = filter_input(INPUT_POST, 'latLong');
} else if (filter_input(INPUT_POST, 'error') !== null) {
    $_SESSION['locationError'] = filter_input(INPUT_POST, 'error');
}