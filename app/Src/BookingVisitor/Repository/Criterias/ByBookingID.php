<?php

namespace App\Src\BookingVisitor\Repository\Criterias;

use App\Models\BookingVisitor;
use App\Utilites\Repositories\Criterias\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class ByBookingID implements Criteria
{
    private $value;

    /**
     * ByBookingID constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param Builder $query
     * @return Builder|mixed
     */
    public function apply(Builder $query)
    {
        return $query->where(BookingVisitor::COLUMN_BOOKING_ID, $this->value);
    }

}
