<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Post extends Model
{
    use HasFactory;

    public const TABLE = 'posts';
    public const ID_COLUMN = 'id';
    public const TITLE_COLUMN = 'title';
    public const DESCRIPTION_COLUMN = 'description';
    public const THUMBNAIL_FILE_NAME_COLUMN = 'thumbnail_file_name';
    public const LANG_COLUMN = 'lang';
    public const AUTHOR_NAME_COLUMN = 'author_name';
    public const CREATED_AT_COLUMN = 'created_at';

    protected $table = self::TABLE;
    protected $fillable = [
        self::TITLE_COLUMN,
        self::DESCRIPTION_COLUMN,
        self::LANG_COLUMN,
        self::AUTHOR_NAME_COLUMN,
        self::THUMBNAIL_FILE_NAME_COLUMN,
    ];

    protected $casts = [
        self::CREATED_AT_COLUMN => 'datetime'
    ];

    public function getId(): int
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getThumbnailFileName(): string
    {
        return $this->getAttribute(self::THUMBNAIL_FILE_NAME_COLUMN);
    }

    public function getTitle(): string
    {
        return $this->getAttribute(self::TITLE_COLUMN);
    }

    public function getLang(): string
    {
        return $this->getAttribute(self::LANG_COLUMN);
    }

    public function getAuthorName(): string
    {
        return $this->getAttribute(self::AUTHOR_NAME_COLUMN);
    }

    public function getDescription(): string
    {
        return $this->getAttribute(self::DESCRIPTION_COLUMN);
    }

    public function getCreatedAt(): Carbon
    {
        return $this->getAttribute(self::CREATED_AT_COLUMN);
    }
}
