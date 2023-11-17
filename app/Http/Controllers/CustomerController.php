<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Http\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends BaseController
{
    private CustomerService $customer_service;
    public function __construct(CustomerService $customer_service)
    {
        $this->customer_service = $customer_service;
    }

    public function getAll()
    {
        try {
            $customers = $this->customer_service->getAll();
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'msg' => $e->getMessage(),
            ])->header('Content-Type', 'text/json');
        }
        return response([
            'success' => true,
            'msg' => '',
            'result' =>  $customers,
        ])->header('Content-Type', 'text/json');
    }

    public function create(Request $request)
    {
        $json = $request->json()->all();
        $name = $json['name'] ?? null;
        $email = $json['email'] ?? null;
        $password = $json['password'] ?? null;
        $birth_date = $json['birthDate'] ?? null;
        try {
            $this->customer_service->create($name, $email, $password, $birth_date);
        } catch (\Exception $e) {
            return response([
                'success' => false,
                'msg' => $e->getMessage(),
            ])->header('Content-Type', 'text/json');
        }

        return response([
            'success' => false,
            'msg' => '',
        ])->header('Content-Type', 'text/json');
    }
}
