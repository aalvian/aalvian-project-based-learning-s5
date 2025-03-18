document.querySelectorAll('nav a[href^="#"]').forEach(anchor => { // semua a href yang diawali #bla akan kepanggil
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const openpopup = document.getElementById('openpopup');
    const closepopup = document.getElementById('closepopup');
    const popup = document.getElementById('popup');
    const openpopup2 = document.getElementById('openpopup2');
    const closepopup2 = document.getElementById('closepopup2');
    const popup2 = document.getElementById('popup2');

    openpopup.addEventListener('click', function(event) {
        event.preventDefault();
        popup.classList.remove('hidden');
    });

    openpopup2.addEventListener('click', function(event) {
        event.preventDefault();
        popup2.classList.remove('hidden');
    });

    closepopup.addEventListener('click', function() {
        popup.classList.add('hidden');
    });

    closepopup2.addEventListener('click', function() {
        popup2.classList.add('hidden');
    });

    window.addEventListener('click', function(event) {
        if (event.target == popup) {
            popup.classList.add('hidden');
        }
    });
    window.addEventListener('click', function(event) {
        if (event.target == popup2) {
            popup2.classList.add('hidden');
        }
    });
});