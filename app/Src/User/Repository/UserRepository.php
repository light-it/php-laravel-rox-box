<?php

namespace App\Src\User\Repository;

use App\Models\User;
use App\Src\User\Repository\Contracts\UserRepository as UserRepositoryInterface;
use App\Utilites\Repositories\Exceptions\RepositoryException;
use App\Utilites\Repositories\Repository;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository implements UserRepositoryInterface
{
    /**
     * Repository constructor.
     * @param UserCriteriaFactory $factory
     * @param User $model
     * @throws RepositoryException
     */
    public function __construct(UserCriteriaFactory $factory, User $model)
    {
        parent::__construct($factory, $model);
    }

    /**
     * @param Model $model
     * @return bool
     */
    protected function isSatisfy(Model $model): bool
    {
        return $model instanceof User;
    }

}
