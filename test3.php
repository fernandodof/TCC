<?php
require_once './src/app/model/persistence/Dao.class.php';
require_once './src/app/model/entities/Categoria.class.php';
$dao = new Dao();

$categoria = new Categoria();
$categoria->setNome('Comida');
$dao->save($categoria);


$categoria1 = new Categoria();
$categoria1->setNome('Bebida');
$dao->save($categoria1);
