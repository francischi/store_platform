<?php

namespace App\Http\CommodityManagement\Domain\Merchant\Entities;

use App\Http\CommodityManagement\Domain\Merchant\ValueObjects\Price;
use Illuminate\Support\Str;
use App\Http\Merchant\Enums\EnableStatus;

class Commodity
{
    private $id = null;
    private $uuid = null;
    private $name;
    private Price $price;
    private $promotion_price;
    private $stock;
    private $enable_status;
    public function __construct(int $id, string $uuid, string $name, Price $price, int $stock, string $enable_status)
    {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
        $this->enable_status = $enable_status;
    }
    public function getUuid()
    {
        return $this->uuid;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPrice()
    {
        return $this->price->getPrice();
    }
    public function getPromotionPrice()
    {
        return $this->price->getPromotionPrice();
    }
    public function getStock()
    {
        return $this->price->getPromotionPrice();
    }
    public function getEnableStatus()
    {
        return $this->enable_status;
    }
}
