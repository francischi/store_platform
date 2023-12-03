<?php

namespace App\Http\MerchantManagement\Merchant;

use Illuminate\Routing\Controller as BaseController;
use App\Http\MerchantManagement\Merchant\MerchantService;
use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;

class MerchantController extends BaseController
{
    private MerchantService $merchant_service;
    public function __construct(MerchantService $merchant_service)
    {
        $this->merchant_service = $merchant_service;
    }
}
