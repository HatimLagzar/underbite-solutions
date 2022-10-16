/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/pages/home.js ***!
  \************************************/
var input = document.querySelector("#phoneInput");
window.phoneNumberInput = intlTelInput(input, {});
var form = document.querySelector('#form-wrapper form');
if (form instanceof HTMLFormElement) {
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var formData = new FormData();
    formData.set('first_name', document.querySelector('#firstNameInput').value);
    formData.set('last_name', document.querySelector('#lastNameInput').value);
    formData.set('email', document.querySelector('#emailInput').value);
    formData.set('age', document.querySelector('#ageInput').value);
    formData.set('height', document.querySelector('#heightInput').value);
    formData.set('weight', document.querySelector('#weightInput').value);
    formData.set('gender', document.querySelector('input[name="gender"]:checked').value);
    formData.set('social_network_note', document.querySelector('#socialNetworkInput').value);
    formData.set('country_id', document.querySelector('#countryInput').value);
    formData.set('phone_number', document.querySelector('#phoneInput').value);
    formData.set('phone_code', phoneNumberInput.selectedCountryData.dialCode);
    formData.set('front_view', document.querySelector('#frontSideInput').files[0]);
    formData.set('left_view', document.querySelector('#leftSideInput').files[0]);
    formData.set('right_view', document.querySelector('#rightSideInput').files[0]);
    axios.post('/api/apply', formData, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'Accept': 'application/json'
      }
    }).then(function (response) {
      debugger;
      toastr.success(response.data.message);
      form.reset();
    })["catch"](function (error) {
      if (error.response && error.response.status === 422) {
        toastr.error(error.response.data.message);
      } else if (error.response) {
        toastr.error(error.response.data.message);
      }
      console.log(error);
    });
  });
}
/******/ })()
;