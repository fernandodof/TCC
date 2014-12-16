var templateRoot;

function reOrder(idPedido, idRestaurante) {
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

    templateRoot = $('#templateRoot').val();
});