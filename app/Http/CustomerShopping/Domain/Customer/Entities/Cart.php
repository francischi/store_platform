<?php

namespace App\Http\CustomerShopping\Domain\Customer\Entities;

use App\Http\CustomerShopping\Domain\Commodity\Commodity;
use App\Http\CustomerShopping\Domain\Customer\Entities\CartItem;

class Cart
{
    private array $cartItems;
    public function __construct(array $cartItems)
    {
        $this->cartItems = $cartItems;
    }
    public function addItem(Commodity $commodity, int $quantity)
    {
        $newCartItem = $this->commodityToCartItem($commodity, $quantity);
        foreach ($this->cartItems as $cartItem) {
            if ($cartItem->getCommodityUuid() == $newCartItem->getCommodityUuid()) {
                $cartItem->addQuantity($newCartItem->getQuantity());
                return $cartItem;
            }
        }
        $this->cartItems [] = $newCartItem;
        return $newCartItem;
    }
    public function reduceItem(Commodity $commodity, int $quantity)
    {
        foreach ($this->cartItems as $index => $cartItem) {
            if ($cartItem->getCommodityUuid() == $commodity->getUuid()) {
                $cartItem->reduceQuantity($quantity);
                if ($cartItem->getQuantity() == 0) {
                    unset($this->cartItems[$index]);
                }
                return $cartItem;
            }
        }

        return;
    }

    private function removeCartItem(CartItem $CartItem)
    {
        return;
    }

    private function commodityToCartItem(Commodity $commodity, int $quantity)
    {
        if ($commodity->stock < $quantity) {
            throw new \Exception('cant add to cart');
        }
        if (!$commodity->isEnable()) {
            throw new \Exception('cant get commodity');
        }
        return new CartItem($commodity->getUuid, $quantity);
    }
}
