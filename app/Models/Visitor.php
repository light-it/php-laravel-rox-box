<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends BaseModel
{
    use SoftDeletes;

    const COLUMN_NAME = 'name';
    const COLUMN_PHONE = 'phone';
    const COLUMN_EMAIL = 'email';

    protected $table = 'visitor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_NAME,
        self::COLUMN_PHONE,
        self::COLUMN_EMAIL,
    ];

    /**
     * Dates mutator
     *
     * @var array
     */
    protected $dates = [
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(BookingVisitor::class, BookingVisitor::COLUMN_VISITOR_ID);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function weathers()
    {
        return $this->hasMany(Weather::class, Weather::COLUMN_VISITOR_ID);
    }

    /**
     * @return mixed
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * @return mixed
     */
    public function getWeathers()
    {
        return $this->weathers;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getAttribute(self::COLUMN_NAME);
    }

    /**
     * @param string $value
     * @return Visitor
     */
    public function setName(string $value): self
    {
        $this->setAttribute(self::COLUMN_NAME, $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->getAttribute(self::COLUMN_PHONE);
    }

    /**
     * @param string $value
     * @return Visitor
     */
    public function setPhone(string $value): self
    {
        $this->setAttribute(self::COLUMN_PHONE, $value);

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getAttribute(self::COLUMN_EMAIL);
    }

    /**
     * @param string $value
     * @return Visitor
     */
    public function setEmail(string $value): self
    {
        $this->setAttribute(self::COLUMN_EMAIL, $value);

        return $this;
    }

}
