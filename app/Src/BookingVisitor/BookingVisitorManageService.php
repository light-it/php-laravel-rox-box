<?php

namespace App\Src\BookingVisitor;

use App\Src\BookingVisitor\Contracts\BookingVisitorManageService as BookingVisitorManageServiceInterface;
use App\Src\BookingVisitor\Repository\Contracts\BookingVisitorRepository;
use Illuminate\Database\Eloquent\Collection;

class BookingVisitorManageService implements BookingVisitorManageServiceInterface
{
    /**
     * @var BookingVisitorRepository
     */
    private $bookingVisitorRepository;

    /**
     * Service constructor.
     * @param BookingVisitorRepository $bookingVisitorRepository
     */
    public function __construct(BookingVisitorRepository $bookingVisitorRepository)
    {
        $this->bookingVisitorRepository = $bookingVisitorRepository;
    }

}
