<?php

namespace App\Http\CommodityManagement\Domain\Merchant\ValueObjects;

use TheSeer\Tokenizer\Exception;

class Email
{
    private $content;
    public function __construct(string $content)
    {
        $this->isValid($content);
        $this->setContent($content);
    }
    private function isValid(string $content)
    {
        $splited_email = explode('@', $content);
        if (count($splited_email) != 2) {
            throw new Exception('invalid email');
        }
    }
    private function setContent(string $content)
    {
        $this->content = $content;
    }
    public function getContent()
    {
        return $this->content;
    }
}
