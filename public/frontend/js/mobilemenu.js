jQuery(document).ready(function($) {
    // Get Modal
    // var modal = document.getElementById('myModal');

    // Get pseudoelement to open Modal
    var btn = document.getElementsByClassName("menu-open")[0];

    // Get the <span> element to close Modal
    var span = document.getElementsByClassName("close")[0];

    // When user clicks button, open Modal
    btn.onclick = function() {
        $('.menu-content').addClass('active');

        var h_wd = $(window).height();
        $('.megamenu-mobile .menu-content .modal-body').height(h_wd);
    };

    // When user clicks Close (x), close Modal
    span.onclick = function() {
        $('.menu-content').removeClass('active');
    };
});