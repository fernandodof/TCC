<?php

require_once '../model/persistence/Dao.class.php';

$dao = new Dao();

$tamanhos = $dao->findAll('TamanhoCadastrado');

$tamanhosComida = array();
$tamanhosBebida = array();

echo "<div class= 'checkboxes'>";
foreach ($tamanhos as $tamanho) {
    if (filter_input(INPUT_GET, 'cat') == 1 && $tamanho->getCategoria()->getNome() == 'Comida') {
       echo "<div class='checkboxDiv col-xs-12'>";
          echo "<input class='checkboxTamanho' type='checkbox' name='tamanhos[]' onchange='checkCreatePrice(this)' value='" . $tamanho->getId() . "' id= '" . $tamanho->getId() . "'/>" .
               "<label class='labelTamanho' for='" . $tamanho->getId() . "'>" . $tamanho->getDescricao() . "</label>";
       echo "</div>";
    } else if (filter_input(INPUT_GET, 'cat') == 2 && $tamanho->getCategoria()->getNome() == 'Bebida') {
        echo "<div class='checkboxDiv col-xs-12'>";
            echo "<input class='checkboxTamanho' type='checkbox' name='tamanhos[]' onchange='checkCreatePrice(this)' value='" . $tamanho->getId() . "' id= '" . $tamanho->getId() . "'/>" .
            "<label class='labelTamanho' for='" . $tamanho->getId() . "'>" . $tamanho->getDescricao() . "</label>";
       echo "</div>";
    }
    
}
echo "</div>";