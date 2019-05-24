<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Weather extends BaseModel
{
    use SoftDeletes;

    const COLUMN_BOOKING_ID = 'booking_id';
    const COLUMN_VISITOR_ID = 'visitor_id';
    const COLUMN_WEATHER = 'weather';

    protected $table = 'weather';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_BOOKING_ID,
        self::COLUMN_VISITOR_ID,
        self::COLUMN_WEATHER,
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class, self::COLUMN_BOOKING_ID);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function visitor()
    {
        return $this->belongsTo(Visitor::class, self::COLUMN_VISITOR_ID);
    }

    /**
     * @return int
     */
    public function getBookingId(): int
    {
        return $this->getAttribute(self::COLUMN_BOOKING_ID);
    }

    /**
     * @param int $value
     * @return Weather
     */
    public function setBookingId(int $value): self
    {
        $this->setAttribute(self::COLUMN_BOOKING_ID, $value);

        return $this;
    }

    /**
     * @return Booking
     */
    public function getBooking(): Booking
    {
        return $this->booking()->firstOfFail();
    }

    /**
     * @param Booking $model
     * @return Weather
     */
    public function setBooking(Booking $model): self
    {
        $this->booking()->associate($model);

        return $this;
    }

    /**
     * @return int
     */
    public function getVisitorId(): int
    {
        return $this->getAttribute(self::COLUMN_VISITOR_ID);
    }

    /**
     * @param int $value
     * @return Weather
     */
    public function setVisitorId(int $value): self
    {
        $this->setAttribute(self::COLUMN_VISITOR_ID, $value);

        return $this;
    }

    /**
     * @return Visitor
     */
    public function getVisitor(): Visitor
    {
        return $this->visitor()->firstOfFail();
    }

    /**
     * @param Visitor $model
     * @return Weather
     */
    public function setVisitor(Visitor $model): self
    {
        $this->visitor()->associate($model);

        return $this;
    }

    /**
     * @return string
     */
    public function getWeather(): string
    {
        return $this->getAttribute(self::COLUMN_WEATHER);
    }

    /**
     * @param string $value
     * @return Weather
     */
    public function setWeather(string $value): self
    {
        $this->setAttribute(self::COLUMN_WEATHER, $value);

        return $this;
    }

}
