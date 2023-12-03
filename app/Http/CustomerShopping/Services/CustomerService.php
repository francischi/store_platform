<?php

namespace App\Http\CustomerShopping\Services;

use App\Http\CustomerShopping\Repos\CustomerRepository;
use App\Http\CustomerShopping\Repos\CommodityRepository;
use Exception;

class CustomerService
{
    private $customer_repository;
    private $commodity_repository;
    public function __construct(CustomerRepository $customer_repository, CommodityRepository $commodity_repository)
    {
        $this->customer_repository = $customer_repository;
        $this->commodity_repository = $commodity_repository;
    }
    public function addCartItems(string $customerUuid, string $productId, int $quantity)
    {
        $customer = $this->customer_repository->getByUuid($customerUuid);
        if (!$customer) {
            throw new Exception('no matched member');
        }
        $commodity = $this->commodity_repository->getByUuid($productId);
        if (!$commodity) {
            throw new Exception('no matched commodity');
        }
        $event = $customer->addIntoCart($commodity, $quantity);
        $this->customer_repository->addCartItem($event);
    }
}
