<link href="{$templateRoot}css/clientePage.css" rel="stylesheet" type="text/css">
{*<link href="{$templateRoot}libs/dataTables/media/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">*}
<link href="{$templateRoot}libs/dataTables/media/css/jquery.dataTables_themeroller.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}libs/dataTables/bootstrapDatatableTheme/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}libs/hoverCSS/hover.min.css" rel="stylesheet">
<link href="{$templateRoot}css/subscribe.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}libs/bootstrapvalidator-dist-0.5.3/dist/css/bootstrapValidator.min.css" rel="stylesheet">
<script src="{$templateRoot}js/jquery.dim-background.js" rel="stylesheet"></script>
<script src="{$templateRoot}libs/dataTables/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="{$templateRoot}libs/dataTables/bootstrapDatatableTheme/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="{$templateRoot}js/clientPageFunctions.js" type="text/javascript"></script>
<script src="{$templateRoot}libs/jquery.mask.min.js" type="text/javascript"></script>
<script src="{$templateRoot}libs/bootstrapvalidator-dist-0.5.3/dist/js/bootstrapValidator.min.js" type="text/javascript"></script>
<script src="{$templateRoot}libs/bootstrapvalidator-dist-0.5.3/src/js/language/pt_BR.js" type="text/javascript"></script>
<div class="container">
    <div id="clienteLoadingDiv">
        <img id="sumitingOrder" class="rotating" src="{$templateRoot}images/icons/plate.svg">
        <h4 class="center">Aguarde...</h4>
    </div>
    <form method="GET" class="form-horizontal searchForm" action="{$templateRoot}pages/search">
        <div class="row input-group col-md-12 pull-left search">
            <div class="col-md-7 col-xs-12 searchDiv pull-left">
                <input type="text" class="form-control input-lg pull-left searchField" placeholder="Digite seu cep ou o nome do restaurante" id="search" name="search">
            </div>
            <div class="row col-md-5 col-xs-12">
                <div class="form-group col-md-11 col-xs-12 pull-left kindOfFoodDiv">
                    <select class="form-control input-lg kindOfFoodSelect col-md-11 col-xs-12" name="kindOfFood">
                        <option class="" value="">Tipo de cozinha (todas)</option>
                        {foreach from = $kindsOfFood kind}
                            <option class="" value='{$kind.nome}'>{$kind.nome}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="col-md-1 visible-lg visible-md btSearchDiv">        
                    <div class="input-group-btn">
                        <button type="submit" name="formSubmit" value="SearchRestaurante" class="btn btn-lg btn-success btSearch"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </div>
            </div>
            <div class="row col-xs-12 visible-sm visible-xs btSearchDiv">        
                <div class="input-group-btn">
                    <button type="submit" name="formSubmit" value="SearchRestaurante" class="col-xs-12 btn btn-lg btn-success btSearch">Pesqusar <span class="glyphicon glyphicon-search"></span></button>
                </div>
            </div>
        </div>
    </form>

    <ul class="nav nav-pills nav-stacked col-md-2 sidebar">
        <li class="active"><a href="#tab_a" data-toggle="pill" class="button glow">Principal<span class="fa fa-fw fa-bars"></span></a></li>
        <li><a href="#tab_b" data-toggle="pill" class="button glow">Pedidos <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
        <li><a href="#tab_c" data-toggle="pill" class="button glow">Perfil <span class="glyphicon glyphicon-user"></span></a></li>
    </ul>
    <div class="tab-content col-md-10">
        <div class="tab-pane active" id="tab_a">
            <h4>Últimos Pedidos</h4>
            {$i=0}
            {foreach from=$ultimosPedidos item=pedido}
                <div class="pedidoDiv well well-sm">
                    <div class="pedidoHeader">
                        <h5 class="date pull-left">{$pedido->getDataHora()}</h5>
                        <button class="btn btn-xs btn-info pull-right addCart glow" id='reOrder{$i}' data-loading-text="Enviando..."
                                onclick="reOrder({$pedido->getId()},{$pedido->getRestaurante()->getId()},{$i});">Refazer Pedido
                        </button>
                    </div>
                    <div class="table-condensed">
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Quantidade</th>
                                    <th>Tamanho</th>
                                </tr>
                            </thead>
                            <tbody>
                                {foreach from=$pedido->getItensPedido() item=it}
                                    <tr>
                                        <td>{$it->getProduto()->getNome()}</td>
                                        <td>{$it->getQuantidade()}</td>
                                        <td>{$it->getTamanho()->getDescricao()}</td>
                                    </tr>
                                {/foreach}
                            </tbody>
                        </table>
                    </div>
                    <h5 class="restaurant">{$pedido->getRestaurante()->getNome()}</h5>
                </div>
                {$i=$i+1}
            {/foreach}

        </div>
        <div class="tab-pane" id="tab_b">
            <h4>Pedidos</h4>
            <div>
                <table id="pedidos" class="table table-responsive display table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Data</th>
                            <th>Valor</th>
                            <th>Estabelecimento</th>
                            <th>Itens</th>
                        </tr>
                    </thead>
                    <tbody>
                        {$i=0}
                        {foreach from=$pedidos item=pedido}
                            <tr>
                                <td>{$pedido->getId()}</td>
                                <td>{$pedido->getDataHora()}</td>
                                <td>R$ {$pedido->getValorTotal()}</td>
                                <td>{$pedido->getRestaurante()->getNome()}</td>
                                <td <label data-toggle="collapse" data-target="#item{$i}" class="elementToggle verItem">Ver Itens <span class="fa fa-eye"></span></label>

                                    <div class="modal" id="item{$i}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4>Itens</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-condensed">
                                                            <thead>
                                                                <tr>
                                                                    <th>Nome</th>
                                                                    <th>Tamanho</th>
                                                                    <th>Quantidade</th>
                                                                    <th>Subtotal</th>
                                                                <tr>
                                                            </thead>
                                                            {foreach from=$pedido->getItensPedido() item=it}
                                                                <tbody>
                                                                    <tr>
                                                                        <td>{$it->getProduto()->getNome()}</td>
                                                                        <td>{$it->getTamanho()->getDescricao()}</td>
                                                                        <td>{$it->getQuantidade()}</td>
                                                                        <td>{$it->getSubtotal()}</td>
                                                                    </tr>
                                                                <tbody>
                                                                {/foreach}
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <label class="pull-right">Valor Total: R$ {$pedido->getValorTotal()}</label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            {$i=$i+1}
                        {/foreach}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane" id="tab_c">
            <form role="form" class="form-horizontal col-sm-6 col-sm-offset-3" id="setRadiusForm" action="javascript:void(0)" method="post">

                <h4>Preferência de raio <img id="radiusImage" class="pull-right" src="{$templateRoot}images/icons/svg/distance.svg"></h4>
                <h5>Defina aqui um raio em kilômetros em que você deseja fazer a pesquisa por estabelecimentos próximos</h5>
                <div class="form-group input-group">
                    <input class="form-control" type="text" id="km" name="km" value="{$smarty.session.raio}">
                    <span class="input-group-addon" id="kmAddon">Km</span>
                    <a id="setRadius" onclick="setRadius();" class="btn btn-success pull-left">Salvar <span id="mapMarker" class="fa fa-fw fa-map-marker"></span> 
                        <span id="saveRadius" class="glyphicon glyphicon-refresh glyphicon-refresh-animate buttonLoadingIcon"></span></a>
                </div>
                <small class="help-block" id="helpKm">Insira um valor entre 0.5 e 30</small>
            </form>

            <div class="divider1 col-sm-6 col-sm-offset-3 pull-left"></div>

            <form role="form" class="form-horizontal col-sm-6 col-sm-offset-3" id="subscribeForm" action="javascript:void(0)" method="post">

                <a id="edit" onclick="edit();" value="CadastrarCliente" type="button" class="btn btn-default pull-right">Editar <span class="fa fa-edit"></span></a>
                <h2>Cadastro</h2>

                <div class="form-group">
                    <input type="text" name="nome" id="nome" class="form-control editField" placeholder="Nome Completo" value="{$cliente->getNome()}" required/>
                </div>
                <div class="form-group" id="emailDiv">
                    <input type="email" name="email" id="email" class="form-control editField" placeholder="Email" required value="{$cliente->getEmail()}"/>
                </div>

                <div class="form-group">
                    <input type="text" name="login" id="login" class="form-control editField" placeholder="Login" required value="{$cliente->getLogin()}"/>
                </div>
                {foreach from=$cliente->getTelefones() item=telefone} 
                    <div class="form-group col-sm-6" id="telefoneDiv">
                        <input type="text" name="telefone" id="telefone" class="form-control editField" placeholder="Número do Telefone" value="{$telefone->getNumero()}"/>
                    </div>

                {/foreach}
                <div class="form-group col-sm-6" id="senhaAtualDiv">
                    <input type="password" name="senhaAtual" id="senhaAtual" class="form-control editField" placeholder="Senha Atual"/>
                </div>
                {foreach from=$cliente->getEnderecos() item=endereco}
                    <h3 class="pull-left" id="enrececoLabel">Endereço</h3>
                    <div class="form-group">
                        <input type="text" name="descricaoEndereco" id="descricaoEndereco" class="form-control editField" placeholder="Descrição para o endereço (ex: casa, escritório, etc)" value="{$endereco->getDescricao()}"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="logradouro" id="logradouro" class="form-control editField" placeholder="Logradouro (ex: Rua, Avenida, etc.)" required value="{$endereco->getLogradouro()}"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="bairro" id="bairro" class="form-control editField" placeholder="Bairro" required value="{$endereco->getBairro()}"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="numero" id="numero" class="form-control editField" placeholder="Número" value="{$endereco->getNumero()}"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="cep" id="cep" class="form-control editField" placeholder="CEP" required value="{$endereco->getCep()}"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="cidade" id="cidade" class="form-control editField" placeholder="Cidade" required value="{$endereco->getCidade()}"/>
                    </div>
                    <div class="form-group">
                        <select name="estado" id="estado" class="form-control editField" required>
                            <option value="">Estado</option>
                            <option value="Ácre" {if $endereco->getEstado() == 'Ácre'} selected{/if}>Ácre</option>
                            <option value="Alagoas" {if $endereco->getEstado() == 'Ácre'} selected{/if}>Alagoas</option>
                            <option value="Amapá" {if $endereco->getEstado() == 'Alagoas'} selected{/if}>Amapá</option>              
                            <option value="Amazonas" {if $endereco->getEstado() == 'Amazonas'} selected{/if}>Amazonas</option>
                            <option value="Bahia" {if $endereco->getEstado() == 'Bahia'} selected{/if}>Bahia</option>
                            <option value="Ceará" {if $endereco->getEstado() == 'Ceará'} selected{/if}>Ceará</option>
                            <option value="Distrito Federal" {if $endereco->getEstado() == 'Distrito Federal'} selected{/if}>Distrito Federal</option>
                            <option value="Espírito Santo" {if $endereco->getEstado() == 'Espírito Santo'} selected{/if}>Espírito Santo</option>
                            <option value="Goiás" {if $endereco->getEstado() == 'Goiás'} selected{/if}>Goiás</option>
                            <option value="Maranhão" {if $endereco->getEstado() == 'Maranhão'} selected{/if}>Maranhão</option>
                            <option value="Mato Gorsso" {if $endereco->getEstado() == 'Mato Gorsso'} selected{/if}>Mato Gorsso</option>
                            <option value="Mato Grosso do Sul" {if $endereco->getEstado() == 'Mato Grosso do Sul'} selected{/if}>Mato Grosso do Sul</option>
                            <option value="Minas Gerais" {if $endereco->getEstado() == 'Minas Gerais'} selected{/if}>Minas Gerais</option>
                            <option value="Pará" {if $endereco->getEstado() == 'Pará'} selected{/if}>Pará</option>              
                            <option value="Paraíba" {if $endereco->getEstado() == 'Paraíba'} selected{/if}>Paraíba</option>
                            <option value="Paraná" {if $endereco->getEstado() == 'Paraná'} selected{/if}>Paraná</option>
                            <option value="Pernambuco" {if $endereco->getEstado() == 'Pernambuco'} selected{/if}>Pernambuco</option>
                            <option value="Piauí" {if $endereco->getEstado() == 'Piauí'} selected{/if}>Piauí</option>
                            <option value="Rio de Janeiro" {if $endereco->getEstado() == 'Rio de Janeiro'} selected{/if}>Rio de Janeiro</option>
                            <option value="Rio Grande Do Norte" {if $endereco->getEstado() == 'Rio Grande Do Norte'} selected{/if}>Rio Grande Do Norte</option>
                            <option value="Rio Grande do Sul" {if $endereco->getEstado() == 'Rio Grande do Sul'} selected{/if}>Rio Grande do Sul</option>
                            <option value="Rondônia" {if $endereco->getEstado() == 'Rondônia'} selected{/if}>Rondônia</option>
                            <option value="Roraima" {if $endereco->getEstado() == 'Roraima'} selected{/if}>Roraima</option>
                            <option value="Santa Catarina" {if $endereco->getEstado() == 'Santa Catarina'} selected{/if}>Santa Catarina</option>
                            <option value="São Paulo" {if $endereco->getEstado() == 'São Paulo'} selected{/if}>São Paulo</option>
                            <option value="Sergipe" {if $endereco->getEstado() == 'Sergipe'} selected{/if}>Sergipe</option>
                            <option value="Tocantins" {if $endereco->getEstado() == 'Tocantins'} selected{/if}>Tocantins</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" name="complemento" id="complemento" class="form-control editField" placeholder="Complemento" value="{$endereco->getComplemento()}"/>
                    </div>
                {/foreach}
                <button type="submit" id="sub" name="formSubmit" value="EditarCliente" class="btn btn-success pull-right editField">Salvar <span class="fa fa-fw fa-save"></span> <span id="saveButton" class="glyphicon glyphicon-refresh glyphicon-refresh-animate buttonLoadingIcon"></span></button>
            </form>

            <div class="divider1 col-sm-6 col-sm-offset-3 pull-left"></div>

            <form role="form" class="form-horizontal col-sm-6 col-sm-offset-3" id="changePassword" action="javascript:void(0)" method="post">
                <h3>Alterar Senha</h3>
                <div class="form-group col-sm-6" id="senhaAtualDiv">
                    <input type="password" name="senhaAtual" id="senhaAtual1" class="form-control" placeholder="Senha Atual"/>
                </div>

                <div class="form-group col-sm-6" id="senha1Div">
                    <input type="password" name="senha1" id="senha1" class="form-control"  placeholder="Nova senha"/>
                </div>

                <div class="form-group col-sm-6" id="senha2Div">
                    <input type="password" name="senha2" id="senha2" class="form-control" placeholder="Confirme a senha"/>
                </div>
                <button type="submit" id="subPass" name="formSubmit" class="btn btn-success pull-right">Salvar <span class="fa fa-fw fa-save"></span> <span id="savePassword" class="glyphicon glyphicon-refresh glyphicon-refresh-animate buttonLoadingIcon"></span></button>
            </form>
        </div>
    </div>
</div>