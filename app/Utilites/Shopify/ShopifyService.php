<?php

namespace App\Utilites\Shopify;

use App\Utilites\Shopify\Contracts\ShopifyService as ShopifyServiceInterface;
use Illuminate\Support\Collection;
use Oseintow\Shopify\Shopify;

/**
 * Class ShopifyService
 * @package App\Utilites\Shopify
 */
final class ShopifyService implements ShopifyServiceInterface
{

    /**
     * @var Shopify
     */
    private $shopify;

    /**
     * ShopifyService constructor.
     * @param Shopify $shopify
     * @param string $accessToken
     */
    public function __construct(Shopify $shopify)
    {
        $this->shopify = $shopify;
    }

    /*
     * @return Collection
    */
    public function getCustomers()
    {
        /** @var Collection $customers */
        $customers = collect([]);

        try {
            $customers = $this->shopify->get('admin/api/2019-04/customers.json');
            $customers->transform(function($customer) {
                return (object)[
                    'name'  => sprintf('%1s %2s', data_get($customer, 'first_name'), data_get($customer, 'last_name')),
                    'phone' => data_get($customer, 'phone'),
                ];
            });
        } catch (Exception $e) { }

        return $customers;
    }

}
