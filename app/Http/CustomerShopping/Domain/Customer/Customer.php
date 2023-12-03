<?php

namespace App\Http\CustomerShopping\Domain\Customer;

use App\Http\CustomerShopping\Domain\Customer\ValueObjects\Email;
use App\Http\CustomerShopping\Domain\Customer\Entities\Cart;
use App\Http\CustomerShopping\Domain\Customer\Events\AddCartItem;
use App\Http\CustomerShopping\Domain\Commodity\Commodity;
use Illuminate\Support\Str;

class Customer implements \JsonSerializable
{
    private $id = null;
    private $uuid = null;
    private $name;
    private Email $email;
    private Cart $cart;
    public function __construct(int $id, string $uuid, string $name, Email $email, Cart $cart)
    {
        $this->id = $id;
        $this->uuid = $uuid;
        $this->name = $name;
        $this->email = $email;
        $this->cart = $cart;
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

    public function addIntoCart(Commodity $commodity, int $quantity)
    {
        $cartItem = $this->cart->addItem($commodity, $quantity);
        return new AddCartItem($this, $cartItem);
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
