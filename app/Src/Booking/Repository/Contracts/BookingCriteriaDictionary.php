<?php

namespace App\Src\Booking\Repository\Contracts;

use App\Utilites\Repositories\Criterias\Contracts\DefaultCriteriaDictionary;

interface BookingCriteriaDictionary extends DefaultCriteriaDictionary
{
    const BY_WORKSHOP_ID = 'by_workshop_id';

}
