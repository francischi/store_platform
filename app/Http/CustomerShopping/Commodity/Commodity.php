<?php

namespace App\Http\Merchant\Entities;

use App\Http\Merchant\ValueObjects\Price;
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
    public function __construct(?int $id, ?string $uuid, string $name, Price $price, int $stock, string $enable_status)
    {
        $this->isValid($name, $stock, $enable_status);
        $this->id = $id;
        $this->uuid = $uuid;
        $this->name = $name;
        $this->price = $price;
        $this->stock = $stock;
        $this->enable_status = $enable_status;
    }
    private function isValid(string $name, int $stock, string $enable_status)
    {
        if (!$name) {
            throw new \Exception("invalid name");
        }
        if ($stock < 0) {
            throw new \Exception("invalid stock");
        }
        if (!in_array($enable_status, EnableStatus::VALID_STATUS)) {
            throw new \Exception("invalid stock");
        }
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
    public function generateUuid()
    {
        if ($this->uuid) {
            return;
        }
        $this->uuid = str::uuid();
    }
    public function disable()
    {
        $this->enable_status = EnableStatus::DISABLE;
    }
    public function enable()
    {
        $this->enable_status = EnableStatus::ENABLE;
    }
}
