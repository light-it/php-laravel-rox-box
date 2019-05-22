<?php

namespace App\Src\Visitor\Repository\Contracts;

use App\Utilites\Repositories\Criterias\Contracts\DefaultCriteriaDictionary;

interface VisitorCriteriaDictionary extends DefaultCriteriaDictionary
{
    const BY_NAME = 'by_name';
    const BY_PHONE = 'by_phone';
    const BY_EMAIL = 'by_email';

}
