<?php
require_once './smartyHeader.php';
require_once '../src/app/model/persistence/Dao.class.php';
require_once '../src/app/model/entities/Produto.class.php';
require_once '../src/app/model/entities/Categoria.class.php';
require_once '../src/app/model/entities/Tamanho.class.php';
require_once '../src/app/model/entities/Pedido.class.php';
require_once '../src/app/model/entities/ItemPedido.class.php';

include_once '../pages/header.php';

$smarty->display('../templates/confirmOrder.tpl');

include_once '../pages/footer.php';