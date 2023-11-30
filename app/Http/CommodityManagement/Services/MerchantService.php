<?php

namespace App\Http\MerchantManagement\Services;

use App\Http\MerchantManagement\Repos\MerchantRepository;
use App\Http\MerchantManagement\Domain\ValueObjects\Password;
use App\Http\MerchantManagement\Domain\ValueObjects\Email;
use App\Http\MerchantManagement\Domain\Merchant;

class MerchantService
{
    private MerchantRepository $merchant_repository;
    public function __construct(MerchantRepository $merchant_repository)
    {
        $this->merchant_repository = $merchant_repository;
    }
    public function create(string $name, string $email, string $password)
    {
        $password_vo = new Password();
        $password_vo->setContent($password);

        $email_vo = new Email($email);

        $existed_merchant = $this->merchant_repository->getByEmail($email_vo);
        if ($existed_merchant) {
            throw new \Exception("duplicated email");
        }

        $merchant = new Merchant(null, null, $name, $email_vo, $password_vo);
        $merchant->generateUuid();
        $merchant->hashPassword();

        $this->merchant_repository->save($merchant);
    }
}
