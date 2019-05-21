<?php

namespace App\Providers;

use App\Src\Booking\Repository\Contracts\BookingRepository;
use App\Src\User\Repository\Contracts\UserRepository;
use App\Utilites\Repositories\Contracts\Repository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            Repository::class,
            \App\Utilites\Repositories\Repository::class
        );

        $this->app->bind(
            BookingRepository::class,
            \App\Src\Booking\Repository\BookingRepository::class
        );

        $this->app->bind(
            UserRepository::class,
            \App\Src\User\Repository\UserRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
