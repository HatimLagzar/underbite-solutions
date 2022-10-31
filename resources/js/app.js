require('./bootstrap');

if (!document.location.pathname.startsWith('/admin')) {
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
}

function checkModalTriggerBtn() {
  document.querySelector('#send-mail-btn').disabled = document.querySelectorAll('.select-patient:checked').length === 0;
}

if (document.location.pathname.startsWith('/admin/applications')) {
  checkModalTriggerBtn()

  document.querySelectorAll('.select-patient').forEach(inputElement => {
    inputElement.addEventListener('change', e => {
      checkModalTriggerBtn()

      document.querySelectorAll('.select-patient:checked').forEach(checkedInputElement => {
        document.querySelector('#send-mail-form')
          .insertAdjacentHTML(
            'beforeend',
            `<input type="hidden" name="ids[]" value="${checkedInputElement.value}" />`
          )

        document.querySelector('#qualify-mass, #unqualify-mass')
          .insertAdjacentHTML(
            'beforeend',
            `<input type="hidden" name="ids[]" value="${checkedInputElement.value}" />`
          )
      })
    })
  })
}