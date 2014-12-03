function callFilter(str) {
    filter(str);
}

function filter(str) {
    if (str === '') {
        $('#lbTamanho').removeClass("visible").addClass("invisible");
        $('#ingredientes').remove();
        $('.checkboxes').remove();
        return;
    }

    if (str === '2') {
        $('#ingredientes').remove();
    } else {
        $('#ingDiv').append("<textarea class='form-control' rows='3' name='ingredientes' id='ingredientes' placeholder='Ingredientes'></textarea>");
    }
    $('#wait').show();

    var data = {cat: str};
    var url = '../src/app/ajaxReceivers/tamanhosProduto.php';

    $.ajax({
        type: "GET",
        url: url,
        async: true,
        data: data,
        success: function (server) {
            $('#tamanhosDiv').html(server);
            $('#lbTamanho').removeClass("invisible").addClass("visilble");
            $('#wait').hide();
        },
        error: function (data) {
            alert("Erro");
        }
    });
}


function checkCreatePrice(checkbox) {
    var checkboxVal = checkbox.value;
    if (checkbox.checked) {
        $(checkbox).parent().append("<input type='text' class='price' name='price[]' required placeholder='Preço' value='000' id='price" + checkboxVal + "'/>");
    } else {
        $("#price" + checkboxVal).remove();
    }
    formatPrices();
}

function formatPrices() {
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
    alert(idPedido + " => " + status);
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
                        alertify.log('Pedido enviado para cozinha');
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
    alert(idPedido + " => " + status);
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
                        alertify.log('Pedido enviado para entrega');
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

function finalizarPedido(checkbox) {
    resetAlertify();

    var idPedido = $('#idPedidoEntrega' + checkbox.value).val();
    var status = 4;
    alert(idPedido + " => " + status);
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
                        alertify.success('Pedido enviado para entrega');
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
                "aLengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "Tudo"]],
                "order": [[1, "desc"]],
                "aoColumns": [
                    null,
                    null,
                    null,
                    {"bSortable": false, "bSearchable": false}
                ]
            });
}

$(document).ready(function () {
    setInterval("updateOrdersList()", 3000);
    activate('img[src*=".svg"]');

    setUpTable();

    formatPrices();
});


