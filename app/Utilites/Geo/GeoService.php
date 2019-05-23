<?php

namespace App\Utilites\Geo;

use App\DTO\GeoDTO;
use App\Utilites\Geo\Contracts\GeoService as GeoServiceInterface;
use Torann\GeoIP\Facades\GeoIP;

/**
 * Class GeoService
 * @package App\Utilites\Geo
 */
final class GeoService implements GeoServiceInterface
{

    const DEFAULT_IP = '127.0.0.0';

    /**
     * @var GeoIP
     */
    private $geoIP;

    /**
     * ShopifyService constructor.
     * @param GeoIP $geoIP
     */
    public function __construct(GeoIP $geoIP)
    {
        $this->geoIP = $geoIP;
    }

    /*
     * @return GeoDTO
    */
    public function getGeoCoordinates(): GeoDTO
    {
        $location = $this->geoIP::getLocation();
        $attributes = data_get($location, 'attributes', null);
        $ip = data_get($attributes, 'ip', self::DEFAULT_IP);
        if (!$attributes || $this->isDefaultIP($ip)) {
            $ip = $this->getIP();
            $location = $this->geoIP::getLocation();
            $attributes = data_get($location, 'attributes', null);
        }

        $lat = data_get($attributes, 'lat', 1);
        $lng = data_get($attributes, 'lon', 1);
        $city = data_get($attributes, 'city', 'Paris');

        return new GeoDTO([
            GeoDTO::LAT => $lat,
            GeoDTO::LNG => $lng,
            GeoDTO::CITY => $city,
        ]);
    }

    /**
     * Gets IP address by PHP native methods
     *
     * @return string
     */
    private function getIP()
    {
        $ipAddress = '';

        if (getenv('HTTP_CLIENT_IP')) {
            $ipAddress = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipAddress = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ipAddress = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ipAddress = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ipAddress = getenv('HTTP_FORWARDED');
        } elseif (getenv('REMOTE_ADDR')) {
            $ipAddress = getenv('REMOTE_ADDR');
        } else {
            $ipAddress = 'UNKNOWN';
        }

        return $ipAddress;
    }

    /**
     * Gets IP address by PHP native methods
     *
     * @param string $ip
     * @return string
     */
    private function isDefaultIP(string $ip)
    {
        return $ip == self::DEFAULT_IP;
    }

}
