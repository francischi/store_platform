<?php

namespace App\Http\DomainModels\Customer;

use App\Http\DomainModels\Customer\ValueObjects\BirthDate;
use App\Http\DomainModels\Customer\ValueObjects\Password;
use App\Http\DomainModels\Customer\ValueObjects\Email;
use Illuminate\Support\Str;

class Customer
{
    private $id = null;
    private $uuid = null;
    private $name;
    private ?Password $password;
    private BirthDate $birth_date;
    public function __construct(?int $id, ?string $uuid, string $name, Email $email, ?Password $password, BirthDate $birth_date)
    {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->birth_date = $birth_date;
    }
    public function getId()
    {
        return $this->id;
    }
    public function generateUuid()
    {
        $this->uuid = Str::uuid()->toString();
    }
    public function getUuid()
    {
        return $this->uuid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email->getContent();
    }

    public function getPassword()
    {
        return $this->password ? $this->password->getContent() : null;
    }

    public function hashPassword()
    {
        $this->password->hash();
    }

    public function getBirthDate()
    {
        return $this->birth_date->getContent();
    }
    public function getAge()
    {
        return $this->birth_date->toAge();
    }

    public function serialize()
    {
        return[
            "id" => $this->getId(),
            "uuid" => $this->getUuid(),
            "name" => $this->getName(),
            "email" => $this->getEmail(),
            "birth_date" => $this->getBirthDate(),
        ];
    }
}
