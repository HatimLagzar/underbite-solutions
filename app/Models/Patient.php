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

    protected $table = self::TABLE;

    protected $casts = [
        self::IS_QUALIFIED_COLUMN => 'boolean',
        self::CREATED_AT_COLUMN => 'datetime'
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
        return str_contains($this->getPhoneNumber(), '+') ? $this->getPhoneNumber() : '+' . $this->getPhoneCode() . $this->getPhoneNumber();
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
