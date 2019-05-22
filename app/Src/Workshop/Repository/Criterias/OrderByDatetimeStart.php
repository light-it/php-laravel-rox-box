<?php

namespace App\Src\Workshop\Repository\Criterias;

use App\Models\Workshop;
use App\Utilites\Repositories\Criterias\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class OrderByDatetimeStart implements Criteria
{
    private $value;

    /**
     * OrderByDate constructor.
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
        return $this->value
            ? $query->orderBy(Workshop::COLUMN_DT_START)
            : $query->orderByDesc(Workshop::COLUMN_DT_START);
    }

}
