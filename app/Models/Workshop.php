<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Workshop extends BaseModel
{
    use SoftDeletes;

    const COLUMN_DT_START = 'dt_start';
    const COLUMN_DT_END = 'dt_end';
    const COLUMN_MAX_VISITORS = 'max_visitors';

    protected $table = 'workshop';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_DT_START,
        self::COLUMN_DT_END,
        self::COLUMN_MAX_VISITORS,
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
        self::COLUMN_DT_START,
        self::COLUMN_DT_END,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, Booking::COLUMN_WORKSHOP_ID);
    }

    /**
     * @return mixed
     */
    public function getBookings()
    {
        return $this->bookings;
    }

    /**
     * @return Carbon
     */
    public function getDTStart(): Carbon
    {
        return $this->getAttribute(self::COLUMN_DT_START);
    }

    /**
     * @param Carbon $value
     * @return Workshop
     */
    public function setDTStart(Carbon $value): self
    {
        $this->setAttribute(self::COLUMN_DT_START, $value);

        return $this;
    }

    /**
     * @return Carbon
     */
    public function getDTEnd(): Carbon
    {
        return $this->getAttribute(self::COLUMN_DT_END);
    }

    /**
     * @param Carbon $value
     * @return Workshop
     */
    public function setDTEnd(Carbon $value): self
    {
        $this->setAttribute(self::COLUMN_DT_END, $value);

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxVisitors(): int
    {
        return $this->getAttribute(self::COLUMN_MAX_VISITORS);
    }

    /**
     * @param int $value
     * @return Workshop
     */
    public function setMaxVisitors(int $value): self
    {
        $this->setAttribute(self::COLUMN_MAX_VISITORS, $value);

        return $this;
    }

}
