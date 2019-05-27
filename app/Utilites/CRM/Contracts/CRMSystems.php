<?php

namespace App\Utilites\CRM\Contracts;

use App\Utilites\CRM\Types\Contracts\CRMSystem;
use App\Utilites\CRM\Exceptions\BuildCRMSystemException;

interface CRMSystems
{

    /**
     * @param string $name
     * @return CRMSystem
     * @throws BuildCsvConfigException
     */
    public function createCRMSystem(string $name): CRMSystem;

}
