<?php

namespace App\Http\Customer\Enums;

class Gender
{
    private $gender;
    public const FEMALE = 0;
    public const MALE = 1;
    public const VALID_GENDER = [
        self::FEMALE,
        self::MALE,
    ];

    public function __construct($gender) {
        if (in_array($gender, self::VALID_GENDER)) {
            throw new \Exception("invalid gender");
        }
        $this->gender = $gender;
    }

    public function get()
    {
        return $this->gender;
    }
}
