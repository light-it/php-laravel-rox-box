<?php

namespace App\Src\Booking\Repository;

use App\Models\Booking;
use App\Src\Booking\Repository\Contracts\BookingRepository as BookingRepositoryInterface;
use App\Utilites\Repositories\Exceptions\RepositoryException;
use App\Utilites\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class BookingRepository extends Repository implements BookingRepositoryInterface
{
    /**
     * Repository constructor.
     * @param BookingCriteriaFactory $factory
     * @param Booking $model
     * @throws RepositoryException
     */
    public function __construct(BookingCriteriaFactory $factory, Booking $model)
    {
        parent::__construct($factory, $model);
    }

    /**
     * @param Model $model
     * @return bool
     */
    protected function isSatisfy(Model $model): bool
    {
        return $model instanceof Booking;
    }

}
