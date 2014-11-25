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
//echo '1';

$tipoRestaurante = new TipoRestaurante();
$tipoRestaurante->setNome("Lanches");
$dao->save($tipoRestaurante);
echo '2';

$forma = $dao->findByKey('FormaPagamento', 1);
$formas[] = $forma;

$tipo = $dao->findByKey('TipoRestaurante', 4);

//$restaurante = new Restaurante();
//$restaurante->setNome("Pizzaria Tarandela 3");
//$restaurante->setAtivo(true);
//$restaurante->setAberto(true);
//$restaurante->setFormasPagamento($formas);
//$restaurante->setTipo($tipo);
//$restaurante->setDescricao("A Pizzaria Tarandela 3 oferece os mais variados tipos de pizza que vão agradar a todos os paladeres");

//$restaurante = new Restaurante();
//$restaurante->setNome("Restaurante China Mania");
//$restaurante->setAtivo(true);
//$restaurante->setAberto(true);
//$restaurante->setFormasPagamento($formas);
//$restaurante->setTipo($tipo);
//$restaurante->setDescricao("O Restaurante China Mania possui um cardápio bastante diverso, com comida chinesa e japosesa");

$restaurante = new Restaurante();
$restaurante->setNome("Novo Lanches");
$restaurante->setAtivo(true);
$restaurante->setAberto(true);
$restaurante->setFormasPagamento($formas);
$restaurante->setTipo($tipo);
$restaurante->setDescricao("Novo Lanches oferece vários tipos de sanduíches");

$endereco = new Endereco();
$endereco->setBairro("Lot. Parque Rosina"); 
$endereco->setCep("58900-000");
$endereco->setCidade("Cajazeiras");
$endereco->setDescricao("Endereço Novo Lanches");
$endereco->setEstado("Paraíba");
$endereco->setLatitude("-6.8926409");
$endereco->setLongitude("-38.5455769");
$endereco->setLogradouro("Avenida Júlio Marquês Nascimento");
$endereco->setNumero("691");
$endereco->setComplemento(null);

//$endereco = new Endereco();
//$endereco->setBairro("Jardim Adalgisa");
//$endereco->setCep("58900-000");
//$endereco->setCidade("Cajazeiras");
//$endereco->setDescricao("Endereço Tarandela 3");
//$endereco->setEstado("Paraíba");
//$endereco->setLatitude("-6.887699");
//$endereco->setLongitude("-38.5572705");
//
//$endereco->setLogradouro("Avenida Comandante Vital Rolim");
//$endereco->setNumero("");
//$endereco->setComplemento("Cajazeiras Shopping");

$dao->save($endereco);
echo '3';

$restaurante->setEndereco($endereco);

$dao->save($restaurante);
echo '4';

//$params['nome'] = '%tar%';
//
//$restaurantes = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST, $params);
//
//print_r($restaurantes[0]->getTipo()[0]);


//$r = $dao->findAll('Restaurante');
//
//print_r($r[0]->getEndereco()->getLogradouro());
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