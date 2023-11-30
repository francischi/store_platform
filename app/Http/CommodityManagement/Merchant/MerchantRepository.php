<?php

namespace App\Http\MerchantManagement\Merchant;

use App\Http\MerchantManagement\Merchant\Merchant as MerchantDomain;
use App\Http\MerchantManagement\Merchant\Entities\Commodity as CommodityDomain;
use App\Http\MerchantManagement\Merchant\ValueObjects\Email;
use App\Models\Merchant;
use App\Models\Commodity;

class MerchantRepository
{
    public function save(MerchantDomain $merchant_domain)
    {
        $merchant = new Merchant();
        $merchant->email = $merchant_domain->getEmail();
        $merchant->uuid = $merchant_domain->getUuid();
        $merchant->name = $merchant_domain->getName();
        $merchant->password = $merchant_domain->getPassword();
        $merchant->save();
    }
    public function saveCommodity(CommodityDomain $commodity_domain)
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
        $merchant_domain = new MerchantDomain($merchant->id, $merchant->uuid, $merchant->name, $email, null);
        return $merchant_domain;
    }
}
