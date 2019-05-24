<?php

namespace App\Src\Weather\Repository;

use App\Utilites\Repositories\Criterias\CriteriaFactory;

class WeatherCriteriaFactory extends CriteriaFactory
{
    const CONTEXT = 'weather';

    /**
     * @return string
     */
    protected function getContext(): string
    {
        return self::CONTEXT;
    }

}
