const navbarToggle = navbar.querySelector('#navbar-toggle');
let isNavbarExpanded = navbarToggle.getAttribute('aria-expanded') === 'true';

const toggleNavbarVisibility = () => {
  isNavbarExpanded = !isNavbarExpanded;
  navbarToggle.setAttribute('aria-expanded', isNavbarExpanded);
};

navbarToggle.addEventListener('click', toggleNavbarVisibility);

function scrollToDiv() {
    document.getElementById("divFirst").scrollIntoView();
}
function closeMenu() {
    // Get the hamburger menu element
    var menu = document.getElementById("hamburger-menu");
  
    // Hide the menu by removing the "active" class
    menu.classList.remove("active");
  }