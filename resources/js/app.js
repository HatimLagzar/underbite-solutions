require('./bootstrap');

window.addEventListener('scroll', () => {
  const navbar = document.querySelector('#navbar');
  const navbarMobile = document.querySelector('#navbar-mobile');
  if (window.scrollY > 50) {
    if (navbar instanceof HTMLElement) {
      navbar.style.position = 'fixed';
      navbar.style.left = 0;
      navbar.style.top = 0;
      navbar.style.paddingBottom = '0.5rem';
    }

    if (navbarMobile instanceof HTMLElement) {
      navbarMobile.style.position = 'fixed';
      navbarMobile.style.top = 0;
    }
  } else {
    if (navbar instanceof HTMLElement) {
      navbar.style.position = 'static';
      navbar.style.top = 'auto';
      navbar.style.left = 'auto';
      navbar.style.paddingBottom = '0';
    }

    if (navbarMobile instanceof HTMLElement) {
      navbarMobile.style.position = 'static';
      navbarMobile.style.top = 'auto';
    }
  }
})