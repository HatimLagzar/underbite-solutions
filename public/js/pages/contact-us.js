/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/pages/contact-us.js ***!
  \******************************************/
var form = document.querySelector('#contact-us-form');
if (form instanceof HTMLFormElement) {
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var submitBtn = form.querySelector('button');
    if (submitBtn instanceof HTMLButtonElement) {
      submitBtn.disabled = true;
    }
    var formData = new FormData();
    formData.set('first_name', document.querySelector('#firstNameInput').value);
    formData.set('last_name', document.querySelector('#lastNameInput').value);
    formData.set('email', document.querySelector('#emailAddress').value);
    formData.set('subject', document.querySelector('#subjectInput').value);
    formData.set('message', document.querySelector('#messageInput').value);
    axios.post('/api/contact-us', formData, {
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'Accept': 'application/json'
      }
    }).then(function (response) {
      form.reset();
      submitBtn.disabled = false;
      toastr.success(response.data.message);
    })["catch"](function (error) {
      submitBtn.disabled = false;
      if (error.response) {
        toastr.error(error.response.data.message);
      }
      console.log(error);
    });
  });
}
/******/ })()
;