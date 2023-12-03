<?php

namespace App\Http\CustomerShopping\Repos;

use App\Http\CustomerShopping\Domain\Commodity\Commodity as CommodityDomain;
use App\Http\CustomerShopping\Domain\Commodity\ValueObjects\Price;
use App\Models\Commodity;

class CommodityRepository
{
    public function getByUuid(string $uuid)
    {
        $commodity = Commodity::where('uuid', $uuid)->first();
        if (!$commodity) {
            return null;
        }
        return $this->ormToDomain($commodity);
    }
    private function ormToDomain($commodity)
    {
        $price = new Price($commodity->price, $commodity->promotion_price);
        $commodity_domain = new CommodityDomain($commodity->id, $commodity->uuid, $commodity->name, $price, $commodity->stock, $commodity->enable_status);
        return $commodity_domain;
    }
}
