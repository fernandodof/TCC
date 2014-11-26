<?php

require '../../../pages/pathVars.php';
require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';
require_once '../model/entities/Restaurante.class.php';
session_start();

$dao = new Dao();

$params['nome'] = trim(filter_input(INPUT_POST, 'search'));
$tipo = trim(filter_input(INPUT_POST, 'kind'));

$params['nome'] = '%' . $params['nome'] . '%';
$params['tipo'] = "%" . $tipo . "%";
$restaurants = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST_NOME_TIPO, $params);


if(isset($_SESSION['id'])){
    $params['id_cliente'] = $_SESSION['id'];
    $idsRestaurantesComprados = $dao->getListResultOfNativeQueryWithParameters(Queries::GET_IDS_RESTAURANTES_CLIENTE_COMPROU, $params);
}

if (empty($restaurants)) {
    echo "<h3 class='no-result-search'>Desculpe, a pesquisa não retornou nenhum resultado.</h3>";
    echo "<div id='faces'>";
       echo "<img id='imgFace' src = '../images/icons/svg/sadFace.svg'/>";
    echo "</div>";
} else {
    foreach ($restaurants as $restaurante) {
        echo "<div class='well closed col-xs-12'>";
            echo "<h4>" . $restaurante->getNome() . "<small> " . $restaurante->getTipo()->getNome() . "</small></h4>";
            echo "<div class='row col-xs-12'>";
                echo "<img class='img pull-left' src='" . $templateRoot . "images/icons/rsz_location.png.'/>";
                echo "<address class='col-xs-10'>" . $restaurante->getEndereco()->getLogradouro() . ", " . $restaurante->getEndereco()->getNumero() . ", Bairro: "
                . $restaurante->getEndereco()->getBairro() . ", CEP: "
                . $restaurante->getEndereco()->getCep() . ", " . $restaurante->getEndereco()->getCidade() . ", " . $restaurante->getEndereco()->getEstado()
                . $restaurante->getEndereco()->getComplemento();
                echo "</address>";
            echo "</div>";
            echo "<div class='row col-xs-12 pull-right formaPagamentoDiv'>";
                foreach ($restaurante->getFormasPagamento() as $forma) {
                    if ($forma->getNome() == 'Dinheiro') {
                        echo "<img class='img pull-right moneyImg' alt='Dinheiro' title='Dinheiro' src='" . $templateRoot . "images/icons/money59.png'/>";
                    }
                    if ($forma->getNome() == 'Cartao') {
                        echo "<img class='img pull-right cardImg' alt='Cartão' title='Cartão src='" . $templateRoot . "images/icons/card25.png'/>";
                    }
                }
                echo "<p class='pull-right'>Formas de Pagamento: </p>";
            echo "</div>";
            echo "<div class='row buttons'>";
                if (isset($idsRestaurantesComprados)){
                    if (in_array($restaurante->getId(), $idsRestaurantesComprados)){
                        echo "<a class='btn btn-default btn-sm pull-left' href='". $templateRoot . "pages/rate/". $restaurante->getId() . "'>Avaliar estabelecimento</a>";
                    }   
                }   
            echo "<a class='btn btn-primary btn-sm pull-right btVerCardapio' href='" . $templateRoot . "/pages/restaurant/" . $restaurante->getId() . "'>Visualizar Cardápio</a>";
            echo "</div>";
        echo "</div>";
    }
}
