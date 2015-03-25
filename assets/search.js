$(document).ready(function () {
    "use strict";

    $('.ipsSearch form.ipsUrl').on('submit', function(e) {
        e.preventDefault();
        var uri = $(this).find('input[name="q"]').val();
        uri = uri.replace(new RegExp("/", "g"), ' ');
        var uriEncoded = encodeURIComponent(uri);
        window.location.replace(ip.languageUrl + 'search/' + uriEncoded);
    });

});
