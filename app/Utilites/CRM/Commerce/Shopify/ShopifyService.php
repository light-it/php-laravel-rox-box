<?php

namespace App\Utilites\CRM\Commerce\Shopify;

use App\Utilites\CRM\Commerce\Shopify\Contracts\ShopifyService as ShopifyServiceInterface;
use App\Utilites\CRM\Types\Contracts\CRMSystem;
use Illuminate\Support\Collection;
use Oseintow\Shopify\Shopify;

/**
 * Class ShopifyService
 * @package App\Utilites\CRM\Commerce\Shopify
 */
final class ShopifyService implements CRMSystem, ShopifyServiceInterface
{

    /**
     * @var Shopify
     */
    private $shopify;

    /**
     * ShopifyService constructor.
     * @param Shopify $shopify
     */
    public function __construct(Shopify $shopify)
    {
        $this->shopify = $shopify;
    }

    /*
     * @return Collection
    */
    public function getCustomers(): Collection
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
        } catch (\Exception $e) { }

        return $customers;
    }

}
