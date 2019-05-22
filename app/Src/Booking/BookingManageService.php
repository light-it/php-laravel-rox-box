<?php

namespace App\Src\Booking;

use App\Models\Booking;
use App\Models\Workshop;
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
     * Service constructor.
     * @param BookingRepository $bookingRepository
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    /**
     * @param Workshop $workshop
     * @return Booking|mixed
     */
    public function findOrCreateByWorkshop(Workshop $workshop): Booking
    {
        /** @var Booking $booking */
        $booking = $this->bookingRepository->findSingleBy([
            $this->bookingRepository::BY_WORKSHOP_ID => $workshop->getKey(),
        ]);

        return $booking
            ? $booking
            : $this->bookingRepository->create([
                Booking::COLUMN_WORKSHOP_ID => $workshop->getKey(),
            ]);
    }

}
