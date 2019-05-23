<?php

namespace App\Providers;

use App\Utilites\Adapters\Config\Contracts\ConfigRepository;
use App\Utilites\Adapters\Container\Contracts\Container;
use App\Utilites\Shopify\Contracts\ShopifyService;
use App\Utilites\Geo\Contracts\GeoService;
use App\Utilites\Weather\Contracts\WeatherService;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use League\Fractal\Serializer\ArraySerializer;
use Oseintow\Shopify\Facades\Shopify;
use Torann\GeoIP\Facades\GeoIP;

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

        // Shopify Service
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

        // Geo Service
        $this->app->bind(
            \App\Utilites\Geo\GeoService::class,
            function ($app, $parameters) {
                $geoIP = $app->make('GeoIP');

                return new \App\Utilites\Geo\GeoService($geoIP);
            }
        );

        $this->app->bind(
            GeoService::class,
            \App\Utilites\Geo\GeoService::class
        );

        // Weather Service
        $this->app->bind(
            \App\Utilites\Weather\WeatherService::class,
            function ($app, $parameters) {
                $geoService = $app->make(GeoService::class);
                $weatherConfig = $app->make('config')->get('services.weather.apixu');
                $weatherUrl = $weatherConfig['url'];
                $weatherKey = $weatherConfig['key'];

                return new \App\Utilites\Weather\WeatherService(
                    $geoService,
                    $weatherUrl,
                    $weatherKey
                );
            }
        );

        $this->app->bind(
            WeatherService::class,
            \App\Utilites\Weather\WeatherService::class
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
