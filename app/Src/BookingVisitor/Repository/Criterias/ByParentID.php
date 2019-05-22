<?php

namespace App\Src\BookingVisitor\Repository\Criterias;

use App\Models\BookingVisitor;
use App\Utilites\Repositories\Criterias\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class ByParentID implements Criteria
{
    private $value;

    /**
     * ByParentID constructor.
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
        return $query->where(BookingVisitor::COLUMN_PARENT_ID, $this->value);
    }

}
