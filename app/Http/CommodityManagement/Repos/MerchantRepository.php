<?php

namespace App\Http\CommodityManagement\Repos;

use App\Http\CommodityManagement\Domain\Merchant\Merchant as MerchantDomain;
use App\Http\CommodityManagement\Domain\Merchant\Entities\Commodity as CommodityDomain;
use App\Http\CommodityManagement\Domain\Merchant\ValueObjects\Email;
use App\Models\Merchant;
use App\Models\Commodity;

class MerchantRepository
{
    public function addCommodity(CommodityDomain $commodity_domain)
    {
        $commodity = new Commodity();
        $commodity->uuid = $commodity_domain->getUuid();
        $commodity->name = $commodity_domain->getName();
        $commodity->price = $commodity_domain->getPrice();
        $commodity->promotion_price = $commodity_domain->getPromotionPrice();
        $commodity->stock = $commodity_domain->getStock();
        $commodity->enable_status = $commodity_domain->getEnableStatus();
        $commodity->save();
    }

    public function getByEmail(Email $email)
    {
        $merchant = Merchant::where('email', $email->getContent())->first();
        return $this->ormToDomain($merchant);
    }
    private function ormToDomain(?Merchant $merchant)
    {
        if (!$merchant) {
            return null;
        }
        $email = new Email($merchant->email);
        $merchant_domain = new MerchantDomain($merchant->id, $merchant->uuid, $merchant->name, $email);
        return $merchant_domain;
    }
}
