$(document).ready(function () {
    "use strict";

    $('.ipsSearch form.ipsUrl').on('submit', function(e) {
        e.preventDefault();
        var $this = $(this);
        var action = $this.attr('action').replace(/\/$/, "");
        var uri = $this.find('input[name="q"]').val();
        uri = uri.replace(new RegExp("/", "g"), ' ');
        var uriEncoded = encodeURIComponent(uri);
        window.location.replace(action + '/' + uriEncoded);
    });

});
