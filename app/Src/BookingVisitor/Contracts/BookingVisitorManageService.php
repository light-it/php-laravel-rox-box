<?php

namespace App\Src\BookingVisitor\Contracts;

use App\Models\Booking;
use App\Models\BookingVisitor;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\Collection;

interface BookingVisitorManageService
{

    /**
     * @param Booking $booking
     * @param Visitor $visitor
     * @param BookingVisitor|null $bookingVisitor
     * @return BookingVisitor|mixed
     */
    public function findOrCreate(
        Booking $booking,
        Visitor $visitor,
        ?BookingVisitor $bookingVisitor = null
    ): BookingVisitor;

}
