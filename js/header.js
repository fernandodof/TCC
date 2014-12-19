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

$(document).ready(function () {
    templateRoot = $('#templateRoot').val();
//    alert(templateRoot + 'src/app/ajaxReceivers/validateLogin.php');
//    $('#loginForm').bootstrapValidator({
//        live: 'disabled',
//        feedbackIcons: {
//            valid: 'glyphicon glyphicon-ok',
//            invalid: 'glyphicon glyphicon-remove',
//            validating: 'glyphicon glyphicon-refresh glyphicon-refresh-animate'
//        },
//        fields: {
//            emailLogin: {
//                validators: {
//                    remote: {
//                        url: templateRoot + 'src/app/ajaxReceivers/validateLogin.php',
//                        // Send both values
//                        data: function (validator) {
//                            return {
//                                senhaLogin: validator.getFieldElements('senhaLogin').val()
//                            };
//                        }
//                    }
//                }
//            },
//            senhaLogin: {
//                validators: {
//                    notEmpty: {
//                        message: 'A senha não pode ser vazia'
//                    },
//                    remote: {
//                        url: templateRoot + 'src/app/ajaxReceivers/validateLogin.php',
//                        // Send both values
//                        data: function (validator) {
//                            return {
//                                emailLogin: validator.getFieldElements('emailLogin').val()
//                            };
//                        },
//                        message: 'Email, login ou senha inválidos'
//                    }
//
//                }
//            }
//        }
//    }).on('error.validator.bv', function(e) {
//        alert('error');
//    });
});