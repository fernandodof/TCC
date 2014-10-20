<?php

require_once '../model/persistence/Dao.class.php';

$dao = new Dao();

$tamanhos = $dao->findAll('Tamanho');

$tamanhosComida = array();
$tamanhosBebida = array();

foreach ($tamanhos as $tamanho) {
    if (filter_input(INPUT_GET, 'cat') == 1 && $tamanho->getCategoria()[0]->getNome() == 'Bebida') {
        echo "<input class='checkboxTamanho pull-left' type='checkbox' name='tamanhos[]' value='" . $tamanho->getId() . "' id= '" . $tamanho->getId() . "'/>" .
        "<label class='pull-left checkboxTamanho' for='" . $tamanho->getId() . "'>" . $tamanho->getDescricao() . "</label>";
    } else if (filter_input(INPUT_GET, 'cat') == 2 && $tamanho->getCategoria()[0]->getNome() == 'Comida') {
        echo "<input class='checkboxTamanho pull-left' type='checkbox' name='tamanhos[]' value='" . $tamanho->getId() . "' id= '" . $tamanho->getId() . "'/>" .
        "<label class='pull-left checkboxTamanho' for='" . $tamanho->getId() . "'>" . $tamanho->getDescricao() . "</label>";
    }
}