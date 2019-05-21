<?php

namespace App\Utilites\Repositories\Criterias\DefaultCriterias;

use App\Utilites\Repositories\Criterias\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ByRelation
 * @package App\Utilites\Repositories\Criterias\DefaultCriterias
 */
class ByRelation implements Criteria
{
    private $value;

    /**
     * ByRelation constructor.
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
        return $query->has($this->value);
    }
}
