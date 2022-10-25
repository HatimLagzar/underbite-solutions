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
    public const URL_COLUMN = 'url';
    public const IP_COLUMN = 'ip';
    public const METHOD_COLUMN = 'method';
    public const TIMESTAMP_COLUMN = 'timestamp';

    protected $table = self::TABLE;

    protected $fillable = [
        self::SESSION_ID_COLUMN,
        self::BROWSER_COLUMN,
        self::DEVICE_COLUMN,
        self::URL_COLUMN,
        self::IP_COLUMN,
        self::METHOD_COLUMN,
        self::TIMESTAMP_COLUMN,
    ];

    public $timestamps = false;
}
