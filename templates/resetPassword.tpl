<link href="{$templateRoot}css/forgotPassword" rel="stylesheet">
<script src="{$templateRoot}js/resetPassword.js"></script>
<div class="container col-lg-4 col-lg-offset-4 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Redefinir senha</h3>
        </div>
        <div class="panel-body" id="resetPasswordPanelBody">
            <input type="hidden" value="{$codigo}" id="codigo">
            <p class="text-info">Redefina a sua senha abaixo</p>

            <form id="resetPasswordForm" method="POST">
                <div class="form-group">
                    <label class="control-label" for="pass1">Nova senha:</label>
                    <input type="password" name="pass1" id="pass1" class="form-control" required placeholder="Nova senha">
                </div>
                <div class="form-group">
                    <label class="control-label" for="pass2">Confirme a senha:</label>
                    <input type="password" name="pass2" id="pass2" class="form-control" required placeholder="Confirme a senha">
                </div>
                <input type="submit" value="Redefinir" data-loading-text="Redefinindo..." id="redefinir" name="formSubmit" class="btn btn-success pull-right">
            </form>
        </div>
    </div>
</div>