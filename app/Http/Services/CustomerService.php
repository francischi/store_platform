<?php

namespace App\Http\Services;

use App\Http\Repositories\CustomerRepository;
use App\Http\DomainModels\Customer\ValueObjects\BirthDate;
use App\Http\DomainModels\Customer\ValueObjects\Password;
use App\Http\DomainModels\Customer\ValueObjects\Email;
use App\Http\DomainModels\Customer\Customer;

class CustomerService
{
    private $customer_repository;
    public function __construct(CustomerRepository $customer_repository)
    {
        $this->customer_repository = $customer_repository;
    }

    public function getAll()
    {
        $customers = $this->customer_repository->getAll();
        $customers = array_map(function ($customer) {
            return $customer->serialize();
        }, $customers);
        return $customers;
    }
    public function create($name, $email, $password, $birth_date)
    {
        $password = new Password($password);
        $email = new Email($email);
        $birth_date = new BirthDate($birth_date);
        $customer = new Customer(null, null, $name, $email, $password, $birth_date);
        $customer->generateUuid();
        $customer->hashPassword();
        $this->customer_repository->save($customer);
    }
}
