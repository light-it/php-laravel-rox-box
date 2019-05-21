<?php

namespace App\Src\User\Repository;

use App\Utilites\Repositories\Criterias\CriteriaFactory;

class UserCriteriaFactory extends CriteriaFactory
{
    const CONTEXT = 'user';

    /**
     * @return string
     */
    protected function getContext(): string
    {
        return self::CONTEXT;
    }

}