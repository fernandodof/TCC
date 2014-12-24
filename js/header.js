var templateRoot;

function validateLogin() {
    var emailLogin = $('#emailLogin').val();
    var senhaLogin = $('#senhaLogin').val();

    var data = {emailLogin: emailLogin, senhaLogin: senhaLogin, type: 'cliente'};
    var url = templateRoot + 'src/app/ajaxReceivers/validateLogin.php';
    $('#btnLogin').button('loading');
    $('.loginFormGroup').removeClass('has-error');
    $('.helpTextLogin').hide();
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            if (serverResponse === '1') {
//                document.forms["loginForm"].submit();
                window.location.replace(templateRoot + 'pages/clientePage');
            } else {
                $('.loginFormGroup').addClass('has-error');
                $('#btnLogin').button('reset');
                $('.helpTextLogin').show();
            }
        },
        error: function (data) {
            alert("Error");
        }
    });
}


function sendContactMessage() {
    $('#sendEmailContact').button('loading');
    var name = $('#nameContact').val();
    var email = $('#emailContact').val();
    var message = $('#messageContact').val();
    var data = {name: name, email:email, message: message};
    var url = templateRoot+'src/app/ajaxReceivers/sendContactEmail.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            alertify.alert('Messagem Enviada, Obrigado pelo seu contato');
            resetMyForm($('#contactForm'));
            $('#sendEmailContact').button('reset');
        },
        error: function (serverResponse) {
            alertify.alert('Ocorreu um erro no processamento da sua mensagem, por favor tente mais tarde');
        }
    });
}

function resetMyForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
}

$(document).ready(function () {
    templateRoot = $('#templateRoot').val();

    $('#contactForm').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh glyphicon-refresh-animate'
        },
        fields: {
            nameContact: {
                validators: {
                    notEmpty: {
                        message: 'Nova senha não pode ser vazia'
                    }
                }
            },
            emailContect: {
                validators: {
                    notEmpty: {
                        message: 'O endereço de email não pode ser vazio'
                    },
                    emailAddress: {
                        message: 'Endereço de email inválido'
                    }
                }
            },
            message: {
                message: 'Por favor, infome a sua messagem',
                validators: {
                    notEmpty: {
                        message: 'Por favor, infome a sua messagem'
                    },
                    stringLength: {
                        max: 300,
                        message: 'A mensagem deve ter no máximo 300 caracteres'
                    }

                }
            }
        }
    }).on('success.form.bv', function (e) {
        // Prevent form submission
        e.preventDefault();
        sendContactMessage();
    });
});