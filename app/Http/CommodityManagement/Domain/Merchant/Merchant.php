<?php

namespace App\Http\CommodityManagement\Domain\Merchant;

use App\Http\CommodityManagement\Domain\Merchant\ValueObjects\Password;
use App\Http\CommodityManagement\Domain\Merchant\ValueObjects\Price;
use App\Http\CommodityManagement\Domain\Merchant\ValueObjects\Email;
use App\Http\CommodityManagement\Domain\Merchant\Entities\Commodity;
use Illuminate\Support\Str;

class Merchant implements \JsonSerializable
{
    private $id = null;
    private $uuid = null;
    private $name;
    private array $commodities;
    public function __construct(?int $id, ?string $uuid, string $name)
    {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->name = $name;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getUuid()
    {
        return $this->uuid;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setCommodities(array $commodities)
    {
        $this->commodities = $commodities;
    }
    public function getCommodities()
    {
        return $this->commodities;
    }
    public function addCommodity(string $name, Price $price, int $stock, string $enable_status)
    {
        $commodity = new Commodity(null, null, $name, $price, $stock, $enable_status);
        $commodity->generateUuid();
        $this->commodities [] = $commodity;
        return $commodity;
    }
    public function jsonSerialize()
    {
        $serialized_commodities = [];
        foreach ($this->commodities as $commodity) {
            $serialized_commodities [] = $commodity->jsonSerialize();
        }
        return[
            "id" => $this->getId(),
            "uuid" => $this->getUuid(),
            "name" => $this->getName(),
            "email" => $this->getEmail(),
            "commodities" => $serialized_commodities,
        ];
    }
}
