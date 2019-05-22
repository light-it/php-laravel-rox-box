<?php

namespace App\Src\BookingVisitor;

use App\Models\Booking;
use App\Models\BookingVisitor;
use App\Models\Visitor;
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

    /**
     * @param Booking $booking
     * @param Visitor $visitor
     * @param BookingVisitor $bookingVisitor
     * @return BookingVisitor|mixed
     */
    public function findOrCreate(
        Booking $booking,
        Visitor $visitor,
        ?BookingVisitor $bookingVisitor = null
    ): BookingVisitor
    {
        $criterias = [
            $this->bookingVisitorRepository::BY_BOOKING_ID => $booking->getKey(),
            $this->bookingVisitorRepository::BY_VISITOR_ID => $visitor->getKey(),
        ];

        if ($bookingVisitor) {
            $criterias[$this->bookingVisitorRepository::BY_PARENT_ID] = $bookingVisitor->getKey();
        }

        /** @var BookingVisitor $bookingVisitorRecord */
        $bookingVisitorRecord = $this->bookingVisitorRepository->findSingleBy($criterias);

        return $bookingVisitorRecord
            ? $bookingVisitorRecord
            : $this->bookingVisitorRepository->create([
                BookingVisitor::COLUMN_BOOKING_ID => $booking->getKey(),
                BookingVisitor::COLUMN_VISITOR_ID => $visitor->getKey(),
                BookingVisitor::COLUMN_PARENT_ID  => $bookingVisitor ? $bookingVisitor->getKey() : null,
            ]);
    }

}
