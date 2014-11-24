function filterRestaurante(str) {
    var search = getUrlParameter('search');
    var data = {kind: str, search: search};

    var absoluteUrl = getAbsoluteUrl();
    var parameters = $.query.set("kindOfFood", str);
    parameters = parameters.toString().replace("%2B", "+");
    
    window.history.pushState(data, "Title", absoluteUrl+parameters);
    
    var url = '../src/app/ajaxReceivers/filterSearch.php';

    $.ajax({
        type: "POST",
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

function getAbsoluteUrl() {
    var url = document.URL;

    if (url.indexOf("?") > -1) {
        url = url.substr(0, url.indexOf("?"));
    }
    return  url;
}