<?php

namespace App\Http\CustomerManagement\Customer;

use Illuminate\Routing\Controller as BaseController;
use App\Http\CustomerManagement\Customer\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends BaseController
{
    private CustomerService $customer_service;
    public function __construct(CustomerService $customer_service)
    {
        $this->customer_service = $customer_service;
    }

    public function getCart()
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

    public function addCartItem()
    {
        try {
            $this->customer_service->addCartItem();
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
            'success' => true,
            'msg' => '',
        ])->header('Content-Type', 'text/json');
    }
}
