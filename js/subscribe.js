var templateRoot;

//function checkEmail() {
//    var email = $('#email').val();
//
//    var data = {email: email};
//    var url = templateRoot + 'src/app/ajaxReceivers/checkLogin.php';
//    $.ajax({
//        type: "POST",
//        url: url,
//        async: true,
//        data: data,
//        success: function (serverResponse) {
//            if(serverResponse==='0'){
//                alertify.success('no');
//            }else{
//                alertify.log('yes');
//            }
//            
//        }
//    });
//
//}

function subscribe() {
    $('body').dimBackground();
    $('#subscribingDiv').show();
    var url = templateRoot + 'src/app/ajaxReceivers/subscribe.php';
    var data = $('#subscribeForm').serialize();
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            if (serverResponse[0] === '1') {
                $('#confirmation').show();
                $('#subscribeForm').hide();
            } else {
                alertify.error('Erro ao enviar os dados');
            }
            $('body').undim();
            $('#subscribingDiv').hide();
        },
        error: function (data) {
            alertify.error('Erro ao enviar os dados');
        }
    });
}

$(document).ready(function () {
    templateRoot = $('#templateRoot').val();
    $("#cep").mask("00.000-000");

    $.fn.bootstrapValidator.validators.invalidCep = {
        validate: function (validator, $field, options) {
            var value = $field.val();
            var regex = /^[0-9]{2}.[0-9]{3}-[0-9]{3}$/;
            return regex.test(value);

        }
    };

    $('#subscribeForm').bootstrapValidator({
        feedbackIcons: {
            validating: 'glyphicon glyphicon-refresh glyphicon-refresh-animate'
        },
        fields: {
            nome: {
                message: 'O nome é inválido',
                validators: {
                    notEmpty: {
                        message: 'O nome é obrigatório e não pode ser vazio'
                    },
                    regexp: {
                        regexp: /^[A-zÀ-ú\s]*$/,
                        message: 'O nome deve conter apenas letras'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'O endereço de email não pode ser vazio'
                    },
                    emailAddress: {
                        message: 'Endereço de email inválido'
                    },
                    remote: {
                        message: 'Email já em uso',
                        url: templateRoot + 'src/app/ajaxReceivers/validateSubscription.php',
                        data: {
                            type: 'email'
                        }
                    }
                }
            },
            login: {
                message: 'Login é inválido',
                validators: {
                    notEmpty: {
                        message: 'O login é obrigatório e não pode ser vazio'
                    },
                    stringLength: {
                        min: 3,
                        max: 100,
                        message: 'O login deve ter entre 5 e 100 caracteres'
                    },
                    remote: {
                        message: 'Login já em uso',
                        url: templateRoot + 'src/app/ajaxReceivers/validateSubscription.php',
                        data: {
                            type: 'login'
                        }
                    }
                }
            },
            telefone: {
                validators: {
                    notEmpty: {
                        message: 'O telefone não pode ser vazio'
                    },
                    regexp: {
//                        regexp: /^((\([0-9]{2}\)))?(\s)?([9]{1})?([0-9]{4})(-)?([0-9]{4})$/,
                        regexp: /^(((\([0-9]{2}\)))|(([0-9]{2})))(\s)?([9]{1})?([0-9]{4})((-)|\s)?([0-9]{4})$/,
                        message: 'Telefone invalido'
                    }
                }
            },
            senha1: {
                validators: {
                    notEmpty: {
                        message: 'A senha não pode ser vazia'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'A senha deve ter entre 6 e 30 caracteres'
                    },
                    identical: {
                        field: 'senha2',
                        message: 'As senhas são diferentes'
                    }
                }
            },
            senha2: {
                validators: {
                    notEmpty: {
                        message: 'A confirmação de senha não pode ser vazia'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'A senha deve ter entre 6 e 30 caracteres'
                    },
                    identical: {
                        field: 'senha1',
                        message: 'As senhas são diferentes'
                    }
                }
            },
            descricaoEndereco: {
                validators: {
                    message: 'Descrição inválida',
                    notEmpty: {
                        message: 'A descrição não pode ser vazia'
                    },
                    stringLength: {
                        min: 2,
                        max: 40,
                        message: 'A descrição deve ter entre 2 e 40 caracteres'
                    }
                }
            },
            logradouro: {
                validators: {
                    message: 'Logadouro inválido',
                    notEmpty: {
                        message: 'O logradouro não pode ser vazio'
                    }
                }
            },
            bairro: {
                validators: {
                    message: 'Bairro inválido',
                    notEmpty: {
                        message: 'O barrio não pode ser vazio'
                    }
                }
            },
            numero: {
                validators: {
                    message: 'Numéro inválido, se não existir número deixe o campo vazio',
                    regexp: {
                        regexp: /^\s*\d*\s*$/,
                        message: 'Número inválido'
                    }
                }
            },
            cep: {
                validators: {
                    invalidCep: {
                        message: 'CEP inválido'
                    }
                }
            },
            cidade: {
                validators: {
                    message: 'Nome da Cidade inválido',
                    notEmpty: {
                        message: 'O Nome da cidade não pode ser vazio'
                    },
                    regexp: {
                        regexp: /^[A-zÀ-ú\s]*$/,
                        message: 'O nome da cidade deve conter apenas números'
                    }
                }
            },
            estado: {
                validators: {
                    notEmpty: {
                        message: 'Escolha um estado'
                    }
                }
            }
        }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        subscribe();
    }).on('erro.form.bv', function (e) {
        alertify.alert("<span class='error'>Por favor confira os seus dados</span>");
    });;
});

