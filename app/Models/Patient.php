<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public const COUNTRY_ID_COLUMN = 'country_id';
    public const PHONE_CODE_COLUMN = 'phone_code';
    public const PHONE_NUMBER_COLUMN = 'phone_number';
    public const SOCIAL_NETWORK_NOTE_COLUMN = 'social_network_note';
    public const IS_QUALIFIED_COLUMN = 'is_qualified';

    public const MALE_GENDER = 1;
    public const FEMALE_GENDER = 2;

    protected $table = self::TABLE;

    protected $casts = [
        self::IS_QUALIFIED_COLUMN => 'boolean'
    ];

    protected $fillable = [
        self::FIRST_NAME_COLUMN,
        self::LAST_NAME_COLUMN,
        self::GENDER_COLUMN,
        self::EMAIL_COLUMN,
        self::AGE_COLUMN,
        self::HEIGHT_COLUMN,
        self::WEIGHT_COLUMN,
        self::COUNTRY_ID_COLUMN,
        self::PHONE_CODE_COLUMN,
        self::PHONE_NUMBER_COLUMN,
        self::SOCIAL_NETWORK_NOTE_COLUMN,
    ];

    public function getId(): int
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getFirstName(): string
    {
        return $this->getAttribute(self::FIRST_NAME_COLUMN);
    }
}
