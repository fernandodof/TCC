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

function qureyPedidos() {
    var idRestaurante = $('#idRestaurante').val();

    var data = {idRestaurante: idRestaurante};
    var url = '../src/app/ajaxReceivers/novosPedidos.php';
    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            $('#pedidos').prepend(serverResponse);
        },
        error: function (serverResponse) {
            alert(serverResponse);
        }
    });
}

function callQueryPedidos() {
    setInterval("qureyPedidos()" , 3000);
}

$(document).ready(function () {
    formatPrices();
    callQueryPedidos();
});


