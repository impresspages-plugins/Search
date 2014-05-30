$(document).ready(function () {
    "use strict";

    $('.ipsSearch').on('submit', function(e) {
        e.preventDefault();
        var uri = $(this).find('input[name="search"]').val();
        var langUrl= $(this).find('input[name="langUrl"]').val();
        uri = uri.replace(new RegExp("/", "g"), ' ');
        var uriEncoded = encodeURIComponent(uri);
        var baseUrl= ip.baseUrl;

        window.location.replace(baseUrl + langUrl + 'search/' + uriEncoded);
    });

});
