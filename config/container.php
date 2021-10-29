<?php

use DI\ContainerBuilder;
use Jumia\Models\Customer;
use Jumia\Service\CustomerService;
use Jumia\Service\CustomerServiceInterface;

$containerBuilder = new ContainerBuilder();

$containerBuilder->addDefinitions([
    CustomerServiceInterface::class => \DI\create(CustomerService::class)->constructor(\DI\get(Customer::class)),
]);

return $containerBuilder->build();
