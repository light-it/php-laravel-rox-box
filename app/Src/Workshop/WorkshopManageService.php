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

    /**
     * @return array
     */
    public function getSchdedule(): array
    {
        $schedule = [];

        $workshops = $this->getAll();
        $workshops->each(function($workshop) use (&$schedule) {
            $date = $workshop->getDTStart()->format('Y-m-d');
            $item = data_get($schedule, $date);
            if (!$item) {
                $item = [
                    'title' => $workshop->getDTStart()->format('M jS'),
                    'time'  => [],
                ];
            }

            $item['time'][] = [
                'title' => sprintf(
                    '%1s - %2s',
                    $workshop->getDTStart()->format('gA'),
                    $workshop->getDTEnd()->format('gA')
                ),
                'value' => $workshop->getDTStart()->format('H:i:s'),
            ];

            $schedule[$date] = $item;
        });

        return $schedule;
    }

}
