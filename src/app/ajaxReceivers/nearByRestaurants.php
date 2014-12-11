<?php
require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';


$latitude = filter_input(INPUT_POST, 'latitude');
$longitude = filter_input(INPUT_POST, 'longitude');
$raio = 5;

