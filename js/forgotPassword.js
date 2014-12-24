function requestPasswordRecovery() {
    var email = $('#email').val();
    var data = {email: email};
    var url = templateRoot + 'src/app/ajaxReceivers/resquestPasswordRecovery.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            $('')
        },
        error: function (data) {
            alert("Error");
        }
    });
}

$(document).ready(function () {
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
    });
});
