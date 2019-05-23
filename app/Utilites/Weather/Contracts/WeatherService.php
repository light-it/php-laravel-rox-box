<?php

namespace App\Utilites\Weather\Contracts;

/**
 * Interface WeatherService
 * @package App\Utilites\Weather\Contracts
 */
interface WeatherService
{

    /*
     * @return string
    */
    public function getWeather(): string;

}
