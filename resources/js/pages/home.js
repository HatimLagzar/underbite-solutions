const input = document.querySelector("#phoneInput");
window.phoneNumberInput = intlTelInput(input, {
  separateDialCode: true
});

const form = document.querySelector('#form-wrapper form');
const inputs = form.querySelectorAll("input, select, textarea");

if (form instanceof HTMLFormElement) {
  form.addEventListener('submit', function (e) {
    e.preventDefault();

    const submitBtn = form.querySelector('button[type=submit]')
    if (submitBtn instanceof HTMLButtonElement) {
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>'
    }

    const formData = new FormData();
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
        'Accept': 'application/json',
      },
    })
      .then(response => {
        submitBtn.innerHTML = 'Apply'
        $(form).find('.dropdown img')
          .toArray()
          .forEach(imgElement => {
            imgElement.src = imgElement.getAttribute('data-src')
          });

        submitBtn.disabled = false;
        document.querySelector('#error-feedback').innerText = ''
        document.querySelector('#success-feedback').innerText = response.data.message
        form.reset();
        inputs.forEach(input => {
          input.removeEventListener(
            "invalid",
            handleInvalidInput,
            false
          );
        });
      })
      .catch((error) => {
        submitBtn.innerHTML = 'Apply'
        submitBtn.disabled = false;
        if (error.response && error.response.status === 422) {
          document.querySelector('#error-feedback').innerText = error.response.data.errors ? Object.values(error.response.data.errors).join('\n') : error.response.data.message;
        } else if (error.response) {
          toastr.error(error.response.data.message);
        }

        console.log(error)
      })
  })

  inputs.forEach(input => {
    input.addEventListener(
      "invalid",
      handleInvalidInput,
      false
    );
  });

  function handleInvalidInput() {
    input.classList.add("error");
  }
}

form.querySelectorAll('input[type=file]').forEach(inputElement => {
  inputElement.addEventListener('change', previewUploadedImage)
})

const usePictureButtonElement = document.querySelector('#use-picture');
const retakePictureButtonElement = document.querySelector('#retake-picture');
const takePictureButtonElement = document.querySelector('#take-picture');
const controlsElement = document.getElementById('picture-controls');
const webcamElement = document.getElementById('webcam-live');
const canvasElement = document.getElementById('picture-canvas');
webcamElement.width = 1200;

const webcam = new Webcam.default(webcamElement, 'user', canvasElement);
let selectedInputId = null;
let picture = null;

document.querySelector('#previewSnapshotModal').addEventListener('hide.bs.modal', () => {
  webcam.stop();
})

form.querySelectorAll('.request-take-picture-btn').forEach(buttonElement => {
  buttonElement.addEventListener('click', () => {
    initWebcam(buttonElement);
  })
})

function initWebcam(buttonElement) {
  $('#previewSnapshotModal').modal('show');
  selectedInputId = $(buttonElement).parents('.dropdown:first').attr('data-target')

  webcam.start()
    .then(() => {
      takePictureButtonElement.removeEventListener('click', preSavePictureFromCamera)
      takePictureButtonElement.addEventListener('click', preSavePictureFromCamera)
    })
    .catch(err => {
      console.log(err);
    });
}

function preSavePictureFromCamera() {
  webcamElement.classList.remove('mx-w-full')

  picture = webcam.snap();

  webcamElement.classList.add('mx-w-full');
  webcamElement.classList.add('d-none');
  canvasElement.classList.remove('d-none');
  canvasElement.classList.add('mx-w-full');
  controlsElement.classList.remove('d-none');
  controlsElement.classList.add('d-flex');

  takePictureButtonElement.classList.add('d-none');

  usePictureButtonElement.removeEventListener('click', savePicture)
  usePictureButtonElement.addEventListener('click', savePicture)

  retakePictureButtonElement.removeEventListener('click', reTakePicture)
  retakePictureButtonElement.addEventListener('click', reTakePicture)
}

function savePicture() {
  webcam.stop();
  $('#previewSnapshotModal').modal('hide');

  $(`.dropdown[data-target="${selectedInputId}"] img`).attr('src', picture);

  fetch(picture)
    .then(res => res.blob())
    .then(blob => {
      const pictureFile = new File([blob], 'image.png', {
        type: blob.type,
      });

      let dataTransfer = new DataTransfer();
      dataTransfer.items.add(pictureFile)

      document.querySelector('input#' + selectedInputId).files = dataTransfer.files

      reTakePicture()
    })
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
  const [file] = e.currentTarget.files;
  const label = e.currentTarget.labels[0];
  const labelDropdown = e.currentTarget.labels[1];
  if (file) {
    $(labelDropdown).parents('.dropdown:first').find('img').attr('src', URL.createObjectURL(file));
    label.querySelector('img').src = URL.createObjectURL(file);
  } else {
    $(labelDropdown).parents('.dropdown:first').find('img').attr('src', $(label).parents('.dropdown:first').find('img').attr('data-src'));
    label.querySelector('img').src = label.querySelector('img').getAttribute('data-src');
  }
}
