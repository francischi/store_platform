<?php

namespace App\Http\Merchant\Enums;

class EnableStatus
{
    public const ENABLE = "enable";
    public const DISABLE = "disable";
    public const VALID_STATUS = [
        self::ENABLE,
        self::DISABLE,
    ];
}
