<?php

namespace App\Utilites\Repositories\Criterias\DefaultCriterias;

use App\Utilites\Repositories\Criterias\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

class WithDeleted implements Criteria
{
    private $value;

    /**
     * WithoutDeleted constructor.
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
        return $q = $this->value
            ? $query->withTrashed()
            : $query->whereNull('deleted_at');
    }

}
