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

$forma = $dao->findByKey('FromaPagamento', 1);
$formas[] = $forma;

$restaurante = new Restaurante();
$restaurante->setNome("Tarandela 3");
$restaurante->setAtivo(true);
$restaurante->setAberto(true);
$restaurante->setFormasPagamento($formas);

$endrereco = new EnderecoRestaurante();
$endrereco->setBairro("Jardim Oásis");
$endrereco->setCep("58900-000");
$endrereco->setCidade("Cajazeiras");

$restaurante->setEndereco($endereco);