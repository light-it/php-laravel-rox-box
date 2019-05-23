<?php

namespace App\Src\Workshop\Contracts;

use App\Models\Workshop;
use Illuminate\Database\Eloquent\Collection;

interface WorkshopManageService
{

    /**
     * @param array|null $filters
     * @return mixed
     */
    public function getAll(?array $filters = []);

    /**
     * @param mixed $dtStart
     * @return Workshop|null
     */
    public function findByDTStart($dtStart): ?Workshop;

    /**
     * @param Workshop $workshop
     * @return int
     */
    public function getQtyAvailableVisitors(Workshop $workshop): int;

    /**
     * @return array
     */
    public function getSchdedule(): array;

}
