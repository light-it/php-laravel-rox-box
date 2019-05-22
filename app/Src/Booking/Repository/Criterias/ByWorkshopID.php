<?php

namespace App\Src\Booking\Repository\Criterias;

use App\Models\Booking;
use App\Utilites\Repositories\Criterias\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class ByWorkshopID implements Criteria
{
    private $value;

    /**
     * ByWorkshopID constructor.
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
        return $query->where(Booking::COLUMN_WORKSHOP_ID, $this->value);
    }

}
