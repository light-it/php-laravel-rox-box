<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends BaseModel
{

    public const COLUMN_TITLE = 'title';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_TITLE,
    ];

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->getAttribute(self::COLUMN_TITLE);
    }

    /**
     * @param string $value
     * @return Booking
     */
    public function setTitle(string $value): self
    {
        $this->setAttribute(self::COLUMN_TITLE, $value);

        return $this;
    }

}
