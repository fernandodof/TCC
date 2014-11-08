<link href="../css/conformOrder.css" rel="stylesheet" type="text/css">
<link href="../font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container">
    {if isset($smarty.session.pedido)}
        <table id="cart" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:50%">Produto</th>
                    <th style="width:10%">Valor</th>
                    <th style="width:8%">Quantidade</th>
                    <th style="width:22%" class="text-center">Subtotal</th>
                    <th style="width:10%"></th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$smarty.session.pedido->getItensPedido() item=it}
                    <tr>
                        <td data-th="Item">
                            <div class="row">
                                <div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
                                <div class="col-sm-10">
                                    <h4 class="nomargin">{$it->getProduto()->getNome()}</h4>
                      
                                    <p>{$it->getProduto()->getIngredientes()}</p>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">R$ {$it->getTamanho()->getPreco()}</td>
                        <td data-th="Quantity">
                            <input type="number" class="form-control text-center" value="{$it->getQuantidade()}">
                        </td>
                        <td data-th="Subtotal" class="text-center">R$ {$it->getSubtotal()}</td>
                        <td class="actions" data-th="">
                            <button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>								
                        </td>
                    </tr>
                {/foreach}
            </tbody>
            <tfoot>
                <tr class="visible-xs">
                    <td class="text-center"><strong>Total</strong></td>
                </tr>
                <tr>
                    <td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Voltar ao cardápio</a></td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Total R$ {$smarty.session.pedido->getValorTotal()}</strong></td>
                    <td><a href="#" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                </tr>
            </tfoot>
        </table>
    {/if}
</div>