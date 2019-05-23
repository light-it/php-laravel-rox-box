<?php

namespace App\Providers;

use App\Utilites\Adapters\Config\Contracts\ConfigRepository;
use App\Utilites\Adapters\Container\Contracts\Container;
use App\Utilites\Shopify\Contracts\ShopifyService;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use League\Fractal\Serializer\ArraySerializer;
use Oseintow\Shopify\Facades\Shopify;

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

        $this->app->bind(
            \App\Utilites\Shopify\ShopifyService::class,
            function ($app, $parameters) {
                $shopifyConfig = $app->make('config')->get('shopify');

                $shopify = Shopify::setShopUrl($shopifyConfig['domain'])
                    ->setKey($shopifyConfig['key'])
                    ->setSecret($shopifyConfig['secret'])
                    ->setAccessToken($shopifyConfig['token']);

                return new \App\Utilites\Shopify\ShopifyService($shopify);
            }
        );

        $this->app->bind(
            ShopifyService::class,
            \App\Utilites\Shopify\ShopifyService::class
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
