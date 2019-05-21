<?php

namespace App\Models;

class User extends BaseModel
{

    public const COLUMN_KEY = 'id';
    public const COLUMN_EMAIL = 'email';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_EMAIL,
    ];

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getAttribute(self::COLUMN_EMAIL);
    }

    /**
     * @param string $value
     */
    public function setEmail(string $value): void
    {
        $this->setAttribute(self::COLUMN_EMAIL, $value);
    }

}
