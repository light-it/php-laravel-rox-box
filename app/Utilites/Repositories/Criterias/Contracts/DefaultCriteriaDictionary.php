<?php

namespace App\Utilites\Repositories\Criterias\Contracts;

/**
 * Interface DefaultCriteriaDictionary
 * @package App\Utilites\Repositories\Criterias\Contracts
 */
interface DefaultCriteriaDictionary
{
    public const BY_KEY = 'id';
    public const WITH_RELATION = 'include_relation';
    public const BY_RELATION = 'relation';
    public const WITH_DELETED = 'deleted';
}