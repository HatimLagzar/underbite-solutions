/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/pages/home.js ***!
  \************************************/
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
function _iterableToArrayLimit(arr, i) { var _i = arr == null ? null : typeof Symbol !== "undefined" && arr[Symbol.iterator] || arr["@@iterator"]; if (_i == null) return; var _arr = []; var _n = true; var _d = false; var _s, _e; try { for (_i = _i.call(arr); !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
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
    var submitBtn = form.querySelector('button[type=submit]');
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
      $(form).find('.dropdown img').toArray().forEach(function (imgElement) {
        imgElement.src = imgElement.getAttribute('data-src');
      });
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
form.querySelectorAll('input[type=file]').forEach(function (inputElement) {
  inputElement.addEventListener('change', previewUploadedImage);
});
var usePictureButtonElement = document.querySelector('#use-picture');
var retakePictureButtonElement = document.querySelector('#retake-picture');
var takePictureButtonElement = document.querySelector('#take-picture');
var controlsElement = document.getElementById('picture-controls');
var webcamElement = document.getElementById('webcam-live');
var canvasElement = document.getElementById('picture-canvas');
webcamElement.width = 1200;
var webcam = new Webcam["default"](webcamElement, 'user', canvasElement);
var selectedInputId = null;
var picture = null;
document.querySelector('#previewSnapshotModal').addEventListener('hide.bs.modal', function () {
  webcam.stop();
  reTakePicture();
});
form.querySelectorAll('.request-take-picture-btn').forEach(function (buttonElement) {
  buttonElement.addEventListener('click', function () {
    initWebcam(buttonElement);
  });
});
function initWebcam(buttonElement) {
  $('#previewSnapshotModal').modal('show');
  selectedInputId = $(buttonElement).parents('.dropdown:first').attr('data-target');
  var text = $('input#' + selectedInputId).attr('data-text');
  $('button#take-picture').html('<i class="fa fa-camera me-2"></i>Take Picture - ' + text);
  webcam.start().then(function () {
    takePictureButtonElement.removeEventListener('click', preSavePictureFromCamera);
    takePictureButtonElement.addEventListener('click', preSavePictureFromCamera);
  })["catch"](function (err) {
    console.log(err);
  });
}
function preSavePictureFromCamera() {
  webcamElement.classList.remove('mx-w-full');
  picture = webcam.snap();
  webcamElement.classList.add('mx-w-full');
  webcamElement.classList.add('d-none');
  canvasElement.classList.remove('d-none');
  canvasElement.classList.add('mx-w-full');
  controlsElement.classList.remove('d-none');
  controlsElement.classList.add('d-flex');
  takePictureButtonElement.classList.add('d-none');
  usePictureButtonElement.removeEventListener('click', savePicture);
  usePictureButtonElement.addEventListener('click', savePicture);
  retakePictureButtonElement.removeEventListener('click', reTakePicture);
  retakePictureButtonElement.addEventListener('click', reTakePicture);
}
function savePicture() {
  webcam.stop();
  $('#previewSnapshotModal').modal('hide');
  $(".dropdown[data-target=\"".concat(selectedInputId, "\"] img")).attr('src', picture);
  fetch(picture).then(function (res) {
    return res.blob();
  }).then(function (blob) {
    var pictureFile = new File([blob], 'image.png', {
      type: blob.type
    });
    var dataTransfer = new DataTransfer();
    dataTransfer.items.add(pictureFile);
    document.querySelector('input#' + selectedInputId).files = dataTransfer.files;
    reTakePicture();
  });
}
function reTakePicture() {
  webcamElement.classList.remove('d-none');
  canvasElement.classList.add('d-none');
  canvasElement.classList.remove('mx-w-full');
  controlsElement.classList.add('d-none');
  controlsElement.classList.remove('d-flex');
  takePictureButtonElement.classList.remove('d-none');
}
function previewUploadedImage(e) {
  var _e$currentTarget$file = _slicedToArray(e.currentTarget.files, 1),
    file = _e$currentTarget$file[0];
  var label = e.currentTarget.labels[0];
  var labelDropdown = e.currentTarget.labels[1];
  if (file) {
    $(labelDropdown).parents('.dropdown:first').find('img').attr('src', URL.createObjectURL(file));
    label.querySelector('img').src = URL.createObjectURL(file);
  } else {
    $(labelDropdown).parents('.dropdown:first').find('img').attr('src', $(label).parents('.dropdown:first').find('img').attr('data-src'));
    label.querySelector('img').src = label.querySelector('img').getAttribute('data-src');
  }
}
/******/ })()
;