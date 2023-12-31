<?php

namespace App\Http\MerchantManagement\Merchant;

use App\Http\MerchantManagement\Merchant\ValueObjects\Password;
use App\Http\MerchantManagement\Merchant\ValueObjects\Price;
use App\Http\MerchantManagement\Merchant\ValueObjects\Email;
use App\Http\MerchantManagement\Merchant\Entities\Commodity;
use Illuminate\Support\Str;

class Merchant implements \JsonSerializable
{
    private $id = null;
    private $uuid = null;
    private $name;
    private Email $email;
    private ?Password $password;
    private array $commodities;
    public function __construct(?int $id, ?string $uuid, string $name, Email $email, ?Password $password)
    {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
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
    public function jsonSerialize()
    {
        $serialized_commodities = [];
        foreach ($this->commodities as $commodity) {
            $serialized_commodities [] = $commodity->jsonSerialize();
        }
        return[
            "id" => $this->getId(),
            "uuid" => $this->getUuid(),
            "name" => $this->getName(),
            "email" => $this->getEmail(),
            "commodities" => $serialized_commodities,
        ];
    }
}
