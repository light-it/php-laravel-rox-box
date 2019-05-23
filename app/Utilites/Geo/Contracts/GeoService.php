<?php

namespace App\Utilites\Geo\Contracts;

use App\DTO\GeoDTO;
use Torann\GeoIP\Facades\GeoIP;

/**
 * Interface GeoService
 * @package App\Utilites\Geo\Contracts
 */
interface GeoService
{

    /*
     * @return GeoDTO
    */
    public function getGeoCoordinates(): GeoDTO;

}
