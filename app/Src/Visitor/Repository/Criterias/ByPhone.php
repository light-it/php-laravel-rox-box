<?php

namespace App\Src\Visitor\Repository\Criterias;

use App\Models\Visitor;
use App\Utilites\Repositories\Criterias\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class ByPhone implements Criteria
{
    private $value;

    /**
     * ByPhone constructor.
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
        return $query->where(Visitor::COLUMN_PHONE, $this->value);
    }

}
