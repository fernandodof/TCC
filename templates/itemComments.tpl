<link href="{$templateRoot}css/comments.css" rel="stylesheet" type="text/css">

<div class="container">

    <div class="col-md-8 col-md-offset-2 col-sm-12">
        
        <div id="itemInfo">
            <h2>{$restaurante->getNome()}</h2>
            <h3>Comentários sobre: <small class="nameP">{$produto->getNome()}</small></h3>
        </div>
        
        <ul class="media-list comments">
            {foreach from=$produto->getComentarios() item=comentario}
                <li class="media">
                    <span class="fa fa-user fa-4x pull-left img-thumbnail userIcon"></span>
                    <div class="media-body">
                        <h5 class="media-heading pull-left">{$comentario->getCliente()->getLogin()}</h5>
                        <div class="comment-info pull-left">
                            <div class="btn btn-default btn-xs"><i class="fa fa-clock-o"></i> {$comentario->getDataHora()->format('d/m/Y')}</div>
                        </div>
                        <br class="clearfix">
                        <p class="well commentText">{$comentario->getTexto()}</p>
                    </div>
                </li>
            {/foreach}
        </ul>
    </div>

</div>