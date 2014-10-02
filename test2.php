<?php

require_once './src/app/model/entities/Restaurante.class.php';
require_once './src/app/model/entities/EnderecoRestaurante.class.php';
require_once './src/app/model/entities/FormaPagamento.class.php';
require_once './src/app/model/entities/TipoRestaurante.class.php';
require_once './src/app/model/persistence/Dao.class.php';
require_once './src/app/util/Queries.php';

$dao = new Dao();
//
//$formaPagamento = new FormaPagamento();
//$formaPagamento->setNome("Dinheiro");
//$dao->save($formaPagamento);
//
//$tipoRestaurante = new TipoRestaurante();
//$tipoRestaurante->setNome("Pizzaria");
//$dao->save($tipoRestaurante);
//
//$forma = $dao->findByKey('FormaPagamento', 1);
//$formas[] = $forma;
//
//$tipo = $dao->findByKey('TipoRestaurante', 1);
//
//$tipoArray[] = $tipo;
//
//$restaurante = new Restaurante();
//$restaurante->setNome("Tarandela 3");
//$restaurante->setAtivo(true);
//$restaurante->setAberto(true);
//$restaurante->setFormasPagamento($formas);
//$restaurante->setTipo($tipoArray);
//$restaurante->setDescricao("Contando com vários tipos de Pizza a PIzzaria Tarandela 3 é a ótima opção para uma boa comida.");
//
//$endereco = new EnderecoRestaurante();
//$endereco->setBairro("Jardim Oásis");
//$endereco->setCep("58900-000");
//$endereco->setCidade("Cajazeiras");
//$endereco->setDescricao("Endereço Tarandela 3");
//$endereco->setEstado("Paraíba");
//$endereco->setLatitude("-6.888774");
//$endereco->setLongitude("-38.546966");
//$endereco->setLogradouro("Rua João Alves da Silva");
//$endereco->setNumero("138");
//
//$enderecoArray[] = $endereco;
//
//$dao->save($endereco);
//
//$restaurante->setEndereco($enderecoArray);
//
//$dao->save($restaurante);
//
$params['nome'] = '%tar%';

$restaurantes = $dao->getListResultOfNamedQueryWithParameters(Queries::SEARCH_REST, $params);

print_r($restaurantes[0]->getEndereco()[0]);

//
//$r = $dao->findAll('Restaurante');
//
//print_r($r[0]);