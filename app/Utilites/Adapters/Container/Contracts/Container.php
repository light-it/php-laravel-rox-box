<?php

namespace App\Utilites\Adapters\Container\Contracts;

/**
 * Interface Container
 * @package App\Utilites\Adapters\Container\Contracts
 */
interface Container
{
    /**
     * @param string $className
     * @return mixed
     */
    public function make(string $className);

    /**
     * @param string $className
     * @param array $parameters
     * @return mixed
     */
    public function makeWith(string $className, array $parameters = []);
}