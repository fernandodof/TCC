<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmailMessages
 *
 * @author Fernando
 */
require_once '../model/VO/PedidoVO.class.php';

class EmailMessages {

    public static function subscriptionConfirmationHTML($personName) {
        return "<!DOCTYPE html>
                    <html>
                        <head>
                             <title>Confirmaçao de cadastro</title>
                                <meta charset='UTF-8'>
                                <meta name='viewport' content='width=device-width', initial-scale=1.0>
                            </head>
                        <body>
                            <div style='text-align: center; margin: 0 auto;'>
                                <img style='width: 150px; width: 150px;' src='http://i62.tinypic.com/3093c02.png' alt='logo'>
                                    <h4 style='margin-top: 40px;
                                                   width: 100%;
                                                   clear: left;
                                                   float: left;'>
                                        Sabor Virtual - Cadastro realizado com sucesso</h4>
                             <h4>Olá <strong>" . $personName . "</strong>, O seu cadastro no Sabor Virtual foi realizado com sucesso !</h4>
                          </div>
                       </body>
                </html>";
    }

    public static function subscriptionConfirmationNormal($personName) {
        return "Olá " . $personName . ", O seu cadastro no Sabor Virtual foi realizado com sucesso !";
    }

    public static function orderConfirmationHtml($personName, $pedidoVO, $restaurantName, $date) {
        $strHtml = "<!DOCTYPE html>
                    <html>
                        <head>
                             <title>Confirmaçao de cadastro</title>
                                <meta charset='UTF-8'>
                                <meta name='viewport' content='width=device-width', initial-scale=1.0>
                            </head>
                        <body>
                            <div style='text-align: center; margin: 0 auto;'>
                                <img style='width: 150px; width: 150px;' src='http://i62.tinypic.com/3093c02.png' alt='logo'>
                                    <h4 style='margin-top: 40px;
                                                   width: 100%;
                                                   clear: left;
                                                   float: left;'>
                                        Sabor Virtual - Confirmação de pedido</h4>
                            <h4>Olá <strong>" . $personName . "</strong>, Este email é a confirmação do seu pedido</h4>
                            <p>Data ".$date."<p>
                            <p>".$restaurantName."<p>
                            <center>
                                <table style='margin-top: 15px; background-color='#F1F1F1' border='1' cellspacing='0' cellpadding='7' align='center'>
                                    <thead>
                                        <tr>
                                            <th>Itens</th>
                                            <th>Tamanho</th>
                                            <th>Quantidade</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                                        foreach ($pedidoVO->getItensPedido() as $it){
                                            $strHtml .= "<tr >";
                                                $strHtml .= "<td>". $it->getProduto()->getNome() . "</td>";
                                                $strHtml .= "<td>". $it->getTamanho()->getDescricao() . "</td>";
                                                $strHtml .= "<td>" .$it->getQuantidade() ."</td>";
                                                $strHtml .= "<td>" . $it->getSubtotal() . "</td>";
                                            $strHtml .= "</tr>";
                                        }
                                    $strHtml .= "</tbody>
                                </table>
                                <h4> Valor Total: R$".$pedidoVO->getValorTotal(). "</h4>
                            </center>
                          </div>
                       </body>
                </html>";
        return $strHtml; 
    }
    
    public static function orderConfirmationNormal($personName, $restaurantName, $date){
        return "Olá ".$personName.", O seu pedido foi confirmado (".$restaurantName." - ". $date. ")";
    }

}
