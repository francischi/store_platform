<?php

namespace App\Http\CustomerManagement\Customer;

use App\Http\CustomerManagement\Customer\ValueObjects\BirthDate;
use App\Http\CustomerManagement\Customer\ValueObjects\Password;
use App\Http\CustomerManagement\Customer\ValueObjects\Email;
use Illuminate\Support\Str;

class Customer implements \JsonSerializable
{
    private $id = null;
    private $uuid = null;
    private $name;
    private Email $email;
    public function __construct(int $id, string $uuid, string $name, Email $email)
    {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->name = $name;
        $this->email = $email;
    }
    public function getId()
    {
        return $this->id;
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

    public function setCart()
    {
        
    }

    public function jsonSerialize()
    {
        return[
            "id" => $this->getId(),
            "uuid" => $this->getUuid(),
            "name" => $this->getName(),
            "email" => $this->getEmail(),
        ];
    }
}
