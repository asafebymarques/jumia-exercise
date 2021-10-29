<?php

namespace Jumia\Models;

use Jumia\Helpers\CountryHelper;

class Phone
{
    private string $phone;

    private string $countryCode;

    public function __construct(string $phone)
    {
        $this->phone = $phone;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function isValid(): string
    {
        $regex = $this->getRegex();

        return preg_match("/{$regex}/", $this->phone) ? 'ok' : 'nok';
    }

    public function setCountryCode(): void
    {
        foreach (CountryHelper::COUNTRIES_LIST as $code => $country) {
            if (preg_match('/\('.$code.'\)/', $this->phone)) {
                $this->countryCode = $code;
                break;
            }
        }
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getCountryNameByCode(): string
    {
        return CountryHelper::COUNTRIES_LIST[$this->countryCode]['name'];
    }

    public function getRegex(): string
    {
        return CountryHelper::COUNTRIES_LIST[$this->countryCode]['regex'];
    }
}
