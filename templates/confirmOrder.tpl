<link href="../css/conformOrder.css" rel="stylesheet" type="text/css">
<link href="../font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link href="../css/animate.css-master/animate.min.css" rel="stylesheet" type="text/css">
<script src="../js/updateOrder.js" type="text/javascript"></script>

<div class="container">
    <img src="../images/loader.GIF" title="Carregando" alt="Carregando" class="img img-responsive" id="loader">
    <h2>{$restaurante->getNome()}</h2>
    <div id="confirmation"></div>
    {if isset($smarty.session.pedido)}
        <table id="cart" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th id="ProdutoTh">Produto</th>
                    <th id="ValorTh">Valor</th>
                    <th id="ValorTh">Quantidade</th>
                    <th id="SubtotalTh" class="text-center">Subtotal</th>
                    <th id="ButtonsTh"></th>
                </tr>
            </thead>
            <tbody>
                {$i = 0}
                {foreach from=$smarty.session.pedido->getItensPedido() item=it}
                    <tr>
                        <td data-th="Item">
                            <div class="row">
                                {if ($it->getProduto()->getIngredientes() ==null)}
                                    <div class="col-sm-2 hidden-xs"><img src="../images/icons/drink.png" alt="..." class="img-responsive"/></div>
                                    {else}
                                    <div class="col-sm-2 hidden-xs"><img src="../images/icons/food.png" alt="..." class="img-responsive"/></div>
                                    {/if}
                                <div class="col-sm-10">
                                    <h4 class="nomargin nomeProduto">{$it->getProduto()->getNome()} <span class="tamanho"> - {$it->getTamanho()->getDescricao()}</span></h4>
                                    <p>{$it->getProduto()->getIngredientes()}</p>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">R$ {$it->getTamanho()->getPreco()}</td>
                        <td data-th="Quantity">
                            <input type="number" class="form-control text-center" min="1" max="99" id="quantidade{$i}" value="{$it->getQuantidade()}">
                        </td>
                        <td data-th="Subtotal" class="text-center">R$ {$it->getSubtotal()}</td>
                        <td class="actions" data-th="">
                            <button class="btn btn-info btn-sm" onclick="updateQuantity({$i});" ><i class="glyphicon glyphicon-refresh"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="removeProduct({$i});"><i class="fa fa-trash-o"></i></button>								
                        </td>
                    </tr>
                    {$i=$i+1}
                {/foreach}
            </tbody>
            <tfoot>
                <tr class="visible-xs">
                    <td class="text-center"><strong>Total</strong></td>
                </tr>
                <tr>
                    <td><a href="../pages/restaurant.php?res={$smarty.session.idRestauranteDoPedidoAtual}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Voltar ao cardápio</a></td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Total R$ {$smarty.session.pedido->getValorTotal()}</strong></td>
            <form method="POST" action="javascript:void(0)">
                <td><button class="btn btn-success btn-block" onclick="checkout();">Comfirmar <i class="fa fa-angle-right"></i></button></td>
            </form>
            </tr>
            </tfoot>
        </table>
    {/if}
</div>