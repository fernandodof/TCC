function checkCreatePriceComida(checkbox) {
    var checkboxVal = checkbox.value;
    if (checkbox.checked) {
        $(checkbox).parent().after("<div id=priceDiv" + checkboxVal + "' class='form-group priceDiv col-xs-7'><input type='text' class='price form-control input-sm' name='price[]' required placeholder='Preço' value='000' id='price" + checkboxVal + "'/>");
        $('#addComidaForm').bootstrapValidator('addField', $('#price' + checkboxVal));
    } else {
        $("#price" + checkboxVal).parent().remove();
        $('#addComidaForm').bootstrapValidator('removeField', $('#price' + checkboxVal));
    }
    formatPrices();
}

function checkCreatePriceBebida(checkbox) {
    var checkboxVal = checkbox.value;
    if (checkbox.checked) {
        $(checkbox).parent().after("<div id=priceDiv" + checkboxVal + "' class='form-group priceDiv col-xs-7'><input type='text' class='price form-control input-sm' name='price[]' required placeholder='Preço' value='000' id='price" + checkboxVal + "'/>");
        $('#addBebidaForm').bootstrapValidator('addField', $('#price' + checkboxVal));
    } else {
        $("#price" + checkboxVal).parent().remove();
        $('#addBebidaForm').bootstrapValidator('removeField', $('#price' + checkboxVal));
    }
    formatPrices();
}

function resetMyForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');
}

function callResetForm(formId) {
    resetMyForm($('#' + formId));
    formatPrices();
    $('#' + formId).data('bootstrapValidator').resetForm();
}

function formatPrices() {
    $('.price').val('000');
    $('.price').priceFormat({
        prefix: 'R$ ',
        centsSeparator: ',',
        thousandsSeparator: '.'
    });
}

function qureyPedidosNovos() {
    var idRestaurante = $('#idRestaurante').val();

    var data = {idRestaurante: idRestaurante};
    var url = '../src/app/ajaxReceivers/newOrders.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            $('#pedidosRecebidos').append(serverResponse);
        },
        error: function (serverResponse) {
            alertify.alert(serverResponse);
        }
    });
}

function qureyPedidosCozinha() {
    var idRestaurante = $('#idRestaurante').val();

    var data = {idRestaurante: idRestaurante};
    var url = '../src/app/ajaxReceivers/kitchenOrders.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            $('#pedidosCozinha').append(serverResponse);
        },
        error: function (serverResponse) {
            alertify.alert(serverResponse);
        }
    });
}

function qureyPedidosEntrega() {
    var idRestaurante = $('#idRestaurante').val();

    var data = {idRestaurante: idRestaurante};
    var url = '../src/app/ajaxReceivers/deliveryOrders.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            $('#pedidosEntrega').append(serverResponse);
        },
        error: function (serverResponse) {
            alertify.alert(serverResponse);
        }
    });
}

function updateHitorico() {
    $('#update').button('loading');
    var idRestaurante = $('#idRestaurante').val();

    var data = {idRestaurante: idRestaurante};
    var url = '../src/app/ajaxReceivers/ordersHistory.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            $('#historico').html(serverResponse);
            setUpTable();
            $('#update').button('reset');
        },
        error: function (serverResponse) {
            alertify.alert(serverResponse);
        }
    });
}

function resetAlertify() {
    alertify.set({
        labels: {
            ok: "Sim",
            cancel: "Não"
        },
        delay: 5000,
        buttonReverse: false
    });
}

function enviarPedidoCozinha(checkbox) {
    resetAlertify();
    var idPedido = $('#idPedidoRecebido' + checkbox.value).val();
    var status = 2;
    if (checkbox.checked) {
        alertify.confirm("Este pedido será enviado para a cozinha. Ao clicar sim ele será removido desta lista, deseja fazer isso ?", function (e) {
            if (e) {

                $('#pedidoRecebidoDiv' + checkbox.value).remove();

                var data = {idPedido: idPedido, status: status};
                var url = '../src/app/ajaxReceivers/changeOrderStatus.php';
                $.ajax({
                    type: "POST",
                    url: url,
                    async: true,
                    data: data,
                    success: function (serverResponse) {
                        $('#pedidosRecebidos').prepend(serverResponse);
                        alertify.yellow = alertify.extend("yellow");
                        alertify.yellow("Pedido enviado para cozinha");

                    },
                    error: function (serverResponse) {
                        $('#pedidosRecebidos').prepend(serverResponse);
                    }
                });
            } else {
                checkbox.checked = false;
            }
        });
    }
}

