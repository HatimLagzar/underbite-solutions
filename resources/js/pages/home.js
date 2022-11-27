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

const webcamElement = document.getElementById('webcam-live');
const canvasElement = document.getElementById('picture-canvas');

if (window.innerWidth <= 425) {
  webcamElement.width = 375;
} else if (window.innerWidth <= 800) {
  webcamElement.width = 500;
} else {
  webcamElement.width = 600;
}


const webcam = new Webcam.default(webcamElement, 'user', canvasElement);
let selectedInputId = null;

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
      document.querySelector('#take-picture').removeEventListener('click', savePictureFromCamera)
      document.querySelector('#take-picture').addEventListener('click', savePictureFromCamera)
    })
    .catch(err => {
      console.log(err);
    });
}

function savePictureFromCamera() {
  let picture = webcam.snap();
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
    })
}

function previewUploadedImage(e) {
  const [file] = e.currentTarget.files;
  const label = e.currentTarget.labels[0];
  if (file) {
    $(label).parents('.dropdown:first').find('img').attr('src', URL.createObjectURL(file));
  } else {
    $(label).parents('.dropdown:first').find('img').attr('src', $(label).parents('.dropdown:first').find('img').attr('data-src'));
  }
}