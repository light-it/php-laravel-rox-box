<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class BookingVisitor extends BaseModel
{
    use SoftDeletes;

    const COLUMN_BOOKING_ID = 'booking_id';
    const COLUMN_VISITOR_ID = 'visitor_id';
    const COLUMN_PARENT_ID = 'parent_id';

    protected $table = 'booking_visitor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_BOOKING_ID,
        self::COLUMN_VISITOR_ID,
        self::COLUMN_PARENT_ID,
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(BookingVisitor::class, self::COLUMN_PARENT_ID);
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
     * @return BookingVisitor
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
     * @return BookingVisitor
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
     * @return BookingVisitor
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
     * @return BookingVisitor
     */
    public function setVisitor(Visitor $model): self
    {
        $this->visitor()->associate($model);

        return $this;
    }

    /**
     * @return int|null
     */
    public function getParentId(): ?int
    {
        return $this->getAttribute(self::COLUMN_PARENT_ID);
    }

    /**
     * @param int|null $value
     * @return BookingVisitor
     */
    public function setParentId(?int $value = null): self
    {
        $this->setAttribute(self::COLUMN_PARENT_ID, $value);

        return $this;
    }

    /**
     * @return BookingVisitor|null
     */
    public function getParent(): ?BookingVisitor
    {
        return $this->parent()->first();
    }

    /**
     * @param BookingVisitor|null $model
     * @return BookingVisitor
     */
    public function setParent(?BookingVisitor $model = null): self
    {
        $this->parent()->associate($model);

        return $this;
    }

}
