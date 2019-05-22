<?php

namespace App\Providers;

use App\Src\Booking\Contracts\BookingManageService;
use App\Src\BookingVisitor\Contracts\BookingVisitorManageService;
use App\Src\User\Contracts\UserManageService;
use App\Src\Visitor\Contracts\VisitorManageService;
use App\Src\Workshop\Contracts\WorkshopManageService;
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
            BookingVisitorManageService::class,
            \App\Src\BookingVisitor\BookingVisitorManageService::class
        );

        $this->app->bind(
            UserManageService::class,
            \App\Src\User\UserManageService::class
        );

        $this->app->bind(
            VisitorManageService::class,
            \App\Src\Visitor\VisitorManageService::class
        );

        $this->app->bind(
            WorkshopManageService::class,
            \App\Src\Workshop\WorkshopManageService::class
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
