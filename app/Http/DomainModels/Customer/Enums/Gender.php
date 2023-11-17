<?php

namespace App\Http\DomainModels\Customer\Enums;

class Gender
{
    private $gender;
    const FEMALE = 0;
    const MALE = 1;
    const VALID_GENDER = [
        self::FEMALE,
        self::MALE,
    ];

    public function __construct($gender) {
        if (in_array($gender, self::VALID_GENDER)) {
            throw new Exception("invalid gender");
        }
        $this->gender = $gender;
    }

    public function get()
    {
        return $this->gender;
    }
}
