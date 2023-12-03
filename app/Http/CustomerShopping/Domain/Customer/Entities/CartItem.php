<?php

namespace App\Http\CustomerShopping\Domain\Customer\Entities;

class CartItem
{
    private $name;
    private $commodityUuid;
    private $quantity;
    public function __construct($commodityUuid, $quantity)
    {
        $this->commodityUuid = $commodityUuid;
        $this->quantity = $quantity;
    }

    public function getCommodityUuid()
    {
        return $this->commodityUuid;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function addQuantity(int $quantity)
    {
        $this->quantity += $quantity;
    }

    public function reduceQuantity(int $quantity)
    {
        $result = $this->quantity - $quantity;
        $this->quantity = $result < 0 ? 0 : $result;
    }
}
