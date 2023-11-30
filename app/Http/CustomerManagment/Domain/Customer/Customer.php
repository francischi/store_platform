<?php

namespace App\Http\CustomerManagement\Domain\Customer;

use App\Http\CustomerManagement\Domain\Customer\ValueObjects\BirthDate;
use App\Http\CustomerManagement\Domain\Customer\ValueObjects\Password;
use App\Http\CustomerManagement\Domain\Customer\ValueObjects\Email;
use Illuminate\Support\Str;

class Customer implements \JsonSerializable
{
    private $id = null;
    private $uuid = null;
    private $name;
    private Email $email;
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
        if ($this->uuid) {
            return;
        }
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

    public function jsonSerialize()
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
