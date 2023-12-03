<?php

namespace App\Http\CustomerShopping\Domain\Customer\Events;

use App\Http\CustomerShopping\Domain\Customer\Customer;
use App\Http\CustomerShopping\Domain\Customer\Entities\CartItem;

class AddCartItem
{
    private Customer $customer;
    private CartItem $cart_item;
    public function __construct(Customer $customer, CartItem $cart_item)
    {
        $this->customer = $customer;
        $this->cart_item = $cart_item;
    }

    public function getCustomerUuid()
    {
        return $this->customer->getUuid();
    }
    public function getCommodityUuid()
    {
        return $this->cart_item->getCommodityUuid();
    }
    public function getQuantity()
    {
        return $this->cart_item->getQuantity();
    }
}
