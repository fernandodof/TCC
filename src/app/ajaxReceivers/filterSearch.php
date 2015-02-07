<?php

require '../../../pages/pathVars.php';
require_once '../model/persistence/Dao.class.php';
require_once '../util/Queries.php';
require_once '../model/entities/Restaurante.class.php';
require_once '../../app/util/CheckLoggedIn.php';
require_once '../../app/util/UserTypes.php';

session_start();

$dao = new Dao();
//
//
//$params['nome'] = trim(filter_input(INPUT_POST, 'search'));

if (trim(filter_input(INPUT_POST, 'kind')) !== null) {
    $tipo = trim(filter_input(INPUT_POST, 'kind'));
    $tipo = str_replace("+", " ", $tipo);
}

if ((filter_input(INPUT_POST, 'location') === 'true') && isset($_SESSION['latLong'])) {

    $latLong = explode(',', $_SESSION['latLong']);

    $params1['latitude'] = $latLong[0];
    $params1['longitude'] = $latLong[1];
    $params1['tipo'] = "%" . $tipo . "%";

    $raio = 0.5;
    if (filter_input(INPUT_POST, 'raio') !== null && filter_input(INPUT_POST, 'raio') !== '') {
        $raio = floatval(filter_input(INPUT_POST, 'raio'));
    } else if (isset($_SESSION['raio'])) {
        $raio = $_SESSION['raio'];
    }

    $params1['raio'] = $raio;
    $_SESSION['raio'] = $raio;

    $nearByrestaurants = $dao->getListAssocResultOfNativeQueryWithParameters(Queries::GET_RESTAURANTE_RAIO_TIPO, $params1);

    $restaurants = new \Doctrine\Common\Collections\ArrayCollection();
    foreach ($nearByrestaurants as $r) {
        $restaurants->add($dao->findByKey('Restaurante', $r['id']));
    }
} else {
    if (filter_input(INPUT_POST, 'location') === 'false') {

        if (isset($_SESSION['locationError'])) {
            $params['tipo'] = '%' . $tipo . '%';

            $nearByrestaurants = $dao->getListAssocResultOfNativeQueryWithParameters(Queries::GET_RESTAURANTE_TIPO_ORDER_BY_AVALIACAO, $params);

            $restaurants = new \Doctrine\Common\Collections\ArrayCollection();
            foreach ($nearByrestaurants as $r) {
                $restaurants->add($dao->findByKey('Restaurante', $r['id']));
            }
        } else {

            $latLong = explode(',', $_SESSION['latLong']);
            $params1['latitude'] = $latLong[0];
            $params1['longitude'] = $latLong[1];
            $params1['tipo'] = '%' . $tipo . '%';

            $nearByrestaurants = $dao->getListAssocResultOfNativeQueryWithParameters(Queries::GET_RESTAURANTE_RAIO_TIPO_ORDER_BY_AVALIACAO_E_RAIO, $params1);

            $restaurants = new \Doctrine\Common\Collections\ArrayCollection();
            foreach ($nearByrestaurants as $r) {
                $restaurants->add($dao->findByKey('Restaurante', $r['id']));
            }
        }
    } else {
        //$restaurants = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST_NOME_TIPO, $params);
        $params['nome'] = trim(filter_input(INPUT_POST, 'search'));

        if (is_numeric($params['nome'])) {
            $params['nome'] = '%' . $params['nome'] . '%';
            if ($tipo == "") {
                $restaurants = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST_CEP, $params); //Correct
            } else {
                $params['tipo'] = $tipo;
                $restaurants = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST_CEP_TIPO, $params);
            }
        } else {
            $params['nome'] = '%' . $params['nome'] . '%';
            if ($tipo == "") {
                $restaurants = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST_NOME, $params); //Correct
            } else {
                $params['tipo'] = $tipo;
                $restaurants = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST_NOME_TIPO, $params);
            }
        }
    }
}

foreach ($restaurants as $r) {
    $avgRating;
    $sum = 0;
    $counter = 0;
    foreach ($r->getAvaliacoes() as $av) {
        $sum += $av->getNota();
        $counter++;
    }

    if ($counter > 0) {
        $avg = $sum / $counter;
    } else {
        $avg = 0;
    }

    $avgRating[] = $avg;
}

if (isset($_SESSION['id']) && CheckLoggedIn::checkPermission(UserTypes::CLIENTE) )  {
    $params2['id_cliente'] = $_SESSION['id'];
    $idsRestaurantesComprados = $dao->getListResultOfNativeQueryWithParameters(Queries::GET_IDS_RESTAURANTES_CLIENTE_COMPROU, $params2);
}

