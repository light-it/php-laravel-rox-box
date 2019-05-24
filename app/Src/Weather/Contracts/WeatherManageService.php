<?php

namespace App\Src\Weather\Contracts;

use App\Models\Booking;
use App\Models\Visitor;
use App\Models\Weather;

interface WeatherManageService
{

    /**
     * @param Booking $booking
     * @param Visitor $visitor
     * @param string $weatherData
     * @return Weather|mixed
     */
    public function create(Booking $booking, Visitor $visitor, string $weatherData): Weather;

}
