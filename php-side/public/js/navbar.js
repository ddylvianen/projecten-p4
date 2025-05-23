try {
    const hamburgerMenu = document.getElementById('hamburger-menu');
    const navLinksCont = document.querySelector('.nav-links-cont');
    const navLinks = document.querySelectorAll('.nav-links');

    function toggleMenu() {
        try {
            navLinksCont.classList.toggle('open');
            navLinks.forEach(i => { i.classList.toggle('open'); });
        } catch (error) {
            console.error("Fout bij het omschakelen van menu:", error);
        }
    }

    if (hamburgerMenu) {
        hamburgerMenu.addEventListener('click', () => {
            toggleMenu();
        });
    } else {
        console.warn("Hamburger menu element niet gevonden.");
    }
} catch (e) {
    console.error("Algemene fout in navbar script:", e);
}