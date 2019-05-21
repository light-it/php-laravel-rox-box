<?php

namespace App\Src\Booking;

use App\Src\Booking\Contracts\BookingManageService as BookingManageServiceInterface;
use App\Src\Booking\Repository\Contracts\BookingRepository;
use Illuminate\Database\Eloquent\Collection;

class BookingManageService implements BookingManageServiceInterface
{
    /**
     * @var BookingRepository
     */
    private $bookingRepository;

    /**
     * BookingManageService constructor.
     * @param BookingRepository $bookingRepository
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

}
