<?php

namespace App\Utilites\CRM;

use App\Utilites\Adapters\Config\Contracts\ConfigRepository;
use App\Utilites\Adapters\Container\Contracts\Container;
use App\Utilites\CRM\Contracts\CRMSystems;
use App\Utilites\CRM\Types\Contracts\CRMSystem;
use App\Utilites\CRM\Exceptions\BuildCRMSystemException;

class CRMSystemFactory implements CRMSystems
{

    const CRM_SYSTEMS = 'loaders.crm.type';

    /**
     * @var ConfigRepository
     */
    private $configRepository;

    /**
     * @var Container
     */
    private $container;

    /**
     * @var array
     */
    private $types;

    /**
     * @param ConfigRepository $configRepository
     * @param Container $container
     */
    public function __construct(ConfigRepository $configRepository, Container $container)
    {
        $this->configRepository = $configRepository;
        $this->container = $container;
        $this->types = $this->getCRMSystems();
    }

    /**
     * @param string $name
     * @return CRMSystem
     * @throws BuildCsvConfigException
     */
    public function createCRMSystem(string $name): CRMSystem
    {
        try {
            return $this->createEntity($this->getAlias($name));
        } catch (\Exception $exception) {
            throw new BuildCRMSystemException(sprintf(
                'Cannot build CRM system instance by given type - %s, %s',
                $name,
                $exception->getMessage()
            ));
        }
    }

    /**
     * @return array
     */
    private function getCRMSystems(): array
    {
        return $this->configRepository->get(self::CRM_SYSTEMS) ?? [];
    }

    /**
     * @param string $alias
     * @return mixed
     */
    private function createEntity(string $alias)
    {
        return $this->container->make($alias);
    }

    /**
     * @param string $alias
     * @return string
     */
    private function getAlias(string $alias): string
    {
        return $this->types[$alias];
    }

}
