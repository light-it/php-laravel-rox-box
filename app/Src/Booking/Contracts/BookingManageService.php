<?php

namespace App\Src\Booking\Contracts;

use App\Models\Booking;
use App\Models\Workshop;
use Illuminate\Database\Eloquent\Collection;

interface BookingManageService
{

    /**
     * @param Workshop $workshop
     * @return Booking|mixed
     */
    public function findOrCreateByWorkshop(Workshop $workshop): Booking;

    /**
     * @param Workshop $workshop
     * @return Booking|mixed
     */
    public function createByWorkshop(Workshop $workshop): Booking;

}
