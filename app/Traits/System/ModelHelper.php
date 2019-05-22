<?php

namespace App\Traits\System;

use App\Interfaces\System\ModelInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @method static static findOrFail(string $ID)
 */
trait ModelHelper
{

    /**
     * Returns primary key name of current eloquent model.
     *
     * @return string
     */
    static public function primaryKey()
    {
        return (new static())->getKeyName();
    }

    /**
     * Returns table name
     *
     * @return string
     */
    static public function tableName()
    {
        return (new static())->getTable();
    }

    /**
     * Scope for given query by given column name and given value or array of
     * its.
     *
     * @param Builder $builder   Given query.
     * @param string $column     Given column name
     * @param array|mixed $value Given value or array of its.
     *
     * @return Builder
     */
    public function scopeIn(Builder $builder, string $column, $value)
    {
        return (is_array($value) || $value instanceof Arrayable)
            ? $builder->whereIn($column, $value)
            : $builder->where($column, '=', $value);
    }

    /**
     * @param Builder $builder
     * @param $values
     *
     * @return Builder
     */
    public function scopeFindIn(Builder $builder, $values)
    {
        return $builder->whereIn($this->getKeyName(), $values);
    }

    /**
     * Scope for given query by given column name and given value or array of
     * its.
     *
     * @param Builder $builder   Given query.
     * @param string $column     Given column name
     * @param array|mixed $value Given value or array of its.
     *
     * @return Builder
     */
    public function scopeNotIn(Builder $builder, string $column, $value)
    {
        return (is_array($value) || $value instanceof Arrayable)
            ? $builder->whereNotIn($column, $value)
            : $builder->where($column, '<>', $value);
    }

    /**
     * Scope for given query without deleted models.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeWoDeleted(Builder $builder)
    {
        return $builder->whereNull('deleted_at');
    }

    /**
     * Scope for given query by given primary key or array of its.
     *
     * @param Builder $builder
     * @param array|mixed $ID
     *
     * @return Builder
     */
    public function scopeByID(Builder $builder, $ID)
    {
        return $this->scopeIn($builder, $this->getKeyName(), $ID);
    }

    /**
     * Checks if current model use soft delete.
     *
     * @return bool True on success, else false.
     */
    public function isModelUseSoftDelete()
    {
        return isset($this->forceDeleting);
    }
}
