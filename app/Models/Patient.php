<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    public const TABLE = 'patients';

    public const ID_COLUMN = 'id';
    public const FIRST_NAME_COLUMN = 'first_name';
    public const LAST_NAME_COLUMN = 'last_name';
    public const EMAIL_COLUMN = 'email';
    public const GENDER_COLUMN = 'gender';
    public const AGE_COLUMN = 'age';
    public const HEIGHT_COLUMN = 'height';
    public const WEIGHT_COLUMN = 'weight';
    public const COUNTRY_CODE_COLUMN = 'country_code';
    public const PHONE_CODE_COLUMN = 'phone_code';
    public const PHONE_NUMBER_COLUMN = 'phone_number';
    public const SOCIAL_NETWORK_NOTE_COLUMN = 'social_network_note';
    public const IS_QUALIFIED_COLUMN = 'is_qualified';
    public const PATIENT_NUMBER_COLUMN = 'patient_number';
    public const CREATED_AT_COLUMN = 'created_at';

    public const MALE_GENDER = 1;
    public const FEMALE_GENDER = 2;

    public const AVAILABLE_HEIGHTS = [
        "120-130" => [120, 130],
        "130-140" => [130, 140],
        "140-150" => [140, 150],
        "150-160" => [150, 160],
        "160-170" => [160, 170],
        "170-180" => [170, 180],
        "180-190" => [180, 190],
        "190-200" => [190, 200],
        "200-210" => [200, 210],
        "210-220" => [210, 220],
    ];

    public const AVAILABLE_AGES = [
        "16-20" => [16, 20],
        "20-25" => [20, 25],
        "25-30" => [25, 30],
        "30-35" => [30, 35],
        "35-40" => [35, 40],
        "40-45" => [40, 45],
        "45-50" => [45, 50],
        "50-55" => [50, 55],
        "55-60" => [55, 60],
        "60-65" => [60, 65],
    ];

    public const AVAILABLE_WEIGHTS = [
        "30-40"   => [30, 40],
        "40-50"   => [40, 50],
        "50-60"   => [50, 60],
        "60-70"   => [60, 70],
        "70-80"   => [70, 80],
        "80-90"   => [80, 90],
        "90-100"  => [90, 100],
        "100-110" => [100, 110],
        "110-120" => [110, 120],
        "120-130" => [120, 130],
    ];

    protected $table = self::TABLE;

    protected $casts = [
        self::IS_QUALIFIED_COLUMN => 'boolean',
        self::CREATED_AT_COLUMN   => 'datetime'
    ];

    protected $fillable = [
        self::FIRST_NAME_COLUMN,
        self::LAST_NAME_COLUMN,
        self::GENDER_COLUMN,
        self::EMAIL_COLUMN,
        self::AGE_COLUMN,
        self::HEIGHT_COLUMN,
        self::WEIGHT_COLUMN,
        self::COUNTRY_CODE_COLUMN,
        self::PHONE_CODE_COLUMN,
        self::PHONE_NUMBER_COLUMN,
        self::SOCIAL_NETWORK_NOTE_COLUMN,
        self::PATIENT_NUMBER_COLUMN,
    ];

    /**
     * @var Collection|PatientImage[]|null
     */
    private ?Collection $images = null;

    private ?PatientImage $setRightSideImage = null;
    private ?Country $country = null;

    public function getId(): int
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getEmail(): string
    {
        return $this->getAttribute(self::EMAIL_COLUMN);
    }

    public function getPhoneNumber(): string
    {
        return $this->getAttribute(self::PHONE_NUMBER_COLUMN);
    }

    public function getFullPhoneNumberFormat(): string
    {
        return str_contains($this->getPhoneNumber(),
            '+') ? $this->getPhoneNumber() : '+' . $this->getPhoneCode() . $this->getPhoneNumber();
    }

    public function getPatientNumber(): string
    {
        return $this->getAttribute(self::PATIENT_NUMBER_COLUMN);
    }

    public function getAge(): int
    {
        return $this->getAttribute(self::AGE_COLUMN);
    }

    public function getHeight(): int
    {
        return $this->getAttribute(self::HEIGHT_COLUMN);
    }

    public function getWeight(): int
    {
        return $this->getAttribute(self::WEIGHT_COLUMN);
    }

    public function getGender(): int
    {
        return $this->getAttribute(self::GENDER_COLUMN);
    }

    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute(self::CREATED_AT_COLUMN);
    }

    public function getFirstName(): string
    {
        return $this->getAttribute(self::FIRST_NAME_COLUMN);
    }

    public function getLastName(): string
    {
        return $this->getAttribute(self::LAST_NAME_COLUMN);
    }

    public function isQualified(): ?bool
    {
        return $this->getAttribute(self::IS_QUALIFIED_COLUMN);
    }

    public function getFullName(): string
    {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }

    /**
     * @return PatientImage[]|Collection|null
     */
    public function getImages(): ?Collection
    {
        return $this->images;
    }

    /**
     * @param Collection|PatientImage[] $images
     */
    public function setImages(Collection $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getRightSideImage(): ?PatientImage
    {
        return $this->setRightSideImage;
    }

    public function setRightSideImage($rightSideImage): self
    {
        $this->rightSideImage = $rightSideImage;

        return $this;
    }

    public function getCountryCode(): string
    {
        return $this->getAttribute(self::COUNTRY_CODE_COLUMN);
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): Patient
    {
        $this->country = $country;

        return $this;
    }

    public function images(): HasMany
    {
        return $this->hasMany(PatientImage::class, PatientImage::PATIENT_ID_COLUMN, self::ID_COLUMN);
    }

    public function getPhoneCode(): string
    {
        return $this->getAttribute(self::PHONE_CODE_COLUMN);
    }
}
