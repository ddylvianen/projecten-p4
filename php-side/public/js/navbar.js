const hamburgerMenu = document.getElementById('hamburger-menu');
const navLinksCont = document.querySelector('.nav-links-cont');
const navLinks = document.querySelectorAll('.nav-links');


function toggleMenu() {
  navLinksCont.classList.toggle('open');
  navLinks.forEach(i=> {i.classList.toggle('open');});
}

hamburgerMenu.addEventListener('click', () => {
    toggleMenu();
  });