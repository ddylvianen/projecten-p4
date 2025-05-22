document.addEventListener('DOMContentLoaded', function() {
    try {
        const modail = document.getElementById('modail-message');
        let modailremove;
        
        if (modail && (modail.getAttribute('data-msg-type') != 'error')) {
            try {
                modailremove = setTimeout(function() {
                    modail.remove();
                }, 5000);
            } catch (timerError) {
                console.error("Fout bij het instellen van timer:", timerError);
            }
        }

        const removebtn = document.getElementById('removebtn');

        if (removebtn) {
            removebtn.addEventListener('click', function() {
                try {
                    modail.remove();
                    if (modailremove) {
                        clearTimeout(modailremove);
                    }
                } catch (removeError) {
                    console.error("Fout bij het verwijderen van modail:", removeError);
                }
            });
        }
    } catch (e) {
        console.error("Algemene fout in modail script:", e);
    }
});