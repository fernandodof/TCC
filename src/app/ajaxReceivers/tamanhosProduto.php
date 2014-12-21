<?php

require_once '../model/persistence/Dao.class.php';

$dao = new Dao();

$tamanhos = $dao->findAll('TamanhoCadastrado');

$tamanhosComida = array();
$tamanhosBebida = array();

echo "<div class= 'checkboxes'>";
foreach ($tamanhos as $tamanho) {
    if (filter_input(INPUT_GET, 'cat') == 1 && $tamanho->getCategoria()->getNome() == 'Comida') {
       echo "<div class='checkboxDiv col-xs-12 checkbox'>";
            echo "<label class='labelTamanho'>";
                echo "<input class='checkboxTamanho' type='checkbox' name='tamanhos[]' onchange='checkCreatePrice(this)' value='" . $tamanho->getId() . "' id= '" . $tamanho->getId() . "'/>" . $tamanho->getDescricao();
            echo "</label>";
       echo "</div>";
    } else if (filter_input(INPUT_GET, 'cat') == 2 && $tamanho->getCategoria()->getNome() == 'Bebida') {
        echo "<div class='checkboxDiv col-xs-12 checkbox'>";
            echo "<label class='labelTamanho'>";
                echo "<input class='checkboxTamanho' type='checkbox' name='tamanhos[]' onchange='checkCreatePrice(this)' value='" . $tamanho->getId() . "' id= '" . $tamanho->getId() . "'/>" . $tamanho->getDescricao();
            echo "</label>";
       echo "</div>";
    }
    
}
echo "</div>";