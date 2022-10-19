require('./bootstrap');

window.addEventListener('scroll', () => {
  const navbar = document.querySelector('#navbar');
  const navbarMobile = document.querySelector('#navbar-mobile');
  const languageSelectorNavbar = document.querySelector('.languages-selector-wrapper-navbar');

  if (window.scrollY > 50) {
    if (navbar instanceof HTMLElement) {
      navbar.style.position = 'fixed';
      navbar.style.left = 0;
      navbar.style.top = 0;
      // navbar.style.paddingBottom = '0.5rem';
    }

    if (languageSelectorNavbar instanceof HTMLElement) {
      languageSelectorNavbar.style.display = 'block';
    }

    if (navbarMobile instanceof HTMLElement) {
      navbarMobile.style.position = 'fixed';
      navbarMobile.style.top = 0;
    }
  } else {
    if (languageSelectorNavbar instanceof HTMLElement) {
      languageSelectorNavbar.style.display = 'none';
    }

    if (navbar instanceof HTMLElement) {
      navbar.style.position = 'relative';
      navbar.style.top = 'auto';
      navbar.style.left = 'auto';
      // navbar.style.paddingBottom = '0';
    }

    if (navbarMobile instanceof HTMLElement) {
      navbarMobile.style.position = 'relative';
      navbarMobile.style.top = 'auto';
    }
  }
})