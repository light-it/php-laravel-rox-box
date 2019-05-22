<?php

namespace App\Src\User;

use App\Src\User\Contracts\UserManageService as UserManageServiceInterface;
use App\Src\User\Repository\Contracts\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserManageService implements UserManageServiceInterface
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Service constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

}
