<?php

namespace App\Http\Customer;

use App\Http\Customer\CustomerRepository;
use App\Http\Customer\ValueObjects\BirthDate;
use App\Http\Common\ValueObjects\Password;
use App\Http\Common\ValueObjects\Email;
use App\Http\Customer\Customer;
use Exception;

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
            return $customer->jsonSerialize();
        }, $customers);
        return $customers;
    }
    public function create(string $name, string $email, string $password, string $birth_date)
    {
        $password_vo = new Password();
        $password_vo->setContent($password);

        $email_vo = new Email($email);

        $birth_date_vo = new BirthDate($birth_date);

        $existed_customer = $this->customer_repository->getByEmail($email_vo);
        if ($existed_customer) {
            throw new Exception("duplicated email");
        }

        $customer = new Customer(null, null, $name, $email_vo, $password_vo, $birth_date_vo);
        $customer->generateUuid();
        $customer->hashPassword();

        $this->customer_repository->save($customer);
    }
}
