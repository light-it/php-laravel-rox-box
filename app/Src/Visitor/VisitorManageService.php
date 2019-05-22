<?php

namespace App\Src\Visitor;

use App\DTO\VisitorDTO;
use App\Models\Visitor;
use App\Src\Visitor\Contracts\VisitorManageService as VisitorManageServiceInterface;
use App\Src\Visitor\Repository\Contracts\VisitorRepository;
use Illuminate\Database\Eloquent\Collection;

class VisitorManageService implements VisitorManageServiceInterface
{
    /**
     * @var VisitorRepository
     */
    private $visitorRepository;

    /**
     * Service constructor.
     * @param VisitorRepository $visitorRepository
     */
    public function __construct(VisitorRepository $visitorRepository)
    {
        $this->visitorRepository = $visitorRepository;
    }

    /**
     * @param VisitorDTO $visitorDTO
     * @return Visitor|mixed
     */
    public function findOrCreate(VisitorDTO $visitorDTO): Visitor
    {
        /** @var Visitor $visitor */
        $visitor = $this->visitorRepository->findSingleBy([
            $this->visitorRepository::BY_NAME  => $visitorDTO->getNameAttribute(),
            $this->visitorRepository::BY_PHONE => $visitorDTO->getPhoneAttribute(),
            $this->visitorRepository::BY_EMAIL => $visitorDTO->getEmailAttribute(),
        ]);

        return $visitor
            ? $visitor
            : $this->visitorRepository->create([
                Visitor::COLUMN_NAME  => $visitorDTO->getNameAttribute(),
                Visitor::COLUMN_PHONE => $visitorDTO->getPhoneAttribute(),
                Visitor::COLUMN_EMAIL => $visitorDTO->getEmailAttribute(),
            ]);
    }

}
