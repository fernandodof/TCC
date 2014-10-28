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

$tipoRestaurante = new TipoRestaurante();
$tipoRestaurante->setNome("Pizzaria");
$dao->save($tipoRestaurante);

$forma = $dao->findByKey('FormaPagamento', 1);
$formas[] = $forma;

$tipo = $dao->findByKey('TipoRestaurante', 2);

$restaurante = new Restaurante();
$restaurante->setNome("Pizzaria Tarandela 3");
$restaurante->setAtivo(true);
$restaurante->setAberto(true);
$restaurante->setFormasPagamento($formas);
$restaurante->setTipo($tipo);
$restaurante->setDescricao("A Pizzaria Tarandela 3 oferece os mais variados tipos de pizza que vão agradar a todos os paladeres");
//$restaurante->setDescricao("O Restaurante China Mania tem oferece os mais variados prados de comida Chinesa e Japonesa");

$endereco = new Endereco();
$endereco->setBairro("Oásis");
$endereco->setCep("58900-000");
$endereco->setCidade("Cajazeiras");
$endereco->setDescricao("Endereço Tarandela 3");
$endereco->setEstado("Paraíba");
//$endereco->setLatitude("-6.888228");
//$endereco->setLongitude("-38.552894");

$endereco->setLatitude("6.8888144");
$endereco->setLongitude("-38.5469936");

$endereco->setLogradouro("Rua João Alves da Silva");
$endereco->setNumero("138");
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