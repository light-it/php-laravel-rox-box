<?php

namespace App\Src\Workshop\Repository;

use App\Utilites\Repositories\Criterias\CriteriaFactory;

class WorkshopCriteriaFactory extends CriteriaFactory
{
    const CONTEXT = 'workshop';

    /**
     * @return string
     */
    protected function getContext(): string
    {
        return self::CONTEXT;
    }

}
