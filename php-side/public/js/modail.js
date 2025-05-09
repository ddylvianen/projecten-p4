document.addEventListener('DOMContentLoaded', function() {
    const modail = document.getElementById('modail-message');
    if ((modail) && (modail.getAttribute('data-msg-type') != 'error')) {
        const modailremove = setTimeout(function() {
            modail.remove();
        }, 5000);
    }

    const removebtn = document.getElementById('removebtn');

    if (removebtn) {
        removebtn.addEventListener('click', function() {
            modail.remove();
            clearTimeout(modailremove);
        });
    }

});