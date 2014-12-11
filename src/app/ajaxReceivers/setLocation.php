<?php
session_start();
$latLong = filter_input(INPUT_POST, 'latLong');
$_SESSION['latLong'] = $latLong; 