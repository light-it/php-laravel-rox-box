<?php

namespace App\DTO;

use Illuminate\Support\Collection;
use SchulzeFelix\DataTransferObject\DataTransferObject;

class GeoDTO extends DataTransferObject
{

    const LAT = 'lat';
    const LNG = 'lng';
    const CITY = 'city';

    /** @var float $lat */
    private $lat;

    /** @var float $lng */
    private $lng;

    /** @var string $city */
    private $city;

    /**
     * @return float|null
     */
    public function getLatAttribute(): ?float
    {
        return $this->lat;
    }

    /**
     * @param float|null $lat
     * @return GeoDTO
     */
    public function setLatAttribute(?float $lat = null): self
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getLngAttribute(): ?float
    {
        return $this->lng;
    }

    /**
     * @param float|null $lng
     * @return GeoDTO
     */
    public function setLngAttribute(?float $lng = null): self
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCityAttribute(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return GeoDTO
     */
    public function setCityAttribute(?string $city = null): self
    {
        $this->city = $city;

        return $this;
    }

}
