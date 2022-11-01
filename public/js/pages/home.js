/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/pages/home.js ***!
  \************************************/
var input = document.querySelector("#phoneInput");
window.phoneNumberInput = intlTelInput(input, {
  separateDialCode: true
});
var form = document.querySelector('#form-wrapper form');
var inputs = form.querySelectorAll("input, select, textarea");
if (form instanceof HTMLFormElement) {
  var handleInvalidInput = function handleInvalidInput() {
    input.classList.add("error");
  };
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var submitBtn = form.querySelector('button');
    if (submitBtn instanceof HTMLButtonElement) {
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
    }
    var formData = new FormData();
    formData.set('first_name', document.querySelector('#firstNameInput').value);
    formData.set('last_name', document.querySelector('#lastNameInput').value);
    formData.set('email', document.querySelector('#emailInput').value);
    formData.set('age', document.querySelector('#ageInput').value);
    formData.set('height', document.querySelector('#heightInput').value);
    formData.set('weight', document.querySelector('#weightInput').value);
    formData.set('gender', document.querySelector('#genderInput').value);
    formData.set('social_network_note', document.querySelector('#socialNetworkInput').value);
    formData.set('country_id', document.querySelector('#countryInput').value);
    formData.set('phone_number', document.querySelector('#phoneInput').value);
    formData.set('phone_code', phoneNumberInput.selectedCountryData.dialCode);
    formData.set('front_side', document.querySelector('#frontSideInput').files[0]);
    formData.set('front_closed', document.querySelector('#frontClosedInput').files[0]);
    formData.set('right_side', document.querySelector('#rightSideInput').files[0]);
    formData.set('right_closed', document.querySelector('#rightClosedSideInput').files[0]);
    axios.post('/api/apply', formData, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'Accept': 'application/json'
      }
    }).then(function (response) {
      submitBtn.innerHTML = 'Apply';
      submitBtn.disabled = false;
      document.querySelector('#error-feedback').innerText = '';
      document.querySelector('#success-feedback').innerText = response.data.message;
      form.reset();
      inputs.forEach(function (input) {
        input.removeEventListener("invalid", handleInvalidInput, false);
      });
    })["catch"](function (error) {
      submitBtn.innerHTML = 'Apply';
      submitBtn.disabled = false;
      if (error.response && error.response.status === 422) {
        document.querySelector('#error-feedback').innerText = error.response.data.errors ? Object.values(error.response.data.errors).join('\n') : error.response.data.message;
      } else if (error.response) {
        toastr.error(error.response.data.message);
      }
      console.log(error);
    });
  });
  inputs.forEach(function (input) {
    input.addEventListener("invalid", handleInvalidInput, false);
  });
}
/******/ })()
;