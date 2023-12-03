<?php

namespace App\Http\CommodityManagement\Services;

use App\Http\CommodityManagement\Repos\MerchantRepository;
use App\Http\CommodityManagement\Domain\Merchant\ValueObjects\Password;
use App\Http\CommodityManagement\Domain\Merchant\ValueObjects\Email;
use App\Http\CommodityManagement\Domain\Merchant\Merchant;

class MerchantService
{
    private MerchantRepository $merchant_repository;
    public function __construct(MerchantRepository $merchant_repository)
    {
        $this->merchant_repository = $merchant_repository;
    }
}
