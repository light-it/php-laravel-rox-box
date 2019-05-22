<?php

namespace App\Src\Visitor\Repository;

use App\Models\Visitor;
use App\Src\Visitor\Repository\Contracts\VisitorRepository as VisitorRepositoryInterface;
use App\Utilites\Repositories\Exceptions\RepositoryException;
use App\Utilites\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class VisitorRepository extends Repository implements VisitorRepositoryInterface
{
    /**
     * Repository constructor.
     * @param VisitorCriteriaFactory $factory
     * @param Visitor $model
     * @throws RepositoryException
     */
    public function __construct(VisitorCriteriaFactory $factory, Visitor $model)
    {
        parent::__construct($factory, $model);
    }

    /**
     * @param Model $model
     * @return bool
     */
    protected function isSatisfy(Model $model): bool
    {
        return $model instanceof Visitor;
    }

}
