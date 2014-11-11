<?php
$idRestaurante = filter_input(INPUT_POST, 'idRestaurantePedido');
session_start();
if (!isset($_SESSION['id'])) {
    echo 'login';
}else if((isset($_SESSION['idRestauranteDoPedidoAtual'])) && ($_SESSION['idRestauranteDoPedidoAtual'] != $idRestaurante)){
    echo 'currentOrder';
}else{
    echo 'noCurrentOrder';
}