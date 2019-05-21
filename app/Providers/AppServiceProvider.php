<?php

namespace App\Providers;

use App\Utilites\Adapters\Config\Contracts\ConfigRepository;
use App\Utilites\Adapters\Container\Contracts\Container;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use League\Fractal\Serializer\ArraySerializer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton(
            'FractalManager',
            function ($app) {
                $manager = (new Manager())
                    ->setSerializer(new ArraySerializer());

                return isset($_GET['include'])
                    ? $manager->parseIncludes($_GET['include'])
                    : $manager;
            }
        );

        $this->app->bind(
            ConfigRepository::class,
            \App\Utilites\Adapters\Config\ConfigRepository::class
        );
        $this->app->bind(
            Container::class,
            \App\Utilites\Adapters\Container\Container::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
