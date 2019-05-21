<?php

namespace App\Providers;

use App\Models\User;
use File;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Current version of API
     *
     * @var string
     */
    protected $version = 'v1';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->bindIdModel('user', User::class);

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        foreach (File::allFiles(base_path('routes/web')) as $route) {
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group($route->getPathname());
        }
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        foreach (File::allFiles(base_path('routes/api/' . $this->version)) as $route) {
            Route::middleware('api')
                ->prefix('api/' . $this->version)
                ->namespace($this->namespace)
                ->group($route->getPathname());
        }
    }

    /**
     * Bind model by id
     *
     * @param $route
     * @param $class
     *
     * @return void
     */
    protected function bindIdModel($route, $class)
    {
        Route::model($route, $class);
    }
}
