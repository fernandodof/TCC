<head>
    <script src="../js/jquery.priceFormat.min.js" type="text/javascript"></script>
    <script>
        {literal}     
        function callFilter(str) {
            filter(str);
        }

        function filter(str) {
            if (str === '') {
                $('#lbTamanho').removeClass("visible").addClass("invisible");
                $('#ingredientes').remove();
                $('.checkboxes').remove();
                return;
            }

            if (str === '2') {
                $('#ingredientes').remove();
            } else {
                $('#ingDiv').append("<textarea class='form-control' rows='3' name='ingredientes' id='ingredientes' placeholder='Ingredientes'></textarea>");
            }
            $('#wait').show();

            var data = {cat: str};
            var url = '../src/app/util/tamanhosProduto.php';

            $.ajax({
                type: "GET",
                url: url,
                async: true,
                data: data,
                success: function (server) {
                    $('#tamanhosDiv').html(server);
                    $('#lbTamanho').removeClass("invisible").addClass("visilble");
                    $('#wait').hide();
                },
                error: function (data) {
                    alert("Erro");
                }
            });
        }


        function checkCreatePrice(checkbox) {
            var checkboxVal = checkbox.value;
            if (checkbox.checked) {
                $(checkbox).parent().append("<input type='text' class='price' name='price[]' required placeholder='Preço' value='000' id='price" + checkboxVal + "'/>");
            } else {
                $("#price" + checkboxVal).remove();
            }
            formatPrices();

            $(document).tooltip();
            $(".price").tooltip({
                show: {
                    effect: "slideDown",
                    delay: 250
                }
            });
        }

        function formatPrices() {
            $('.price').priceFormat({
                prefix: 'R$ ',
                centsSeparator: ',',
                thousandsSeparator: '.'
            });
        }

        $(document).ready(function () {
            formatPrices();
        });
        {/literal}
    </script>
    <link href="../css/funcionarioPage.css" rel="stylesheet" type="text/css">
    <link href="../css/cardapio.css" rel="stylesheet" type="text/css">
</head>

<div class="container" id="page">
    <h3>{$smarty.session.funcRestaurante}</h3>
    <ul class="nav nav-pills nav-stacked col-md-2 sidebar">
        <li class=""><a href="#tab_a" data-toggle="pill">Pedidos<span class="glyphicon glyphicon-shopping-cart"></span></a></li>
        <li class="{if isset($smarty.get.produtoCadastrado)}active{/if}"><a href="#tab_b" data-toggle="pill">Cardápio<span class="glyphicon glyphicon-list-alt"></span></a></li>
    </ul>
    <div class="tab-content col-md-10">
        <div class="tab-pane" id="tab_a">
            <h4>Pedidos</h4>
            <p></p>
        </div>

        <div class="tab-pane {if isset($smarty.get.produtoCadastrado)}active{/if}" id="tab_b">
            <h4 data-toggle="collapse" data-target="#cardapio" class="elementToggle" id="openCardapio">Cardápio <b class="caret"></b></h4>
            <div id="cardapio" class="collapse">
                <ul class="nav nav-tabs nav-justified" data-tabs="tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#comida" data-toggle="tab">Comida</a></li>
                    <li role="presentation"><a href="#bebida" data-toggle="tab">Bebida</a></li>
                </ul>
                <div class="tab-content">
                    <div id="comida" class="tab-pane active fade in">
                        {foreach from=$produtosComida item=produto}
                            <div class="produto">
                                <p class="nome">{$produto->getNome()}</p>
                                {foreach from = $produto->getTamanhos() item=tamanho}
                                    <div class="tamanho row col-xs-12">
                                        <div class="tam">
                                            <p class="pull-left descricaoTamanho">{$tamanho->getDescricao()}</p>
                                            <p class="pull-right precoTamanho">R$ {$tamanho->getPreco()}</p>
                                        </div>
                                    </div>
                                {/foreach}
                                <h6 data-toggle="collapse" data-toggle="tooltip" data-placement="right" title="Clique para ver os ingredientes" data-target="#ingredientes{$produto->getId()}" class="elementToggle ingredientesLabel">Ingredientes</h6>
                                <div id="ingredientes{$produto->getId()}" class="collapse ingredientes fade">
                                    <p>{$produto->getIngredientes()}</p>
                                </div>
                            </div>
                        {/foreach}
                    </div>
                    <div id="bebida" class="tab-pane fade">
                        {foreach from=$produtosBebida item=produto}
                            <div class="produto">
                                <p class="nome">{$produto->getNome()}</p>
                                {foreach from = $produto->getTamanhos() item=tamanho}
                                    <div class="tamanho row col-xs-12">
                                        <div class="tam">
                                            <p class="pull-left descricaoTamanho">{$tamanho->getDescricao()}</p>
                                            <p class="pull-right precoTamanho">R$ {$tamanho->getPreco()}</p>
                                        </div>
                                    </div>
                                {/foreach}
                            </div>
                        {/foreach}
                    </div>
                </div>
            </div>
            <h4 data-toggle="collapse" data-target="#addProduto" class="elementToggle" id="openInserir">Inserir Novo Produto <b class="caret"></b></h4>
                {if isset($smarty.get.produtoCadastrado)}
                <div class="alert alert-success alert-dismissible col-md-10" role="alert">
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span></button>
                    Produto cadastrado com sucesso
                </div>
            {/if}
            <form class="form-horizontal col-md-10 collapse" method="POST" name="addProduto" id="addProduto" action="../src/app/processes/ProcessProduto.php">
                <input type="hidden" name="idRestaurante" value="{$smarty.session.idRestaurante}"/>
                <div class="form-group">
                    <select name="categoria" class="form-control" onchange="window.callFilter(this.value);" required>
                        <option value="">Escolha a categria</option>
                        {foreach from = $categorias item = categoria}
                            <option value="{$categoria->getId()}">{$categoria->getNome()}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Nome do produto" name="nomeProduto" class="form-control"/>
                </div>

                <div class="form-group" id="ingDiv">
                    {*                    <textarea class="form-control" rows="3" name="ingredientes" id="ingredientes" placeholder="Ingredientes"></textarea>*}
                </div>

                <div class="form-group">   
                    <label id="lbTamanho" class="invisible col-sm-2">Tamanho(s):</label>
                    <span id="wait" style="display: none;"><img src="../images/ajax-loader1.gif" alt = "Aguarde..."></span>
                    <div id="tamanhosDiv" class="col-xs-12 form-group">
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-success pull-right" name="formSubmit" value="cadastrarProduto"> Cadastrar </button>
            </form>
        </div>
    </div>
</div> <!-- tab content -->