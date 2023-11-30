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
    public function create(Request $request)
    {
        Telegram::sendMessage([
            'chat_id' => config('telegram-chat-id'),
            'text' => 'Hello, this is a test message!',
        ]);
        $json = $request->json()->all();
        $name = $json['name'] ?? null;
        $email = $json['email'] ?? null;
        $password = $json['password'] ?? null;
        try {
            $this->merchant_service->create($name, $email, $password);
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'msg' => $e->getMessage(),
            ])->header('Content-Type', 'text/json');
        }

        return response([
            'success' => true,
            'msg' => '',
        ])->header('Content-Type', 'text/json');
    }
}