if (count($restaurants) == 0) {
    
    if($tipo !== '' && filter_input(INPUT_POST, 'search') !== null){
        $tipo = "em <span id='type'>" . $tipo . "</span>";
    }
    
    if(filter_input(INPUT_POST, 'search') !== null){
        echo "<h3 class='no-result-search'>Desculpe, a pesquisa não retornou nenhum resultado para: <small id='term'>\"" . trim(filter_input(INPUT_POST, 'search')) . "\"</smalL> " . $tipo . "</h3>";
    }else{
        echo "<h3 class='no-result-search'>Desculpe, a pesquisa não retornou nenhum resultado para: " . $tipo . "</h3>";
    }
    echo "<div id='faces'>";
    echo "<img id='imgFace' src = '../images/icons/svg/sadFace.svg'/>";
    echo "</div>";
} else {
    $i = 0;
    foreach ($restaurants as $restaurante) {
        echo "<div class='well closed col-xs-12'>";
        echo "<h4 id='nameRestaurante' class='col-sm-8'>" . $restaurante->getNome() . "<small> " . $restaurante->getTipo()->getNome() . "</small></h4>";
        echo "<div class='row col-xs-12 enderecoDiv'>";
        echo "<span class='fa fa-map-marker fa-2x pull-left'> </span>";
        echo "<address class='col-xs-10'>" . $restaurante->getEndereco()->getLogradouro() . ", " . $restaurante->getEndereco()->getNumero() . ", Bairro: " . $restaurante->getEndereco()->getBairro() . ",  CEP: ";
        echo $restaurante->getEndereco()->getCep() . ", " . $restaurante->getEndereco()->getCidade() . ", " . $restaurante->getEndereco()->getEstado() . " ";
        echo $restaurante->getEndereco()->getComplemento();
        echo "</address>";
        echo "</div>";
        echo "<div class='row col-xs-12 pull-right formaPagamentoDiv'>";
        foreach ($restaurante->getFormasPagamento() as $forma) {
            if ($forma->getNome() == 'Dinheiro') {
                echo "<img class='img pull-right moneyImg' alt='Dinheiro' title='Dinheiro' src='" . $templateRoot . "images/icons/money59.png'/>";
            }
            if ($forma->getNome() == 'Cartao') {
                echo "<img class='img pull-right cardImg' alt='Cartão' title='Cartão' src='" . $templateRoot . "images/icons/card25.png'/>";
            }
        }
        echo "<p class='pull-right'>Formas de Pagamento: </p>";
        echo "</div>";
        if (isset($idsRestaurantesComprados) && in_array($restaurante->getId(), $idsRestaurantesComprados)) {
            echo "<div class='row'>";
            echo "<a class='btn btn-default btn-sm pull-left btAvaliar visible-lg visible-md' href='" . $templateRoot . "pages/rate/" . $restaurante->getId() . "'>Avaliar estabelecimento</a>";
            echo "</div>";
        }

        echo "<div class='row buttons pull-left col-md-12'>";
        echo "<div class='col-md-6 col-sm-8 col-xs-12'>";
        echo "<input class='rateInputs pull-left' data-show-clear='false' value='" . $avgRating[$i] . "'>";
        echo "</div>";
        echo "<a class='btn btn-info btn-sm pull-right btVerCardapio visible-lg visible-md' href='" . $templateRoot . "pages/restaurant/" . $restaurante->getId() . "'>Visualizar Cardápio</a>";
        echo "<a class='btn btn-primary btn-xs pull-right commentButton visible-lg visible-md'";
        if (count($restaurante->getComentarios()) == 0) {
            echo " disabled ";
        }
        echo "href='" . $templateRoot . "pages/comments/" . $restaurante->getId() . "'><span class='fa fa-comment fa-2x commentIcon'></span> ";
        echo "<span class='badge commentCountBadge'>" . count($restaurante->getComentarios()) . "</span>";
        echo "</a>";
        echo "<a class='btn btn-info btn-sm pull-right btVerCardapioSm visible-xs visible-sm btn-block' href='" . $templateRoot . "pages/restaurant/" . $restaurante->getId() . "'>Visualizar Cardápio</a>";
        echo "<a class='btn btn-primary btn-xs pull-right commentButtonSm visible-xs visible-sm btn-block'";
        if (count($restaurante->getComentarios()) == 0) {
            echo " disabled";
        }
        echo "href='" . $templateRoot . "pages/comments/" . $restaurante->getId() . "'><span class='fa fa-comment fa-2x commentIcon'></span> ";
        echo "<span class='badge commentCountBadge'>" . count($restaurante->getComentarios()) . "</span> Comentários";
        echo "</a>";
        if (isset($idsRestaurantesComprados) and in_array($restaurante->getId(), $idsRestaurantesComprados)) {
            echo "<a class='btn btn-default btn-sm pull-left btAvaliar visible-xs visible-sm btn-block' href='" . $templateRoot . "pages/rate/" . $restaurante->getId() . "'>Avaliar estabelecimento</a>";
        }

        echo "</div>";
        echo "</div>";
        $i++;
    }
}

