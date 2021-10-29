<?php

namespace Jumia\Tests;

use Jumia\Models\Phone;
use PHPUnit\Framework\TestCase;

class PhoneTest extends TestCase
{
    public function testGetPhone(): void
    {
        $phone = new Phone('(212) 698054317');

        $this->assertEquals('(212) 698054317', $phone->getPhone());
    }

    public function testPhoneIsValid(): void
    {
        $phone = new Phone('(212) 698054317');
        $phone->setCountryCode();
        $result = $phone->isValid();

        $this->assertEquals('ok', $result);
    }

    public function testPhoneCode(): void
    {
        $phone = new Phone('(212) 698054317');
        $phone->setCountryCode();
        $result = $phone->getCountryCode();

        $this->assertEquals('212', $result);
    }

    public function testGetCountryNameByPhone(): void
    {
        $phone = new Phone('(212) 698054317');
        $phone->setCountryCode();
        $result = $phone->getCountryNameByCode();

        $this->assertEquals('Morocco', $result);
    }

    public function testGetRegex(): void
    {
        $phone = new Phone('(212) 698054317');
        $phone->setCountryCode();
        $result = $phone->getRegex();

        $this->assertEquals('\(212\)\ ?[5-9]\d{8}$', $result);
    }
}
