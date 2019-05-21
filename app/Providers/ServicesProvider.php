<?php

namespace App\Providers;

use App\Src\Booking\Contracts\BookingManageService;
use App\Src\User\Contracts\UserManageService;
use Illuminate\Support\ServiceProvider;

class ServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(
            BookingManageService::class,
            \App\Src\Booking\BookingManageService::class
        );

        $this->app->bind(
            UserManageService::class,
            \App\Src\User\UserManageService::class
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
