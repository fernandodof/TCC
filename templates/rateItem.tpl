<link href="{$templateRoot}libs/bootstrap-star-rating/css/star-rating.min.css" rel="stylesheet" type="text/css">
<script src="{$templateRoot}libs/bootstrap-star-rating/js/star-rating.min.js" type="text/javascript" charset="UTF-8"></script>
<link href="{$templateRoot}css/restaurantColumn.css" rel="stylesheet" type="text/css">
<link href="{$templateRoot}css/rate.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="{$templateRoot}js/rateFunctions.js" charset="UTF-8"></script>
<script type="text/javascript" src="{$templateRoot}js/stopVerbosity.min.js" charset="UTF-8"></script>
<div class="container">
    <div class="visible-sm visible-xs">
        <button class="btn btn-primary btn-sm" data-toggle="collapse" data-target=".restaurant">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </button>
    </div>

    <div class="menu col-md-8 col-md-offset-2 col-sm-12">
        <input type="hidden" id="idProduto" value="{$produto->getId()}">
        <h2>{$restaurante->getNome()}</h2>
        <h3>Avaliar: <small class="nameP">{$produto->getNome()}</small></h3>
        <div id="rateDiv">
            <h4>Faça Sua Avaliação</h4>
            <input id="rateInputUserItem" data-show-clear="false" value="{$nota}">
        </div>

        <div id="comment">
            <form class="form-horizontal" method="POST" action="javascript:void(0)">
                <label for="commentBox">Você também pode fazer um comentário</label>
                <div class="form-group">
                    <textarea id="commentBox" rows="5" class="form-control" name="comment" required placeholder="Insira seu comentário aqui"></textarea>
                </div>
                <button class="btn btn-primary pull-right" data-loading-text="Enviando....." id="send" onclick="sendCommentItem();">Enviar comentário</button>
            </form>
        </div>
    </div>
</div>