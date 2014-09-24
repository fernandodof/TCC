<?php

require_once './src/app/model/entities/Restaurante.class.php';
require_once './src/app/model/entities/EnderecoRestaurante.class.php';
require_once './src/app/model/entities/FormaPagamento.class.php';
require_once './src/app/model/entities/TipoRestaurante.class.php';
require_once './src/app/model/persistence/Dao.class.php';

$dao = new Dao();

//$formaPagamento = new FormaPagamento();
//$formaPagamento->setNome("Á vista");
//$dao->save($formaPagamento);
//
//$tipoRestaurante = new TipoRestaurante();
//$tipoRestaurante->setNome("Pizzaria");
//$dao->save($tipoRestaurante);
//
//
//$forma = $dao->findByKey('FormaPagamento', 1);
//$formas[] = $forma;
//
//$tipo = $dao->findByKey('TipoRestaurante', 1);
//
//
//$restaurante = new Restaurante();
//$restaurante->setNome("Tarandela 3");
//$restaurante->setAtivo(true);
//$restaurante->setAberto(true);
//$restaurante->setFormasPagamento($formas);
//$restaurante->setTipoRestaurante($tipo);
//$restaurante->setDescricao("Cotando com vários tipos de Pizza a PIzzaria Tarandela 3 é a ótima opção para uma boa comida.");
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
//$endereco->setLongitude("-38.546966");$endereco->setLogradouro("Rua João Alves da Silva");
//$endereco->setNumero("138");
//
//$restaurante->setEndereco($endereco);
//
//$dao->save($restaurante);

$kinds = $dao->findAll('tipoRestaurante');

//print_r($kinds);

foreach ($kinds as $kind){
    echo $kind->getNome();
}