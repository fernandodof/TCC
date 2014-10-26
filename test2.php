<?php

require_once './src/app/model/entities/Restaurante.class.php';
require_once './src/app/model/entities/EnderecoRestaurante.class.php';
require_once './src/app/model/entities/FormaPagamento.class.php';
require_once './src/app/model/entities/TipoRestaurante.class.php';
require_once './src/app/model/persistence/Dao.class.php';
require_once './src/app/util/Queries.php';

$dao = new Dao();

$formaPagamento = new FormaPagamento();
$formaPagamento->setNome("Dinheiro");
$dao->save($formaPagamento);

$tipoRestaurante = new TipoRestaurante();
$tipoRestaurante->setNome("Comida Chinesa");
$dao->save($tipoRestaurante);

$forma = $dao->findByKey('FormaPagamento', 1);
$formas[] = $forma;

$tipo = $dao->findByKey('TipoRestaurante', 1);

$tipoArray[] = $tipo;

$restaurante = new Restaurante();
$restaurante->setNome("Restaurante China Mania");
$restaurante->setAtivo(true);
$restaurante->setAberto(true);
$restaurante->setFormasPagamento($formas);
$restaurante->setTipo($tipoArray);
$restaurante->setDescricao("O Restaurante China Mania tem oferece os mais variados prados de comida Chinesa e Japonesa");

$endereco = new EnderecoRestaurante();
$endereco->setBairro("Jardim Adalgiza ");
$endereco->setCep("58900-000");
$endereco->setCidade("Cajazeiras");
$endereco->setDescricao("Endereço China Mania");
$endereco->setEstado("Paraíba");
$endereco->setLatitude("-6.888228");
$endereco->setLongitude("-38.552894");
$endereco->setLogradouro("Rua Comandante Vital Rolim");
$endereco->setNumero("138");
$endereco->setComplemento("Cajazeiras Shopping");

$enderecoArray[] = $endereco;

$dao->save($endereco);

$restaurante->setEndereco($enderecoArray);

$dao->save($restaurante);

//$params['nome'] = '%tar%';
//
//$restaurantes = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST, $params);
//
//print_r($restaurantes[0]->getEndereco()[0]);
//
//
//$r = $dao->findAll('Restaurante');
//
//print_r($r[0]);
//
//
//$tamanhos = $dao->findAll('Tamanho');
//
//
//foreach ($tamanhos as $key => $tamanho){
//    if($tamanho->get>gCategoria()[0]->getNome()=='Comida'){
//        unset($tamanhos[$key]);
//    }
//}
//
//foreach ($tamanhos as $tamanho){
//    echo $tamanho->getCategoria()[0]->getNome();
//}