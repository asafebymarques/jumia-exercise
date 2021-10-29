<?php

namespace Jumia\Tests;

use Jumia\Models\Customer;
use PHPUnit\Framework\TestCase;

class CustomerTest extends TestCase
{
    public function testGetCustomersFromDB(): void
    {
        $customers = (new Customer())->getCustomers(1);

        $this->assertIsArray($customers);
    }
}
