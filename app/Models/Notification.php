<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public const TABLE = 'notifications';
    public const ID_COLUMN = 'id';
    public const NAME_COLUMN = 'name';
    public const MIN_AGE_COLUMN = 'min_age';
    public const MAX_AGE_COLUMN = 'max_age';
    public const MIN_HEIGHT_COLUMN = 'min_height';
    public const MAX_HEIGHT_COLUMN = 'max_height';
    public const MIN_WEIGHT_COLUMN = 'min_weight';
    public const MAX_WEIGHT_COLUMN = 'max_weight';
    public const GENDER_COLUMN = 'gender';
    public const COUNTRY_CODE_COLUMN = 'country_code';

    protected $table = self::TABLE;

    protected $fillable = [
        self::NAME_COLUMN,
        self::MIN_AGE_COLUMN,
        self::MAX_AGE_COLUMN,
        self::MIN_HEIGHT_COLUMN,
        self::MAX_HEIGHT_COLUMN,
        self::MIN_WEIGHT_COLUMN,
        self::MAX_WEIGHT_COLUMN,
        self::GENDER_COLUMN,
        self::COUNTRY_CODE_COLUMN,
    ];

    public function getId(): int
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getGender(): int
    {
        return $this->getAttribute(self::GENDER_COLUMN);
    }

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getMinAge(): int
    {
        return $this->getAttribute(self::MIN_AGE_COLUMN);
    }

    public function getMaxAge(): int
    {
        return $this->getAttribute(self::MAX_AGE_COLUMN);
    }

    public function getMinHeight(): int
    {
        return $this->getAttribute(self::MIN_HEIGHT_COLUMN);
    }

    public function getMaxHeight(): int
    {
        return $this->getAttribute(self::MAX_HEIGHT_COLUMN);
    }

    public function getMinWeight(): int
    {
        return $this->getAttribute(self::MIN_WEIGHT_COLUMN);
    }

    public function getMaxWeight(): int
    {
        return $this->getAttribute(self::MAX_WEIGHT_COLUMN);
    }

    public function getCountryCode(): string
    {
        return $this->getAttribute(self::COUNTRY_CODE_COLUMN);
    }
}
