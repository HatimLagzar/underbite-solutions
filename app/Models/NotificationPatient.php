<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationPatient extends Model
{
    use HasFactory;

    public const TABLE = 'notifications_patients';
    public const ID_COLUMN = 'id';
    public const PATIENT_ID_COLUMN = 'patient_id';
    public const NOTIFICATION_ID_COLUMN = 'notification_id';

    protected $table = self::TABLE;

    protected $fillable = [
        self::PATIENT_ID_COLUMN,
        self::NOTIFICATION_ID_COLUMN,
    ];
}
