<?php

namespace App\Utilites\Repositories\Criterias\DefaultCriterias;

use App\Utilites\Repositories\Criterias\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class WithRelation
 * @package App\Utilites\Repositories\Criterias\DefaultCriterias
 */
class WithRelation implements Criteria
{
    private $value;

    /**
     * WithRelation constructor.
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
        if (!is_array($this->value)) {
            return $query->with($this->value);
        }
        foreach ($this->value as $relation) {
            $query->with($relation);
        }

        return $query;
    }
}
