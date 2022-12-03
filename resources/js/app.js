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
  const sendMailBtn = document.querySelector('#send-mail-btn');
  if (sendMailBtn instanceof HTMLElement) {
    sendMailBtn.disabled = document.querySelectorAll('.select-patient:checked').length === 0;
  }
}

function hanldeCheckInput() {
  checkModalTriggerBtn()

  document.querySelectorAll('#send-mail-form input[name="ids[]"]').forEach(item => item.remove());
  document.querySelectorAll('#qualify-mass input[name="ids[]"]').forEach(item => item.remove());
  document.querySelectorAll('#unqualify-mass input[name="ids[]"]').forEach(item => item.remove());

  document.querySelectorAll('.select-patient:checked').forEach(checkedInputElement => {
    document.querySelector('#send-mail-form')
      .insertAdjacentHTML(
        'beforeend',
        `<input type="hidden" name="ids[]" value="${checkedInputElement.value}" />`
      )

    document.querySelector('#qualify-mass')
      .insertAdjacentHTML(
        'beforeend',
        `<input type="hidden" name="ids[]" value="${checkedInputElement.value}" />`
      )

    document.querySelector('#unqualify-mass')
      .insertAdjacentHTML(
        'beforeend',
        `<input type="hidden" name="ids[]" value="${checkedInputElement.value}" />`
      )
  })
}

let areAllSelected = false;

if (document.location.pathname.startsWith('/admin/applications')) {
  checkModalTriggerBtn()

  document.querySelectorAll('.select-patient').forEach(inputElement => {
    inputElement.addEventListener('change', hanldeCheckInput)
  })

  const selectAllBtn = document.querySelector('#select-all')
  if (selectAllBtn instanceof HTMLElement) {
    selectAllBtn.addEventListener('click', e => {
      document.querySelectorAll('.select-patient').forEach(inputElement => {
        inputElement.checked = !areAllSelected;
        hanldeCheckInput();
      })

      areAllSelected = !areAllSelected;
    })
  }

  document.querySelectorAll('select[multiple]').forEach(elem => {
    elem.size = 3
  })

  $('.selectpicker').select2({
    placeholder: 'Select an option',
    closeOnSelect: false
  });
}