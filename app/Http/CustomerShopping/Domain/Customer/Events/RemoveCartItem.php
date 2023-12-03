<?php

namespace App\Http\CustomerShopping\Domain\Customer\Events;

class AddCartItem
{
    private string $customer_uuid;
    private string $comodity_uuid;
    private string $quantity;
    public function __construct(string $customer_uuid, string $comodity_uuid, string $quantity)
    {
        $this->customer_uuid = $customer_uuid;
        $this->comodity_uuid = $comodity_uuid;
        $this->quantity = $quantity;
    }

    public function getCustomerUuid()
    {
        return $this->customer_uuid;
    }
    public function getCommodityUuid()
    {
        return $this->comodity_uuid;
    }
    public function getQuantity()
    {
        return $this->quantity;
    }
}
