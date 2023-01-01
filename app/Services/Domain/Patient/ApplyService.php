<?php

namespace App\Services\Domain\Patient;

use App\Mail\NotificationPatientMail;
use App\Models\NotificationPatient;
use App\Models\Patient;
use App\Models\PatientImage;
use App\Services\Core\Country\CountryService;
use App\Services\Core\Notification\NotificationService;
use App\Services\Core\NotificationPatient\NotificationPatientService;
use App\Services\Core\Patient\PatientService;
use App\Services\Core\PatientImage\PatientImageService;
use App\Services\Domain\Patient\Exceptions\PatientAlreadyExistsException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ApplyService
{
    private PatientService $patientService;
    private PatientImageService $patientImageService;
    private NotificationService $notificationService;
    private NotificationPatientService $notificationPatientService;
    private CountryService $countryService;

    public function __construct(
        PatientService $patientService,
        PatientImageService $patientImageService,
        NotificationService $notificationService,
        NotificationPatientService $notificationPatientService,
        CountryService $countryService
    ) {
        $this->patientService = $patientService;
        $this->patientImageService = $patientImageService;
        $this->notificationService = $notificationService;
        $this->notificationPatientService = $notificationPatientService;
        $this->countryService = $countryService;
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
        string $hearingAboutUsSource,
        string $countryId,
        UploadedFile $frontView,
        UploadedFile $rightView,
        UploadedFile $rightClosedView,
        UploadedFile $frontClosedView
    ): Patient {
        $existingPatient = $this->patientService->findByEmail($email);
        if ($existingPatient instanceof Patient) {
            throw new PatientAlreadyExistsException();
        }

        $patient = $this->patientService->create([
            Patient::FIRST_NAME_COLUMN              => $firstName,
            Patient::LAST_NAME_COLUMN               => $lastName,
            Patient::GENDER_COLUMN                  => $gender,
            Patient::EMAIL_COLUMN                   => $email,
            Patient::AGE_COLUMN                     => $age,
            Patient::HEIGHT_COLUMN                  => $height,
            Patient::WEIGHT_COLUMN                  => $weight,
            Patient::COUNTRY_CODE_COLUMN            => $countryId,
            Patient::PHONE_CODE_COLUMN              => $phoneCode,
            Patient::PHONE_NUMBER_COLUMN            => $phoneNumber,
            Patient::HEARING_ABOUT_US_SOURCE_COLUMN => $hearingAboutUsSource,
            Patient::PATIENT_NUMBER_COLUMN          => rand(10000000, 99999999),
        ]);

        $frontViewFileName = $frontView->hashName();
        $frontView->storeAs('public/patients_images/', $frontViewFileName);

        $rightViewFileName = $rightView->hashName();
        $rightView->storeAs('public/patients_images/', $rightViewFileName);

        $rightClosedViewFileName = $rightClosedView->hashName();
        $rightClosedView->storeAs('public/patients_images/', $rightClosedViewFileName);

        $frontClosedViewFileName = $frontClosedView->hashName();
        $frontClosedView->storeAs('public/patients_images/', $frontClosedViewFileName);

        $this->patientImageService->create([
            PatientImage::PATIENT_ID_COLUMN => $patient->getId(),
            PatientImage::FILE_NAME_COLUMN  => $frontViewFileName,
            PatientImage::POSITION_COLUMN   => PatientImage::FRONT_VIEW,
        ]);

        $this->patientImageService->create([
            PatientImage::PATIENT_ID_COLUMN => $patient->getId(),
            PatientImage::FILE_NAME_COLUMN  => $rightViewFileName,
            PatientImage::POSITION_COLUMN   => PatientImage::RIGHT_VIEW,
        ]);

        $this->patientImageService->create([
            PatientImage::PATIENT_ID_COLUMN => $patient->getId(),
            PatientImage::FILE_NAME_COLUMN  => $rightClosedViewFileName,
            PatientImage::POSITION_COLUMN   => PatientImage::RIGHT_CLOSED_VIEW,
        ]);

        $this->patientImageService->create([
            PatientImage::PATIENT_ID_COLUMN => $patient->getId(),
            PatientImage::FILE_NAME_COLUMN  => $frontClosedViewFileName,
            PatientImage::POSITION_COLUMN   => PatientImage::FRONT_CLOSED_VIEW,
        ]);

        $this->checkNotifications($patient);

        return $patient;
    }

    private function checkNotifications(Patient $patient): void
    {
        $notifications = $this->notificationService->getAll();
        foreach ($notifications as $notification) {
            if ($notification->getMinAge() !== null) {
                if ($notification->getMinAge() > $patient->getAge()) {
                    continue;
                }
            }

            if ($notification->getMaxAge() !== null) {
                if ($notification->getMaxAge() < $patient->getAge()) {
                    continue;
                }
            }

            if ($notification->getMinHeight() !== null) {
                if ($notification->getMinHeight() > $patient->getHeight()) {
                    continue;
                }
            }

            if ($notification->getMaxHeight() !== null) {
                if ($notification->getMaxHeight() < $patient->getHeight()) {
                    continue;
                }
            }

            if ($notification->getMinWeight() !== null) {
                if ($notification->getMinWeight() > $patient->getWeight()) {
                    continue;
                }
            }

            if ($notification->getMaxWeight() !== null) {
                if ($notification->getMaxWeight() < $patient->getWeight()) {
                    continue;
                }
            }

            if ($notification->getGender() !== null) {
                if ($notification->getGender() !== $patient->getGender()) {
                    continue;
                }
            }

            if (count($notification->getCountryCodeArr()) > 0) {
                if (in_array($patient->getCountryCode(), $notification->getCountryCodeArr()) === false) {
                    continue;
                }
            }

            if ($notification->getContinentCode() !== null) {
                $country = $this->countryService->findByCountryCode($patient->getCountryCode());
                if ($notification->getContinentCode() !== $country->getContinentCode()) {
                    continue;
                }
            }

            $this->notificationPatientService->create([
                NotificationPatient::NOTIFICATION_ID_COLUMN => $notification->getId(),
                NotificationPatient::PATIENT_ID_COLUMN      => $patient->getId(),
            ]);

            $patient->setImages($this->patientImageService->getAllByPatient($patient));

            Mail::to(env('MAIL_FROM_ADDRESS'))
                ->queue(new NotificationPatientMail($notification, $patient));
        }
    }
}