$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) { // Adjust the scroll threshold as needed
            $('.navbar').addClass('navbar-scrolled');
            $('.account-icon').addClass('scrolled');
        } else {
            $('.navbar').removeClass('navbar-scrolled');
            $('.account-icon').removeClass('scrolled');
        }
    });
});
