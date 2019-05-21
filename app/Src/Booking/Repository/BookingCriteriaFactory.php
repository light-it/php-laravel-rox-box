<?php

namespace App\Src\Booking\Repository;

use App\Utilites\Repositories\Criterias\CriteriaFactory;

class BookingCriteriaFactory extends CriteriaFactory
{
    const CONTEXT = 'booking';

    /**
     * @return string
     */
    protected function getContext(): string
    {
        return self::CONTEXT;
    }

}
