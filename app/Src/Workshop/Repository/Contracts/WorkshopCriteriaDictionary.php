<?php

namespace App\Src\Workshop\Repository\Contracts;

use App\Utilites\Repositories\Criterias\Contracts\DefaultCriteriaDictionary;

interface WorkshopCriteriaDictionary extends DefaultCriteriaDictionary
{
    const BY_DT_START = 'by_dt_start';
    const ORDER_BY_DT_START= 'order_by_dt_start';

}
