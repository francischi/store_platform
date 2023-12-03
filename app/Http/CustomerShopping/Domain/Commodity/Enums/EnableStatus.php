<?php

namespace App\Http\CustomerShopping\Domain\Commodity\Enums;

class EnableStatus
{
    public const ENABLE = "enable";
    public const DISABLE = "disable";
    public const VALID_STATUS = [
        self::ENABLE,
        self::DISABLE,
    ];
}
