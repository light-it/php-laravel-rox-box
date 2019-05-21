<?php

namespace App\Utilites\Repositories\Criterias\DefaultCriterias;

use App\Utilites\Repositories\Criterias\Contracts\Criteria;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class ByKey
 * @package App\Utilites\Repositories\Criterias\DefaultCriterias
 */
class ByKey implements Criteria
{
    private $value;

    /**
     * ByKey constructor.
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
        $table         = $query->getModel()->getTable();
        $columnKeyName = $table . '.' . $query->getModel()->getKeyName();
        
        if (!is_array($this->value)) {
            return $query->where($columnKeyName, $this->value);
        }
        
        foreach ($this->value as $id) {
            $query->orWhere($columnKeyName, $id);
        }
        
        return $query;
    }
}
