<link href="{$templateRoot}css/forgotPassword" rel="stylesheet">
<script src="{$templateRoot}js/forgotPassword.js"></script>
<div class="container col-lg-4 col-lg-offset-4 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Recuperar senha</h3>
        </div>
        <div class="panel-body" id="recoverPasswordPanelBody">
            <p class="text-info">Enviaremos um email para você com instruções para recuperar a sua senha.</p>

            <form id="forgotPasswordForm" method="POST">
                <div class="form-group">
                    <label class="control-label" for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required placeholder="Email cadastrado">
                </div>
                <input type="submit" value="Enviar" data-loading-text="Enviando..." id="enviar" name="formSubmit" class="btn btn-success pull-right">
            </form>

        </div>
    </div>
</div>