function filterRestaurante(str) {
    alert(str);
    var search = getUrlParameter('search');

    var data = {kind : str, search : search};
    var url = '../src/app/ajaxReceivers/filterSearch.php';

    $.ajax({
        type: "GET",
        url: url,
        async: true,
        data: data,
        success: function (serverResponse) {
            $('#results').html(serverResponse);
        }
    });
}

function getUrlParameter(sParam)
{
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++)
    {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] === sParam)
        {
            return sParameterName[1];
        }
    }
}  