function enviarPedidoEntrega(checkbox) {
    resetAlertify();

    var idPedido = $('#idPedidoCozinha' + checkbox.value).val();
    var status = 3;
    if (checkbox.checked) {
        alertify.confirm("Este pedido será enviado para a entrega. Ao clicar sim ele será removido desta lista, deseja fazer isso ?", function (e) {
            if (e) {
                $('#pedidoCozinhaDiv' + checkbox.value).remove();
                var data = {idPedido: idPedido, status: status};
                var url = '../src/app/ajaxReceivers/changeOrderStatus.php';
                $.ajax({
                    type: "POST",
                    url: url,
                    async: true,
                    data: data,
                    success: function (serverResponse) {
                        $('#pedidosCozinha').prepend(serverResponse);
                        alertify.green = alertify.extend("green");
                        alertify.green("Pedido enviado para entrega");
                    },
                    error: function (serverResponse) {
                        alert(serverResponse);
                    },
                });
            } else {
                checkbox.checked = false;
            }
        });
    }
}

function finalizarPedido(checkbox) {
    resetAlertify();

    var idPedido = $('#idPedidoEntrega' + checkbox.value).val();
    var status = 4;
    if (checkbox.checked) {
        alertify.confirm("Este pedido será finalizado. Ao clicar sim ele será removido desta lista, deseja fazer isso ?", function (e) {
            if (e) {

                $('#pedidoEntregaDiv' + checkbox.value).remove();
                var data = {idPedido: idPedido, status: status};
                var url = '../src/app/ajaxReceivers/changeOrderStatus.php';
                $.ajax({
                    type: "POST",
                    url: url,
                    async: true,
                    data: data,
                    success: function (serverResponse) {
                        $('#pedidosEntrega').prepend(serverResponse);
                        alertify.success('Pedido finalizado');
                    },
                    error: function (serverResponse) {
                        alert(serverResponse);
                    }
                });
            } else {
                checkbox.checked = false;
            }
        });
    }
}

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

function updateOrdersList() {
    qureyPedidosNovos();
    qureyPedidosCozinha();
    qureyPedidosEntrega();
}

function  setUpTable() {
    $.fn.dataTable.ext.pager.numbers_length = 5;
    $('#historicoPedidos').DataTable(
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
                "iDisplayLength": 10,
                responsive: true,
                "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tudo"]],
                "order": [[1, "desc"]],
                "aoColumns": [
                    null,
                    null,
                    null,
                    {"bSortable": false, "bSearchable": false}
                ]
            });
    $('.dataTables_paginate').parent().removeClass('col-sm-6').addClass('col-xs-12');
}

function setUpFormValidation() {

    $.fn.bootstrapValidator.validators.invalidPrice = {
        validate: function (validator, $field, options) {
            var value = $field.val();
            value = value.replace('R$ ', '');

            if (parseFloat(value.replace(/,/g, '')) <= 0) {
                return false;
            }

            return true;
        }
    };

    $('#addComidaForm').bootstrapValidator({
        feedbackIcons: {
            valid: '',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh glyphicon-refresh-animate'
        },
        fields: {
            nomeProduto: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, informe um nome para o produto'
                    }
                }
            },
            ingredientes: {
                message: 'Por favor, infome os ingredientes',
                validators: {
                    notEmpty: {
                        message: 'Por favor, infome os ingredientes'
                    },
                    stringLength: {
                        max: 200,
                        message: 'Os Ingredientes devem ter menos de 200 caracteres'
                    }

                }
            },
            image: {
                message: 'Por favor escolha uma imagem',
                validators: {
                    file: {
                        extension: 'jpeg,jpg,png,',
                        type: 'image/jpeg,image/png',
                        maxSize: 1048576, // 1024 * 1024
                        message: 'Arquivo inválido'
                    }
                }
            },
            'tamanhos[]': {
                message: 'Escolha um tamanho',
                validators: {
                    choice: {
                        min: 1,
                        message: 'Escolha pelo menos um tamanho'
                    }
                }
            },
            'price[]': {
                message: 'Por favor, informe o preço',
                validators: {
                    invalidPrice: {
                        message: 'Por favor, informe o preço'
                    }
                }
            }
        }
    });

    //
    $('#addBebidaForm').bootstrapValidator({
        feedbackIcons: {
            valid: '',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh glyphicon-refresh-animate'
        },
        fields: {
            nomeProduto: {
                validators: {
                    notEmpty: {
                        message: 'Por favor, informe um nome para o produto'
                    }
                }
            },
            'tamanhos[]': {
                message: 'Escolha um tamanho',
                validators: {
                    choice: {
                        min: 1,
                        message: 'Escolha pelo menos um tamanho'
                    }
                }
            },
            'price[]': {
                message: 'Por favor, informe o preço',
                validators: {
                    invalidPrice: {
                        message: 'Por favor, informe o preço'
                    }
                }
            }
        }
    });

}

$(document).ready(function () {
    setInterval("updateOrdersList()", 3000);
    activate('img[src*=".svg"]');

    setUpTable();

    formatPrices();
    setUpFormValidation();

    $(".alert-success").fadeTo(3000, 1000).slideUp(500, function () {
        $("#success-alert").alert('close');
    });

    $(".alert-danger").fadeTo(4000, 1500).slideUp(1500, function () {
        $("#erro-alert").alert('close');
    });

});


