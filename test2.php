<?php

require_once './src/app/model/entities/Restaurante.class.php';
require_once './src/app/model/entities/EnderecoRestaurante.class.php';
require_once './src/app/model/entities/FormaPagamento.class.php';
require_once './src/app/model/entities/TipoRestaurante.class.php';
require_once './src/app/model/persistence/Dao.class.php';
require_once './src/app/util/Queries.php';

$dao = new Dao();

//$formaPagamento = new FormaPagamento();
//$formaPagamento->setNome("Dinheiro");
//$dao->save($formaPagamento);

//$tipoRestaurante = new TipoRestaurante();
//$tipoRestaurante->setNome("Pizzaria");
//$dao->save($tipoRestaurante);

$forma = $dao->findByKey('FormaPagamento', 1);
$formas[] = $forma;

$tipo = $dao->findByKey('TipoRestaurante', 2);

$restaurante = new Restaurante();
$restaurante->setNome("Teste Pizzaria");
$restaurante->setAtivo(true);
$restaurante->setAberto(false);
$restaurante->setFormasPagamento($formas);
$restaurante->setTipo($tipo);
$restaurante->setDescricao("A Pizzaria Tarandela 3 conta com diversos sabores de pizza que agrada a todos os paladares");

$endereco = new Endereco();
$endereco->setBairro("Jardim Oásis");
$endereco->setCep("58900-000");
$endereco->setCidade("Cajazeiras");
$endereco->setDescricao("Pizzaria");
$endereco->setEstado("Paraíba");
$endereco->setLatitude("-6.8888144");
$endereco->setLongitude("-38.5469936");
$endereco->setLogradouro("Rua João Alves da Silva");
$endereco->setNumero("000");
$endereco->setComplemento(null);

$dao->save($endereco);

$restaurante->setEndereco($endereco);

$dao->save($restaurante);

//$params['nome'] = '%tar%';
//
//$restaurantes = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST, $params);
//
//print_r($restaurantes[0]->getTipo()[0]);


$r = $dao->findAll('Restaurante');

print_r($r[0]->getEndereco()->getLogradouro());
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