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
    public const AGE_COLUMN = 'age';
    public const GENDER_COLUMN = 'gender';
    public const HEIGHT_COLUMN = 'height';
    public const WEIGHT_COLUMN = 'weight';
    public const COUNTRY_CODE_COLUMN = 'country_code';

    protected $table = self::TABLE;
}
