<?php

namespace App\Src\Workshop\Repository\Criterias;

use App\Models\Workshop;
use App\Utilites\Repositories\Criterias\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class ByDateTimeStart implements Criteria
{
    private $value;

    /**
     * Criteria constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param Builder $query
     * @return Builder|\Illuminate\Database\Query\Builder|mixed
     */
    public function apply(Builder $query)
    {
        return $query->where(Workshop::COLUMN_DT_START, '=', $this->value);
    }

}
