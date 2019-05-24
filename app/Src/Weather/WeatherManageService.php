<?php

namespace App\Src\Weather;

use App\Models\Booking;
use App\Models\Visitor;
use App\Models\Weather;
use App\Src\Weather\Contracts\WeatherManageService as WeatherManageServiceInterface;
use App\Src\Weather\Repository\Contracts\WeatherRepository;
use Illuminate\Database\Eloquent\Collection;

class WeatherManageService implements WeatherManageServiceInterface
{
    /**
     * @var WeatherRepository
     */
    private $weatherRepository;

    /**
     * Service constructor.
     * @param WeatherRepository $weatherRepository
     */
    public function __construct(WeatherRepository $weatherRepository)
    {
        $this->weatherRepository = $weatherRepository;
    }

    /**
     * @param Booking $booking
     * @param Visitor $visitor
     * @param string $weatherData
     * @return Weather|mixed
     */
    public function create(Booking $booking, Visitor $visitor, string $weatherData): Weather
    {
        /** @var Weather $weather */
        $weather = $this->weatherRepository->create([
            Weather::COLUMN_BOOKING_ID => $booking->getKey(),
            Weather::COLUMN_VISITOR_ID => $visitor->getKey(),
            Weather::COLUMN_WEATHER    => $weatherData,
        ]);

        return $weather;
    }

}
