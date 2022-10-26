<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public const TABLE = 'countries';
    public const CODE_COLUMN = 'code';
    public const NAME_COLUMN = 'name';
    public const CONTINENT_CODE_COLUMN = 'continent_code';
    public const ISO3_COLUMN = 'iso3';

    protected $table = self::TABLE;

    public function getCode(): string
    {
        return $this->getAttribute(self::CODE_COLUMN);
    }

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getIso3(): string
    {
        return $this->getAttribute(self::ISO3_COLUMN);
    }
}
