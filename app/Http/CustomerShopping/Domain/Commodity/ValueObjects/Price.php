<?php

namespace App\Http\CustomerShopping\Domain\Commodity\ValueObjects;

use TheSeer\Tokenizer\Exception;

class Price
{
    private $price;
    private $promotion_price;
    public function __construct(int $price, int $promotion_price)
    {
        $this->isValid($price, $promotion_price);
        $this->price = $price;
        $this->promotion_price = $promotion_price;
    }
    private function isValid(int $price, int $promotion_price)
    {
        if ($price == 0) {
            throw new \Exception("invalid price");
        }
        if ($promotion_price == 0) {
            throw new \Exception("invalid promotion price");
        }
    }
    public function getPromotionPrice()
    {
        return $this->promotion_price;
    }
    public function getPrice()
    {
        return $this->price;
    }
    public function getPromotionRate()
    {
        return $this->promotion_price / $this->price;
    }
}
