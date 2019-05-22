<?php

namespace App\Src\Visitor;

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

}
