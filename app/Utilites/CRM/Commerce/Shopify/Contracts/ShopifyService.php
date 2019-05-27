<?php

namespace App\Utilites\CRM\Commerce\Shopify\Contracts;

use Illuminate\Support\Collection;

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
