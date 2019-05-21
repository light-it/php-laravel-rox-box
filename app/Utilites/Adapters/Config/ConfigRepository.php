<?php

namespace App\Utilites\Adapters\Config;

use App\Utilites\Adapters\Config\Contracts\ConfigRepository as ConfigRepositoryInterface;
use Illuminate\Contracts\Config\Repository as LaravelConfig;

/**
 * Class ConfigRepository
 * @package App\Utilites\Adapters\Config
 */
final class ConfigRepository implements ConfigRepositoryInterface
{
    /**
     * @var LaravelConfig
     */
    private $configRepository;

    /**
     * ConfigRepository constructor.
     * @param LaravelConfig $configRepository
     */
    public function __construct(LaravelConfig $configRepository)
    {
        $this->configRepository = $configRepository;
    }

    /**
     * @param string $alias
     * @return mixed
     */
    public function get(string $alias)
    {
        return $this->configRepository->get($alias);
    }

    /**
     * @param string $alias
     * @param string $value
     */
    public function set(string $alias, string $value)
    {
        $this->configRepository->set($alias, $value);
    }
}