<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientImage extends Model
{
    use HasFactory;

    public const TABLE = 'patients_images';

    public const ID_COLUMN = 'id';
    public const PATIENT_ID_COLUMN = 'patient_id';
    public const FILE_NAME_COLUMN = 'file_name';
    public const POSITION_COLUMN = 'position';

    public const FRONT_VIEW = 'FRONT';
    public const LEFT_VIEW = 'LEFT';
    public const RIGHT_VIEW = 'RIGHT';

    protected $table = self::TABLE;

    protected $fillable = [
        self::PATIENT_ID_COLUMN,
        self::FILE_NAME_COLUMN,
        self::POSITION_COLUMN,
    ];
}