<?php

namespace App\Providers;

use App\Utilites\CRM\Contracts\CRMSystems;
use App\Utilites\CRM\Commerce\Shopify\Contracts\ShopifyService;
use App\Utilites\Geo\Contracts\GeoService;
use App\Utilites\Weather\Contracts\WeatherService;
use Illuminate\Support\ServiceProvider;
use Oseintow\Shopify\Facades\Shopify;
use Torann\GeoIP\Facades\GeoIP;

class UtilitesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // CRM systems factory
        $this->app->bind(CRMSystems::class, \App\Utilites\CRM\CRMSystemFactory::class);

        // Shopify Service
        $this->app->bind(
            \App\Utilites\CRM\Commerce\Shopify\ShopifyService::class,
            function ($app, $parameters) {
                $shopifyConfig = $app->make('config')->get('shopify');

                $shopify = Shopify::setShopUrl($shopifyConfig['domain'])
                    ->setKey($shopifyConfig['key'])
                    ->setSecret($shopifyConfig['secret'])
                    ->setAccessToken($shopifyConfig['token']);

                return new \App\Utilites\CRM\Commerce\Shopify\ShopifyService($shopify);
            }
        );

        $this->app->bind(
            ShopifyService::class,
            \App\Utilites\CRM\Commerce\Shopify\ShopifyService::class
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
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
