require('./bootstrap');

window.addEventListener('scroll', () => {
  const header = document.querySelector('#header');
  const navbarMobile = document.querySelector('#navbar-mobile');
  if (window.scrollY > 50) {
    if (header instanceof HTMLElement) {
      header.style.position = 'fixed';
      header.style.top = 0;
    }

    if (navbarMobile instanceof HTMLElement) {
      navbarMobile.style.position = 'fixed';
      navbarMobile.style.top = 0;
    }
  } else {
    if (header instanceof HTMLElement) {
      header.style.position = 'static';
      header.style.top = 'auto';
    }

    if (navbarMobile instanceof HTMLElement) {
      navbarMobile.style.position = 'static';
      navbarMobile.style.top = 'auto';
    }
  }
})