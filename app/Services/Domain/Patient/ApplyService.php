<?php

namespace App\Services\Domain\Patient;

use App\Models\Patient;
use App\Models\PatientImage;
use App\Services\Core\Patient\PatientService;
use App\Services\Core\PatientImage\PatientImageService;
use App\Services\Domain\Patient\Exceptions\InvalidEmailException;
use App\Services\Domain\Patient\Exceptions\PatientAlreadyExistsException;
use Illuminate\Http\UploadedFile;

class ApplyService
{
    private PatientService $patientService;
    private PatientImageService $patientImageService;

    public function __construct(
        PatientService $patientService,
        PatientImageService $patientImageService
    ) {
        $this->patientService = $patientService;
        $this->patientImageService = $patientImageService;
    }

    /**
     * @throws PatientAlreadyExistsException
     */
    public function apply(
        string $firstName,
        string $lastName,
        string $email,
        int $gender,
        int $age,
        int $height,
        int $weight,
        string $phoneNumber,
        int $phoneCode,
        ?string $socialNetworkNote,
        string $countryId,
        UploadedFile $frontView,
        UploadedFile $leftView,
        UploadedFile $rightView
    ): Patient {
        $existingPatient = $this->patientService->findByEmail($email);
        if ($existingPatient instanceof Patient) {
            throw new PatientAlreadyExistsException();
        }

        $patient = $this->patientService->create([
            Patient::FIRST_NAME_COLUMN          => $firstName,
            Patient::LAST_NAME_COLUMN           => $lastName,
            Patient::GENDER_COLUMN              => $gender,
            Patient::EMAIL_COLUMN               => $email,
            Patient::AGE_COLUMN                 => $age,
            Patient::HEIGHT_COLUMN              => $height,
            Patient::WEIGHT_COLUMN              => $weight,
            Patient::COUNTRY_ID_COLUMN          => $countryId,
            Patient::PHONE_CODE_COLUMN          => $phoneCode,
            Patient::PHONE_NUMBER_COLUMN        => $phoneNumber,
            Patient::SOCIAL_NETWORK_NOTE_COLUMN => $socialNetworkNote,
        ]);

        $frontViewFileName = $frontView->hashName();
        $frontView->storeAs('public/patients_images/', $frontViewFileName);

        $leftViewFileName = $leftView->hashName();
        $leftView->storeAs('public/patients_images/', $leftViewFileName);

        $rightViewFileName = $rightView->hashName();
        $rightView->storeAs('public/patients_images/', $rightViewFileName);

        $this->patientImageService->create([
            PatientImage::PATIENT_ID_COLUMN => $patient->getId(),
            PatientImage::FILE_NAME_COLUMN  => $frontViewFileName,
            PatientImage::POSITION_COLUMN   => PatientImage::FRONT_VIEW,
        ]);

        $this->patientImageService->create([
            PatientImage::PATIENT_ID_COLUMN => $patient->getId(),
            PatientImage::FILE_NAME_COLUMN  => $leftViewFileName,
            PatientImage::POSITION_COLUMN   => PatientImage::LEFT_VIEW,
        ]);

        $this->patientImageService->create([
            PatientImage::PATIENT_ID_COLUMN => $patient->getId(),
            PatientImage::FILE_NAME_COLUMN  => $rightViewFileName,
            PatientImage::POSITION_COLUMN   => PatientImage::RIGHT_VIEW,
        ]);

        return $patient;
    }
}