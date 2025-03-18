$(document).ready(function () {
    // Smooth scrolling for navigation links
    $('a.nav-link').on('click', function (event) {
        if (this.hash !== "") {
            event.preventDefault();

            var hash = this.hash;

            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 100, 'swing', function () {
                window.location.hash = hash;
            });
        }
    });
});

