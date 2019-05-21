<?php

namespace App\Utilites\Adapters\Config\Contracts;

/**
 * Interface ConfigRepository
 * @package App\Utilites\Adapters\Config\Contracts
 */
interface ConfigRepository
{
    /**
     * @param string $alias
     * @return mixed
     */
    public function get(string $alias);

    /**
     * @param string $alias
     * @param string $value
     * @return mixed
     */
    public function set(string $alias, string $value);

}