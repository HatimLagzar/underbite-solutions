<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestHistory extends Model
{
    use HasFactory;

    public const TABLE = 'requests_history';
    public const ID_COLUMN = 'id';
    public const SESSION_ID_COLUMN = 'session_id';
    public const BROWSER_COLUMN = 'browser';
    public const DEVICE_COLUMN = 'device';
    public const TO_COLUMN = 'to';
    public const FROM_COLUMN = 'from';
    public const IP_COLUMN = 'ip';
    public const METHOD_COLUMN = 'method';
    public const TIMESTAMP_COLUMN = 'timestamp';
    public const COUNTRY_CODE_COLUMN = 'country_code';
    public const CREATED_AT_COLUMN = 'created_at';

    public const TABLET_DEVICE = 'TABLET';
    public const MOBILE_DEVICE = 'MOBILE';
    public const DESKTOP_DEVICE = 'DESKTOP';

    public const GET_METHOD = 'GET';

    protected $table = self::TABLE;

    protected $fillable = [
        self::SESSION_ID_COLUMN,
        self::BROWSER_COLUMN,
        self::DEVICE_COLUMN,
        self::TO_COLUMN,
        self::FROM_COLUMN,
        self::IP_COLUMN,
        self::METHOD_COLUMN,
        self::TIMESTAMP_COLUMN,
        self::COUNTRY_CODE_COLUMN,
    ];

    public $timestamps = false;
}
