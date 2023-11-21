<?php

namespace App\Http\Merchant;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Merchant\MerchantService;
use Illuminate\Http\Request;

class MerchantController extends BaseController
{
    private MerchantService $merchant_service;
    public function __construct(MerchantService $merchant_service)
    {
        $this->merchant_service = $merchant_service;
    }
    public function create(Request $request)
    {
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
