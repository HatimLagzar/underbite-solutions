<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public const TABLE = 'countries';
    public const ID_COLUMN = 'id';
    public const NICE_NAME_COLUMN = 'nicename';

    protected $table = self::TABLE;

    public function getId(): int
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getNiceName(): string
    {
        return $this->getAttribute(self::NICE_NAME_COLUMN);
    }
}
