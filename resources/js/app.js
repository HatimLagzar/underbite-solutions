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

    const qualifyMass = document.querySelector('#qualify-mass')
    if (qualifyMass) {
      document.querySelector('#qualify-mass')
        .insertAdjacentHTML(
          'beforeend',
          `<input type="hidden" name="ids[]" value="${checkedInputElement.value}" />`
        )
    }

    const unqualifyMass = document.querySelector('#unqualify-mass')
    if (unqualifyMass) {
      document.querySelector('#unqualify-mass')
        .insertAdjacentHTML(
          'beforeend',
          `<input type="hidden" name="ids[]" value="${checkedInputElement.value}" />`
        )
    }
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
      console.log(document.querySelectorAll('.select-patient'))
      document.querySelectorAll('.select-patient')
        .forEach(inputElement => {
          inputElement.checked = !areAllSelected;
          hanldeCheckInput();
        })

      areAllSelected = !areAllSelected;
    })
  }

  initMultipleSelectBoxes()
}

function initMultipleSelectBoxes() {
  document.querySelectorAll("select[multiple]").forEach((selectElement) => {
    buildDropDown(selectElement);

    buildChoices(selectElement);

    eventsBindingOnSearch(selectElement)

    eventsBindingSelectChoice(selectElement);
  });

  eventBindingOpenMenu();

  eventsBindingEscapeChoicesMenu();
}

function buildDropDown(selectElement) {
  selectElement.insertAdjacentHTML(
    "afterend",
    `<div class="dropdown">
      <button type="button" class="form-select form-select-sm w-auto">Open</button>
      <ul class="hide list-group">
        <li class="list-group-item input">
          <input class="form-control form-control-sm" type="text" placeholder="Search" />
        </li>
      </ul>
    </div>`
  );
}

function buildChoices(selectElement) {
  selectElement.querySelectorAll("option").forEach((option) => {
    selectElement.nextElementSibling
      .querySelector("ul")
      .insertAdjacentHTML(
        "beforeend",
        `<li class="list-group-item list-group-item-action ${option.selected ? 'active' : ''}" data-value="${option.value}">${option.innerText}</li>`
      );
  });
}

function eventsBindingSelectChoice(selectElement) {
  selectElement.nextElementSibling.querySelectorAll("ul li").forEach((liElem) => {
    liElem.addEventListener("click", (e) => {
      const value = e.currentTarget.getAttribute("data-value");

      if (!value) {
        $(selectElement).find('option:selected').toArray().forEach(item => {
          item.selected = false;
        })

        selectElement.nextElementSibling.querySelectorAll('li.active').forEach(item => {
          item.classList.remove('active')
        })
      } else {
        $(selectElement).find('option[value=""]').toArray().forEach(item => {
          item.selected = false;
        })

        selectElement.nextElementSibling.querySelectorAll('li[data-value=""]').forEach(item => {
          item.classList.remove('active')
        })
      }

      if (selectElement.querySelector('option[value="' + value + '"]').selected) {
        e.currentTarget.classList.remove("active");
      } else {
        e.currentTarget.classList.add("active");
      }

      selectElement.querySelector(
        'option[value="' + value + '"]'
      ).selected = !selectElement.querySelector('option[value="' + value + '"]')
        .selected;

      const selectedChoices = $(selectElement).find('option:selected')
      if (selectedChoices.length > 0) {
        selectElement.nextElementSibling
          .querySelector('button.form-select')
          .style
          .borderWidth = '3px';

        selectElement.nextElementSibling
          .querySelector('button.form-select')
          .classList
          .add('border-success')
      } else {
        selectElement.nextElementSibling
          .querySelector('button.form-select')
          .style
          .borderWidth = '1px';

        selectElement.nextElementSibling
          .querySelector('button.form-select')
          .classList
          .remove('border-success')
      }
    });
  });
}

function eventBindingOpenMenu() {
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
}

function eventsBindingOnSearch(selectElement) {
  selectElement.nextElementSibling
    .querySelector("ul input")
    .addEventListener("input", (e) => {
      selectElement.nextElementSibling.querySelectorAll("ul li").forEach((item) => {
        if (!item.className.includes("input")) {
          item.remove();
        }
      });

      selectElement.querySelectorAll("option").forEach((option) => {
        if (!option.innerText.toLowerCase().startsWith(e.target.value.toLowerCase())) {
          return;
        }

        selectElement.nextElementSibling
          .querySelector("ul")
          .insertAdjacentHTML(
            "beforeend",
            `<li class="list-group-item list-group-item-action ${option.selected ? 'active' : ''}" data-value="${option.value}">${option.innerText}</li>`
          );
      });

      eventsBindingSelectChoice(selectElement)
    });
}

function eventsBindingEscapeChoicesMenu() {
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
}

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