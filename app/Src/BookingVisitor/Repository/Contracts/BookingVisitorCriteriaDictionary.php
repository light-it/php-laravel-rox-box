<?php

namespace App\Src\BookingVisitor\Repository\Contracts;

use App\Utilites\Repositories\Criterias\Contracts\DefaultCriteriaDictionary;

interface BookingVisitorCriteriaDictionary extends DefaultCriteriaDictionary
{
    const BY_BOOKING_ID = 'by_booking_id';
    const BY_VISITOR_ID = 'by_visitor_id';
    const BY_PARENT_ID = 'by_parent_id';

}
