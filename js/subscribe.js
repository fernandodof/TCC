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

$(document).ready(function () {
    templateRoot = $('#templateRoot').val();
    $("#cep").mask("99.999-999");
    $('#subscribeForm').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
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
                        regexp: /^[a-zA-Z\s]*$/,
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
                    remote :{
                        message: 'Email já em uso',
                        url : templateRoot + 'src/app/ajaxReceivers/validateSubscription.php',
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
                    remote :{
                        message: 'Login já em uso',
                        url : templateRoot + 'src/app/ajaxReceivers/validateSubscription.php',
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
                        regexp: /^((\([0-9]{2}\)))?(\s)?([9]{1})?([0-9]{4})(-)?([0-9]{4})$/,
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
                message: 'Descrição inválida',
                notEmpty: {
                    message: 'A descrição não pode ser vazia'
                },
                stringLength: {
                    min: 2,
                    max: 40,
                    message: 'A descrição deve ter entre 2 e 40 caracteres'
                }
            },
            logradouro: {
                message: 'Logadouro inválido',
                notEmpty: {
                    message: 'O logradouro não pode ser vazio'
                }
            },
            bairro: {
                message: 'Bairro inválido',
                notEmpty: {
                    message: 'O barrio não pode ser vazio'
                }
            },
            numero: {
                message: 'Numéro inválido, se não existir número deixe o campo vazio',
                regexp: {
                    regexp: /^\s*\d*\s*$/,
                    message: 'Número inválido'
                }
            },
            cep: {
                notEmpty: {
                    message: 'O CEP não pode ser vazio'
                },
                regexp: {
                    regexp: /^[0-9]{2}.[0-9]{3}-[0-9]{3}$/,
                    message: 'CEP inválido'
                }
            },
            cidade: {
                message: 'Nome da Cidade inválido',
                notEmpty: {
                    message: 'O Nome da cidade não pode ser vazio'
                },
                regexp: {
                    regexp: /^[a-zA-Z]+$/,
                    message: 'O nome da cidade deve conter apenas números'
                }
            },
            estado: {
                notEmpty: {
                    message: 'Escolha um estado'
                }
            }
        }
    });
});

