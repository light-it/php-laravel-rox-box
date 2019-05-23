<?php

namespace App\Utilites\Weather;

use App\DTO\GeoDTO;
use App\Utilites\Geo\Contracts\GeoService;
use App\Utilites\Weather\Contracts\WeatherService as WeatherServiceInterface;

/**
 * Class WeatherService
 * @package App\Utilites\Weather
 */
final class WeatherService implements WeatherServiceInterface
{

    /**
     * @var GeoService
     */
    private $geoService;

    /**
     * @var string
     */
    private $weatherUrl;

    /**
     * @var string
     */
    private $weatherKey;

    /**
     * WeatherService constructor.
     * @param GeoService $geoIP
     * @param string $weatherUrl
     * @param string $weatherKey
     */
    public function __construct(
        GeoService $geoService,
        string $weatherUrl,
        string $weatherKey
    ) {
        $this->geoService = $geoService;
        $this->weatherUrl = $weatherUrl;
        $this->weatherKey = $weatherKey;
    }

    /*
     * @return string
    */
    public function getWeather(): string
    {
        $weather = '';

        try {
            /** @var GeoDTO $geoDTO */
            $geoDTO = $this->geoService->getGeoCoordinates();

            $url = sprintf(
                '%1s?key=%2s&q=%3s',
                $this->weatherUrl,
                $this->weatherKey,
                urlencode($geoDTO->getCityAttribute())
            );

            $weather = json_encode(file_get_contents($url));
        } catch (\Exception $e) { }

        return $weather;
    }

}
