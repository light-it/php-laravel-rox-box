<?php

namespace App\Src\Workshop;

use App\Src\Workshop\Contracts\WorkshopManageService as WorkshopManageServiceInterface;
use App\Src\Workshop\Repository\Contracts\WorkshopRepository;
use Illuminate\Database\Eloquent\Collection;

class WorkshopManageService implements WorkshopManageServiceInterface
{
    /**
     * @var WorkshopRepository
     */
    private $workshopRepository;

    /**
     * Service constructor.
     * @param WorkshopRepository $workshopRepository
     */
    public function __construct(WorkshopRepository $workshopRepository)
    {
        $this->workshopRepository = $workshopRepository;
    }

}
