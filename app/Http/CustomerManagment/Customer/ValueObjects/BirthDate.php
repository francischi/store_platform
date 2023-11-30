<?php

namespace App\Http\CustomerManagement\Customer\ValueObjects;

use TheSeer\Tokenizer\Exception;

class BirthDate
{
    private $year;
    private $month;
    private $day;
    private $birth_date;
    public function __construct(string $birth_date)
    {
        $this->isValidBirthday($birth_date);
        $this->setDate($birth_date);
    }
    private function isValidBirthday(string $birth_date)
    {
        $splited_birth_date = explode('-', $birth_date);
        if (count($splited_birth_date) != 3) {
            throw new Exception("invalid birthday");
        }

        $year = $splited_birth_date[0];
        $month = $splited_birth_date[1];
        $day = $splited_birth_date[2];

        if (strlen($year) < 4) {
            throw new Exception("invalid birthday");
        }
        if (strlen($month) < 2) {
            throw new Exception("invalid birthday");
        }
        if (intval($month) < 0 || intval($month) > 12) {
            throw new Exception("invalid birthday");
        }
        if (strlen($day) < 2) {
            throw new Exception("invalid birthday");
        }
    }
    public function getContent()
    {
        return $this->birth_date;
    }
    private function setDate(string $birth_date)
    {
        $splited_birth_date = explode('-', $birth_date);
        $this->birth_date = $birth_date;
        $this->year = $splited_birth_date[0];
        $this->month = $splited_birth_date[1];
        $this->date = $splited_birth_date[2];
    }
    public function toAge()
    {
        $date = new \DateTime($this->birth_date);
        $now = new \DateTime();
        $interval = $now->diff($date);
        return $interval->y;
    }
}
