<?php

namespace App\Utilites\Repositories\Criterias\Contracts;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface Criteria
 * @package App\Utilites\Repositories\Criterias\Contracts
 */
interface Criteria
{
    /**
     * @param Builder $query
     * @return mixed
     */
    public function apply(Builder $query);
}