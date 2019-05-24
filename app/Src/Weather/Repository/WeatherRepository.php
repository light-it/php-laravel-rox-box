<?php

namespace App\Src\Weather\Repository;

use App\Models\Weather;
use App\Src\Weather\Repository\Contracts\WeatherRepository as WeatherRepositoryInterface;
use App\Utilites\Repositories\Exceptions\RepositoryException;
use App\Utilites\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class WeatherRepository extends Repository implements WeatherRepositoryInterface
{
    /**
     * Repository constructor.
     * @param WeatherCriteriaFactory $factory
     * @param Weather $model
     * @throws RepositoryException
     */
    public function __construct(WeatherCriteriaFactory $factory, Weather $model)
    {
        parent::__construct($factory, $model);
    }

    /**
     * @param Model $model
     * @return bool
     */
    protected function isSatisfy(Model $model): bool
    {
        return $model instanceof Weather;
    }

}
