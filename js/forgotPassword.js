var templateRoot;

function requestPasswordRecovery() {
    $('#enviar').button('loading');
    var email = $('#email').val();
    var data = {email: email};
    var url = templateRoot + 'src/app/ajaxReceivers/resquestPasswordRecovery.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            $('#enviar').button('reset');
            $('#recoverPasswordPanelBody').html("<div class='alert alert-success' id='successMessage'> <p>Um email foi enviado para que você possa recuperar a senha</p> </div>");
        },
        error: function (data) {
            alert("Error");
        }
    });
}

$(document).ready(function () {
    templateRoot = $('#templateRoot').val();
    $('#forgotPasswordForm').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh glyphicon-refresh-animate'
        },
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'Por favor informe o endereço de email'
                    },
                    emailAddress: {
                        message: 'Endereço de email inválido'
                    },
                    remote: {
                        message: 'Email não cadastrado',
                        url: templateRoot + 'src/app/ajaxReceivers/checkEmailExists.php',
                        data: {
                            type: 'email'
                        }
                    }
                }
            }
        }
    }).on('success.form.bv', function (e) {
        // Prevent form submission
        e.preventDefault();
        requestPasswordRecovery();
    });
});
