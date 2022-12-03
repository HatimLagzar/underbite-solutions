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

  initMultipleSelectBoxes()
}

function initMultipleSelectBoxes() {
  document.querySelectorAll("select[multiple]").forEach((elem) => {
    elem.insertAdjacentHTML('afterend', `
  <div class="dropdown">
    <button type="button" class="form-select form-select-sm w-auto">Open</button>
    <ul class="hide list-group"></ul>
  </div>
  `)
    let options = [];
    elem.querySelectorAll("option").forEach((option) => {
      options[option.value] = option.innerText;
      elem.nextElementSibling
        .querySelector("ul")
        .insertAdjacentHTML(
          "beforeend",
          `<li class="list-group-item list-group-item-action" data-value="${option.value}">${option.innerText}</li>`
        );
    });

    elem.nextElementSibling.querySelectorAll("ul li").forEach((liElem) => {
      liElem.addEventListener("click", (e) => {
        const value = e.currentTarget.getAttribute("data-value");

        if (elem.querySelector('option[value="' + value + '"]').selected) {
          e.currentTarget.classList.remove("active");
        } else {
          e.currentTarget.classList.add("active");
        }

        elem.querySelector(
          'option[value="' + value + '"]'
        ).selected = !elem.querySelector('option[value="' + value + '"]')
          .selected;
      });
    });
  });

  document.querySelectorAll(".dropdown button").forEach((button) => {
    button.addEventListener("click", (e) => {
      if (
        e.currentTarget.getAttribute("data-open") === "false" ||
        !e.currentTarget.getAttribute("data-open")
      ) {
        showMenu(e.currentTarget);

        return;
      }

      hideMenu(e.currentTarget);
    });
  });

  window.addEventListener("click", (e) => {
    if (!e.target.closest(".dropdown")) {
      const openMenusButtons = document.querySelectorAll(
        '.dropdown button[data-open="true"]'
      );

      openMenusButtons.forEach((buttonElement) => {
        hideMenu(buttonElement);
      });
    }
  });

  function hideMenu(buttonElement) {
    buttonElement.setAttribute("data-open", "false");
    buttonElement.nextElementSibling.classList.remove("show");
    buttonElement.nextElementSibling.classList.add("hide");
  }

  function showMenu(buttonElement) {
    buttonElement.nextElementSibling.classList.add("show");
    buttonElement.nextElementSibling.classList.remove("hide");
    buttonElement.setAttribute("data-open", "true");
  }
}