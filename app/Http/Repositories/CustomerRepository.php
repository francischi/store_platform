<?php

namespace App\Http\Repositories;

use App\Http\DomainModels\Customer\Customer as CustomerDomain;
use App\Http\DomainModels\Customer\ValueObjects\Email;
use App\Http\DomainModels\Customer\ValueObjects\BirthDate;
use App\Models\Customer;

class CustomerRepository
{
    public function __construct()
    {
        return;
    }

    public function save(CustomerDomain $customer_domain)
    {
        $customer = new Customer();
        $customer->uuid = $customer_domain->getUuid();
        $customer->name = $customer_domain->getName();
        $customer->email = $customer_domain->getEmail();
        $customer->birth_date = $customer_domain->getBirthDate();
        $customer->password = $customer_domain->getPassword();
        $customer->save();
    }

    public function getAll()
    {
        $customers = Customer::all();
        $customers = $customers->map(function ($customer) {
            return $this->ormToDomain($customer);
        })->toArray();


        return $customers;
    }

    public function getByEmail(Email $email)
    {
        $customer = Customer::where('email', $email->getContent())->get();
        return $this->ormToDomain($customer);
    }
    private function ormToDomain(Customer $customer)
    {
        $email = new Email($customer->email);
        $birth_date = new BirthDate($customer->birth_date);
        $customer_domain = new CustomerDomain($customer->id, $customer->uuid, $customer->name, $email, null, $birth_date);
        return $customer_domain;
    }
}
