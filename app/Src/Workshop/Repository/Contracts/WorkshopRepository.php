<?php

namespace App\Src\Workshop\Repository\Contracts;

use App\Models\Workshop;
use App\Utilites\Repositories\Contracts\Repository;

interface WorkshopRepository extends Repository, WorkshopCriteriaDictionary
{

    /**
     * @param Workshop $model
     * @return int
     */
    public function getQtyBookedVisitors(Workshop $model): int;

    /**
     * @param Workshop $model
     * @return int
     */
    public function getQtyAvailableVisitors(Workshop $model): int;

}
