<link href= "../css/sidebar.css" rel="stylesheet">
<link href="../css/search.css" rel="stylesheet">

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4>Filtrar resultados</h4>
            <div class="visible-xs sidebarToggleButton">
                <button class="btn btn-primary btn-lg" data-toggle="collapse" data-target=".sidebarCollapse">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </button>
            </div>
        </div>
    </div>
    <div class="col-sm-3 sidebarContainer">
        <div class="navbar navbar-default navbar-static-top sidebar">
            <div class="collapse navbar-collapse sidebarCollapse">
                <ul class="nav nav-pills nav-stacked">
                    <li><a>Todas</a></li>
                        {foreach from = $kindsOfFood item = kindOfFood}
                        <li><a>{$kindOfFood}</a></li>
                        {/foreach}
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="row">   
                        <div class="page-header">
                            <h3>Resultados da pesquisa</h3>
                            <div class="well well-sm closed col-xs-2 statusIndicatioClosed"><p>Aberto</p></div>
                            <div class="well well-sm opened col-xs-2 pull-right statusIndicationOpened"><p>Fechado</p></div>
                        </div>
                    </div>
                    {foreach from = $restaurants key = restaurant item = status}
                        {if $status}
                            <div class="well closed col-xs-12">
                                <h4>{$restaurant} <small> Tipo de cozinha</small></h4>
                                <div class="row col-xs-12">
                                    <img class="img pull-left" src="../images/icons/rsz_location.png"/>
                                    <p class="col-xs-10">Endereço</p>                                    
                                </div>
                                <div class="row col-xs-12 pull-right">
                                    <img class="img pull-right moneyImg" src="../images/icons/money59.png"/>
                                    <img class="img pull-right cardImg" src="../images/icons/card25.png"/>
                                </div>
                            </div>       
                        {else}
                            <div class="well opened col-xs-12">
                                <h4>{$restaurant} <small> Tipo de cozinha</small></h4>
                                <div class="row col-xs-12">
                                    <img class="img pull-left locationImg" src="../images/icons/rsz_location.png"/>
                                    <p class="col-xs-10">Endereço</p>                                    
                                </div>
                                <div class="row col-xs-12 pull-right">
                                    <img class="img pull-right moneyImg" src="../images/icons/money59.png"/>
                                    <img class="img pull-right cardImg" src="../images/icons/card25.png"/>
                                </div>
                            </div>      
                        {/if}
                    {/foreach}

                </div>
            </div>
        </div>
    </div>   
</div>    