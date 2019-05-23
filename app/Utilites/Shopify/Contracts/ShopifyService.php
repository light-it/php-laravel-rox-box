<?php

namespace App\Utilites\Shopify\Contracts;

use Illuminate\Support\Collection;
use Oseintow\Shopify\Shopify;

/**
 * Interface ShopifyService
 * @package App\Utilites\Shopify\Contracts
 */
interface ShopifyService
{

    /*
     * @return Collection
    */
    public function getCustomers(): Collection;

}
