<?php

namespace App\Http\DomainModels\Customer\ValueObjects;

use TheSeer\Tokenizer\Exception;

class Password
{
    private $content;
    const PASSWORD_RULE = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
    public function __construct(string $content)
    {
        $this->isValid($content);
        $this->content = $content;
    }
    private function isValid(string $content)
    {
        // 使用 preg_match 函數檢查字串
        if (preg_match(self::PASSWORD_RULE, $content)) {
            return;
        } else {
            throw new Exception('invalid password'); 
        }
    }

    public function getContent()
    {
        return $this->content;
    }

    public function hash()
    {
        $hash = password_hash($this->content,  
          PASSWORD_DEFAULT);
        $this->content = $hash;
    }
}