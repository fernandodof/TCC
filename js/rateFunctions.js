var templateRoot;

function saveRating() {
    var nota = $('#rateInputUser').val();
    var idRestaurante = $('#idRestaurante').val();
    var data = {nota: nota, idRestaurante: idRestaurante};

    var url = templateRoot + 'src/app/ajaxReceivers/saveRating.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
//            $('body').html(serverResponse);
            alertify.log('Avaliação recebida');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
            alert(textStatus);
            alert(jqXHR);
        }
    });
}


function sendComment() {
    var comment = $('#commentBox').val();

    if (comment === '') {
        return;
    }
    $('#send').button('loading');
    var idRestaurante = $('#idRestaurante').val();
    var data = {comment: comment, idRestaurante: idRestaurante};

    var url = templateRoot + 'src/app/ajaxReceivers/saveComment.php';

    $.ajax({
        type: "POST",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            alertify.log('Comentário recebido');
            $('#send').button('reset');
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(errorThrown);
            alert(textStatus);
            alert(jqXHR);
        }
    });
}

function initIputs() {
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
        size: 'xs',
        disabled: true
    });
}




$(document).ready(function () {
    $("#rateInputUser").rating({
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

    $('#rateInputUser').on('rating.change', function (event, value, caption) {
        saveRating();
    });

    $('#commentBox').stopVerbosity({
        limit: 300,
        indicatorPhrase: ['[countdown]'
//            '[countdown]', 'characters remaining.', 'Maximo', '[limit]'
//            'characters.', '<br>', 'Permits multiple counts up:', '[countup]',
//            'and counts down:', '[countdown].',
//            'This indicator is customizable.'
        ]
    });

    initIputs();
    templateRoot = $('#templateRoot').val();
});