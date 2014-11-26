var templateRoot;

function saveRating() {
    var nota = $('#rateInput').val();
    var idRestaurante = $('#idRestaurante').val();
    var data = {nota: nota, idRestaurante: idRestaurante};

    var url =  templateRoot +  'src/app/ajaxReceivers/saveRating.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            alertify.log('Avaliação recebida');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
            alert(textStatus);
            alert(jqXHR);
        }
    });
}


$(document).ready(function () {
    $("#rateInput").rating({
        starCaptions: function (val) {
            if (val === 0) {
                return 'Sem Avaliação';
            } else if (val > 0.1 && val < 1) {
                return val;
            } else if (val === 1) {
                return  val;
            }
            else {
                return val;
            }
        },
        clearCaption: '',
        size: 'lg'
    });

    $('#rateInput').on('rating.change', function (event, value, caption) {
        saveRating();
    });
    templateRoot = $('#templateRoot').val();
});