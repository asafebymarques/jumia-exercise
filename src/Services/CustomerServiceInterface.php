<?php

declare(strict_types=1);

namespace Jumia\Services;

interface CustomerServiceInterface
{
    public function getCustomers(string $page): array;

    public function getCustomersWithCriteria(string $countryCode, string $state, string $page): array;
}
