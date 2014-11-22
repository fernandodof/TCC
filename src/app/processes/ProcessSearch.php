<?php
require_once '../model/entities/Restaurante.class.php';
require_once '../util/Queries.php';
require_once '../model/persistence/Dao.class.php';

function recieveForm($param) {
    return strip_tags(addslashes($param));
}

switch (recieveForm(filter_input(INPUT_POST, 'formSubmit'))) {
    case "SearchRestaurante": {
            searchRestaurante();
            break;
        }
}