<?php

namespace App\Src\BookingVisitor\Repository;

use App\Models\BookingVisitor;
use App\Src\BookingVisitor\Repository\Contracts\BookingVisitorRepository as BookingVisitorRepositoryInterface;
use App\Utilites\Repositories\Exceptions\RepositoryException;
use App\Utilites\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class BookingVisitorRepository extends Repository implements BookingVisitorRepositoryInterface
{
    /**
     * Repository constructor.
     * @param BookingVisitorCriteriaFactory $factory
     * @param BookingVisitor $model
     * @throws RepositoryException
     */
    public function __construct(BookingVisitorCriteriaFactory $factory, BookingVisitor $model)
    {
        parent::__construct($factory, $model);
    }

    /**
     * @param Model $model
     * @return bool
     */
    protected function isSatisfy(Model $model): bool
    {
        return $model instanceof BookingVisitor;
    }

}
