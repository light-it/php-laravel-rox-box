<?php

namespace App\Src\Workshop\Repository;

use App\Models\Workshop;
use App\Src\Workshop\Repository\Contracts\WorkshopRepository as WorkshopRepositoryInterface;
use App\Utilites\Repositories\Exceptions\RepositoryException;
use App\Utilites\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class WorkshopRepository extends Repository implements WorkshopRepositoryInterface
{
    /**
     * Repository constructor.
     * @param WorkshopCriteriaFactory $factory
     * @param Workshop $model
     * @throws RepositoryException
     */
    public function __construct(WorkshopCriteriaFactory $factory, Workshop $model)
    {
        parent::__construct($factory, $model);
    }

    /**
     * @param Model $model
     * @return bool
     */
    protected function isSatisfy(Model $model): bool
    {
        return $model instanceof Workshop;
    }

}
