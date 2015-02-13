var templateRoot;

function activate(string) {
    jQuery(string).each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function (data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');
    });
}


function reOrder(idPedido, idRestaurante, btn) {
    $('#reOrder' + btn).button('loading');
    var data = {idPedido: idPedido, idRestaurante: idRestaurante};
    var url = templateRoot + 'src/app/ajaxReceivers/reOrder.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
//            $('body').html(serverResponse);
            window.location.replace(templateRoot + 'pages/confirmOrder');
        },
        error: function (data) {
            alert("Error");
        }
    });

}

function edit() {
    $('.editField').prop('disabled', function (i, oldVal) {
        return !oldVal;
    });
}

function editSubscription() {
    $('#saveButton').show();
    $('#clienteLoadingDiv').show();
    $('body').dimBackground();
    var nome = $('#nome').val();
    var email = $('#email').val();
    var login = $('#login').val();
    var telefone = $('#telefone').val();
    var senha = $('#senhaAtual').val();
    var descricaoEndereco = $('#descricaoEndereco').val();
    var logradouro = $('#logradouro').val();
    var bairro = $('#bairro').val();
    var numero = $('#numero').val();
    var cep = $('#cep').val();
    var cidade = $('#cidade').val();
    var estado = $('#estado').val();
    var complemento = $('#complemento').val();

    var data = {nome: nome, email: email, login: login, telefone: telefone, senha: senha, descricaoEndereco: descricaoEndereco,
        logradouro: logradouro, bairro: bairro, numero: numero, cep: cep, cidade: cidade, estado: estado, complemento: complemento};
    var url = templateRoot + 'src/app/ajaxReceivers/editSubscription.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            $('body').append(serverResponse);
            $('#subscribeForm').data('bootstrapValidator').resetForm();
            edit();
            $('#senhaAtual').val('');
            $('body').undim();
            $('#saveButton').hide();
            $('#clienteLoadingDiv').hide();
            alertify.success('Cadastro atualizado');
        },
        error: function (data) {
            alert("Error");
        }
    });
}

function editPassword() {
    $('#savePassword').show();
    $('#clienteLoadingDiv').show();
    $('body').dimBackground();
    var senha = $('#senha1').val();
    var data = {senha: senha};
    var url = templateRoot + 'src/app/ajaxReceivers/editPassword.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            $('body').append(serverResponse);
            $('#senhaAtual1').val('');
            $('#senha1').val('');
            $('#senha2').val('');
            $('#changePassword').data('bootstrapValidator').resetForm();
            $('#savePassword').hide();
            $('#clienteLoadingDiv').hide();
            $('body').undim();
            alertify.success('Senha atualizada');
        },
        error: function (data) {
            alert("Error");
        }
    });
}

function setRadius() {
    var km = $('#km').val();

    if (isNaN(km) || km < 0.5 || km > 30) {
        $('#helpKm').addClass('red');
        return;
    }

    $('#helpKm').removeClass('red');
    $('body').dimBackground();
    $('#saveRadius').show();
    $('#clienteLoadingDiv').show();
    var data = {km: km};
    var url = templateRoot + 'src/app/ajaxReceivers/setRadiusPref.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            if (serverResponse === '1') {
                alertify.alert('Raio de pesquisa atualizado');
            } else {
                alertify.alert('Ocorreu um erro na transmissão do dados, tente novamente mais tarde');
            }
            $('#clienteLoadingDiv').hide();
            $('#saveRadius').hide();
            $('body').undim();
        },
        error: function (data) {
            $('#clienteLoadingDiv').hide();
            $('#saveRadius').hide();
            $('body').undim();
            alertify.alert('Ocorreu um erro na transmissão do dados, tente novamente mais tarde');
        }
    });


}

function centerModal() {
    $(this).css('display', 'block');
    var $dialog = $(this).find(".modal-dialog");
    var offset = ($(window).height() - $dialog.height()) / 2;
    $dialog.css("margin-top", offset);
}

$('.modal').on('show.bs.modal', centerModal);
$(window).on("resize", function () {
    $('.modal:visible').each(centerModal);
});

$(document).ready(function () {
    edit();
    activate('img[src*=".svg"]');
    $('#pedidos').DataTable(
            {
                language: {
                    processing: "Processando...",
                    search: "Pesquisar&nbsp;:",
                    lengthMenu: "Mostrar _MENU_ Registros",
                    info: "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando de 0 até 0 de 0 registros",
                    infoFiltered: "",
                    infoPostFix: "",
                    loadingRecords: "Carregando resgistros...",
                    zeroRecords: "Não foram encontrados resultados",
                    emptyTable: "Tabela Vazia",
                    paginate: {
                        first: "Primeiro",
                        previous: "Anterior",
                        next: "Próximo",
                        last: "Último"
                    },
                    aria: {
                        sortAscending: ": Habilitar ordenação ascendente",
                        sortDescending: ": Habilitar ordenação descendente"
                    }
                },
                "iDisplayLength": 5,
                "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tudo"]],
                "order": [[1, "desc"]],
                "aoColumns": [
                    null,
                    null,
                    null,
                    null,
                    {"bSortable": false}
                ]
            });
            
    $('.dataTables_paginate').parent().removeClass('col-sm-6').addClass('col-xs-12');
    templateRoot = $('#templateRoot').val();

    $("#cep").mask("00.000-000");
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
                        message: 'Email já em uso', url: templateRoot + 'src/app/ajaxReceivers/validateEdit.php',
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
                        message: 'Login já em uso', url: templateRoot + 'src/app/ajaxReceivers/validateEdit.php',
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
            senhaAtual: {
                validators: {
                    notEmpty: {
                        message: 'A senha não pode ser vazia'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'A senha deve ter entre 6 e 30 caracteres'
                    },
                    remote: {
                        message: 'Senha não confere',
                        url: templateRoot + 'src/app/ajaxReceivers/validateEdit.php',
                        data: {
                            type: 'senhaAtual'
                        }
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
                    message: 'Bairro inválido', notEmpty: {
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
                    notEmpty: {
                        message: 'O CEP não pode ser vazio'
                    },
                    regexp: {
                        regexp: /^[0-9]{2}.[0-9]{3}-[0-9]{3}$/,
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
        // Prevent form submission
        e.preventDefault();
        editSubscription();

    });

    $('#changePassword').bootstrapValidator({
        fields: {
            senhaAtual: {
                validators: {
                    notEmpty: {
                        message: 'A senha não pode ser vazia'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'A senha deve ter entre 6 e 30 caracteres'
                    },
                    remote: {
                        message: 'Senha não confere',
                        url: templateRoot + 'src/app/ajaxReceivers/validateEdit.php',
                        data: {
                            type: 'senhaAtual'
                        }
                    }
                }
            },
            senha1: {
                validators: {notEmpty: {
                        message: 'Nova senha não pode ser vazia'},
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
                validators: {notEmpty: {
                        message: 'Confirmação de senha não pode ser vazia'
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
            }
        }
    }).on('success.form.bv', function (e) {
        // Prevent form submission
        e.preventDefault();
        editPassword();
    });

});