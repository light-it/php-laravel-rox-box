<?php

namespace App\Src\Workshop;

use App\Models\Workshop;
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

    /**
     * @param array|null $filters
     * @return mixed
     */
    public function getAll(?array $filters = [])
    {
        return $this->workshopRepository->findBy($filters);
    }

    /**
     * @param mixed $dtStart
     * @return Workshop|null
     */
    public function findByDTStart($dtStart): ?Workshop
    {
        return $this->workshopRepository->findSingleBy([
            $this->workshopRepository::BY_DT_START => $dtStart,
        ]);
    }

    /**
     * @param Workshop $workshop
     * @return int
     */
    public function getQtyAvailableVisitors(Workshop $workshop): int
    {
        return $this->workshopRepository->getQtyAvailableVisitors($workshop);
    }

}
