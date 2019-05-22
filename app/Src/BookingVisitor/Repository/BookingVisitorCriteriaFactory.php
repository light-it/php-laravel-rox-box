<?php

namespace App\Src\BookingVisitor\Repository;

use App\Utilites\Repositories\Criterias\CriteriaFactory;

class BookingVisitorCriteriaFactory extends CriteriaFactory
{
    const CONTEXT = 'booking_visitor';

    /**
     * @return string
     */
    protected function getContext(): string
    {
        return self::CONTEXT;
    }

}
