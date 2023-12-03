<?php

namespace App\Http\CustomerShopping\Repos;

use App\Http\CustomerShopping\Domain\Customer\Customer;
use App\Http\CustomerShopping\Domain\Customer\ValueObjects\Email;
use App\Http\CustomerShopping\Domain\Customer\Events\AddCartItem;
use App\Http\CustomerShopping\Domain\Customer\Events\ReduceCartItem;
use App\Http\CustomerShopping\Domain\Customer\Entities\Cart;
use App\Http\CustomerShopping\Domain\Customer\Entities\CartItem;
use App\Models\Customer as CustomerOrm;
use App\Models\CartItem as CartItemOrm;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository
{
    public function getByUuid(string $uuid)
    {
        $customer = CustomerOrm::where('uuid', $uuid)->first();
        if (!$customer) {
            return null;
        }
        $cart_items = CartItemOrm::where('customer_uuid', $uuid)->get();
        return $this->ormToDomain($customer, $cart_items);
    }
    public function addCartItem(AddCartItem $event)
    {
        $customer_uuid = $event->getCustomerUuid();
        $commodity_uuid = $event->getCommodityUuid();
        $quantity = $event->getQuantity();
        return;
    }
    public function reduceCartItem(ReduceCartItem $event)
    {
        $customer_uuid = $event->getCustomerUuid();
        $commodity_uuid = $event->getCommodityUuid();
        $quantity = $event->getQuantity();
        return;
    }
    private function ormToDomain(CustomerOrm $customer_orm, Collection $cart_items_orm)
    {
        $cart_item_entities = [];
        foreach ($cart_items_orm as $cart_item_orm) {
            $cart_item_entity = new CartItem($cart_item_orm->commodity_uuid, $cart_item_orm->quantity);
            $cart_item_entities [] = $cart_item_entity;
        }
        $cart = new Cart($cart_item_entities);
        $email = new Email($customer_orm->email);
        $customer_domain = new Customer($customer_orm->id, $customer_orm->uuid, $customer_orm->name, $email, $cart);
        return $customer_domain;
    }
}
