<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends BaseModel
{
    use SoftDeletes;

    const COLUMN_WORKSHOP_ID = 'workshop_id';

    protected $table = 'booking';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_WORKSHOP_ID,
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
    public function bookingVisitors()
    {
        return $this->hasMany(BookingVisitor::class, BookingVisitor::COLUMN_BOOKING_ID);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workshop()
    {
        return $this->belongsTo(Workshop::class, self::COLUMN_WORKSHOP_ID);
    }

    /**
     * @return mixed
     */
    public function getVisitors()
    {
        return $this->bookingVisitors;
    }

    /**
     * @return int
     */
    public function getWorkshopId(): int
    {
        return $this->getAttribute(self::COLUMN_WORKSHOP_ID);
    }

    /**
     * @param int $value
     * @return Booking
     */
    public function setWorkshopId(int $value): self
    {
        $this->setAttribute(self::COLUMN_WORKSHOP_ID, $value);

        return $this;
    }

    /**
     * @return Workshop
     */
    public function getWorkshop(): Workshop
    {
        return $this->workshop()->firstOfFail();
    }

    /**
     * @param Workshop $model
     * @return Booking
     */
    public function setWorkshop(Workshop $model): self
    {
        $this->workshop()->associate($model);

        return $this;
    }

}
