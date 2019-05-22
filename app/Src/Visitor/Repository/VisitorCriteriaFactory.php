<?php

namespace App\Src\Visitor\Repository;

use App\Utilites\Repositories\Criterias\CriteriaFactory;

class VisitorCriteriaFactory extends CriteriaFactory
{
    const CONTEXT = 'visitor';

    /**
     * @return string
     */
    protected function getContext(): string
    {
        return self::CONTEXT;
    }

}
